<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Entity;

class EntityAttribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'is_key',
        'foreign_id',
        'entity_id',
    ];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function referencing_attributes()
    {
        return $this->hasMany(EntityAttribute::class, 'foreign_id');
    }

    public function foreign_attribute()
    {
        return $this->belongsTo(EntityAttribute::class, 'foreign_id');
    }
}
