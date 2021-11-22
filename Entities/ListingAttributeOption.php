<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingAttributeOption extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'listing_attribute_option'; 
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingAttributeOptionFactory::new();
    }
	public function listing_attribute_option_translation()
    {
        return $this->hasMany(ListingAttributeOptionTranslation::class, 'translatable_id', 'id')->where('locale', app()->getLocale());
    } 
}
