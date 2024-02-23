from flask_sqlalchemy import SQLAlchemy

db = SQLAlchemy()

@foreach ($project->entities as $entity)
class {{ $s . $entity->singular_name }}(db.Model):
    __tablename__ = '{{ $entity->table_name }}'
@foreach ($entity->attributes as $attribute)
@if ($attribute->type == 'boolean')
    {{ $attribute->name }} = db.Column(db.Boolean, {!! isset($attribute->foreign_attribute) ? 'db.ForeignKey("' . $attribute->foreign_attribute->entity->table_name . '.' . $attribute->foreign_attribute->name . '"),' : '' !!} {{ $attribute->is_key ? 'primary_key=True' : 'nullable=False' }})
@if(isset($attribute->foreign_attribute))
    {{ $attribute->foreign_attribute->entity->singular_name }} = db.relationship('{{ $s . $attribute->foreign_attribute->entity->singular_name }}', backref='{{ $entity->multiple_name }}')
@endif

@elseif ($attribute->type == 'int')
    {{ $attribute->name }} = db.Column(db.Integer, {!! isset($attribute->foreign_attribute) ? 'db.ForeignKey("' . $attribute->foreign_attribute->entity->table_name . '.' . $attribute->foreign_attribute->name . '"),' : '' !!} {{ $attribute->is_key ? 'primary_key=True' : 'nullable=False' }})
@if(isset($attribute->foreign_attribute))
    {{ $attribute->foreign_attribute->entity->singular_name }} = db.relationship('{{ $s . $attribute->foreign_attribute->entity->singular_name }}', backref='{{ $entity->multiple_name }}')
@endif
@else
    {{ $attribute->name }} = db.Column(db.Unicode, {!! isset($attribute->foreign_attribute) ? 'db.ForeignKey("' . $attribute->foreign_attribute->entity->table_name . '.' . $attribute->foreign_attribute->name . '"),' : '' !!} {{ $attribute->is_key ? 'primary_key=True' : 'nullable=False' }})
@if(isset($attribute->foreign_attribute))
    {{ $attribute->foreign_attribute->entity->singular_name }} = db.relationship('{{ $s . $attribute->foreign_attribute->entity->singular_name }}', backref='{{ $entity->multiple_name }}')
@endif
@endif

   
@endforeach
@endforeach


#TODO: ADD FOREIGN KEY CHECKS
#{{ $attribute->name }} = db.Column(db.@if ($attribute->type == 'boolean')Boolean @elseif ($attribute->type == 'int')Integer @elseif (1 == 1)Unicode @else THIS WILL NEVER BE REACHED! @endif, {{ $attribute->is_key ? 'primary_key=True' : 'nullable=False' }})