<?php
namespace Modules\Ledger\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repository\UserInterface;
use Modules\Ledger\Repository\Listing\ListingInterface;
use Illuminate\Support\Facades\Hash;
use Auth;
use View;
use DB;
class LedgerController extends Controller
{
    private $listingRepository = null; 
    private $userRepository = null; 
    public function __construct(ListingInterface $listingRepository, UserInterface $userRepository){
        $this->listingRepository = $listingRepository;
        $this->userRepository = $userRepository;
    }    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        //Auth::user()->attachPermission('create-listing');
        // Auth::user()->attachRole('Admin');        
        return view('ledger::index');
    }

    /**
    * @method	  : hostList
    * @developer  : Devloper @KS
    * @date	  	  : 21-10-2021
    * @purpose	  : get all host list data against the listing data
    * @intent	  : get all host list data with the help of repository functions
    * @return	  : Renderable
    */
    public function hostList()
    {
        $title = "Host";
        $image_path ='https://booking.fairbnb.coop/media/cache/listing_xxmedium/uploads/listings/images/';
        $profile_path = 'https://booking.fairbnb.coop/media/cache/user_medium/uploads/users/images/';
        $listing = $this->listingRepository->getHostListing()->paginate(15);
        return view('ledger::host.index', compact('listing', 'image_path','profile_path'));
    }

    /**
    * @method	  : hostListAjax
    * @param	  : Request $request
    * @developer  : Devloper @KS
    * @date	  	  : 21-10-2021
    * @purpose	  : ajax call for pagination to get next page host list data
    * @intent	  : ajax call for pagination to get next page host list data with the help of repository functions
    * @return	  : Renderable
    */
    public function hostListAjax(Request $request)
    {

        $image_path ='https://booking.fairbnb.coop/media/cache/listing_xxmedium/uploads/listings/images/';
        $profile_path = 'https://booking.fairbnb.coop/media/cache/user_medium/uploads/users/images/';
        $search = $request->get('search');

        if($request->ajax() || isset($search))
        {  
            $query = $request->get('query');
            if($query != '')
            {
                $listing = $this->listingRepository->getHostListing($query);
                $listing= $listing->paginate(15);
                $listing->appends(['search' => $query]);
            }
            elseif( $search != '')
            {
                $listing = $this->listingRepository->getHostListing($search);
                $listing= $listing->paginate(15);
                $listing->appends(['search' => $search]);
            }
            else{
                $listing = $this->listingRepository->getHostListing($search=null);
                $listing= $listing->paginate(15);
            }

            $html = View::make('ledger::host.host-ajax-list',compact('listing', 'image_path','profile_path'))->render();
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
    * @method	  : hostDetails
    * @param	  : Request $request
    * @developer  : Devloper @KS
    * @date	  	  : 21-10-2021
    * @purpose	  : show host user deatils
    * @intent	  : host user details data with the help of repository functions
    * @return	  : Renderable
    */
    public function hostDetails(Request $request){
        
        $image_path ='https://booking.fairbnb.coop/media/cache/listing_xxmedium/uploads/listings/images/';
        
        $hostdetails = $this->listingRepository->getHostDetails($request->id);
        if($hostdetails){            
            $nextPrevious = $this->listingRepository->getHostListing()->get(); 
            $id = $hostdetails->listing[0]->id;
            $index = $nextPrevious->search(function($listing) use($id) {
                return $listing->id === $id;
            });
            $preId =$nextId = null;
            if($index > 0){
                $previous = $nextPrevious->slice($index-1, 1);
                foreach($previous as $detail){
                    $preId= $detail->slug;
                }
            }
            $next = $nextPrevious->slice($index+1, 1);
            foreach($next as $detail){
                $nextId= $detail->slug;
            }
            return view('ledger::host.host-details', compact('hostdetails', 'image_path', 'preId', 'nextId'));
        
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
     * Show the ledger profile.     
     * @return Renderable
     */
    public function profile()
    {
        return view('ledger::profile.profile');
    }
    
    public function checkAnswers(Request $request)
    {   

        return $this->listingRepository->checkAnswers($request);

    }
     /**
     * Show the ledger profile.     
     * @return Renderable
     */
    public function profileSetting()
    {   
        $userId =  Hash::make(Auth::id());

        // ITC START
        $publicKey =  $this->listingRepository->getUserPublicKey();

        return view('ledger::profile.settings', compact('userId', 'publicKey'));

        //return view('ledger::profile.settings', compact('userId'));

        // ITC END
    }
    
    public function savePublicKey(Request $request)
    {
        return $this->listingRepository->savePublicKey($request);
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

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}

