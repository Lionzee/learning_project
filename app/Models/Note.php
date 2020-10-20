<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use FullTextSearch;

    protected $table = 'notes';

    protected $fillable = [
        'topic_id', 'title', 'description','url','origin_id','is_public'
    ];

    protected $searchable = [
        'title','description'
    ];
}
