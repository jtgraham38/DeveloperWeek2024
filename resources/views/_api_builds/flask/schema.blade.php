from database import {{ ($project->entities->isEmpty() ? '' : $s) . $project->entities->pluck('singular_name')->implode(', ' . $s) }}
from marshmallow_sqlalchemy import SQLAlchemyAutoSchema

@foreach ($project->entities as $entity)
class {{ $s . $entity->singular_name }}Schema(SQLAlchemyAutoSchema):
    class Meta:
        model = {{ $s . $entity->singular_name }}
        load_instance = True
        include_fk = True
@endforeach