<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [];
	protected $table = 'booking';
    
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\BookingFactory::new();
    }

    /*
    * @method	  : listing_translation
    * @params	  : none
    * @developer  : Devloper @KS
    * @date	  	  : 22-10-2021
    * @purpose	  : create relationship with listing_translation table on the behalf of listing id 
    * @intent	  : get selected data with the help of relationship with listing_translation table on the behalf of listing id
    * @return	  : collection
    */

    public function listing_translation()
	{
		return $this->hasOne(ListingTranslation::class,'translatable_id','listing_id')->select('id','translatable_id','title','description', 'locale', 'slug');
	}

    public function reviews()
    {
        return $this->belongsTo(Review::class, 'id' , 'booking_id');
    }
    
    public function booking_option()
    {
        return $this->belongsTo(BookingOption::class, 'id', 'booking_id');
    }
}
