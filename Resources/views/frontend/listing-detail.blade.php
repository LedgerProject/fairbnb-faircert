@extends('ledger::layouts.master')
@section('content')
<!-- dashboard start here -->
@php
     $rulesData   =  json_decode($listing->rules);
     $image_path  = public_path('listing_xxlarge/uploads/listings/images');
     $carouselImgPath = public_path('listing_xxlarge/uploads/listings/images');
     $profile_path = public_path('user_medium/uploads/users/images');
     $lat = $locations->listing_location->geo_coordinate->lat;
     $lng = $locations->listing_location->geo_coordinate->lng;
     $price = $listing->price;

     $cert="";
     $laSign="";
     $pk="";
     $stHash="";
     $stId="";
     $certAndSignature="";

     $certDetail = json_decode($certificateDetails, true);
     if($certDetail != null){
           $cert=$certDetail["certificate"];
           $laSign=$certDetail["signature"];
           $pk= "----BEGIN PUBLIC KEY-----".$certDetail["public_key"]."-----END PUBLIC KEY-----";
           $stHash=$certDetail["blockchain_hash"];
           $stId=$certDetail["blockchain_id"];
           $certAndSignature = "{fairCertDetails: ".$cert.", fairCertSignature".$laSign."}";
     }

     /*echo "cert: ".$cert."<br>";
     echo "sing: ".$laSign."<br>";
     echo "pk: ".$pk."<br>";
     echo "hash: ".$stHash."<br>";
     echo "id: ".$stId."<br>";
     die();*/

      //echo '<pre>';
      //print_r($signatureData['productInfo']);

@endphp

 
<section class="ladger-section pt-3 ladger_section_1">
   <div class="container">
      <div class="right-top-search">
         <div class="row no-gutters justify-content-between align-items-center mb-2">
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

                        <div class="next-previoes">
                           @if(!empty($nextPreviousArray['previous']))
                           <a href="{{ $nextPreviousArray['previous'] }}" class="previous but_next_prev_1"> &laquo;
                              Previous</a>
                           @endif
                           @if(!empty($nextPreviousArray['next']))
                           <a href="{{$nextPreviousArray['next']}}" class="next but_next_prev_1">Next &raquo; </a>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>

         </div>
      </div>
      <div class="row">

         <!-- details start here -->

         <div class="col-lg-7 col-md-6 col-sm-12">

            <h3 class="mb-3"><b>{{  $listing->listing_translation->title }}</b></h3>

            <div id="sub-navigation-links" class="nav-wrapper collapse fade d-lg-block mt-n-2 mt-lg-0 show">
               <nav class="nav nav-pills nav-justified nav-pills-primary shadow flex-lg-nowrap">
                  <a class="nav-item nav-link clickitem active" href="#description">
                     <span data-item-text="">
                        Description
                     </span>
                  </a>
                  <a class="nav-item nav-link clickitem" href="#faimess">
                     <span data-item-text="">
                     Fairness
                     </span>
                  </a>
                  @if(!$upgrades->isEmpty())
                  <a class="nav-item nav-link clickitem " href="#options">
                     <span data-item-text="">
                        Options
                     </span>
                  </a>
                  @endif
                  <a class="nav-item nav-link clickitem" href="#policies">
                     <span data-item-text="">
                        Policies
                     </span>
                  </a>
                  <a class="nav-item nav-link clickitem" href="#listing-location">
                     <span data-item-text="">
                        Location
                     </span>
                  </a>
                  
                    <a class="nav-item nav-link clickitem " href="#availability">
                     <span data-item-text="">
                        Availability
                     </span>
                  </a>  
                 
                  @if(!empty($reviews['rating']) && !empty($reviews['user']))
                  <a class="nav-item nav-link clickitem " href="#reviews">
                     <span data-item-text="">
                        Reviews
                     </span>
                  </a>
                  @endif
               </nav>
            </div>

            <!-- descriptio start here -->
            <div id="description" class="py-2 section-active">
               <h2 class="lead mb-2 text-weight-medium">
                  Description
               </h2>
               <p>{{ $listing->listing_translation->description }} </p>

               <div id="wrap">
                  <!-- Carousel -->
                  <div id="carousel" class="carousel slide gallery" data-ride="carousel">
                     <div class="carousel-inner">


                        @foreach($listing->listing_image as $key => $image)
                        @php
                           $imgRelPath = '/storage/listings/listing_xxlarge/uploads/listings/images/'. $image->name;

                            $imgPath = $_SERVER['DOCUMENT_ROOT'].'/public/'.$imgRelPath;
                            $check = file_exists($imgPath);

                          if($check == 1){
                            $path = asset($imgRelPath );
                          }else{
                            $path = asset('storage/listings/listing_xxlarge/uploads/listings/images/demo-image.png');
                          }
                        @endphp

                        <div class="carousel-item {{ ($key == 0) ? 'active' : '' }}" data-slide-number="{{ $key }}"
                           data-toggle="lightbox" data-gallery="gallery" data-remote="{{ $path }}">
                           <img src="{{ $path }}" class="d-block w-100" alt="...">
                        </div>
                        @endforeach

                     </div>
                     <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                     </a>

                  </div>

                  <!-- Carousel Navigatiom -->
                  <div id="carousel-thumbs" class="carousel slide" data-ride="carousel">
                     <div class="carousel-inner">
                        @foreach($listing->listing_image->chunk(4) as $k => $chunk)


                        <div class="carousel-item {{ ($k == 0) ? 'active' : '' }}" data-slide-number="{{ $k }}">
                           <div class="row mx-0">
                              @foreach($chunk as $key => $image)
                              @php

                                 $imgRelPath = '/storage/listings/listing_xxlarge/uploads/listings/images/'. $image->name;

                               $imgPath = $_SERVER['DOCUMENT_ROOT'].'/public/'.$imgRelPath;
                               $check = file_exists($imgPath);

                                 if($check == 1){
                                 $path = asset('storage/listings/listing_xxlarge/uploads/listings/images/'. $image->name );
                                 }else{
                                 $path = asset('storage/listings/listing_xxlarge/uploads/listings/images/demo-image.png');
                                 }
                              @endphp
                              <div id="carousel-selector-{{ $key }}" class="thumb col-3 px-1 py-2 selected"
                                 data-target="#carousel" data-slide-to="{{ $key }}">
                                 <img src="{{ $path }}" class="img-fluid" alt="...">
                              </div>
                              @endforeach
                           </div>
                        </div>
                        @endforeach
                     </div>
                     <a class="carousel-control-prev" href="#carousel-thumbs" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#carousel-thumbs" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                     </a>
                  </div>


               </div>
               <!-- carousel ends here -->

             <h2 class="lead mb-2 text-weight-medium">Accommodation details </h2>
            <!-- description cards start here -->
            <div class="row mb-1">
            
               @php $group = $prev_group = ""; @endphp
               @foreach($result as $group )
               @php $attrCount = 0 ; $attrContent = ""; @endphp
            
               <div class="col-md-6 col-lg-12 col-xl-6 mb-4 attribute_group">
                  <div class="card h-100">
                     <div class="card-body p-lg-3">
                        <h3 class="lead text-blue text-weight-bold mb-2">
                           {{ $group['translations'][app()->getLocale()]['title'] }}
                        </h3>
                        <div class="dl-inline mb-1 attributes-container">
            
                           @foreach($group['children'] as $attr )
                           @if ($listing_attributes[$attr['id']] )
                           @php $title = $attr['translations'][app()->getLocale()]['title'] ;
                           $value = $listing_attributes[$attr['id']];
            
                           @endphp
            
                           @if($attr['type'] ==1)
            
                           @if($value)
                           @php $attrCount = $attrCount + 1; @endphp
                           <div class="attribute">
                              <div>
                                 <span class="custom-icon-attribute custom-icon-attribute-valid mb-0_5"></span>
                              </div>
                              <div>
                                 {{ $title }}
                              </div>
                           </div>
                           @endif
                           @else
                           @if($value != '')
                           @php $attrCount = $attrCount + 1; @endphp
                           <div class="attribute">
                              <div>
                                 {{ $title }} :
                              </div>
                              @if($attr['type'] == 3 )
                              <div class="text-weight-bold">
                                 {{ $value }}
                              </div>
                              @else
                              <div class="text-weight-bold">
                                 {{ $value }}
                              </div>
                              @endif
                           </div>
                           @endif
                           @endif
                           @endif
            
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
               <!-- cards start here -->

            </div>
            <!-- description ends here -->

            <!-- faimess Start here -->
            <div id="faimess" class="mb-5">
				   <h2 class="lead mb-2 text-weight-medium despot_buyt_1">Faimess</h2>
				   <div class="card shadow mb-1_5 h-100f">
					  <div class="card-body px-lg-3 py-lg-2_5 faimess_1">

                 @if($listing->certified==1)
						<div class="row top_faimess_1">
							 <div class="col-md-6">
                      <h3 class="lead text-blue text-weight-bold mb-2">Fairness Certificate</h3>
								<p class="mb-0_7 lorem_ipsum_1">
                                   Certified listings comply with all the mandatory rules of our platform. <br><br>
                                   Such rules can include, but are not limited to, compliance with local regulations set by public authorities and with additional rules set by the local node or the platform.
							 </div>
							 <div class="col-md-6  certificate_signed_by_1">
								<h3 class="lead text-blue text-weight-bold mb-2 listing_certi_fied_1"><i class="fa fa-check-square-o"></i> Listing certified</h3>
								<p class="lead text-blue text-weight-bold mb-2"> Certificate signed by</p>
								<p>Local Ambassador:<span> {{$laName}}</span>  <i class="fa fa-user-check"></i></p>
								<p>Local Authority: <span style="color: #868686 !important">Under request</span>  <i style="color: #868686;" class="fa fa-user-times"></i></p>
								<button id="my_btn_1" class="view_certificate_1">VIEW CERTIFICATE</button>
							 </div>
						</div>
                  @endif

						 <div class="row bot_faimess_1">
							<div class="col-md-12 s">
							   <h3 class="lead text-blue text-weight-bold mb-2">Fairness Badges</h3>
							   <p>Hosts/Experiences receive badges as recognition of their efforts to promote fairness and sustainability their work.</p>
							</div>
                            @foreach($getAssignbadgesData as  $badges )
                               <div class="col-md-6" style="margin-top: 25px;">
                                  <div class="row">
                                     <div class="col-md-12 badge_title_1">
                                        <div class="row">


                                           <div class="col-md-3 wint_ead_1 ead_wint_gold_1 ead_wint_silver_1">
                                              <img src="{{URL::to('/public') }}/badgesIcons/{{ $badges->icon }}">
                                              <span  style="    text-transform: uppercase;" class="{{$badges->level}}_span_1">{{$badges->level}}</span>
                                           </div>
                                           <div class="col-md-9 badge_ps_title_1">
                                              <h3>{{$badges->categories}}</h3>
                                              {{ strip_tags($badges->description) }}
                                           </div>


                                        </div>
                                     </div>
                                  </div>

                               </div>
                         @endforeach
							<!--div class="col-md-6">
								<div class="row">
								   <div class="col-md-12 badge_title_1">
										<div class="row">	
											 <div class="col-md-3">
												 <img src="images/icon/wheelchair.png" />
											  </div>
											  <div class="col-md-9 badge_ps_title_1">
												 <h3>Lorem ipsum dolor</h3>
												 <p> sit amet, consectetur adipiscing elit. Vitae sagittis egestas volutpat congue cursus gravida. Et sit hac orci cursus. Interdurn scelerisque proin lectus viverra posuere ullamcorper.</p>
											  </div>
										</div> 
								   </div>
								</div>  
								<div class="row">
								   <div class="col-md-12 badge_title_1">
										<div class="row">
										  <div class="col-md-3">
											<img src="images/icon/flage-1.png" />
										  </div>
										  <div class="col-md-9 badge_ps_title_1">
											 <h3>Lorem ipsum dolor</h3>
											 <p> sit amet, consectetur adipiscing elit. Vitae sagittis egestas volutpat congue cursus gravida. Et sit hac orci cursus. Interdurn scelerisque proin lectus viverra posuere ullamcorper.</p>
										  </div>
										 </div> 
								   </div>
								</div> 
								<div class="row">
								   <div class="col-md-12 badge_title_1">
										<div class="row">
											  <div class="col-md-3">
												<img src="images/icon/life-saver.png" />
											  </div>
											  <div class="col-md-9 badge_ps_title_1">
												 <h3>Lorem ipsum dolor</h3>
												 <p> sit amet, consectetur adipiscing elit. Vitae sagittis egestas volutpat congue cursus gravida. Et sit hac orci cursus. Interdurn scelerisque proin lectus viverra posuere ullamcorper.</p>
											  </div>
										</div>  
								   </div>
								</div>   
							</div>
							<div class="col-md-6">
								<div class="row">
								   <div class="col-md-12 badge_title_1">
										<div class="row">
											  <div class="col-md-3">
												<img src="images/icon/hart-icon.png" />
											  </div>
											  <div class="col-md-9 badge_ps_title_1">
												 <h3>Lorem ipsum dolor</h3>
												 <p> sit amet, consectetur adipiscing elit. Vitae sagittis egestas volutpat congue cursus gravida. Et sit hac orci cursus. Interdurn scelerisque proin lectus viverra posuere ullamcorper.</p>
											  </div>
										</div>	  
								   </div>
								</div>  
								 <div class="row">  
								   <div class="col-md-12 badge_title_1">
										<div class="row">
											  <div class="col-md-3">
												<img src="images/icon/life-saver.png" />
											  </div>
											  <div class="col-md-9 badge_ps_title_1">
												 <h3>Lorem ipsum dolor</h3>
												 <p> sit amet, consectetur adipiscing elit. Vitae sagittis egestas volutpat congue cursus gravida. Et sit hac orci cursus. Interdurn scelerisque proin lectus viverra posuere ullamcorper.</p>
											  </div>
										</div>	  
								   </div>
								   </div>  
								 <div class="row"> 
								   <div class="col-md-12 badge_title_1">
										<div class="row">
											   
											  <div class="col-md-12 badge_ps_title_1">
												 <h3>Lorem ipsum dolor</h3>
												 <p> sit amet, consectetur adipiscing elit. Vitae sagittis egestas volutpat congue cursus gravida. Et sit hac orci cursus. <a class="Inter_durn_faimess_1">Interdurn</a> scelerisque proin lectus viverra posuere ullamcorper.</p>
												 <a class="view_more_faimess_1">VIEW MORE</a>
											  </div>
										</div>	  
								   </div>
								</div>

							   <div>
							   </div>
							</div-->
						 </div>
					  </div>
				   </div>
				</div>
            <!-- faimess End here -->

            <!-- Options start here -->
            @if(!$upgrades->isEmpty())
            <div id="options" class="mb-5">
               <h2 class="lead mb-2_5 text-weight-medium">
                  Upgrades
               </h2>
               @foreach($upgrades as $key => $value)
               <div class="card rounded-0 shadow mb-2" data-listing-option="19">
                  <div class="card-body py-2 py-sm-1">
                     <div class="card-content-group d-sm-flex">
                        <div class="flex-grow-1 pt-sm-1 pb-sm-0_25 mb-2">
                           <h3 class="text-size-default text-weight-bold">
                             {{ $value->booking_option_translation->name }}
                           </h3>
                           <p class="truncate-text truncate-overflow mb-0_5">
                              {{  $value->booking_option_translation->description }}
                              
                              <span></span>
                           </p>
                        </div>
                        <div
                           class="card-content-group-append d-flex flex-column justify-content-center align-items-center pr-sm-1 pl-sm-4 ml-sm-3">
                           <h4 class="text-weight-thin text-blue display-4 mb-0_5">
                              €{{ $value->price/100 }}
                           </h4>
                           <p class="text-size-xs text-weight-semibold text-uppercase mb-1">
                              per head
                           </p>                           
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
            @endif
            <!-- policies ends here -->
            <!-- policies start here -->
            <div id="policies" class="mb-5">

               <h2 class="lead mb-2 text-weight-medium">Policies</h2>
               <div class="card shadow mb-1_5">
                  <div class="card-body px-lg-3 py-lg-2_5">
                     <h3 class="lead text-blue text-weight-bold mb-2">
                        Cancellation policy:
                        <span class="text-weight-bold">
                           Flexible
                        </span>
                     </h3>
                     <p class="mb-0_7">&gt; If the guest cancels <strong>more than 7 day(s)</strong> before the start of
                        the booking, s/he is reimbursed <strong>100 %</strong> of the amount paid<br>
                        &gt; If the guest cancels <strong>less than 7 day(s)</strong> before the start of the booking ,
                        s/he is reimbursed <strong>50 % </strong>of the amount paid</p>
                  </div>
               </div>

            </div>
            <!-- policies ends here -->

            <!-- location start here -->
            <div id="listing-location" class="mb-5">
               <h2 class="lead mb-2 text-weight-medium">Location</h2>
               <div class="card-body p-lg-3_5">
                  
                  <div style="height: 400px;" id="map"></div>
               
               </div>
            </div>
            <!-- location start here -->
            <!-- availability start here -->
              <div id="availability" class="mb-5">
               <h2 class="lead mb-2_5 text-weight-medium">
                  Calendar
               </h2>
               <div id='calendar-container' class="fullcalendar-container">
			    
				  <div class="fullcalendar-holder fullcalendar-frontend"
                                 data-locale="en"
                                 data-calendar-mode="status-mode"
                                 data-time-unit="day"
                                 data-height="500"
                                 data-horizontal-select="false"
                                 data-popup-id=""
                                 data-events-url="/listing-availabilities/{{ $listing->id }}/1971-05-29/1971-05-30"
                                 data-selectable="false"
                            >
                            </div>
				  
               </div>
            </div>
            <!-- availability ends here -->
            <!-- reviews start here -->
            @if(!empty($reviews['rating']) && !empty($reviews['user']))
            <div id="reviews" class="mb-5">
               <div class="d-md-flex align-items-center mb-2 mb-md-0_75">
                  <h2 class="lead text-weight-medium mb-1_5 mr-md-3_5">
                     Last reviews
                  </h2>
                  <div class="d-sm-flex ml-md-auto mb-1_5">
                     <strong class="text-weight-medium text-blue mr-sm-2_5">
                        Average rating:
                     </strong>
                     <div class="d-inline-flex">
                        <div class="star-rating-lg star-rating" title="5 stars">
                           <div class="star-rating-holder d-flex align-items-center flex-row-reverse"
                              data-disabled="true">

                              <label class="mb-0">
                                 <i class="fa fa-star" aria-hidden="true"></i>
                              </label>

                              <label class="mb-0">
                                 <i class="fa fa-star" aria-hidden="true"></i>
                              </label>

                              <label class="mb-0">
                                 <i class="fa fa-star" aria-hidden="true"></i>
                              </label>

                              <label class="mb-0">
                                 <i class="fa fa-star" aria-hidden="true"></i>
                              </label>

                              <label class="mb-0">
                                 <i class="fa fa-star" aria-hidden="true"></i>
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
            
            @foreach($reviews['rating'] as $key => $review)
            <div class="card card-sm shadow mb-1_5">
               <div class="card-body">
                  <div class="row no-gutters">
                     <div class="col-md">
                        <div class="d-flex justify-content-between py-0_5">
                           <div class="text-size-default text-weight-bold card-title mb-0">
                              {{ $reviews['user'][$key]->first_name;  }} {{ $reviews['user'][$key]->last_name }}</div>

                           <div class=" star-rating" title="5 stars">
                              <div class="star-rating-holder d-flex align-items-center flex-row-reverse"
                                 data-disabled="true">
                                 @php $count = $review->rating; @endphp
                                 @for( $i=0 ; $i< $count; $i++) <label class="mb-0">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    </label>
                                    @endfor
                              </div>
                           </div>
                        </div>
                        <div class="text-lh-sm mb-0_25">
                           <p>{{ $review->comment; }}</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
            @endif
         </div>
         
         <!-- reviews start End here -->
         <!-- details ends here -->

         <!-- right side rules start here -->

         <div class="col-lg-5 col-md-6 col-sm-12">
            <div class="both-rules hard_rules_1">
               <div class="top-rules">
                  <!-- <h3 class="mb-3"><b>Local Node Name</b></h3> -->

                  <div class="d-flex justify-content-between mb-1">
                     <!-- <select class="form-control form-control-md js-custom-select select2-hidden-accessible"
                     data-currency-select="" data-select2-id="6" tabindex="-1" aria-hidden="true">
                     <option value="�" data-url="#" selected="" data-select2-id="8">
                        Nederlands
                     </option>
                     <option value="$" data-url="#" data-select2-id="17">
                        Nederlands
                     </option>
                     <option value="CHF" data-url="#" data-select2-id="18">
                        Nederlands
                     </option>
                     <option value="A$" data-url="#" data-select2-id="19">
                        Nederlands
                     </option>
                     <option value="�" data-url="#" data-select2-id="20">
                        Nederlands
                     </option>
                     <option value="CA$" data-url="#" data-select2-id="21">
                        Nederlands
                     </option>
                  </select> -->
 
                  </div>

               </div>
               @php $rules = json_decode($listing->listing_translation->rules);
               $read_only = ($listing->certified == 0 || $listing->certified == 2) ? '' : 'readonly';
               @endphp

   <!--  start certiesfy badges -->

                  <div style="width: 100%;display: inline-block;">
                     <!-- Static content: To be removed -->
                  @include('ledger::listing.fake-booking')
                  <!-- End Static content: To be removed -->
                  <div class="right_list_ing_1">
                     @if($listing->certified==1)
                     <div class="right_top_list_ing_1">
                        <div class="col-md-6 right_list_lt_ing_1">
                           <h3 class="lead text-blue text-weight-bold mb-2 listing_certi_fied_1"><i class="fa fa-check-square-o" aria-hidden="true"></i> Listing certified</h3>
                        </div>
                        <div class="col-md-6 right_list_rt_ing_1">
                           <a  href="#faimess" class="view_more_12" style="padding: 5px 10px;">view more</a>
                        </div>
                     </div>
                     @endif
                     <div class="col-md-12">
                        <div class="fair_ness_bad_ges_1">
                           <p class="fairness_bad_ges_1">Fairness badges</p>
                        @foreach($getAssignbadgesData as  $badges ) 
                           <div data-toggle="tooltip" title="{{$badges->categories." (".ucfirst($badges->level).")"}}" style="margin-top: 0px;" class="col-md-2 img_icn_1 right_win_1 right_win_{{$badges->level}}_1 ">
                              <img class="img_por_{{$badges->level}}_1" src="{{URL::to('/public') }}/badgesIcons/{{$badges->icon}}">
                              <span style="top: -15px" class="right_{{$badges->level}}_1"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
                              <!--span class="right_silver_1"><i class="fa fa-caret-right" aria-hidden="true"></i></span-->
                           </div>
                           @endforeach
                             
                        </div>   
                     </div>
                  </div>   
               </div>
                <!--  end certiesfy badges -->
                
            </div>
         </div>

         <!-- right side rules ends here -->

      </div>

   </div>

   
</section>

<!-- dashboard ends -->
@endsection

@push('scripts')
<script src="{{ asset('modules/ledger/js/calendar.js') }}"></script>
<script>

   $(function () {
      $('[data-toggle="tooltip"]').tooltip()
   })

   //######################## MAP #############################///
    var map = L.map('map').setView([<?= $lat; ?>, <?= $lng; ?>], 12);

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

   var certify = "{{ $listing->certified }}";
   var listing_id = "{{ $listing->id }}";
   if (certify == 0 || certify == 2) {
      $('.rules-reply ul li').each(function () {

         $('input[type=radio]').attr("disabled", true);
         $('input[type=text]').attr("readonly", false);
      });
   }
   if(certify == 1){
      $('.rules-reply ul li').each(function () {
         $('input[type=radio]').attr("disabled", true);
         $('input[type=text]').attr("readonly", true);
         $('input[type=checkbox]').attr("disabled", true);
      });
   }

   $(document).on('click', '#submit_ask_moreinfo', function () {

      var askmoreinfo_title = $('#askmoreinfo_title').val();
      var askmoreinfo_desc = $('textarea#askmoreinfo_desc').val();

      if (askmoreinfo_title == '') {
         $('.aks_mi_title').show();
         setTimeout(() => {
            $('.aks_mi_title').hide();
         }, 3000);
         return false;
      }
      $("textarea#askmoreinfo_desc").validate();
      if (askmoreinfo_desc == '' || askmoreinfo_desc == null) {
         $('.ask_mi_desc').css('display', 'block');
         setTimeout(() => {
            $('.ask_mi_desc').hide();
         }, 3000);
         return false;
      }

      axios.post(" {{ route('ledger.listing.ask.moreinfo') }} ", {
         askmoreinfo_title: askmoreinfo_title,
         askmoreinfo_desc: askmoreinfo_desc,
         listing_id: listing_id
      }).then(res => {
         $("#askMoreInfo .close").click();
         $('#askmoreinfo_title').val('');
         $('textarea#askmoreinfo_desc').val('');
         console.log(res);
         if (res.data) {

            Swal.fire({
               position: 'top-end',
               icon: 'success',
               title: 'Email sent to host!',
               showConfirmButton: false,
               timer: 1500
            })
         }

      }).catch(function (error) {
         console.log(error);
      });



   });

   function checkRules(type, id) {

      if (type == 'hardrule') {
         var chkname = 'hard_rule_' + id;
         var radioname = id;
      } else {
         var chkname = 'soft_rule_' + id;
         var radioname = id;
      }

      if ($('#' + chkname + ':checkbox:checked').is(':checked')) {

         $('input[type=radio][name=' + radioname + ']').attr("disabled", false);
         $('input[type=radio][name=' + radioname + ']').attr("required", true);
         if (certify == 0 || certify == 2) {
            $('#infosoftrule_' + id).show();
         }
         $('#certify').prop('disabled', false);

      } else {
         $('input[type=radio][name=' + radioname + ']').attr("disabled", true);
         $('input[type=radio][name=' + radioname + ']').attr("required", false);
         if (certify == 0 || certify == 2) {
            $('#infosoftrule_' + id).val('').hide();
         }
         $('#certify').prop('disabled', true);
      }
   }

   function certifyList(status) {

      if (status == 'certify') {

         if ($('#rulesForm').valid()) {
            var btnVul = 'Certify';
            var denyBtn = true;
            changeCertifyStatus(status, btnVul, denyBtn);
         }
         return false;
      }

      if (status == 'uncertify') {

         var btnVul = 'Uncertify';
         var denyBtn = false;
         changeCertifyStatus(status, btnVul, denyBtn);
      }
      return false;
   }

   function changeCertifyStatus(status, btnVul, denyBtn) {

      Swal.fire({
         title: 'Do you want to save the changes?',
         icon: 'question',
         showDenyButton: false,
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: btnVul,
         denyButtonText: `Reject `,
      }).then((result) => {

         if (result.isConfirmed) {
            axiosCall(status);

         } else if (result.isDenied) {

            axiosCall(status);
         }

      });
      return false;
   }

   function axiosCall(status) {

      $('.pagination-loader').removeClass('d-none');
      var id = "{{ $listing->id }}";
      var rulesData = null;

      if (status == 'certify') {
         rulesData = JSON.stringify($('#rulesForm').serializeArray());
      }
      axios.post(" {{ route('ledger.listing.certify') }} ", {
         id: id,
         status: status,
         rules_data: rulesData
      }).then(res => {
         console.log(res, "responsesss");
         $('.pagination-loader').addClass('d-none');
         if (res.data) {
            //$('#rulesForm')[0].reset();
            Swal.fire({
               position: 'top-end',
               icon: 'success',
               title: 'Saved!',
               showConfirmButton: false,
               timer: 1500
            })
            location.reload();
         }

      }).catch(function (error) {
         console.log(error);
      });
   }
   $(document).ready(function () {
      
      $(".clickitem").on('click', function () {
         $(this).siblings().removeClass('active');
         $(this).addClass('active')
      })

      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();
      var calendar = <?php echo json_encode($calendar) ?>;
 
 
      $(".addcls").on("click", function () {
         $(this).hide();
         $(this).prev('.numbercstom').show();
      });

      //////smoothscroll######################
      $(document).on("scroll", onScroll);
      
      $('a[href^="#"]').on('click', function (e) {
         e.preventDefault();
         $(document).off("scroll");

         $('a').each(function () {
            $(this).removeClass('active');
         })
         $(this).addClass('active');

         var target = this.hash,
            menu = target;
         $target = $(target);
         $('html, body').stop().animate({
            'scrollTop': $target.offset().top + 2
         }, 500, 'swing', function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
         });
      });
   });

   function onScroll(event) {
      var scrollPos = $(document).scrollTop();
      $('#sub-navigation-links .clickitem').each(function () {
         var currLink = $(this);
         var refElement = $(currLink.attr("href"));
         if (refElement.position().top <= scrollPos && refElement.position().top) {
            $('#sub-navigation-links nav a').removeClass("active");
            currLink.addClass("active");
         } else {
            currLink.removeClass("active");
         }
      });
   }

   window.downloadFbnbFile = (filename, text) => {
      var element = document.createElement('a');
      element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
      element.setAttribute('download', filename);

      element.style.display = 'none';
      document.body.appendChild(element);

      element.click();

      document.body.removeChild(element);
   }

   //// certification Pop up ////
   
   // Get the mod_al_1
   var mod_al_1 = document.getElementById("my_mod_al_1");

   // Get the button that opens the mod_al_1
   var btn = document.getElementById("my_btn_1");

   // Get the <span> element that closer_1s the mod_al_1
   var span = document.getElementsByClassName("closer_1")[0];

   // When the user clicks the button, open the mod_al_1 
   btn.onclick = function() {
   mod_al_1.style.display = "block";
   }

   // When the user clicks on <span> (x), closer_1 the mod_al_1
   span.onclick = function() {
   mod_al_1.style.display = "none";
   }

   // When the user clicks anywhere outside of the mod_al_1, closer_1 it
   window.onclick = function(event) {
   if (event.target == mod_al_1) {
      mod_al_1.style.display = "none";
   }
   }

</script>

<script type="module">
//import { zenroom_exec, zencode_exec } from "https://jspm.dev/zenroom@next";
import { zencode_exec } from "https://jspm.dev/zenroom@2.2.0";

      const conf = "memmanager=lw";

      const contract = `Scenario 'ecdh': create the signature of an object 
Given I am 'Alice' 
Given I have my 'keypair' 

When I create the signature of 'keypair' 
When I rename the 'signature' to 'keypair.signature' 

Then print the 'keypair' 
Then print the 'keypair.signature'`;

      zencode_exec(contract, {data:``, keys:`{
	"Alice": {
		"keypair": {
			"private_key": "Aku7vkJ7K01gQehKELav3qaQfTeTMZKgK+5VhaR3Ui0=",
			"public_key": "BBCQg21VcjsmfTmNsg+I+8m1Cm0neaYONTqRnXUjsJLPa8075IYH+a9w2wRO7rFM1cKmv19Igd7ntDZcUvLq3xI="
		}
	}
}`, conf:``}).then((resultHashAnswers) => {
         let result = JSON.parse(resultHashAnswers.result);
         
         var keypair_sign = result['keypair.signature'];
         //console.log('keypair_sign',keypair_sign);
         //$('span#__r').text(keypair_sign.r);
         //$('span#__s').text(keypair_sign.s);
      });
</script>

@endpush


<!-- The mod_al_1 -->
<div id="my_mod_al_1" class="mod_al_1">
   <!-- mod_al_1 content -->
   <div class="content_cont_1">
      <span class="closer_1">&times;</span>
      <div id="faimess1" class="mb-5">
         <h2 class="lead mb-2 text-weight-medium despot_buyt_1">Fairness</h2>
         <div class="row po_pup_faimess_1">
		    <div class="col-md-12 po_pup_faimess_two_1">
               <p>Certified listings comply with all the mandatory rules of our platform. Such rules can include, but are not limited to, compliance with local regulations set by public authorities and with additional rules set by the local node or the platform.</p>
            </div>
            <div class="code_tg_1" style="width:100%">
				<div class="col-md-12">
               @if(!empty($cert))
					<code>
						{{$cert}}
					</code>
               @endif
					<a href="#" onclick="downloadFbnbFile('fairbnb_certificate.txt','{{$certAndSignature}}')" download class="download_certi_ficate_1"><i class="fa fa-download" aria-hidden="true"></i> Download Certificate</a>
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="col-md-12 po_pup_faimess_two_1" style="margin-top: 5px;">
               <h3 class="lead text-blue text-weight-bold mb-2">ECDSA Signatures</h3>
            </div>
			<div class="code_tg_1">
				<div class="code_fix_d_1">
					<div class="col-md-6 code_dol_fix_d_1">
                       <p>Local ambassador signature</p>
						<code>
							{{$laSign}}
						</code>
						<a download href="#" onclick="downloadFbnbFile('local_ambassador_public_key.txt','{{$pk}}')" class="download_certi_ficate_1"><i class="fa fa-download" aria-hidden="true"></i> Download Local Ambassador Public Key</a>
					</div>
				</div>	
			</div>
            <div class="code_tg_1" style="margin-left: 5px; width: 683px;">
               <div class="code_fix_d_1">
                  <div class="col-md-6 code_dol_fix_d_1">
                     <p>Local authority signature</p>
                     <code style="height: 55px; display: block">
                        Not available
                     </code>
                     <a download href="images/icon/wheelchair.png" class=" download_certi_ficate_1" style="color: #8f8f8f"><i style="color: #8f8f8f" class="fa fa-download" aria-hidden="true"></i> Download Local Authority Public Key</a>
                  </div>
               </div>
            </div>
			<div class="col-md-12 po_pup_faimess_two_1" style="margin-top: 5px;">
               <h3 class="lead text-blue text-weight-bold mb-2">Blockchain</h3>
               <p>Certificate is store in <a href="https://sawtooth.hyperledger.org/">Sawtooth</a> blockchain</p>
            </div>
			<div class="code_tg_1 bot_tom_popup_1">
				<div class="col-md-12">
                   <p>Certificate hash:</p>
                   <code>
						{{$stHash}}
					</code>

				</div>
			</div>
            <div class="code_tg_1 bot_tom_popup_1" style="margin-top: 5px">
               <div class="col-md-12">
                  <p>Sawtooth ID:</p>
                  <code>
                     {{$stId}}
                  </code>

               </div>

            </div>
         </div>
      </div>
   </div>
</div>

<style>

   .img_icn_1 .right_bronze_1 {
      position: absolute;
      top: -23px;
      transform: rotate(
              -44deg);
      font-size: 39px;
      right: -3px;
      text-shadow: -3px 0px 11px #bfbcbc;
   }


.code_fix_d_1 .code_dol_fix_d_1 {
    float: left;
}
.download_certi_ficate_1 {
    width: 100% !important;
    display: table;
    font-weight: 600;
    font-size: 16px;
    margin: 20px 0;
}
.po_pup_faimess_two_1 {
    padding-left: 0 !important;
    padding-right: 0 !important;
}
.code_tg_1 {
    background-color: #dfdfdf;
    padding-top: 25px;
    border: 3px solid #9b9b9a;
}
.content_cont_1 .row {
	margin: 0 !important;
}
.bot_tom_popup_1 {
    padding-bottom: 15px;
    padding-top: 15px;
    width: 100%;
}
.code_tg_1 code {
    color: #000;
}


   /* The mod_al_1 (background) */
.mod_al_1 {
    display: none;
    position: fixed;
    z-index: 10000000;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: #131313cc;
}

/* mod_al_1 Content */
.content_cont_1 {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The closer_1 Button */
.closer_1 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.closer_1:hover,
.closer_1:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
