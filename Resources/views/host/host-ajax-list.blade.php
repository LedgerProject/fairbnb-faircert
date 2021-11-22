@if($listing !=null && count($listing) > 0)
@foreach($listing as $list)
<div class="single-list">
    <div class="row align-items-center">
        <div class="col-md-8 order-md-2">
            <h2 class="featurette-heading d-flex align-items-center">
                @php 
                    $checkProfile = remote_file_exists($_SERVER['DOCUMENT_ROOT'].'/storage/user/user_medium/uploads/users/images/'. $list->profile_img);
        
                    if($checkProfile == 1){
                        $profile_path = asset('storage/user/user_medium/uploads/users/images/'. $list->profile_img );

                    }else{
                        $profile_path = asset('storage/user/user_medium/uploads/users/images/default-user.png');
                    }
                @endphp
           
                <img src="{{ $profile_path }}" class="rounded-circle" alt="img" />
                <p class="text-muted ml-2"> {{ $list->fullname }}<span class="location">{{ $list->phone }} </span>
                <span style="color:#000" class="desc">{{ $list->adress }} , {{ $list->city }} </span> </p>
                 
            </h2>

            <p class="desc"></p>

        </div>
        <div class="col-md-4 order-md-3 btns-with-icons">
            <a href="#"><i class="far fa-comment" aria-hidden="true"></i> Contact</a>
            <a href="{{ route('ledger.hostDetails', $list->slug) }}"><i class="far fa-eye" aria-hidden="true"></i>
                View</a>
        </div>

    </div>
</div>
@endforeach
<div class="d-flex justify-content-center">
    {!! $listing->links() !!}
</div>
@else
<div class="single-list">
    <h2> No record Found </h2>
</div>
@endif