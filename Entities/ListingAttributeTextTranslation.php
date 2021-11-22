<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class listingAttributeTextTranslation extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'listing_attribute_text_translation';
	
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingAttributeTextTranslationFactory::new();
    }
}
