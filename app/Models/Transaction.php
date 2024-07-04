<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['customer_id', 'items', 'total', 'desc', 'is_done'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function casts()
    {
        return [
            'items' => 'array',
            'is_done' => 'boolean',
        ];
    }
}
