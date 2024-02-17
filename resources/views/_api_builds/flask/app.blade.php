import json
from flask import Flask, jsonify, abort, request
from flask_sqlalchemy import SQLAlchemy
from marshmallow.exceptions import ValidationError
from marshmallow_sqlalchemy import fields

from database import db, seed_db, {{ $project->entities->pluck('singular_name')->implode(', ') }}
from schema import {{ $project->entities->pluck('singular_name')->implode('Schema, ') . "Schema" }}


# identify the script directory to locate the database and helper files
import os, sys
scriptdir = os.path.dirname(os.path.abspath(__file__))
# add the directory with this script to the Python path
sys.path.append(scriptdir)
# identify the full path to the database file
dbfile = os.path.join(scriptdir, "db.sqlite3")

# configure this web application, and intialize it
app = Flask(__name__)
app.config['SEND_FILE_MAX_AGE_DEFAULT'] = 0
app.config['SECRET_KEY'] = "{{ Illuminate\Support\Str::random(20) }}"
app.config['SQLALCHEMY_DATABASE_URI'] = f"sqlite:///{dbfile}"
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db.init_app(app)

#documentation route
@app.get("/")
def documentation():
    return "Put documentation generator here."


#api endpoint definition
api_endpoint = "/api"


@foreach($project->entities as $entity)

#create route
@app.post(api_endpoint + "/{{ $entity->table_name }}")
def {{ $entity->singular_name }}_create():
    #get schema
    schema = {{ $entity->singular_name }}Schema()

    #validate input and create model, or return error
    try:
        model = schema.load(request.json, session=db.session)
    except ValidationError as err:
        return jsonify(jsonify({'error': err.messages}), 400)

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
@app.get(api_endpoint + "/{{ $entity->table_name }}")
def {{ $entity->singular_name }}_index():
    #get record ids
    index = {{ $entity->singular_name }}.query.all()
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
@app.get(api_endpoint + "/{{ $entity->table_name }}/<id>")
def {{ $entity->singular_name }}_get(id):
#get record and schema
    model = {{ $entity->singular_name }}.query.get(id)
    schema = {{ $entity->singular_name }}Schema()

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
@app.route(api_endpoint + "/{{ $entity->table_name }}/<id>", methods=["PUT", "PATCH"])
def {{ $entity->singular_name }}_update(id):
    #get record and schema
    model = {{ $entity->singular_name }}.query.get(id)
    schema = {{ $entity->singular_name }}Schema()

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
@app.route(api_endpoint + "/{{ $entity->table_name }}/<id>", methods=["DELETE"])
def {{ $entity->singular_name }}_delete(id):
    #get record and schema
    model = {{ $entity->singular_name }}.query.get(id)
    schema = {{ $entity->singular_name }}Schema()

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
    #seed_db(app)
    app.run()
