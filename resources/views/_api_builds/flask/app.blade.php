#make imports
import json
from flask import Flask, jsonify, abort, request, redirect, url_for, render_template
from flask_sqlalchemy import SQLAlchemy
from sqlalchemy import inspect
from marshmallow.exceptions import ValidationError
from marshmallow_sqlalchemy import fields
from dotenv import load_dotenv
import os, sys

#import models and schema
from database import db, {{ ($project->entities->isEmpty() ? '' : $s) . $project->entities->pluck('singular_name')->implode(', ' . $s) }}
from schema import {{ ($project->entities->isEmpty() ? '' : $s) . $project->entities->pluck('singular_name')->implode('Schema, ' . $s) . "Schema" }}

#load environment
load_dotenv()

#load environment variables
db_user = os.getenv('db_user')
db_password = os.getenv('db_password')
db_host = os.getenv('db_host')
db_name = os.getenv('db_name')
db_filename = os.getenv('db_filename')

# configure this web application
app = Flask(__name__)
app.config['SEND_FILE_MAX_AGE_DEFAULT'] = 0
app.config['SECRET_KEY'] = "{{ Illuminate\Support\Str::random(40) }}"
app.config['ENV'] = 'production'
app.config['CSRF_ENABLED'] = True
app.config['SESSION_COOKIE_SECURE'] = True
app.config['SESSION_COOKIE_HTTPONLY'] = True


#configure the app database
@if($project->db_type == "sqlite")
scriptdir = os.path.dirname(os.path.abspath(__file__))  #add the directory with this script to the Python path
sys.path.append(scriptdir)  #identify the full path to the database file
db_file = os.path.join(scriptdir, db_filename)

app.config['SQLALCHEMY_DATABASE_URI'] = f"sqlite:///{db_file}"
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
@else
app.config['SQLALCHEMY_DATABASE_URI'] = f'{{ $project->db_type }}{{ $project->db_type == "mysql" ? "+mysqlconnector" : "" }}://{ db_user }:{ db_password }@{ db_host }/{ db_name }'
@endif


#initialize database
db.init_app(app)

#documentation route
@app.get("/")
def redirect_docs():
    return redirect(url_for('documentation'))
@app.get("/docs")
def documentation():
    domain_name = request.host.split(':')[0]
    return render_template('docs.html', domain_name=domain_name)


#api endpoint definition
api_endpoint = "/api"


@foreach($project->entities as $entity)

#create route
@app.post(api_endpoint + "/{{ $entity->multiple_name }}")
def {{ $s . $entity->multiple_name }}_create():
    #get schema
    schema = {{ $s . $entity->singular_name }}Schema()

    #validate input and create model, or return error
    try:
        model = schema.load(request.json, session=db.session)
    except ValidationError as err:
        return abort(jsonify({'error': err.messages}), 400)

    #save the model
    db.session.add(model)
    db.session.commit()

    #assemble response
    response = {
        "msg": "Record created.",
        "data": schema.dump(model)
    }

    #return message and result
    return jsonify(response)

#get listing route
@app.get(api_endpoint + "/{{ $entity->multiple_name }}")
def {{ $s . $entity->multiple_name }}_index():
    #get record ids
    index = {{ $s . $entity->singular_name }}.query.all()
    ids = [ model.id for model in index]

    #assemble result
    response = {
        "msg": "Records retrieved.",
        "count": len(ids),
        "data": ids
    }

    #return result
    return jsonify(response)
    


#get specific route
@app.get(api_endpoint + "/{{ $entity->multiple_name }}/<id>")
def {{ $s . $entity->multiple_name }}_get(id):
#get record and schema
    model = {{ $s . $entity->singular_name }}.query.get(id)
    schema = {{ $s . $entity->singular_name }}Schema()

    #return 404 if not found
    if not model:
        abort(404)

    #use schema
    result = schema.dump(model)

    #assemble response
    response = {
        "msg": "Record retrieved.",
        "data": result
    }

    #return result
    return jsonify(response)

#update route
@app.route(api_endpoint + "/{{ $entity->multiple_name }}/<id>", methods=["PUT", "PATCH"])
def {{ $s . $entity->multiple_name }}_update(id):
    #get record and schema
    model = {{ $s . $entity->singular_name }}.query.get(id)
    schema = {{ $s . $entity->singular_name }}Schema()

    #return 404 if not found
    if not model:
        abort(404)

    #validate submitted data
    try:
        patch_data = schema.load(request.json, session=db.session, partial=True)
    except ValidationError as err:
        return jsonify({'error': err.messages}), 400
    
    #validate input and update model
    for field_name, field in schema.fields.items():


        field_value = getattr(patch_data, field_name, None)
        if field_value is not None:
            # Update the corresponding attribute of the user object
            setattr(model, field_name, field_value)

    #save the model
    db.session.add(model)
    db.session.commit()

    #assemble response
    response = {
        "msg": "Record updated.",
        "data": schema.dump(model)
    }

    #return message and result
    return jsonify(response)

    #delete route
@app.route(api_endpoint + "/{{ $entity->multiple_name }}/<id>", methods=["DELETE"])
def {{ $s . $entity->multiple_name }}_delete(id):
    #get record and schema
    model = {{ $s . $entity->singular_name }}.query.get(id)
    schema = {{ $s . $entity->singular_name }}Schema()

    #return 404 if not found
    if not model:
        abort(404)

    #delete record
    db.session.delete(model)
    db.session.commit()

    #use schema
    result = schema.dump(model)

    #assemble response
    response = {
        "msg": "Record deleted.",
        "data": result
    }

    #return response
    return jsonify(response)

@endforeach


if __name__ == '__main__':
    #check if tables exist in the database
    with app.app_context():
        inspector = inspect(db.engine)
        existing_tables = inspector.get_table_names()

    #create tables only if they don't exist
    if not existing_tables:
        with app.app_context():
            db.create_all()
        print("Tables created successfully.")
    else:
        print("Tables already exist in the database.")

    #run the app
    app.run()
