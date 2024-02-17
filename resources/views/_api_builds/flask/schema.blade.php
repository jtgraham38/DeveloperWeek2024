from database import {{ $project->entities->pluck('singular_name')->implode(', ') }}
from marshmallow_sqlalchemy import SQLAlchemyAutoSchema

@foreach ($project->entities as $entity)
class {{ $entity->singular_name }}Schema(SQLAlchemyAutoSchema):
    class Meta:
        model = {{ $entity->singular_name }}
        load_instance = True
@endforeach