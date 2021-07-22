<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Task extends Model
{
    use HasFactory;

    protected $casts = [
        'done_at' => 'datetime',
    ];

    protected $fillable = [
        'title',
        'content',
        'attachment',
        'done_at'
    ];

    public function getAttachmentUrlAttribute()
    {
        if ($this->attachment) {
            return Storage::url($this->attachment);
        }

        return $this->attachment;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
