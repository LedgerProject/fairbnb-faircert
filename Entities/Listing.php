<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use DB;

class listing extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'listing';
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingFactory::new();
    }
	
	public function user()
	{
		return $this->belongsTo(User::class,'user_id','id')->select('id','username',DB::raw("CONCAT(users.first_name,' ',users.last_name) as fullname"),DB::raw("CONCAT(users.phone_prefix,' ',users.phone) as phone"));
	}
	
	public function listing_location()
	{
		return $this->belongsTo(ListingLocation::class,'location_id','id')->select('id','coordinate_id','country','city');
	}
	
	public function listing_translation()
	{
		return $this->hasOne(ListingTranslation::class,'translatable_id','id')->where('locale', app()->getLocale());
	}
	
	public function listing_image()
	{
		return $this->hasMany(ListingImage::class,'listing_id','id')->select('id','listing_id','name');
	}

	public function listing_attributes()
	{
		return $this->hasMany(ListingAttribute::class, 'listing_id' , 'id');
	}
	public function booking_listing()
	{
		return $this->hasOne(Booking::class, 'listing_id' , 'id');
	}

	public function booking()
	{
		return $this->hasMany(Booking::class, 'listing_id', 'id');
	}

}


