<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['invoice', 'customer_id', 'items', 'total', 'desc', 'is_done'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function scopeDone($query): Builder
    {
        return $query->where('is_done', true);
    }

    public function casts()
    {
        return [
            'items' => 'array',
            'is_done' => 'boolean',
        ];
    }
}
