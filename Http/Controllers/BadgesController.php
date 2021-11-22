<?php

namespace Modules\Ledger\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repository\UserInterface;
use Modules\Ledger\Repository\Listing\ListingInterface;
use Modules\Ledger\Repository\Badges\BadgesInterface;
use Modules\Ledger\Entities\LocalNodeAmbassador;
use Auth;
use View;
use DataTables;
use Validator;

class BadgesController extends Controller
{

    private $listingRepository = null; 
    private $userRepository = null; 
    private $badgesRepository = null; 
    public function __construct(ListingInterface $listingRepository, UserInterface $userRepository, BadgesInterface $badgesRepository){
        $this->listingRepository    = $listingRepository;
        $this->userRepository       = $userRepository;
        $this->badgesRepository     = $badgesRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->badgesRepository->getBadgesListing();   
             
            return Datatables::of($data)
                    ->addIndexColumn()                     
                    ->addColumn('action', function($data){
                       $btn = '<a href="javascript:void(0)" data-ruleid="'.$data->id.'"  onClick="editRule('.$data->id.')" id="edit_rule_'.$data->id.'" class="edit btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i></a><a href="javascript:void(0)" class="edit btn-sm" id="delete_'.$data->id.'" onClick="deleteRule('.$data->id.')"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('ledger::badges.index');
    }

    /**
    * @method	  : add
    * @param	  : Request $request
    * @developer  : Devloper @KS
    * @date	  	  : 16-11-2021
    * @purpose	  : add data
    * @intent	  : add with the help of repository functions
    * @return	  : Renderable
    */
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'file'  => 'required|file|mimes:jpg,jpeg,png',
            'level' => 'required',
            'categories' => 'required',
             
             
        ]);
        if ($validator->passes()) {  
            $response =  $this->badgesRepository->addBadges($request->all());
            if($response){
                return response()->json([
                   "message"       => 'success',
                   "isSucceeded"   => TRUE,
                  
               ]);
            }else{
                return response()->json([
                    "message"       => 'failed',
                    "isSucceeded"   => FALSE,
                   
                ]);
    
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]);
        
         
    }

    /**
    * @method	  : get
    * @param	  : Request $request
    * @developer  : Devloper @KS
    * @date	  	  : 16-11-2021
    * @purpose	  : get Badges data
    * @intent	  : get Badges data with the help of repository functions to show Badges list
    * @return	  : JSON data
    */

    public function get(Request $request)
    {
        
        $response =  $this->badgesRepository->getBadges($request->get('id'));
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
    * @date	  	  : 17-11-2021
    * @purpose	  : to delete badges
    * @intent	  : to delete rule from the db with the help of repository functions
    * @return	  : JSON data
    */

    public function delete(Request $request)
    {
        $res = $this->badgesRepository->delete($request->get('id'));

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
