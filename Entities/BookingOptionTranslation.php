<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingOptionTranslation extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'booking_option_translation';
    
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\BookingOptionTranslationFactory::new();
    }
}
