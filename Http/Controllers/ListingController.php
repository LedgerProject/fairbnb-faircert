<?php

namespace Modules\Ledger\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ledger\Repository\Listing\ListingInterface;
use Modules\Ledger\Repository\Booking\BookingInterface;
use Modules\Ledger\Notifications\SendEmailNotification;
use App\Models\User;
use Auth;
use View;
use DB;
use DateTime;
use DateInterval;
use DateTimeZone;
use DatePeriod;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

     private $listingRepository;
     private $bookingRepository;
    
     public function __construct(ListingInterface $listingRepository, BookingInterface $bookingRepository)
     {
         $this->listingRepository = $listingRepository;
         $this->bookingRepository = $bookingRepository;
     }

    /**
    * @method	  : getAllBooking
    * @param	  : Request $request
    * @developer  : Devloper @HS
    * @date	  	  : 22-10-2021
    * @purpose	  : get all listing and its count.
    * @intent	  : show all listing and its count.
    * @return	  : Renderable
    */

    public function index()
    {
           $title = "Listing";
           $listings = $this->listingRepository->getAllListingByAmbassador($certified=[1]);
           $listings = $listings->paginate(15);           

           $ambas_listing = $this->listingRepository->getAllListingByAmbassador($certified=[1]);   
           $certifiedlistingCount = $ambas_listing->get()->count();
           
           $ambas_listing2 = $this->listingRepository->getAllListingByAmbassador($certified=[0]);   
           $nonecertifiedlistingCount = $ambas_listing2->get()->count();
          
           $ambas_listing3 = $this->listingRepository->getAllListingByAmbassador($certified=[2]);   
           $recertifiedlistingCount = $ambas_listing3->get()->count();
           
           $ambasListing = $this->listingRepository->getAllListingByAmbassador($certified=[1,0,2]); 
           $ambasListing = $ambasListing->pluck('id')->toArray();

           $booking = $this->bookingRepository->getAllBooking($ambasListing); 
           $bookingCount = $booking->get()->count(); 

           $rejBooking = $this->bookingRepository->getRejectedBooking($ambasListing);  
           $rejBookingCount = $rejBooking->get()->count();

           $image_path ='https://booking.fairbnb.coop/media/cache/listing_xxlarge/uploads/listings/images/';
           $profile_path = 'https://booking.fairbnb.coop/media/cache/user_medium/uploads/users/images/';
           return view('ledger::listing.index' ,compact('listings','title', 'image_path', 'profile_path', 'certifiedlistingCount','nonecertifiedlistingCount','recertifiedlistingCount','bookingCount','rejBookingCount'));
    }
    
    /**
    * @method	  : getListing
    * @param	  : Request $request
    * @developer  : Devloper @HS
    * @date	  	  : 22-10-2021
    * @purpose	  : get listing by click on pagination number.
    * @intent	  : 
    * @return	  : Renderable
    */

    public function getListing(Request $request)
    {
        $image_path ='https://booking.fairbnb.coop/media/cache/listing_xxmedium/uploads/listings/images/';
        $profile_path = 'https://booking.fairbnb.coop/media/cache/user_medium/uploads/users/images/';
        if($request->ajax()){
            $listings = $this->listingRepository->getAllListingByAmbassador([$request->value],$request->serach_value);
            $listings= $listings->paginate(15);
            $html = View::make('ledger::listing.ajax-ambassador-listing',compact('listings', 'image_path', 'profile_path'))->render();
            if(count($listings)){
                 return response()->json([
                    "message"       => 'list get successfully.',
                    "isSucceeded"   => TRUE,
                    "data"          => $html,
                ]);
            }else{
                return response()->json([
                    "message"       => 'There is no Scouts.',
                    "isSucceeded"   => FALSE,                   
                    "locations"     => ""
                ]);

            }
        }
    } 
    
    /**
    * @method	  : listingAvailabilities
    * @param	  : Request $request,$listingId,$startDate,$endDate
    * @developer  : Devloper @HS
    * @date	  	  : 22-10-2021
    * @purpose	  : get listing detail by its slug.
    * @intent	  : 
    * @return	  : Renderable
    */

    public function listingAvailabilities(Request $request,$listingId,$startDate=null,$endDate=null)
    { 

    $timezone = 'UTC';
	if($startDate != null){		
	       $start = \Carbon\Carbon::parse($startDate);
	        $startDate = $start->format('Y-m-d H:i:s');
	} 
	if($endDate != null){		
	       $end = \Carbon\Carbon::parse($endDate);
	         $endDate = $end->format('Y-m-d 23:59:59');
	} 
    $period = new DatePeriod(
                 new DateTime($start->format('Y-m-d')),
                 new DateInterval('P1D'),
                 new DateTime($end->format('Y-m-d'))
            );

      $listingDetails = $this->listingRepository->getListing($listingId); 
      $feeAsAsker = $this->listingRepository->getFeeAsAsker($listingId); 
 
      $fee_as_asker = $feeAsAsker ? $feeAsAsker[0]->fee_as_asker : ''; 
	   $availabilities = $this->listingRepository->findAvailabilitiesByListing($listingId,$startDate,$endDate);
	   $displayPrice = true;
	    $daysEvents = [[]];
        foreach ($availabilities as $availability) {
            $daysEvents[] = $this->getCalendarDayEvents($availability, $timezone='UTC');
        }
     
        $daysEvents = array_merge_recursive(...$daysEvents);
        foreach ($period as $key => $value) {

                    if (array_key_exists($value->format('Y-m-d'),$daysEvents))
                    {}
                    else
                    {
                        $daysEvents[$value->format('Y-m-d')][]=[
                        'id' =>'0000',
                        'start' => $value->format('Y-m-d H:i'),
                        'end' => $value->format('Y-m-d H:i'),
                        'status' => 1,
                         'source' => null,
                        'price' => $listingDetails ? $listingDetails->price:0,
                    ];
                    } 
            }
        $allDay =  true;
        $result = [];
        $statusValues['1']='available';
        $statusValues['2']='unavailable';
        $statusValues['3']='unavailable';
        foreach ($daysEvents as $dayEvents) {
            $prevEvent = null;
            foreach ($dayEvents as $event) {
              $status = $statusValues[$event['status']];
                /** @Ignore */
            
              

                //If current start event is equal to previous end and event time and price are equals then events are merged
                if ($prevEvent && $event['start'] === $prevEvent['end'] && $prevEvent['price'] === $event['price'] && $prevEvent['status'] === $event['status']) {
                    array_splice($result, count($result) - 1, 1);
                    $event['start'] = $prevEvent['start'];
                }
                $prevEvent = $event;

                //Get start and end in UTC
                $startUTC = new DateTime($event['start'], new DateTimeZone($timezone));
                $startUTC->setTimezone(new DateTimeZone('UTC'));
                $endUTC = new DateTime($event['end'], new DateTimeZone($timezone));
                $endUTC->setTimezone(new DateTimeZone('UTC'));
                $date_now = new DateTime(); 
              if($date_now < $startUTC) {
                      $dDate = true;
                }else{
                    $dDate = false; 
                }
                if(!empty($fee_as_asker)){

                        $price = $event['price'] ;
                        $newPrice = (($price * $fee_as_asker / 100) + $price /100 ); 
                         
                    }else{
                        $newPrice =$event['price'] / 100;
                    }
                $result[] = [
                    'id' => $event['id'],
                    'title' => $displayPrice && $event['status'] == 1 &&  $dDate ? "€". $newPrice : '',
                    'className' => ($dDate ? ($status =='unavailable' ? $status.'-evt icon-cross ' : $status.'-evt ' ) : 'unavailable-evt icon-cross '),
                    'start' => $event['start'],
                    'end' => $event['end'],
                    'startUTC' => $startUTC->format('Y-m-d H:i'),
                    'endUTC' => $endUTC->format('Y-m-d H:i'),
                   // 'editable' => 'booked' !== $status,
                    'editable' => false,
                    'allDay' => $allDay,
                    'rendering' => 'background',
                    'status' => $event['status'],
                    'source' => $event['source'],
                ];
            }
        }

        return $result;
	
	}

    /**
     * Return availability data organized by time range for availability day
     *
     * @param array  $availability
     * @param string $timezone
     *
     * @return array
     */
    public function getCalendarDayEvents($availability, $timezone)
    {
		
		
		
        /** @var MongoDate $dayMD */
        $dayMD = $availability->cal_date;
        $day = new DateTime($dayMD); 
        $dayAsString = $dayEndAsString = $day->format('Y-m-d'); //by default day is the same for an event

        $nextDay = clone $day; //if end time is 00:00 the day will be the next one
        $nextDay->add(new DateInterval('P1D'));
        $nextDayAsString = $nextDay->format('Y-m-d');

        //time ranges array in UTC
        $timesRanges = $this->getTimesRanges($availability);

        $events = [];
        if (count($timesRanges)) {
            foreach ($timesRanges as $timeRange) {
                $dayEndAsString = $dayAsString;
                if ('00:00' === $timeRange['end']) {
                    $dayEndAsString = $nextDayAsString;
                }

                $startUTC = new DateTime($dayAsString.' '.$timeRange['start']);
                $endUTC = new DateTime($dayEndAsString.' '.$timeRange['end']);

                $start = clone $startUTC;
                $end = clone $endUTC;
                $start->setTimezone(new DateTimeZone($timezone));
                $end->setTimezone(new DateTimeZone($timezone));

                //If time range span days then it is splitted from start to midnight and midnight to end
                $subTimeRanges = [new TimeRange($start, $end, $start)];
                if ($start->format('Y-m-d') !== $end->format('Y-m-d')) {
                    $midnight = clone $end;
                    $midnight->setTime(0, 0, 0);

                    $subTimeRanges = [
                        new TimeRange($start, $midnight, $start),
                        new TimeRange($midnight, $end, $midnight),
                    ];
                }

              foreach ($subTimeRanges as $index => $subTimeRange) {
                    $subStart = $subTimeRange->getStart();
                    $subEnd = $subTimeRange->getEnd();
                    if ($subStart->format('Y-m-d H:i') !== $subEnd->format('Y-m-d H:i')) {
                        $events[$subStart->format('Y-m-d')][] = [
                            'id' => $availability['id'].str_replace(':', '', $subStart->format('H:i')),
                            'start' => $subStart->format('Y-m-d H:i'),
                            'end' => $subEnd->format('Y-m-d H:i'),
                            'status' => $timeRange['status'],
                            'source' => null,
                            'price' => $timeRange['price'],
                        ];
                    }
                }
            }
        } else {
            $start = new DateTime($dayAsString.' '.'00:00');
            $end = new DateTime($dayAsString.' '.'23:59');

              $events[$start->format('Y-m-d')][] = [
                'id' => $availability->id.'0000',
                'start' => $start->format('Y-m-d H:i'),
                'end' => $end->format('Y-m-d H:i'),
                'status' => $availability->status,
                'source' => $availability->source,
                'price' => $availability->price,
            ];
        } 
        return $events;
    }
	  /**
     * Construct time ranges from ListingAvailabilityTimes
     *
     * @param array $availability
     * @param int   $addOneMinuteToEndTime 1 or 0
     */
    public function getTimesRanges($availability, int $addOneMinuteToEndTime = 1, bool $timeAsString = true): array
    {
        $times = $availability->ts ?? [];
        $timesRanges = $range = [];
        $prevStatus = $prevId = $prevPrice = false;

        foreach ($times as $i => $time) {
            if ($time->status !== $prevStatus || $time->id !== ($prevId + 1) || $time->price !== $prevPrice) {
                if (false !== $prevStatus && false !== $prevId) {
                    $end = $prevId + $addOneMinuteToEndTime;
                    if ($timeAsString) {
                        $end = date('H:i', mktime(0, $end));
                    }
                    $range['end'] = $end;
                    $timesRanges[] = $range;
                }

                $start = $time->id;
                if ($timeAsString) {
                    $start = date('H:i', mktime(0, $start));
                }
                $range = [
                    'start' => $start,
                    'status' => $time->status,
                    'price' => $time->price,
                ];
            }

            $prevStatus = $time->status;
            $prevPrice = $time->price;
            $prevId = $time->id;
        }

        if (count($times)) {
            $lastTime = end($times);
            $end = $lastTime->id + $addOneMinuteToEndTime;
            if ($timeAsString) {
                $end = date('H:i', mktime(0, $end));
            }
            $range['end'] = $end;
            $timesRanges[] = $range;
        }

        return $timesRanges;
    }
    /**
    * @method	  : listingBySlug
    * @param	  : Request $request,slug
    * @developer  : Devloper @HS
    * @date	  	  : 22-10-2021
    * @purpose	  : get listing detail by its slug.
    * @intent	  : 
    * @return	  : Renderable
    */

    public function listingBySlug(Request $request,$slug)
    {
        $id =  $this->listingRepository->listingId($slug); 
        
        
         $reqLocale = is_string(app()->getLocale()) ?app()->getLocale() : (app()->getLocale())();
         $getEmptyGroups = false;
         $attributeResult=[];
        if($id != null){
    
            $listingData = $this->listingRepository->getListingDetails($id); 
            $locations = $this->listingRepository->listingLocation($id);
            $reviews = $this->listingRepository->listingUpgradesReview($id);
            $upgrades= $reviews['upgrades'];

            $listing = $listingData['listing']; 
            $attributesGroup = $listingData['attributeGroup'];
            $listing_attributes  = $listingData['listingAttributes'];
 
            $result = [];
            foreach ($attributesGroup  as $group) {
                $children = [];
 
               foreach ($group->attribute as $attribute) { 

           // print_r($attribute->id);die();
               if ($listing != null && ! array_key_exists($attribute->id,$listing_attributes) ) {
                    continue;
                }
            $hasValue = false;  
             if($listing != null) {
                    $a = $listing_attributes[$attribute->id];
                    $val=$listing_attributes[$attribute->id];

                 //   dd($attribute->id);
               if ($attribute->type == 1) {
                        if ($val) {
                            $hasValue = true;
                        }
                    } else {
                        if ($val != null && $val != "") {
                            $hasValue = true;
                        }
                    }
                   if (!$hasValue) {
                       continue;
                    } 
                } else {
                    $hasValue = true;
                }
              $attrTranslations = [];
              $translation= $attribute->attribute_translation;
    
              $locale =$attribute->attribute_translation->locale;
                   if($listing != null) {
                        if ($locale == $reqLocale) {
                            $attrTranslations[$locale] = [
                                'title' => $translation->title,
                                'description' => $translation->description,
                            ];
 
                        }
                    } else {
                        $attrTranslations[$locale] = [
                             'title' => $translation->title,
                             'description' => $translation->description,
                        ];
                    }
            $options = [];
            
             foreach ($attribute->listing_attribute_option as $option) {
                    $optTranslations = [];
                //   /echo "<pre>"; dd($option->listing_attribute_option_translation);die();
                    foreach ($option->listing_attribute_option_translation as  $translation) {
                     
                        $locale= $translation->locale;
                        if($listing != null) {
                            if ($locale == $reqLocale) {
                                $optTranslations[$locale] = [
                                    'title' => $translation->title,
                                ];

                                break;
                            }
                        } else {
                            $optTranslations[$locale] = [
                                'title' => $translation->title,
                            ];
                        }
                    }

                    $options[] = [
                        'translations' => $optTranslations,
                    ];
                }
                 $listingAttributes = $attribute->listing_attribute;

                $children[] = [
                    'id' => $attribute->id,
                    'type' => $attribute->type,
                    'required' => $attribute->is_required,
                    'visible' => $attribute->is_visible,
                    'searchable' => $attribute->is_searchable,
                    'translations' => $attrTranslations,
                    'options' => $options,
                    'sort' => $attribute->sort,
                    'countListings' => $listingAttributes->count(),
                ];
                //$listingAttributes = $attribute->getListingAttributes();
                
            }
            
            if (!$getEmptyGroups && [] === $children) {
                continue;
            }
            
            $translations = []; 
            foreach ($group->attribute_group_translation as $locale => $translation) {
               $locale = $translation->locale;
                if($listing != null) {
                    if ($locale == $reqLocale) {
                        $translations[$locale] = [
                            'title' => $translation->title,
                        ];

                        break;
                    }
                } else {
                    $translations[$locale] = [
                        'title' => $translation->title,
                    ];
                }
            }
            $categories = [];
           /* foreach ($group->getCategories() as $category) {
                $categories[] = $category->getId();
            }*/
             $result[] = [
                'id' => $group->id,
                'translations' => $translations,
                //'categories' => $categories,
                'children' => $children,
            ];
        } 

   
       
            $listingData = $this->listingRepository->getAllListingByAmbassador($certified=[$listing->certified])->get();   
            
            $index = $listingData->search(function($list) use($id) {
                return $list->id === $id;
            });

            $preSlug = $nextSlug = null;
            
            if($index > 0){
                $previous = $listingData->slice($index-1, 1);
                foreach($previous as $detail){
                    $preSlug= $detail->list_slug;
                }
            }
            $next = $listingData->slice($index+1, 1);
            foreach($next as $detail){
                $nextSlug= $detail->list_slug;
            }
            $nextPreviousArray = array('next'=> $nextSlug, 'previous' => $preSlug);   

            $listingRules = $this->listingRepository->getRules();  
            $calendar = $this->listingRepository->listingCalendar($id);
            $getAllBadges = $this->listingRepository->getAllBadges();
            $getAssignbadges = $this->listingRepository-> getAssignbadges($id);
            $getAssignbadgesData=[];
            foreach($getAssignbadges as $badges){
                $getAssignbadgesData[$badges->id]= $badges->ListingBadges;
             }
              $getbadgesimg =array();
              $getbadgesData =array();
             foreach($getAllBadges as $badges){
                $getbadgesData[$badges->categories][$badges->id] = $badges;
                $getbadgesimg[$badges->categories] = $badges->icon;

             }

            // dd($getbadgesData);
            $attributes=array();
            return view('ledger::listing.listing-detail',compact('listing','slug', 'getbadgesimg','getbadgesData','getAllBadges','result','listing_attributes','calendar','reviews','upgrades', 'attributes', 'locations','getAssignbadgesData', 'nextPreviousArray', 'listingRules', 'slug'));
        
        }else{

            return view('ledger::404');
        }
        
    }

    
	public static function getEloquentSqlWithBindings($query)
	{
		return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
			$binding = addslashes($binding);
			return is_numeric($binding) ? $binding : "'{$binding}'";
		})->toArray());
	}

    /**
    * @method	  : assignBadges
    * @param	  : Request $request
    * @developer  : Devloper @HS
    * @date	  	  : 17-11-2021
    * @purpose	  : assign badges for listing.
    * @intent	  : 
    * @return	  : Renderable
    */

    public function assignBadges(Request $request){
            
        $response = $this->listingRepository->insertAssignBadges($request->params);
        if($response){
            return response()->json([
               "message"       => 'success',
               "isSucceeded"   => TRUE,
               "data"          => $response,
           ]);
        }else{
            return response()->json([
                "message"       => 'failed',
                "isSucceeded"   => FALSE,
                "data"          => $response,
            ]);

        }
        
 
    }
    
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ledger::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('ledger::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('ledger::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function certifyListing(Request $request)
    {     
       return  $res = $this->listingRepository->certifyListing($request);
    }

    public function askMoreInfo(Request $request)
    {
        
        $userDetail = $this->listingRepository->user($request->get('listing_id'));
        $user = User::findOrFail($userDetail->user_id);
        $subject = 'Ask More Info';
        $email_message = $request->askmoreinfo_title.',<br><br>'.$request->askmoreinfo_desc.'.';

        $user->notify(new SendEmailNotification($subject, $email_message));
        return true;
    }
    
}
