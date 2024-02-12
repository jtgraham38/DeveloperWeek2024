<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Entity;

class Route extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'type',
        'checks',
        'entity_id'
    ];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
