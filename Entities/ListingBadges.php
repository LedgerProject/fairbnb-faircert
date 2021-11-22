<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingBadges extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'listing_badges';
 
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingBadgesFactory::new();
    }
}
