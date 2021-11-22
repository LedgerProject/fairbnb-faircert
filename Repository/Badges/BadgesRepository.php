<?php

namespace Modules\Ledger\Repository\Badges;

use App\Repository\Eloquent\BaseRepository;
use Modules\Ledger\Repository\Badges\BadgesInterface as BadgesInterface;
use Modules\Ledger\Entities\Rules;
use Modules\Ledger\Entities\ListingBadges;
use Modules\Ledger\Entities\LocalNodeAmbassador;
use Modules\Ledger\Entities\RuleTranslation;
use DB;
use App\Models\User; 
use Auth;

class BadgesRepository extends BaseRepository implements BadgesInterface
{
    protected $model = null;
	
	public function __construct(ListingBadges $model)
	{
		$this->model=$model;
	}

    /*
    * @method	  : getbadgesListing
    * @developer  : Devloper @KS
    * @date	  	  : 17-11-2021
    * @purpose	  : get all badges listing data
    * @intent	  : get all badges listing data with the help of relationship with listing_translation table
    * @return	  : collection
    */ 
    public function getbadgesListing()
    {   
        $localNode = LocalNodeAmbassador::where('user_id',  Auth::id())->first();
        return ListingBadges::orderBy('id', 'desc')->get();
    }

    /*
    * @method	  : orderingStatus
    * @params	  : sort
    * @developer  : Devloper @KS
    * @date	  	  : 26-10-2021
    * @purpose	  : get rule ordering from the db
    * @intent	  : get rule ordering from the db with the help of common function SortingRange() 
    * @return	  : sorting values array
    */  
    public function orderingStatus($sort)
    {   
        $localNode = LocalNodeAmbassador::where('user_id',  Auth::id())->first();
        return $this->SortingRange($localNode->local_node_id, $sort);
    }

    /*
    * @method	  : addBadges
    * @params	  : request
    * @developer  : Devloper @KS
    * @date	  	  : 16-11-2021
    * @purpose	  : add/update Badges to the db
    * @intent	  : add/update Badges to the db with the help of data request type
    * @return	  : sorting values array
    */ 
    public function addBadges($request)
    { 
          
        $user_id = auth()->user()->id;   
        if ($files = $request['file']) {                
            $upload_path = public_path('badgesIcons');
            $file_name = $request['file']->getClientOriginalName();
            $generated_new_name = time().'.'.$request['file']->getClientOriginalExtension();
            $request['file']->move($upload_path, $generated_new_name);  
            
          }
          if($file_name){
              $icon = $generated_new_name;                
           }else{
              $icon  = 'gold.jpg'; 
           }         
        if(!empty($request['badges_id'])){
                 $update = ListingBadges::where('id', $request['badges_id'])->update(['title' => $request['title'], 'icon' => $icon , 'categories' => $request['categories'], 'level' => $request['level'], 'description' => $request['desc'] ]);
            
         }else{ 
            $title  = $request['title'];
            $desc   = $request['desc'];           
            $categories   = $request['categories']; 
            $level   = $request['level'];            
            $status  = 2;            
            $values = array('title' => $title,'description' => $desc, 
                'icon' => $icon,
                'categories' => $categories,
                'level' => $level,
                'status' => $status,
                'user_id'=>$user_id
            ); 
             return  ListingBadges::insert($values);
            }
 
    }
 

    /*
    * @method	  : getBadges
    * @params	  : id
    * @developer  : Devloper @KS
    * @date	  	  : 26-10-2021
    * @purpose	  : get Badges info to edit Badges values
    * @intent	  : get Badges info to edit Badges values with the help of relationship with listing_translation table
    * @return	  : collection
    */ 
    public function getBadges($id){
        $getBadges = ListingBadges::where('id', $id)->first();         
        return $getBadges;

    }

    /*
    * @method	  : delete
    * @params	  : id
    * @developer  : Devloper @KS
    * @date	  	  : 16-11-2021
    * @purpose	  : delete Badges from the db
    * @intent	  : delete Badges from the db with the help of with models
    * @return	  : boolean value
    */ 
    public function delete($id)
    {
        $deleteBadges  = ListingBadges::findOrFail($id)->delete();        
        if($deleteBadges)
        {    
            return true;
        }else{
            return false;
        }
    }

}
