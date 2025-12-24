<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Feedback extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'message', 'is_reviewed'];

    protected $casts = [
        'is_reviewed' => 'boolean',
    ];

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function scopeReviewed($query)
    {
        return $query->where('is_reviewed', true);
    }
}
