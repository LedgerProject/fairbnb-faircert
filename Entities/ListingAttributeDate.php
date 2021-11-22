<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingAttributeDate extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'listing_attribute_date';
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingAttributeDateFactory::new();
    }
}
