<!--  banner start here -->
<div class="jumbotron jumbotron-fluid bg-cover text-white mb-0"
    style="background-image:url({{url('public/images/hero-background.jpg')}});">
    <div class="container">
        <h1 class="h3 mb-0">
            @if(!empty($title)) {{$title}} @endif


        </h1>

        
    </div>     
    <div id="listing-show-header" class="container mt-4">
            <div class="row">
                <div class="col-lg-8 col-xl-9">
                    @if(!empty($listing->listing_translation->title))
                    <h1 class="h3 mb-0"><b>{{$listing->listing_translation->title }}</b></h1>
                    @endif
                   
                    @if(!empty($locations->listing_location->city) && !empty($locations->listing_location->country))
                    <h3 class="h6 mb-1"><i class="icon-bordered-pin mr-0_75"></i> {{$locations->listing_location->city}}, {{$locations->listing_location->country}}</h3>
                    @endif

                </div>
            </div>
        </div>
</div> 
<!--Banner ends here -->