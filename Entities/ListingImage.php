<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = [];
	protected $table = 'listing_image';
    
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingImageFactory::new();
    }
}

