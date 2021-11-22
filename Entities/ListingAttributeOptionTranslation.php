<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingAttributeOptionTranslation extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'listing_attribute_option_translation';
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingAttributeOptionTranslationFactory::new();
    }
}
