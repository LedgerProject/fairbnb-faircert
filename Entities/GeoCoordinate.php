<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeoCoordinate extends Model
{
    use HasFactory;

    protected $fillable = [];
	protected $table = 'geo_coordinate';
    
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\GeoCoordinateFactory::new();
    }
}

