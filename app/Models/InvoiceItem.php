<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    use HasFactory;

    public static function getForm(): array
    {
        return [
            Select::make('invoice_id')
                ->relationship('invoice', 'id')
                ->required(),
            Select::make('customer_id')
                ->relationship('customer', 'name')
                ->required(),
            Select::make('product_id')
                ->relationship('product', 'name')
                ->required(),
            TextInput::make('currency')
                ->required()
                ->maxLength(255),
            TextInput::make('subtotal_amount')
                ->required()
                ->numeric(),
            TextInput::make('subtax_amount')
                ->required()
                ->numeric(),
        ];
    }

    public static function backAction()
    {
        return Action::make('back')
            ->label('Back')
            ->color('warning')
            ->url(route('filament.admin.resources.invoice-items.index', Filament::getTenant()));
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
