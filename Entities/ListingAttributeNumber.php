<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class listingAttributeNumber extends Model
{
    use HasFactory;

    protected $fillable = [];
      protected $table = 'listing_attribute_number';
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingAttributeNumberFactory::new();
    }
}
