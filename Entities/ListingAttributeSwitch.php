<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingAttributeSwitch extends Model
{
    use HasFactory;

    protected $fillable = [];
      protected $table = 'listing_attribute_switch';
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingAttributeSwitchFactory::new();
    }
}
