<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class listingAttributeText extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'listing_attribute_text';
	
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingAttributeTextFactory::new();
    }
	public function listing_attribute_text_translation()
    {
        return $this->hasOne(listingAttributeTextTranslation::class, 'translatable_id', 'id')->where('locale', app()->getLocale());
    } 
	
}
