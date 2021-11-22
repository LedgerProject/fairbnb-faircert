<?php
namespace Modules\Ledger\Repository\Listing;
use App\Repository\Eloquent\BaseRepository;
use Modules\Ledger\Entities\ListingCertificate;
use Modules\Ledger\Repository\Listing\ListingInterface as ListingInterface;
use Modules\Ledger\Entities\Listing;
use Modules\Ledger\Entities\Rules;
use Modules\Ledger\Entities\Review;
use Modules\Ledger\Entities\BookingOptionTranslation;
use Modules\Ledger\Entities\BookingOption;
use Modules\Ledger\Entities\Attributes;
use Modules\Ledger\Entities\ListingBadges;
use Modules\Ledger\Entities\Assignlistingbadges;
use Modules\Ledger\Entities\ListingAttributeGroup;
use Modules\Ledger\Entities\ListingTranslation;
use Modules\Ledger\Entities\LocalNodeAmbassador;
use Modules\Ledger\Entities\ListingAttributeTranslation;
use Modules\Ledger\Entities\UserQuestion;
use Modules\Ledger\Notifications\SendEmailNotification;


use DB;
use Auth;
use App\Models\User; 
use Modules\Ledger\Entities\Booking;
 
class ListingRepository extends BaseRepository implements ListingInterface
{
    protected $model = null;
	
	public function __construct(Listing $model)
	{
		$this->model=$model;
	}

    /*
    * @method	  : getAllListingByAmbassador
    * @params	  : certified
    * @developer  : Devloper @HS
    * @date	  	  : 21-10-2021
    * @purpose	  : get all listing for logged in ambassador
    * @intent	  : get all listing by certified field
     * @return	  : array of listing
    */

	public function getAllListingByAmbassador($certified, $search=null, $where= null)
	{ 
		$getAllListingByAmbassador = DB::table('listing')
		->select('listing.id','listing.certified','lt.slug as list_slug', 'latt1.value as national_code', 'limg.name as list_img', 'ui.name as profile_img', 'user1.id as user_id', 'user1.username',DB::raw("CONCAT(user1.first_name,' ',user1.last_name) as fullname"),DB::raw("CONCAT(user1.phone_prefix,' ',user1.phone) as phone"),'listing.status','listing.updated_at as last_update', 'listing.created_at as created_at', 'listing.availabilities_updated_at','ll.country','ll.city','gc.address','lt.title','lt.description','lct.name as category','latt1.value as national_code','latt2.value as local_code','local_node.name as Local_node','lng.responsibility as node_level',DB::raw('(listing.price/100) as base_price'),DB::raw('(listing.capacity +  listing.extra_people_capacity) as total_capacity'))
		->join('user as user1',  'listing.user_id', '=', 'user1.id')
		->join('listing_location as ll',  'listing.location_id', '=', 'll.id')
		->join('geo_coordinate as gc',  'll.coordinate_id', '=', 'gc.id')
		->join('listing_translation as lt',function($join)
			{
				$join->on('lt.translatable_id', '=', 'listing.id')
				     ->on('lt.locale','=',DB::raw("'".app()->getLocale()."'"));

			})
		->leftjoin('listing_attribute as la1',function($join1)
			{
				$join1->on('la1.listing_id', '=', 'listing.id')
				      ->on('la1.attribute_id','=',DB::raw("22"));	
			})
		->leftjoin('listing_attribute_text_translation as latt1',function($join2)
			{
				$join2->on('latt1.translatable_id', '=', 'la1.id')
				      ->on('latt1.locale','=',DB::raw("'".app()->getLocale()."'"));	
			})
		->leftjoin('listing_attribute as la2',function($join3)
			{
				$join3->on('la2.listing_id', '=', 'listing.id')
					  ->on('la2.attribute_id','=',DB::raw("50"));	
			})
		->leftjoin('listing_attribute_text_translation as latt2',function($join4)
			{
				$join4->on('latt2.translatable_id', '=', 'la2.id')
				      ->on('latt2.locale','=',DB::raw("'".app()->getLocale()."'"));	
			})
		->leftjoin('listing_listing_category as llc',function($join5)
			{
				$join5->on('llc.listing_id', '=', 'listing.id')
				      ->whereNotExists(function ( $query)
					  {
						   $query->select('*')
								 ->from('listing_listing_category as llc2')
								 ->where([['llc2.listing_id','=',DB::raw("`listing`.`id`")],['llc2.id','>',DB::raw("`llc`.`id`")]]);
					  });
			})
		->leftjoin('listing_category_translation as lct',function($join6)
			{
				$join6->on('lct.translatable_id','=','llc.listing_category_id')
					  ->on('lct.locale','=',DB::raw("'".app()->getLocale()."'"));
			})
		->join('local_node_geo as lng',function($join7)
			{
				$join7->where(function($q)
					   	{
							$q->where('gc.zip','=', DB::raw("`lng`.`zip`"))
							  ->orWhereNull('lng.zip');
					    })
				      ->where(function($q2)
						{
							$q2->where('gc.city_id','=', DB::raw("`lng`.`city_id`"))
							   ->orWhereNull('lng.city_id');
						})
					  ->where(function($q2)
						{
							$q2->where('gc.department_id','=', DB::raw("`lng`.`department_id`"))
							   ->orWhereNull('lng.department_id');
						})
					  ->where(function($q2)
						{
							$q2->where('gc.area_id','=', DB::raw("`lng`.`area_id`"))
							   ->orWhereNull('lng.area_id');
						})
					  ->on('gc.country_id','=', DB::raw("`lng`.`country_id`"))
					  ->on('lng.Incl_Excl','=',DB::raw("'I'"))
					  /* select correct level, how better defined the better, so exclude less defined matches */
					  ->whereNotExists(function ( $query)
					  {
						   $query->select('*')
								 ->from('local_node_geo as lng2')
								 ->where('lng2.local_node_id','=', DB::raw("`lng`.`local_node_id`"))
								 ->where(function($q)
								 {
									 $q->where('gc.zip','=', DB::raw("`lng2`.`zip`"))
									   ->orWhereNull('lng2.zip');
								 })
								 ->where(function($q2)
								 {
									 $q2->where('gc.city_id','=', DB::raw("`lng2`.`city_id`"))
									    ->orWhereNull('lng2.city_id');
								 })
								 ->where(function($q2)
								 {
									 $q2->where('gc.department_id','=', DB::raw("`lng2`.`department_id`"))
									    ->orWhereNull('lng2.department_id');
								 })
								 ->where(function($q2)
								 {
									 $q2->where('gc.area_id','=', DB::raw("`lng2`.`area_id`"))
									    ->orWhereNull('lng2.area_id');
								 })
								 ->where('gc.country_id','=',DB::raw("`lng2`.`country_id`"))
							     ->where('lng2.Incl_Excl','=', 'I')
								 ->where('lng2.geo_level','>', DB::raw("`lng`.`geo_level`"));
					  })
					  /* exclude excluding areas */
					  ->whereNotExists(function ( $query)
					  {
						   $query->select('*')
								 ->from('local_node_geo as lng3')
								 ->where('lng3.local_node_id','=', DB::raw("`lng`.`local_node_id`"))
								 ->where(function($q)
								 {
									 $q->where('gc.zip','=', DB::raw("`lng3`.`zip`"))
									   ->orWhereNull('lng3.zip');
								 })
								 ->where(function($q2)
								 {
									 $q2->where('gc.city_id','=', DB::raw("`lng3`.`city_id`"))
									   ->orWhereNull('lng3.city_id');
								 })
								 ->where(function($q2)
								 {
									 $q2->where('gc.department_id','=', DB::raw("`lng3`.`department_id`"))
									   ->orWhereNull('lng3.department_id');
								 })
								 ->where(function($q2)
								 {
									 $q2 ->where('gc.area_id','=', DB::raw("`lng3`.`area_id`"))
									   ->orWhereNull('lng3.area_id');
								 })
								->where('gc.country_id','=',DB::raw("`lng3`.`country_id`"))
								->where('lng3.Incl_Excl','=', 'E')
								->where('lng3.geo_level','>', DB::raw("`lng`.`geo_level`"));
					  })
					  /* exclude all existing nodes for country  */
					  ->whereNotExists(function ( $query)
					  {
						   $query->select('*')
								 ->from('local_node_geo as lng4')
								 ->where('lng4.local_node_id','!=', DB::raw("`lng`.`local_node_id`"))
								 ->where(function($q)
								 {
									 $q->where('gc.zip','=', DB::raw("`lng4`.`zip`"))
									   ->orWhereNull('lng4.zip');
								 })
								 ->where(function($q2)
								 {
									 $q2->where('gc.city_id','=', DB::raw("`lng4`.`city_id`"))
									   ->orWhereNull('lng4.city_id');
								 })
								 ->where(function($q2)
								 {
									 $q2->where('gc.department_id','=', DB::raw("`lng4`.`department_id`"))
									   ->orWhereNull('lng4.department_id');
								 })
								 ->where(function($q2)
								 {
									 $q2 ->where('gc.area_id','=', DB::raw("`lng4`.`area_id`"))
									   ->orWhereNull('lng4.area_id');
								 })
								 ->where('gc.country_id','=',DB::raw("`lng4`.`country_id`"))
								 ->where('lng4.Incl_Excl','=', 'I')
								 ->where('lng4.geo_level','<', DB::raw("`lng`.`geo_level`"));
					  });
			})
		->join('local_node','local_node.id', '=', 'lng.local_node_id')
		->join('local_node_ambassadors','local_node_ambassadors.local_node_id', '=', 'lng.local_node_id')
		->leftJoin('listing_image as limg', function ($join) {
			$join->on('listing.id', '=', 'limg.listing_id')
				->where('limg.sort', '=', DB::raw("1"));
	   })
		->leftJoin('user_image as ui', function ($join) {
			$join->on('listing.user_id', '=', 'ui.user_id')
				->whereRaw(DB::raw('listing.user_id = ui.user_id'));
	   });
	   
		$getAllListingByAmbassador->where('local_node_ambassadors.user_id', '=', Auth::id());
		if($search != null){
			$getAllListingByAmbassador->where('lt.title', 'like', '%'.$search.'%');

		}

		$getAllListingByAmbassador->whereIn('listing.certified',$certified);
		$getAllListingByAmbassador->distinct(); 
		
		if($where != null){

			return $getAllListingByAmbassador->where('listing.id', '=', $where);
		}
		$getAllListingByAmbassador->orderBy('listing.id', 'desc');
		return $getAllListingByAmbassador;
		
	}

	public static function getEloquentSqlWithBindings($query)
	{
		return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
			$binding = addslashes($binding);
			return is_numeric($binding) ? $binding : "'{$binding}'";
		})->toArray());
	}

	/*
    * @method	  : getHostListing
    * @params	  : none
    * @developer  : Devloper @KS
    * @date	  	  : 20-10-2021
    * @purpose	  : get host user listing
    * @intent	  : get host listing with the help of relationship with user table and listing_location table
    * @return	  : @collection
    */ 
    public function getHostListing($search=null){
		$hostListing = DB::table('listing')
		->select('listing.id', 'listing.user_id', 'ui.name as profile_img' ,DB::raw("CONCAT(ua.address,' ,',ua.city, ' ,'  ,ua.zip, ' ,' ,ua.country ) as adress"), 'user1.slug','user1.username',DB::raw("CONCAT(user1.first_name,' ',user1.last_name) as fullname"),DB::raw("CONCAT(user1.phone_prefix,' ',user1.phone) as phone"),'ll.country','ll.city','gc.address', 'local_node.name as Local_node','lng.responsibility as node_level')
		->join('user as user1',  'listing.user_id', '=', 'user1.id')
		->join('user_address as ua',  'ua.user_id', '=', 'user1.id')
		->join('listing_location as ll',  'listing.location_id', '=', 'll.id')
		->join('geo_coordinate as gc',  'll.coordinate_id', '=', 'gc.id')
		->join('local_node_geo as lng',function($join)
		{
			$join->where(function($q)
					   {
						$q->where('gc.zip','=', DB::raw("`lng`.`zip`"))
						  ->orWhereNull('lng.zip');
					})
				  ->where(function($q2)
					{
						$q2->where('gc.city_id','=', DB::raw("`lng`.`city_id`"))
						   ->orWhereNull('lng.city_id');
					})
				  ->where(function($q2)
					{
						$q2->where('gc.department_id','=', DB::raw("`lng`.`department_id`"))
						   ->orWhereNull('lng.department_id');
					})
				  ->where(function($q2)
					{
						$q2->where('gc.area_id','=', DB::raw("`lng`.`area_id`"))
						   ->orWhereNull('lng.area_id');
					})
				  ->on('gc.country_id','=', DB::raw("`lng`.`country_id`"))
				  ->on('lng.Incl_Excl','=',DB::raw("'I'"))
				/* select correct level, how better defined the better, so exclude less defined matches */
				->whereNotExists(function ( $query)
				{
					 $query->select('*')
						   ->from('local_node_geo as lng2')
						   ->where('lng2.local_node_id','=', DB::raw("`lng`.`local_node_id`"))
						   ->where(function($q)
						   {
							   $q->where('gc.zip','=', DB::raw("`lng2`.`zip`"))
								 ->orWhereNull('lng2.zip');
						   })
						   ->where(function($q2)
						   {
							   $q2->where('gc.city_id','=', DB::raw("`lng2`.`city_id`"))
								  ->orWhereNull('lng2.city_id');
						   })
						   ->where(function($q2)
						   {
							   $q2->where('gc.department_id','=', DB::raw("`lng2`.`department_id`"))
								  ->orWhereNull('lng2.department_id');
						   })
						   ->where(function($q2)
						   {
							   $q2->where('gc.area_id','=', DB::raw("`lng2`.`area_id`"))
								  ->orWhereNull('lng2.area_id');
						   })
						   ->where('gc.country_id','=',DB::raw("`lng2`.`country_id`"))
						   ->where('lng2.Incl_Excl','=', 'I')
						   ->where('lng2.geo_level','>', DB::raw("`lng`.`geo_level`"));
				})
				/* exclude excluding areas */
				->whereNotExists(function ( $query)
				{
					 $query->select('*')
						   ->from('local_node_geo as lng3')
						   ->where('lng3.local_node_id','=', DB::raw("`lng`.`local_node_id`"))
						   ->where(function($q)
						   {
							   $q->where('gc.zip','=', DB::raw("`lng3`.`zip`"))
								 ->orWhereNull('lng3.zip');
						   })
						   ->where(function($q2)
						   {
							   $q2->where('gc.city_id','=', DB::raw("`lng3`.`city_id`"))
								 ->orWhereNull('lng3.city_id');
						   })
						   ->where(function($q2)
						   {
							   $q2->where('gc.department_id','=', DB::raw("`lng3`.`department_id`"))
								 ->orWhereNull('lng3.department_id');
						   })
						   ->where(function($q2)
						   {
							   $q2 ->where('gc.area_id','=', DB::raw("`lng3`.`area_id`"))
								 ->orWhereNull('lng3.area_id');
						   })
						  ->where('gc.country_id','=',DB::raw("`lng3`.`country_id`"))
						  ->where('lng3.Incl_Excl','=', 'E')
						  ->where('lng3.geo_level','>', DB::raw("`lng`.`geo_level`"));
				})
				/* exclude all existing nodes for country  */
				->whereNotExists(function ( $query)
				{
					 $query->select('*')
						   ->from('local_node_geo as lng4')
						   ->where('lng4.local_node_id','!=', DB::raw("`lng`.`local_node_id`"))
						   ->where(function($q)
						   {
							   $q->where('gc.zip','=', DB::raw("`lng4`.`zip`"))
								 ->orWhereNull('lng4.zip');
						   })
						   ->where(function($q2)
						   {
							   $q2->where('gc.city_id','=', DB::raw("`lng4`.`city_id`"))
								 ->orWhereNull('lng4.city_id');
						   })
						   ->where(function($q2)
						   {
							   $q2->where('gc.department_id','=', DB::raw("`lng4`.`department_id`"))
								 ->orWhereNull('lng4.department_id');
						   })
						   ->where(function($q2)
						   {
							   $q2 ->where('gc.area_id','=', DB::raw("`lng4`.`area_id`"))
								 ->orWhereNull('lng4.area_id');
						   })
						   ->where('gc.country_id','=',DB::raw("`lng4`.`country_id`"))
						   ->where('lng4.Incl_Excl','=', 'I')
						   ->where('lng4.geo_level','<', DB::raw("`lng`.`geo_level`"));
				});

		})
		->join('local_node','local_node.id', '=', 'lng.local_node_id')
		->join('local_node_ambassadors','local_node_ambassadors.local_node_id', '=', 'lng.local_node_id')
		->leftJoin('user_image as ui', function ($join) {
			$join->on('listing.user_id', '=', 'ui.user_id')
				->whereRaw(DB::raw('listing.user_id = ui.user_id'));
	   });
		$hostListing->where('local_node_ambassadors.user_id', '=', Auth::id());
		$hostListing->distinct(); 

		if($search != null){

			$hostListing->where('first_name', 'like', '%'.$search.'%')
			->orWhere('ua.address', 'like', '%'.$search.'%')
			->orWhere('ua.city', 'like', '%'.$search.'%')
			->orWhere('ua.country', 'like', '%'.$search.'%')
			->orWhere('user1.phone', 'like', '%'.$search.'%');
		}
		return $hostListing->orderBy('listing.id', 'desc');
		
    }

	/*
    * @method	  : getHostDetails
    * @params	  : $id
    * @developer  : Devloper @KS
    * @date	  	  : 20-10-2021
    * @purpose	  : to show host user details
    * @intent	  : get host details with the help of relationship with listing table, listing_translation table and listing_image table
     * @return	  : @collection
    */  
	public function getHostDetails($slug){

		return User::with(['listing' => function($query){
			$query->with(['listing_location'  => function($query){

				$query->with('geo_coordinate');

	   		}, 'listing_translation','listing_image']);
		}])->where('slug', $slug)->first();
	}

	/*
    * @method	  : getListingDetails
    * @params	  : $query
    * @developer  : Devloper @KS
    * @date	  	  : 10-11-2021
    * @purpose	  : to show Listing details
    * @intent	  :  
     * @return	  : @collection
    */  
	public function getListingDetails($id)
	{
			$attribute =$attrs =[];

			$listing = Listing::with(['listing_translation', 'listing_image', 'listing_attributes' => function($query){

			$query->with(['attribute'=> function($query){

				$query->with(['listing_attribute_option'=> function($query3){

				$query3->with(['listing_attribute_option_translation']);

			}]);

			}, 'listing_attribute_text_translation','listing_attribute_switch','listing_attribute_number','listing_attribute_date','listing_attribute_select' => function($query){

				$query->with(['listing_attribute_option_translation']);

			}]);

			}])->where('id', $id)->first();	

	 
			foreach($listing->listing_attributes as $lattr){
				//dd( $lattr);
               if($lattr->value_type == 'date'){ 
				    $listingAttributes[$lattr->attribute_id]=  optional($lattr->listing_attribute_date)->value ;
			   }elseif($lattr->value_type == 'switch'){ 
				     $listingAttributes[$lattr->attribute_id]=  optional($lattr->listing_attribute_switch)->value;
			   }
			   elseif($lattr->value_type == 'number'){ 
				     $listingAttributes[$lattr->attribute_id]=  optional($lattr->listing_attribute_number)->value;
			   }elseif($lattr->value_type == 'select'){
				    
				  // dd($lattr->listing_attribute_select[0]->listing_attribute_option_translation);
				     $listingAttributes[$lattr->attribute_id]=  optional(optional($lattr->listing_attribute_select)->first()->listing_attribute_option_translation)->title;
			   }else{
				  $listingAttributes[$lattr->attribute_id]=  optional($lattr->listing_attribute_text_translation)->value ; 
			   }

	        // $listingAttributes[$lattr->attribute_id]=  optional($lattr->listing_attribute_text_translation)->value;
				foreach($lattr->attribute as $attr){
					$attrs[]= $attr->group_id;
				    //echo"<pre>"; print_r($attr->listing_attribute_text);
				
				}	
			}
		  
			//die();
			$attrs = array_unique($attrs);
			//DB::enableQueryLog();
			
		   	/*$attribute= Attributes::with(['attribute_translation','listing_attribute_option' => function($query3){

				$query3->with(['listing_attribute_option_translation']);

			}, 'attribute_group_translation','listing_attribute' => function($query){

				$query->with(['listing_attribute_number','listing_attribute_text_translation','listing_attribute_text' => function($query1){

				$query1->with(['listing_attribute_text_translation']);

			}]);

			}])->whereIn('group_id', $attrs)->get();*/
            $attributeGroup= ListingAttributeGroup::with(['attribute'=> function($query){

				$query->with(['listing_attribute','attribute_translation','listing_attribute_option'=> function($query1){

				$query1->with(['listing_attribute_option_translation']);

			}]);

			},'listing_attribute_option'=> function($query1){

				$query1->with(['listing_attribute_option_translation']);

			},'attribute_group_translation'])->orderBy('sort', 'ASC')->get();
		 //  $attributeGroup= ListingAttributeGroup::with(['attribute','listing_attribute_option','attribute_group_translation'])->whereIn('id', $attrs)->orderBy('sort', 'ASC')->get();
            $attributeGroupData=array();
           /* $attributeData=array();  
			foreach ($attribute as $key => $value) { 
			    $attributeData[$value->id]=$value; 
				 
			}*/
			 
			return array('listing'=> $listing, 'listingAttributes' => $listingAttributes,  'attributeGroup'=>$attributeGroup);

	}

	/*
    * @method	  : getRules
    * @developer  : Devloper @KS
    * @date	  	  : 26-10-2021
    * @purpose	  : to show rules listing on the listing details page
    * @intent	  : to show rules listing on the listing details with the help of relationship with node_rule_translation table
    * @return	  : @collection
    */ 
	public function getRules()
	{
		$localNode = LocalNodeAmbassador::where('user_id',  Auth::id())->first();
        return Rules::with('rule_translation')->where('local_node_id', $localNode->local_node_id)->get();
	}

	/*
    * @method	  : certifyListing
    * @developer  : Devloper @KS
    * @date	  	  : 27-10-2021
    * @purpose	  : certify listing accpeted/rejected
    * @intent	  : certify listing accpeted/rejected with help of relationship table
    * @return	  : @Boolan
    */ 
	public function certifyListing($request){

		$listingTrans =  ListingTranslation::where(['translatable_id' => $request->id, 'locale' => app()->getLocale() ])->update(['rules' => $request->rules_data, 'signature' => $request->sign ]);
		
		$certify = ($request->status == 'certify') ? 1 : 2;
		$update = Listing::where(['id' => $request->id ])->update(['certified' => $certify ]);

        if($request->status == 'certify') {
            ListingCertificate::insert(['listing_id' => $request->id, 'certificate' => $request->certificate,
                'signature' => $request->signature, 'public_key' => $request->pk, 'blockchain_hash' => $request->sawtooth_hash,
                'blockchain_id' => $request->sawtooth_id]);
        }

		$listing = $this->user($request->id);
		$user = User::findOrFail($listing->user_id);

		if($request->status == 'certify'){
			$subject = 'Listing Certify';
			$email_message = 'Your listing is certified, please contact Ambassador for more details.';

		}else{
			$subject = 'Certification Revoked';
			$email_message = 'Your listing certification is revoked, please contact Ambassador for more details and for re-certify.';
		}

		$user->notify(new SendEmailNotification($subject, $email_message));

		return true;
		
	}

	public function user($id)
	{
		return Listing::where(['id' => $id ])->first();

	}

	public function getListing($id)
	{
		return Listing::where(['id' => $id ])->first();

	}
	public function getFeeAsAsker()
	{
   
		return $fee_as_asker = DB::table('config')
							->select(DB::raw("JSON_EXTRACT(value, '$.percent') as fee_as_asker"))
							->where('name','cocorico_booking.fee_as_asker')->get();
							

	}
	/*
    * @method	  : listingReview
    * @developer  : Devloper @KS
    * @date	  	  : 11-11-2021
    * @purpose	  : get listing review with users 
    * @intent	  : get listing review with help of relationship
    * @return	  : @array
    */ 
	public function listingUpgradesReview($id)
	{  
		
		$rating = $user = $booking_option =[];

		$reviews = Listing::with(['booking' => function($query){

						$query->with(['reviews', 'booking_option']);
					
					}])->where('id', $id)->first();
		
		foreach ($reviews->booking as $key => $booking) {
           
			if(!empty($booking->reviews)){
				$rating [] = $booking->reviews;
				$user []  = DB::table('user')->where('id', $booking->reviews->review_by)->first();    
			}
		 }

		foreach($reviews->booking as $booking){

			if(!empty($booking->booking_option)){
 
				$booking_option[] = $booking->booking_option->id;
			}
		}
		
		$upgrades = BookingOption::with('booking_option_translation')->whereIn('id', $booking_option)->get();

		return array('user' => $user, 'rating' =>   $rating, 'upgrades' => $upgrades);
	}

	public function listingCalendar($id)
	{
		return  $calendar = DB::table('listing')		                          
							->join('calendar as ca',  'listing.id', '=', 'ca.listing_id')	
							->select(DB::raw('(listing.price/100) as dprice'), 'ca.*') 
							->groupBy()
							->where('listing.id',$id)
							->get(); 
	}

	public function findAvailabilitiesByListing($listingId, $start, $end, $endDayIncluded = false, $hydrate = false, $status = null)
	{    
	     //DB::enableQueryLog(); // Enable query log
		// $listingId = 446276980;
		  $calendar = DB::table('calendar as c')		                      	
							->select( 'c.*') 
							->groupBy()
							->where('c.listing_id',$listingId)
							->where('c.cal_date','>=', $start); 
					   if (!$endDayIncluded) { 
						   $calendar->where('c.cal_date','<',$end); 
					    }else { 
							$calendar->where('c.cal_date','<=', $end); 
						}
						if (null !== $status) { 
							$calendar->where('c.status',$status);
						}
						
		   return  	$calendar->get();		
         //  dd(DB::getQueryLog()); // Show results of log				
         //  dd(DB::getQueryLog()); // Show results of log				
		}
 

	public function listingLocation($id)
	{
		return	Listing::with(['listing_location' => function($query){

							     $query->with('geo_coordinate');

						}])->where('id', $id)->first();	
	}

	/*
    * @method	  : listingId
    * @developer  : Devloper @KS
    * @date	  	  : 12-11-2021
    * @purpose	  : get listing ID from slug
    * @intent	  : get listing  ID from slug for further use
    * @return	  : @Integer
    */ 
	public function listingId($slug)
	{
		$listingTrans =  ListingTranslation::where(['slug' => $slug, 'locale' => app()->getLocale() ])->first();

		if($listingTrans)
		{
		 	return $listingTrans->translatable_id;

		}else{
			return null;
		}
	}
	/*
    * @method	  : getBadges
    * @developer  : Devloper @KS
    * @date	  	  : 17-11-2021
    * @purpose	  : get badges for assigning
    * @intent	  : get badges for further use
    * @return	  : @Integer
    */ 
	public function getAllBadges()
	{
	  return $ListingBadges =  ListingBadges::get();
 
	}
	/*
    * @method	  : insertAssignBadges
    * @developer  : Devloper @KS
    * @date	  	  : 17-11-2021
    * @purpose	  : insert badges for assigning
    * @intent	  : insert badges for further use
    * @return	  : @Integer
    */ 
	public function insertAssignBadges($request)
	{
	       if($request){  
				foreach($request['badges_id'] as $badgesId){			  
					$data = array('badges_id' => $badgesId, 'listing_id' => $request['listing_id']);
					$insert = 	Assignlistingbadges::insert($data);
					
				}
			if($insert){
				return true;

			}else{
				return false;
			}
          
			
 
	  }
 
	}
	/*
    * @method	  : getAssignbadges
    * @developer  : Devloper @KS
    * @date	  	  : 17-11-2021
    * @purpose	  : get Assignbadges for assigning
    * @intent	  : get Assignbadges  
    * @return	  : @Integer
    */ 
	public function getAssignbadges($listingId)
	{
	       
		return Assignlistingbadges::with('ListingBadges')->where('listing_id',$listingId)->groupBy()->get();
	  
 
	}

	public function checkAnswers($request)
	{

        $result = UserQuestion::where(["user_id" => Auth::id()])->first();
		$encMessages =null;

		if(!$result) {

            $add = new UserQuestion;
            $add->user_id = Auth::id();
            $add->answers  = $request->answers;
            $add->save();
            $return = 1;
			$encMessages = $request->answers;

        }else {
            if ($result->answers == $request->answers) {
                $return = 1;
				$encMessages = $result->answers;
            }else{
				$return = 0;
			}
        }

        $ajaxReturn = [
            $return,
            $encMessages,
        ];

        die(json_encode($ajaxReturn));
	}

	public function savePublicKey($request)
	{

		$result = UserQuestion::where(["user_id" => Auth::id()])->first();

		if($result) {

			UserQuestion::where(["user_id" => Auth::id()])->update(['public_key' => $request->public_key ]);
			return 1;
		}else{
			return 0;
		}
	}

    // ITC START
    public function getUserPublicKey()
    {

        $result = UserQuestion::where(["user_id" => Auth::id()])->first();
        if($result) {
            return $result["public_key"];
        } else {
            return null;
        }
    }

    public function getLaDetails() {
        $result = User::where(["id" => Auth::id()])->first();
        return $result;
    }

    public function getCertDetails($listingId) {
        $result = ListingCertificate::where(["listing_id" => $listingId])->first();
        return $result;
    }
    // ITC END
}
 