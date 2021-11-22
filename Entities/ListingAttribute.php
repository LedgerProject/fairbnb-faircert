<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingAttribute extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'listing_attribute';
    
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingAttributeFactory::new();
    }
	
    public function attribute()
    {

        return $this->hasMany(Attributes::class,'id','attribute_id');
    }
	public function listing_attribute_number()
    {
        return $this->hasOne(ListingAttributeNumber::class, 'id', 'id');
    }
	
	public function listing_attribute_switch()
    {
        return $this->hasOne(ListingAttributeSwitch::class, 'id', 'id');
    }
	
	public function listing_attribute_date()
    {
        return $this->hasOne(ListingAttributeDate::class, 'id', 'id');
    }
	public function listing_attribute_text()
    {
        return $this->hasOne(ListingAttributeText::class, 'id', 'id');
    } 
	public function listing_attribute_select()
    {
        return $this->hasMany(ListingAttributeSelect::class, 'id', 'id');
    } 
	public function listing_attribute_option()
    {
        return $this->hasMany(ListingAttributeOption::class, 'attribute_id', 'id');
    } 
	public function listing_attribute_text_translation()
    {
        return $this->hasOne(ListingAttributeTextTranslation::class, 'translatable_id', 'id')->where('locale', app()->getLocale());
    } 
 
	
}
