<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'price', 'desc', 'category_menu_id', 'image'];

    public function getHargaAttribute()
    {
        return "Rp. " . Number::format($this->price, locale: 'id');
    }
    public function getDesclimitAttribute()
    {
        return Str::of($this->desc)->limit(50, ' ...');
    }
    public function getImgAttribute()
    {
        return $this->image ? url('storage', $this->image) : url('empty-image.png');
    }

    public function categoryMenu(): BelongsTo
    {
        return $this->belongsTo(CategoryMenu::class);
    }
}
