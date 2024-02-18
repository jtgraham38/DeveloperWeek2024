<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Route;
use App\Models\EntityAttribute;
use App\Models\Project;

class Entity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'display_name',
        'description',
        'table_name',
        'singular_name',
        'multiple_name',
        'is_private',   //user's can only access instances of this entity that they own
        'project_id'
    ];

    public function routes()
    {
        return $this->hasMany(Route::class);
    }

    public function attributes()
    {
        return $this->hasMany(EntityAttribute::class);
    }

    public function build()
    {
        return $this->belongsTo(Project::class);
    }
}
