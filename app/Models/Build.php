<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Entity;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Build extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function entities()
    {
        return $this->hasMany(Entity::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
