<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Project;

class Build extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
