@extends('ledger::layouts.master')
@section('content')
@php
    if(isset($hostdetails->listing[0]->listing_location->geo_coordinate))
    {
        $lat = $hostdetails->listing[0]->listing_location->geo_coordinate->lat;
        $lng = $hostdetails->listing[0]->listing_location->geo_coordinate->lng;
    }
@endphp
<div class="container">
<div class="right-top-search">
                    <div class="row no-gutters justify-content-between align-items-center">
                        <div class="col-12 col-xl-auto flex-grow-1">
                            <!-- breadcrumbs -->
                            <ol id="breadcrumbs" class="breadcrumb text-size-md pt-1_5 pb-0_5 mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('ledger.listing') }}" rel=""><span><i class="fas fa-home"></i></span>Home</a>
                                    <!--i class="fas fa-angle-right"></i-->
                                </li> 
                            <?php $segments = ''; ?>
                            @foreach(Request::segments() as $segment)
                                <?php $segments .= '/'.$segment; ?>
                                <li class="breadcrumb-item">
                                    <a href="{{ $segments }}">{{$segment}}</a>
                                  </li> 
                            @endforeach
            
                            </ol>
                        </div>
                        <div class="col-xl col-xl-auto">
                            <div class="search">
                                <div class="input-group d-block d-md-flex flex-md-nowrap align-items-center">
                                    <div class="mb-0_5 mb-md-0 ml-2">
                                        <div class="input-group input-group-alternate  bg-default mb-0">
                                            <div class="input-group-prepend">
                                            <div class="next-previoes">
                                                @if($preId !=null)
                                                    <a href="{{ $preId }}" class="previous but_next_prev_1">&laquo; Previous</a>
                                                @endif
                                                @if($nextId !=null)
                                                    <a href="{{ $nextId }} " class="next but_next_prev_1">Next &raquo;</a> 
                                                @endif
                                            </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <div class="row flex-lg-row-reverse">
        <div class="col col-fix flex-grow-1 pt-2">
            <div class="row">
                
                <div class="col-lg-10">
                    <div class="sticky-wrap-floating-block sticky-wrap-overlap-right sticky-wrap-mb-2 sticky-wrap-py-2">
                        <div class="floating-block overlap-right mb-2 py-2" data-sticky-nav="" style="">
                            <button class="btn btn-block btn-default dropdown-toggle dropdown-toggle-arrow dropdown-toggle-colored flex-grow-1 shadow-none rounded-0 d-lg-none" data-toggle="collapse" data-target="#sub-navigation-links" role="button" aria-expanded="true" aria-controls="sub-navigation-links">
                            <span class="my-n-0_25" data-selected-text="">Listings</span>
                            <span class="icon icon-arrow-down"></span>
                            </button>
                            <div id="sub-navigation-links" class="nav-wrapper collapse fade d-lg-block mt-n-2 mt-lg-0 show">
                                <nav class="nav nav-pills nav-justified nav-pills-primary shadow flex-lg-nowrap">
                                    <a class="nav-item nav-link active" href="#presentation">
                                    <span data-item-text="">Presentation</span>
                                    </a>
                                    <a class="nav-item nav-link" href="#listings">
                                    <span data-item-text="">Listings</span>
                                    </a>
                                    <!-- <a class="nav-item nav-link" href="#ratings">
                                    <span data-item-text="">Reviews</span>
                                    </a> -->
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="img-carousel mb-3 mb-lg-5 mx-n-0_75 slick-initialized slick-slider" id="images">
                <div class="slick-list draggable">
                    <div class="slick-track" style="opacity: 1; width: 0px; transform: translate3d(0px, 0px, 0px);">
                    </div>
                </div>
            </div>

            <div id="presentation" class="section-active">
                <h2 class="lead text-weight-medium mb-2">Presentation</h2>
                <p class="mb-2_5">{{  @$hostdetails->listing[0]->listing_translation->description }}</p>
            </div>

            <div id="listings" class="pb-lg-4_5">
            <h2 class="lead text-weight-medium mb-2">Listings</h2>
                <div class="carousel-offcanvas carousel-offcanvas-right mx-n-1_5 mb-5">

                    <div class="d-flex justify-content-between align-items-center pb-2 mx-1_5">
                        <div class="carousel-controls align-self-end"></div>
                    </div>
                    @if($hostdetails != null)
                    @foreach($hostdetails->listing as $listing)
                    <div class="carousel-holder slick-initialized slick-slider">
                        <div class="slick-list draggable">
                            <div class="slick-track"
                                style="opacity: 1; width: 349px; transform: translate3d(0px, 0px, 0px);">
                                <div class="card card-sm border-0 rounded-0 bg-transparent mx-1_5 slick-slide slick-current slick-active"
                                    style="width: 319px;" data-slick-index="0" aria-hidden="false">
                                    <a href="{{  route('ledger.listdetail', ['slug' => $listing->listing_translation->slug]) }}"
                                        class="card-visual d-flex flex-column p-1 rounded" target="_blank"
                                        rel="noopener"
                                        title="Book online > At 2' only of St Mark's Square, cosy pied à terr - Venezia - €129 per night"
                                        tabindex="0">
                                        @php

                                            $check = remote_file_exists($_SERVER['DOCUMENT_ROOT'].'/storage/listings/listing_large/uploads/listings/images/'.$listing->list_img);

                                            if($check == 1){
                                                $path = asset('storage/listings/listing_xxlarge/uploads/listings/images/'. $listing->list_img );
                                            
                                            }else{
                                                $path = asset('storage/listings/listing_xxlarge/uploads/listings/images/demo-image.png');
                                            }
                                        @endphp
                                      
                                        <img class="img-cover rounded" src="{{ $path }}"                                 alt="DSC6516-1617464459221" style="max-height: 228px">
                                       
                                        
                                    </a>
                                    <div class="card-body px-0">
                                        <div class="row no-gutters justify-content-between align-items-center mb-0_5">
                                            <div class="col flex-grow-1">
                                                <div class="text-uppercase small mb-0 mr-1">{{ $listing->listing_location->city }}, {{ $listing->listing_location->country }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <a href="#" class="btn-like d-flex text-size-default px-0_7"
                                                    data-id="favorite-157312844" tabindex="0">
                                                    <input id="listing-157312844" type="checkbox"
                                                        class="btn-like-checkbox sr-only" tabindex="0">
                                                    <label for="listing-157312844"
                                                        class="btn-like-label icon-heart-o m-0"></label>
                                                </a>
                                            </div>
                                        </div>
                                        <h3 class="text-size-default text-weight-semibold mb-0_25">
                                            <a href="{{  route('ledger.listdetail', ['slug' => $listing->listing_translation->slug]) }}"
                                                class="text-current"
                                                title="Book online > At {{ $listing->listing_translation->title }} - {{ $listing->listing_location->city }} - €{{ $listing->price }} per night"
                                                tabindex="0">
                                                {{ $listing->listing_translation->title }}
                                            </a>
                                        </h3>
                                        <p class="text-blue text-size-default mb-0_5">
                                            €{{ $listing->price }} per night
                                        </p>
                                        <div class="d-flex">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <!-- <div id="ratings" class="">
                <div class="d-md-flex align-items-center mb-2 mb-md-0_75">
                    <h2 class="lead text-weight-medium mb-1_5 mr-md-3_5">Reviews</h2>
                    <div class="d-flex" data-review-filter="">
                        <div class="form-group mb-1_5 mr-2">
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rev_from" checked="">
                            <label class="custom-control-label align-items-center text-weight-medium" for="rev_from">made</label>
                            </div>
                        </div>
                        <div class="form-group mb-1_5 mr-2">
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rev_to" checked="">
                            <label class="custom-control-label align-items-center text-weight-medium" for="rev_to">received</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-sm-flex ml-md-auto pr-md-0_75 mb-1_5">
                        <strong class="text-weight-medium text-blue mr-sm-2">
                        Average based on 2 reviews
                        </strong>
                        <div class="d-inline-flex">
                            <div class="star-rating-lg star-rating" title="5 stars">
                            <div class="star-rating-holder d-flex align-items-center flex-row-reverse" data-disabled="true">
                                <input class="star_rating_radio_1" type="radio" checked="" value="5">
                                <label class="mb-0">
                                <i class="fa fa-star"></i>
                                </label>
                                <input class="star_rating_radio_1" type="radio" value="4">
                                <label class="mb-0">
                                <i class="fa fa-star"></i>
                                </label>
                                <input class="star_rating_radio_1" type="radio" value="3">
                                <label class="mb-0">
                                <i class="fa fa-star"></i>
                                </label>
                                <input class="star_rating_radio_1" type="radio" value="2">
                                <label class="mb-0">
                                <i class="fa fa-star"></i>
                                </label>
                                <input class="star_rating_radio_1" type="radio" value="1">
                                <label class="mb-0">
                                <i class="fa fa-star"></i>
                                </label>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-review-container="">
                    <div class="card card-sm shadow rounded-0 mb-1_5">
                        <div class="card-body">
                            <div class="row no-gutters">
                            <div class="col-md-auto text-center mb-2 ml-md-1 mr-md-2_5 mb-md-0 pt-0_75">
                                <a href="#" class="user-avatar mx-auto user-avatar-md rounded-circle flex-shrink-0 border-0 shadow-none" style="background-image: url(/ladger/images/630f81d9da613d5227206a10cf9036eb629547f3.gif);width: 4.625rem;height: 4.625rem;display: block;background-size: cover;background-position: center center;transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;"></a>
                            </div>
                            <div class="col-md">
                                <div class="d-flex justify-content-between py-0_5">
                                    <div class="text-size-default text-weight-bold card-title mb-0">Ann D.</div>
                                    <div class=" star-rating" title="5 stars">
                                        <div class="star-rating-holder d-flex align-items-center flex-row-reverse" data-disabled="true">
                                        <input class="star_rating_radio_1" type="radio" checked="" value="5">
                                        <label class="mb-0">
                                        <i class="fa fa-star"></i>
                                        </label>
                                        <input class="star_rating_radio_1" type="radio" value="4">
                                        <label class="mb-0">
                                        <i class="fa fa-star"></i>
                                        </label>
                                        <input class="star_rating_radio_1" type="radio" value="3">
                                        <label class="mb-0">
                                        <i class="fa fa-star"></i>
                                        </label>
                                        <input class="star_rating_radio_1" type="radio" value="2">
                                        <label class="mb-0">
                                        <i class="fa fa-star"></i>
                                        </label>
                                        <input class="star_rating_radio_1" type="radio" value="1">
                                        <label class="mb-0">
                                        <i class="fa fa-star"></i>
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-lh-sm mb-0_25">
                                    <p>Very nice accommodation, excellent environment with beautiful nature all around.</p>
                                    <p class="mb-0 text-right text-size-md">
                                        <a href="#">
                                        <u>View this listing</u>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="col-lg-auto">
            <div class="aside-block-md">
                <button type="button" class="btn btn-primary p-1 rounded-0 d-lg-none aside-opener btn-sm"
                    data-aside-opener=""><i class="icon icon-chevron-left d-inline-block align-middle"></i></button>
                <div class="sticky-wrap-aside sticky-wrap-py-2 sticky-wrap-pb-lg-4">
                    <div class="aside py-2 pb-lg-4" data-sticky-aside="" data-offset-blocks="#additional_nav" style="">
                        <div class="aside-holder px-1 px-lg-0">
                            <div class="card shadow">
                                <div class="card-body px-lg-3_5">
                                    <div class="card-user-overflow text-center mt-0_75 mb-4">
                                        <a href="#"
                                            class="user-avatar user-avatar-xl rounded-circle border-0 shadow-none mx-auto  "
                                            style="background-image: url({{ asset('storage/user/user_medium/uploads/users/images/default-user.png') }});width: 9.6875rem;height: 9.6875rem;display: block;background-size: cover;background-position: center center;transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;margin-bottom:15px;">
                                        </a>
                                        <a href="#" class="btn btn-primary"
                                            data-modal-url="#"
                                            data-modal-dialog="" data-modal-tab="login-tab"
                                            data-modal-container=".modal-dialog">
                                            Contact me
                                        </a>
                                    </div>
                                    <div class="text-weight-medium pb-2_5 pt-0_25">
                                        <p class="mb-1">
                                            <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                                            <span> Member since {{ date('d-m-Y', strtotime($hostdetails->subscription_date))  }}</span>
                                        </p>
                                        <p class="mb-1">
                                            <i class="fas fa-envelope" aria-hidden="true"></i>
                                            <span>{{ ($hostdetails->email_verified == 0) ? 'Email not verified' : 'Email verified'  }}</span>
                                        </p>
                                        <p class="mb-1">
                                            <i class="fa fa-id-card" aria-hidden="true"></i>
                                            <span>{{ ($hostdetails->id_card_verified == 0) ? 'ID not verified' : 'ID verified'  }}</span>
                                        </p>
                                        <p class="mb-1">
                                        <i class="fa fa-certificate" aria-hidden="true"></i>
                                            <span>Has completed {{  $hostdetails->nb_bookings_offerer}} booking(s) </span>
                                        </p>
                                        <p class="mb-1">
                                        <i class="fa fa-male mrtd_1" aria-hidden="true"></i><i class="fa fa-male" aria-hidden="true"></i>
                                            <span>{{ ($hostdetails->company_name == null) ? 'I represent an individual' : 'I represent company'  }} </span>
                                        </p>
                                    </div>
                                    <div class="mb-n-1_5 mx-n-1_5 mx-lg-n-2_5">
                                        <div class="map-block h-0vh">
                                            <div id="map-user" style="width: 100%; height: 171px; position: relative; overflow: hidden;">
                                            <div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
                                                <div style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px;" class="gm-style">
                                                    
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')

@push('scripts')
<script>
   //######################## MAP #############################///
    var map = L.map('map-user', { zoomControl: false }).setView([<?= $lat; ?>, <?= $lng; ?>], 12);

   L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=sk.eyJ1IjoidGVzdGVyLW5ldHFvbSIsImEiOiJja3Z1d2RlMTQxNWg1Mm5seWVyNDU3cmt3In0.x4Z8_q5EHCBEmD4xdP17fA', {
         attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
         maxZoom: 18,
         id: 'mapbox/streets-v11',
         tileSize: 512,
         zoomOffset: -1,
         accessToken: 'sk.eyJ1IjoidGVzdGVyLW5ldHFvbSIsImEiOiJja3Z1d2RlMTQxNWg1Mm5seWVyNDU3cmt3In0.x4Z8_q5EHCBEmD4xdP17fA'
   }).addTo(map);

   L.marker([<?= $lat; ?>, <?= $lng; ?>]).addTo(map)
   //.bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
   .openPopup();
   //######################## END MAP #############################///
</script>
@endpush