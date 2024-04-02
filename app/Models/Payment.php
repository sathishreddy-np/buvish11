<?php

namespace App\Models;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $casts = [
        'transaction_details' => 'json',
    ];

    public static function getForm(): array
    {
        return [
            Section::make()->schema([
                Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('invoice_id')
                    ->label('Invoice Id')
                    ->relationship('invoice', 'invoice_id')
                    ->prefix('#')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('amount_paid')
                    ->required()
                    ->numeric(),
                TextInput::make('payment_gateway')
                    ->required()
                    ->maxLength(255),
                TextInput::make('transaction_reference')
                    ->required()
                    ->numeric(),
                TextInput::make('transaction_mode')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('transaction_date')
                    ->required(),
                KeyValue::make('transaction_details')
                    ->required()
                    ->deletable(false)
                    ->addable(false)
                    ->columnSpanFull(),

            ])->columnSpanFull()->columns(2)

        ];
    }

    public static function backAction()
    {
        return Action::make('back')
            ->label('Back')
            ->color('warning')
            ->url(route('filament.admin.resources.payments.index', Filament::getTenant()));
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}
