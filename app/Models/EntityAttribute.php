<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Entity;

class EntityAttribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'is_key',
        'is_foreign',
        'entity_id',
    ];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
