<?php

namespace App\Models;

use Filament\Support\Actions\Concerns\HasForm;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Contract extends Model {
    use HasFactory, HasForm, SoftDeletes;

    protected $fillable = [
        'user_id',
        'events_id',
        'type',
        'email',
        'customer_name',
        'items',
        'title',
        'description',
        'contracts_content',
        'sent',
        'opened',
        'signed',
        'signe_data',
        'contract_url',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    public function getTotalPriceAttribute(): int
    {

        return Collection::make($this->items)->map(function ($item) {
            return $item['price'] * $item['count'];
        })->sum();


    }


    public function event(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Events::class, 'events_id');
    }

}
