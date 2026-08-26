<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'price', 'clicks'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Panggil method ini setiap kali produk diklik/dibuka oleh user,
     * misalnya di ProductController@show.
     */
    public function incrementClicks(): void
    {
        $this->increment('clicks');
    }
}
