<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingListingCategory extends Model
{
    use HasFactory;

    protected $fillable = [];
     protected $table = 'listing_listing_category';
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingListingCategoryFactory::new();
    }
}
