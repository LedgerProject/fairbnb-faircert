<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingAttributeTranslation extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'listing_attribute_translation';
    
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingAttributeTranslationFactory::new();
    }
	
    public function attributes()
    {

        return $this->hasMany(Attributes::class,'id','translatable_id');
    }
}
