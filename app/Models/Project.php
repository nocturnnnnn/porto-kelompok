<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'description',
        'image',
        'member_id',
        'tech_stack',
        'demo_url',
        'github_url',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    protected $appends = [
        'tech_stack_array',
        'image_url',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title).'-'.Str::random(5);
            }
        });
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function getTechStackArrayAttribute(): array
    {
        if (empty($this->tech_stack)) {
            return [];
        }

        if (is_array($this->tech_stack)) {
            return $this->tech_stack;
        }

        $decoded = json_decode($this->tech_stack, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }

        return array_map('trim', explode(',', $this->tech_stack));
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                return $this->image;
            }
            if (Storage::disk('public')->exists($this->image)) {
                return Storage::disk('public')->url($this->image);
            }
            if (file_exists(public_path('storage/'.$this->image))) {
                return asset('storage/'.$this->image);
            }
        }

        return 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&auto=format&fit=crop&q=80';
    }
}
