<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingAttributeGroupTranslation extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'listing_attribute_group_translation';
    
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingAttributeGroupTranslationFactory::new();
    }
	
    public function attributes()
    {
        return $this->hasMany(Attributes::class, 'group_id', 'translatable_id')->where('locale', app()->getLocale());
    }
}
