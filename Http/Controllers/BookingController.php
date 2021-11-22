<?php
namespace Modules\Ledger\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repository\UserInterface;
use Modules\Ledger\Repository\Listing\ListingInterface;
use Modules\Ledger\Repository\Booking\BookingInterface;
use Auth;
use View;
class BookingController extends Controller
{
    private $listingRepository = null; 
    private $userRepository = null; 
    private $bookingRepository = null; 

    public function __construct(ListingInterface $listingRepository, UserInterface $userRepository, BookingInterface $bookingRepository){

        $this->listingRepository    = $listingRepository;
        $this->userRepository       = $userRepository;
        $this->bookingRepository     = $bookingRepository;
    }
    

    
    /**
    * @method	  : index
    * @developer  : Devloper @KS
    * @date	  	  : 22-10-2021
    * @purpose	  : get all booking against the listing data
    * @intent	  : get all booking listing with the help of repository functions
    * @return	  : Renderable
    */
    public function index()
    {
        $title = "Booking";
        $ambas_listing = $this->listingRepository->getAllListingByAmbassador($certified=[1,0,2]); 
        $ambas_listing = $ambas_listing->pluck('id')->toArray();
        $listing = $this->bookingRepository->getAllBooking($ambas_listing); 
        $listing = $listing->paginate(15); 
        return view('ledger::booking.index', compact('listing','title'));
    }


    /**
    * @method	  : getAllBooking
    * @param	  : Request $request
    * @developer  : Devloper @KS
    * @date	  	  : 22-10-2021
    * @purpose	  : ajax call for pagination to get next page booking data
    * @intent	  : ajax call for pagination to get next page booking data with the help of repository functions
    * @return	  : Renderable
    */
    public function getBookingList(Request $request)
    {

        if($request->ajax()){           
            $ambas_listing = $this->listingRepository->getAllListingByAmbassador($certified=[1,0,2]);
            $ambas_listing = $ambas_listing->pluck('id')->toArray();
            $listing = $this->bookingRepository->getAllBooking($ambas_listing,$request->serach_value); 
            $listing = $listing->paginate(15); 
            $html = View::make('ledger::booking/booking-ajax-list',compact('listing'))->render();
            if(count($listing)){
                 return response()->json([
                    "message"       => 'list get successfully.',
                    "isSucceeded"   => TRUE,
                    "data"          => $html,
                ]);
            }else{
                return response()->json([
                    "message"       => 'There is no Scouts.',
                    "isSucceeded"   => FALSE,
                    "data"          => $html,
                    "locations"     => ""
                ]);

            }
        }
    }

    /**
    * @method	  : getAllBooking
    * @param	  : Request $request
    * @developer  : Devloper @KS
    * @date	  	  : 22-10-2021
    * @purpose	  : get all rejected booking against the listing data
    * @intent	  : get all rejected booking listing with the help of repository functions
    * @return	  : Renderable
    */
    public function rejectedBookingList(Request $request)
    {
        $title = "Reject Booking";
        $ambas_listing = $this->listingRepository->getAllListingByAmbassador($certified=[1,0,2]);
        $ambas_listing = $ambas_listing->pluck('id')->toArray();
        $listing = $this->bookingRepository->getRejectedBooking($ambas_listing,$request->serach_value);  
        $listing = $listing->paginate(15);
        if($request->ajax()){           
            $html = View::make('ledger::booking.booking-ajax-list',compact('listing'))->render();
            if(count($listing)){
                 return response()->json([
                    "message"       => 'list get successfully.',
                    "isSucceeded"   => TRUE,
                    "data"          => $html,
                ]);
            }else{
                return response()->json([
                    "message"       => 'There is no Scouts.',
                    "isSucceeded"   => FALSE,
                    "data"          => $html,
                    "locations"     => ""
                ]);

            }
        }
   
        return view('ledger::booking.rejected-booking', compact('listing','title'));

    }
    
}


