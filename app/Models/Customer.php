<?php

namespace App\Models;

use Filament\Support\Actions\Concerns\HasForm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, HasForm, SoftDeletes;

    protected $fillable =[
        'creator_id',
        'first_name',
        'last_name',
        'uid',
        'phone',
        'email',
        'city',
        'address',
    ];

    protected $casts = [
        'creator_id' => 'integer',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function events(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Events::class, 'customer_id');
    }

    public function contracts()
    {
        return $this->hasManyThrough(
            Contract::class,
            Events::class,
            'customer_id',
            'events_id',
            'id',
            'id'
        );
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
