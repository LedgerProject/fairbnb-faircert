
@if(count($listing))
@forelse($listing as $list)
<div class="single-list listing_book_ing_1">
	<div class="row align-items-center">			
			<div class="col-md-6 order-md-2">
			<h4 class="featurette-heading d-flex align-items-center">
                <p> {{  @$list->listing_translation->title }} </p> 
            </h4>	
			<div class="list_booking_p_1">
				<p class="text-muted ml-2">
					Booking Date: 
					{{ date('Y-m-d', strtotime($list->start)) }}
					<span class="location">
					{{ date('Y-m-d', strtotime($list->end))}}</span>
				</p>
			   <p class="desc">{{$list->message}}</p>
			   <p class="desc">Total Amount: ${{$list->amount_total}}</p>
               <p class="desc">Total Guest: {{$list->guest_number}}</p>
			   <p class="desc">Duration: {{ (int)$list->duration}} days</p>
			   <p class="desc">Status: {{$list->status}}</p>
			</div>
			</div>
		 	<div class="col-md-2 order-md-1">
			   <img class="featurette-image img-fluid mx-auto rounded" src="{{ Module::asset('ledger:images/accomodation.jpg') }}">
			</div>
		    <div class="col-md-4 order-md-3 btns-with-icons">
			  <a href="#"><i class="far fa-comment"></i> Contact Host</a>
			  <a href=" {{  route('ledger.listdetail', ['slug' => $list->listing_translation->slug]) }} "><i class="far fa-eye"></i> View Listing</a>
			</div>
	
	</div>
</div>
@empty
@endforelse
	<div class="d-flex justify-content-center ">
			{!! $listing->links() !!}
	</div> 
@else
<div class="no-record">
    <p class="text-muted ml-2"> No Record Found</p>
</div>
@endif
