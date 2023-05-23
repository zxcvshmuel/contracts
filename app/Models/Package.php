<?php

namespace App\Models;

use Filament\Support\Actions\Concerns\HasForm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory, HasForm;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // relation to user
    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_package')->withPivot('started_at', 'expired_at')
            ->withTimestamps();
    }


}
