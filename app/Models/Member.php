<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    protected $fillable = [
        'name',
        'nim',
        'role',
        'email',
        'phone',
        'bio',
        'skills',
        'photo',
        'github_url',
        'linkedin_url',
        'instagram_url',
        'order',
    ];

    protected $appends = [
        'skills_array',
        'photo_url',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getSkillsArrayAttribute(): array
    {
        if (empty($this->skills)) {
            return [];
        }

        if (is_array($this->skills)) {
            return $this->skills;
        }

        $decoded = json_decode($this->skills, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }

        return array_map('trim', explode(',', $this->skills));
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            if (filter_var($this->photo, FILTER_VALIDATE_URL)) {
                return $this->photo;
            }
            if (Storage::disk('public')->exists($this->photo)) {
                return Storage::disk('public')->url($this->photo);
            }
            if (file_exists(public_path('storage/'.$this->photo))) {
                return asset('storage/'.$this->photo);
            }
        }

        $colors = ['6366f1', 'ec4899', '14b8a6', 'f59e0b', '8b5cf6', '3b82f6'];
        $color = $colors[abs(crc32($this->name ?? 'User')) % count($colors)];

        return 'https://ui-avatars.com/api/?name='.urlencode($this->name ?? 'Member').'&background='.$color.'&color=ffffff&size=300&font-size=0.38';
    }
}
