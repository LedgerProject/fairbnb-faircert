<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingOption extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'booking_option';

    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\BookingOptionFactory::new();
    }

    public function booking_option_translation()
    {
        return $this->belongsTo(BookingOptionTranslation::class, 'id', 'translatable_id')->where('locale', app()->getLocale());
    }

}
