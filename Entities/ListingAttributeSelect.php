<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingAttributeSelect extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'listing_attribute_select';
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingAttributeSelectFactory::new();
    }
	
	public function listing_attribute_option_translation()
    {
        return $this->hasOne(ListingAttributeOptionTranslation::class, 'translatable_id', 'attribute_option')->where('locale', app()->getLocale());
    } 

}
