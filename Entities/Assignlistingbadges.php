<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assignlistingbadges extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'assign_listing_badges';    
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\AssignlistingbadgesFactory::new();
    }
    public function ListingBadges()
    {
         return $this->hasOne(ListingBadges::class,'id','badges_id');
    }
}
