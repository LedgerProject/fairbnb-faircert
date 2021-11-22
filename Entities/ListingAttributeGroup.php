<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingAttributeGroup extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'listing_attribute_group';
    
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingAttributeGroupFactory::new();
    }
	 public function attribute_group_translation()
    {
        return $this->hasMany(ListingAttributeGroupTranslation::class, 'translatable_id', 'id');
    }
	 public function attribute()
    {
        return $this->hasMany(Attributes::class, 'group_id', 'id');
    }
	 public function listing_attribute_option()
    {
        return $this->hasMany(ListingAttributeOption::class, 'attribute_id', 'id');
    }
}
