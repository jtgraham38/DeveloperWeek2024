<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Route;
use App\Models\EntityAttribute;
use App\Models\Build;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'table_name',
        'is_private',   //user's can only access instances of this entity that they own
        'build_id'
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
        return $this->belongsTo(Build::class);
    }
}
