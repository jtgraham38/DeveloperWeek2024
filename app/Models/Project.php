<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Entity;
use App\Models\User;
use App\Models\Build;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'db_type',
        'output_type',
        'user_id'
    ];

    public function builds()
    {
        return $this->hasMany(Build::class);
    }
    public function entities()
    {
        return $this->hasMany(Entity::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
