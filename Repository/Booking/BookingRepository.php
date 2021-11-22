<?php

namespace Modules\Ledger\Repository\Booking;

use App\Repository\Eloquent\BaseRepository;
use Modules\Ledger\Repository\Booking\BookingInterface as BookingInterface;
use Modules\Ledger\Entities\Booking;
use DB;
use Auth;
use App\Models\User; 

class BookingRepository extends BaseRepository implements BookingInterface
{
    protected $model = null;
	
	public function __construct(Booking $model)
	{
		$this->model=$model;
	}

     /*
    * @method	  : getAllBooking
    * @params	  : listing Id's array
    * @developer  : Devloper @KS
    * @date	  	  : 22-10-2021
    * @purpose	  : get all booking against the listing data
    * @intent	  : get all booking listing with the help of relationship with listing_translation table
    * @return	  : collection
    */ 
    public function getAllBooking($array , $search = null)
    {
 
        $query = Booking::with(['listing_translation' => function($query2){

            $query2->where('locale' , app()->getLocale());
        }])->whereIn('listing_id', $array)->where(['refused_booking_at' => null, 'cancelled_by_asker_booking_at' => null, 'expired_booking_at' => null]);
 
        $query =  Booking::with('listing_translation')
                  ->whereIn('listing_id', $array);
                  if($search != null){
                        $query->Where('start', 'like', '%'.$search.'%');                         
                    }
                 $query->where(['refused_booking_at' => null, 'cancelled_by_asker_booking_at' => null, 'expired_booking_at' => null]);
               return $query;
 
    }

    /*
    * @method	  : getRejectedBooking
    * @params	  : listing Id's array
    * @developer  : Devloper @KS
    * @date	  	  : 22-10-2021
    * @purpose	  : get all rejcetd booking against the listing data
    * @intent	  : get all rejected booking listing with the help of relationship with listing_translation table
    * @return	  : collection
    */ 
    public function getRejectedBooking($array,$search = null)
    {
      
        $query = Booking::with('listing_translation')
           ->whereIn('listing_id', $array);
        if($search != null){
            $query->Where('start', 'like', '%'.$search.'%');
                         
           }
        $query->WhereNotNull('refused_booking_at');
        $query->orWhereNotNull('cancelled_by_asker_booking_at');
    
          return $query;
    }
    
}


