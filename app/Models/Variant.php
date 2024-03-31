<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Variant extends Model
{
    use HasFactory;


    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    // public function currency(): BelongsTo
    // {
    //     return $this->belongsTo(Currency::class);
    // }

    // public function attributes(): BelongsToMany
    // {
    //     return $this->belongsToMany(Attribute::class, 'attribute_variant')->withPivot('attribute_value_id')->withTimestamps();
    // }

    // public function attributeValues(): BelongsToMany
    // {
    //     return $this->belongsToMany(AttributeValue::class, 'attribute_variant')->withPivot('attribute_value_id')->withTimestamps();
    // }
}
