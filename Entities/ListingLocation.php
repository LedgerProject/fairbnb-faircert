<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingLocation extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'listing_location';
    
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingLocationFactory::new();
    }
	
	public function geo_coordinate()
	{
		return $this->belongsTo(GeoCoordinate::class,'coordinate_id','id');
	}
}
