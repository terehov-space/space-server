<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'tag_id',
        'created_by',
        'assigned_to',
        'deleted',
    ];

    public function tag()
    {
        return $this->belongsTo('App\Models\Tag', 'tag_id', 'id');
    }
}
