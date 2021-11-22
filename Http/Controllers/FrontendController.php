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

class FrontendController extends Controller
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
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('ledger::index');
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

    public function frontendListingBySlug(Request $request,$slug)
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

            $listingRules = array();  
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

             // TODO: to be changed, checking who has signed the certificate
            $laUser = $this->listingRepository->getLaDetails();
            if($laUser) {
                 $laName = $laUser["last_name"] . " " . $laUser["first_name"];
            } else {
                $laName = "TDB";
            }


            $certificateDetails = $this->listingRepository->getCertDetails($id);

            $attributes=array();
              return view('ledger::frontend.listing-detail',compact('listing','getbadgesimg','getbadgesData',
                  'getAllBadges','result','listing_attributes','calendar','reviews','upgrades', 'attributes',
                  'locations','getAssignbadgesData', 'nextPreviousArray', 'listingRules', 'slug', 'laName', 'certificateDetails'));
        
        }else{ 
            return view('ledger::404');
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
}
