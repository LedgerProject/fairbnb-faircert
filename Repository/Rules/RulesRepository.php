<?php

namespace Modules\Ledger\Repository\Rules;

use App\Repository\Eloquent\BaseRepository;
use Modules\Ledger\Repository\Rules\RulesInterface as RulesInterface;
use Modules\Ledger\Entities\Rules;
use Modules\Ledger\Entities\LocalNodeAmbassador;
use Modules\Ledger\Entities\RuleTranslation;
use DB;
use App\Models\User; 
use Auth;

class RulesRepository extends BaseRepository implements RulesInterface
{
    protected $model = null;
	
	public function __construct(Rules $model)
	{
		$this->model=$model;
	}

    /*
    * @method	  : getRuleListing
    * @developer  : Devloper @KS
    * @date	  	  : 25-10-2021
    * @purpose	  : get all rules listing data
    * @intent	  : get all rules listing data with the help of relationship with listing_translation table
    * @return	  : collection
    */ 
    public function getRuleListing()
    {   
        $localNode = LocalNodeAmbassador::where('user_id',  Auth::id())->first();
        return Rules::with('rule_translation')->where('local_node_id', $localNode->local_node_id);
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
    * @method	  : addRule
    * @params	  : request
    * @developer  : Devloper @KS
    * @date	  	  : 26-10-2021
    * @purpose	  : add/update rules to the db
    * @intent	  : add/update rules to the db with the help of data request type
    * @return	  : sorting values array
    */ 
    public function addRule($request)
    {

        $localNode = LocalNodeAmbassador::where('user_id',  Auth::id())->first();
    
        if(!empty($request['rule_id'])){

           $update = Rules::where('id', $request['rule_id'])->update(['type_of_rule' => $request['type'], 'ordering' => $request['sort_order'] ]);

           RuleTranslation::where('translatable_id', $request['rule_id'])->update(['value' => $request['rule'], 'description' => $request['desc']]);


        }else{

            $add= new Rules;
            $add->local_node_id = $localNode->local_node_id;
            $add->type_of_rule  = $request['type'];
            $add->ordering      = $request['sort_order'];
            $add->save();
            
            $lastId = $add->id;

            $values = array('translatable_id' => $lastId,'value' => $request['rule'], 'description' => $request['desc'], 'locale' => 'en');
            RuleTranslation::insert($values);

        }
        return $this->SortingRange($localNode->local_node_id, 'soft-rule');
          
    }

    /*
    * @method	  : SortingRange
    * @params	  : id, sort
    * @developer  : Devloper @KS
    * @date	  	  : 26-10-2021
    * @purpose	  : get rule ordering from the db
    * @intent	  : common function to get rule ordering from the db 
    * @return	  : array
    */ 
    public function SortingRange($id, $sort){

        $sortOrder = range(1,100);

        if($sort == 'soft-rule'){
            
            $softRuleSort = Rules::where(['local_node_id' => $id ])->pluck('ordering')->toArray();

            if(count($softRuleSort) > 0){
                $clean1 = array_diff($softRuleSort, $sortOrder); 
                $clean2 = array_diff($sortOrder, $softRuleSort); 
                $softSortOrder = array_merge($clean1, $clean2);
            }else{
                $softSortOrder = $sortOrder;
            }
            return $softSortOrder;

        }else{

            $hardRuleSort = Rules::where(['local_node_id' => $id , 'type_of_rule' => 'hard-rule'])->pluck('ordering')->toArray();
    
            if(count($hardRuleSort) > 0){
                $clean1 = array_diff($hardRuleSort, $sortOrder); 
                $clean2 = array_diff($sortOrder, $hardRuleSort); 
                $hardSortOrder = array_merge($clean1, $clean2);
            }else{
                $hardSortOrder = $sortOrder;
            }
            return $hardSortOrder;
        }
    }

    /*
    * @method	  : getRule
    * @params	  : id
    * @developer  : Devloper @KS
    * @date	  	  : 26-10-2021
    * @purpose	  : get rule info to edit rule values
    * @intent	  : get rule info to edit rule values with the help of relationship with listing_translation table
    * @return	  : collection
    */ 
    public function getRule($id){

        return Rules::with('rule_translation')->where('id', $id)->first();
    }

    /*
    * @method	  : delete
    * @params	  : id
    * @developer  : Devloper @KS
    * @date	  	  : 26-10-2021
    * @purpose	  : delete rule from the db
    * @intent	  : delete rule from the db with the help of with models
    * @return	  : boolean value
    */ 
    public function delete($id)
    {
        $deleteTrans = RuleTranslation::where('translatable_id', $id)->delete();
        $deleteRule  = Rules::findOrFail($id)->delete();
        
        if($deleteTrans && $deleteRule)
        {    
            return true;
        }else{

            return false;
        }
    }

}
