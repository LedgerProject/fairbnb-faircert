@if(count($listings))
@forelse($listings as $list)
<div class="single-list">
    <div class="row align-items-center">

        <div class="col-md-7 order-md-2">
             <a href="{{route('ledger.listdetail',['slug'=>$list->list_slug])}}">
            <h2 class="featurette-heading d-flex align-items-center">
                
            @php 
                $checkProfile = remote_file_exists($_SERVER['DOCUMENT_ROOT'].'/storage/user/user_medium/uploads/users/images/'. $list->profile_img);
    
                if($checkProfile == 1){
                    $profile_path = asset('storage/user/user_medium/uploads/users/images/'. $image->name );

                }else{
                    $profile_path = asset('storage/user/user_medium/uploads/users/images/default-user.png');
                }
            @endphp
           
                <img src="{{ $profile_path }}" class="rounded-circle" alt="img" />
           
                <p class="text-muted ml-2">{{$list->title}} <span class="location">{{$list->address}}</span></p>
            </h2> 
            </a>
            <p class="desc">{{ mb_strimwidth($list->description, 0, 300, '.....') }}</p>
        </div>
        <div class="col-md-2 order-md-1">

        <a href="{{route('ledger.listdetail',['slug'=>$list->list_slug])}}">
            
            @php
                $imgRelPath = '/storage/listings/listing_xlarge/uploads/listings/images/'. $list->list_img;
                $imgPath = $_SERVER['DOCUMENT_ROOT'].'/public/'.$imgRelPath;
                $checkListing = file_exists($imgPath);

                if($checkListing == 1){
                    $listing_path = asset($imgRelPath);

                }else{
                    $listing_path = asset('storage/listings/listing_xxlarge/uploads/listings/images/demo-image.png');
                }
            @endphp
   
            <img class="featurette-image img-fluid mx-auto rounded" src="{{  $listing_path }}">
                
        </a>
        </div>
        <div class="col-md-3 order-md-3 btns-with-icons but_on_1">
            @if($list->certified == 1)
                <!--<a href="{{route('ledger.listdetail',['slug'=>$list->list_slug])}}" class="revoke_1"><i class="far fa-file-alt"></i> Revoke Certification</a>-->
            @else
                <a href="{{route('ledger.listdetail',['slug'=>$list->list_slug])}}" class="certif_1"><i class="far fa-file-alt"></i> Certify</a>
            @endif
            <a href="{{route('ledger.listdetail',['slug'=>$list->list_slug])}}" class="view_1"><i class="far fa-eye"></i> View</a>
        </div>

    </div>
</div>
@empty
@endforelse
<div class="d-flex justify-content-center ">
    {!! $listings->links() !!}
</div>
@else
<div class="no-record">
    <p class="text-muted ml-2"> No Record Found</p>
</div>
@endif
