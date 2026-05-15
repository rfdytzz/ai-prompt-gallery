<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prompt extends Model
{
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tag() {
        return $this->belongsTo(Tag::class);
    }
}
