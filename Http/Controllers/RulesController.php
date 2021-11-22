<?php
namespace Modules\Ledger\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repository\UserInterface;
use Modules\Ledger\Repository\Listing\ListingInterface;
use Modules\Ledger\Repository\Rules\RulesInterface;
use Modules\Ledger\Entities\LocalNodeAmbassador;
use Auth;
use View;
use DataTables;
class RulesController extends Controller
{
    private $listingRepository = null; 
    private $userRepository = null; 
    private $rulesRepository = null; 
    public function __construct(ListingInterface $listingRepository, UserInterface $userRepository, RulesInterface $rulesRepository){
        $this->listingRepository    = $listingRepository;
        $this->userRepository       = $userRepository;
        $this->rulesRepository     = $rulesRepository;
    }
    
    /**
    * @method	  : index
    * @developer  : Devloper @KS
    * @date	  	  : 25-10-2021
    * @purpose	  : get all rules data for the ambassador
    * @intent	  : get all rules listing with the help of repository functions
    * @return	  : Renderable
    */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->rulesRepository->getRuleListing()->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('value', function ($data) {
                        return $data->rule_translation[0]->value;
                    })
                    ->addColumn('desc', function ($data) {
                        return $data->rule_translation[0]->description;
                    })
                    ->addColumn('action', function($data){
                       $btn = '<a href="javascript:void(0)" data-ruleid="'.$data->id.'"  onClick="editRule('.$data->id.')" id="edit_rule_'.$data->id.'" class="edit btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i></a><a href="javascript:void(0)" class="edit btn-sm" id="delete_'.$data->id.'" onClick="deleteRule('.$data->id.')"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['value', 'action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        $title = "Rule Listing";
        $order = $this->rulesRepository->orderingStatus('ordering');
        return view('ledger::rules.index',  compact('order','title'));
    }

    /**
    * @method	  : add
    * @param	  : Request $request
    * @developer  : Devloper @KS
    * @date	  	  : 25-10-2021
    * @purpose	  : add data
    * @intent	  : add with the help of repository functions
    * @return	  : Renderable
    */
    public function add(Request $request)
    {
        $response =  $this->rulesRepository->addRule($request->params);
        return $response;
    }

    /**
    * @method	  : get
    * @param	  : Request $request
    * @developer  : Devloper @KS
    * @date	  	  : 26-10-2021
    * @purpose	  : get rules data
    * @intent	  : get rules data with the help of repository functions to show rules list
    * @return	  : JSON data
    */

    public function get(Request $request)
    {
        
        $response =  $this->rulesRepository->getRule($request->get('id'));
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
    * @method	  : getRuleOrdering
    * @param	  : Request $request
    * @developer  : Devloper @KS
    * @date	  	  : 26-10-2021
    * @purpose	  : get rules ording(sorting) status data
    * @intent	  : get rules ording status data with the help of repository functions to show on change rule type
    * @return	  : JSON data
    */
    public function getRuleOrdering(Request $request)
    {

        $response =  $this->rulesRepository->orderingStatus('soft-rule');
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
    * @method	  : delete
    * @param	  : Request $request
    * @developer  : Devloper @KS
    * @date	  	  : 26-10-2021
    * @purpose	  : to delete rule
    * @intent	  : to delete rule from the db with the help of repository functions
    * @return	  : JSON data
    */

    public function delete(Request $request)
    {
        $res = $this->rulesRepository->delete($request->get('id'));

        if($res){
            return response()->json([
               "message"       => 'delete successfully.',
               "isSucceeded"   => TRUE,
               "data"          => $res,
           ]);
        }else{
            return response()->json([
                "message"       => 'cannot be deleted.',
                "isSucceeded"   => FALSE,
                "data"          => $res,
            ]);
        }
    }
    
}
