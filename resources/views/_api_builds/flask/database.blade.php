from flask_sqlalchemy import SQLAlchemy

db = SQLAlchemy()

@foreach ($project->entities as $entity)
class {{ $s . $entity->singular_name }}(db.Model):
    __tablename__ = '{{ $entity->table_name }}'
@foreach ($entity->attributes as $attribute)
    {{ $attribute->name }} = db.Column(db.@if ($attribute->type == 'boolean')Boolean @elseif ($attribute->type == 'int')Integer @elseif (1 == 1)Unicode @else THIS WILL NEVER BE REACHED! @endif, {{ $attribute->is_key ? 'primary_key=True' : 'nullable=False' }})
@endforeach
@endforeach


#TODO: ADD FOREIGN KEY CHECKS