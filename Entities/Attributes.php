<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attributes extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'attribute';
    
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\AttributesFactory::new();
    }
	
	public function attribute_translation()
    {
        return $this->belongsTo(ListingAttributeTranslation::class, 'id', 'translatable_id')->where('locale', app()->getLocale());
    }

    public function attribute_group_translation()
    {
        return $this->hasOne(ListingAttributeGroupTranslation::class, 'translatable_id', 'group_id')->where('locale', app()->getLocale());
    }
    public function listing_attribute()
    {
        return $this->hasOne(ListingAttribute::class, 'attribute_id', 'id');
    }
	 public function listing_attribute_option()
    {
        return $this->hasMany(ListingAttributeOption::class, 'attribute_id', 'id');
    }
	 public function attribute_option()
    {
        return $this->hasMany(AttributeOption::class, 'attribute_id', 'id');
    }
	
	
 
}
