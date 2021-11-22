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
     $listing_address = null;
     if(!empty($locations->listing_location->city))
     {
         $listing_address =   $locations->listing_location->city .','. $locations->listing_location->country;
      }
@endphp

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
</style>
 
<section class="ladger-section pt-3">
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

         <div class="col-lg-8 col-md-7 col-sm-12">

            <h3 class="mb-3 sow_pag_1"><b>{{  $listing->listing_translation->title }}</b></h3>
            <div id="sub-navigation-links" class="nav-wrapper collapse fade d-lg-block mt-n-2 mt-lg-0 show ">
               <nav class="nav nav-pills nav-justified nav-pills-primary shadow flex-lg-nowrap">
                  <a class="nav-item nav-link clickitem active" href="#description">
                     <span data-item-text="">
                        Description
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
            <!-- <textarea id="signed_contract"></textarea> -->
            <!-- descriptio start here -->
            <div id="description" class="py-2 section-active">
               <h2 class="lead mb-2 text-weight-medium show_p_h2_1">
                  Description
               </h2>
               <p>{{ $listing->listing_translation->description }} </p>

               <div id="wrap">
                  <!-- Carousel -->
                  <div id="carousel" class="carousel slide gallery" data-ride="carousel">
                     <div class="carousel-inner">


                        @foreach($listing->listing_image as $key => $image)
                        @php

                           $imgRelPath = 'storage/listings/listing_xxlarge/uploads/listings/images/'. $image->name;

                                 $imgPath = $_SERVER['DOCUMENT_ROOT'].'/public/'.$imgRelPath;

                                 //echo $imgPath;
                                 $check = file_exists($imgPath);
                          if($check == 1){
                          $path = asset('storage/listings/listing_xxlarge/uploads/listings/images/'. $image->name );
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

                                 $imgRelPath = 'storage/listings/listing_xxlarge/uploads/listings/images/'. $image->name;

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
@foreach($result as  $group ) 
@php $attrCount = 0 ; $attrContent = "";   @endphp

      <div class="col-md-6 col-lg-12 col-xl-6 mb-4 attribute_group">
         <div class="card h-100">
            <div class="card-body p-lg-3">
               <h3 class="lead text-blue text-weight-bold mb-2">
                  {{ $group['translations'][app()->getLocale()]['title'] }}  
               </h3>
        <div class="dl-inline mb-1 attributes-container">
               
                  @foreach($group['children'] as $attr )
                     @if ($listing_attributes[$attr['id']] )
                     @php   $title = $attr['translations'][app()->getLocale()]['title'] ;
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

               <h2 class="lead mb-2 text-weight-medium show_p_h2_1">Policies</h2>
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


            <!-- start faimess here -->
            {{--
            <div id="fairness" class="mb-5">
				   <h2 class="lead mb-2 text-weight-medium despot_buyt_1">Fairness</h2>
				   <div class="card shadow mb-1_5">
					  <div class="card-body px-lg-3 py-lg-2_5 faimess_1">
						<div class="row top_faimess_1">	
							 <div class="col-md-6">
                      <h3 class="lead text-blue text-weight-bold mb-2">Fairness Certificate</h3>
								<p class="mb-0_7 lorem_ipsum_1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam dui purus lacus, elementum rhoncus odio tortor arcu. Venenatis viverra malesuada bibendum ut malesuada nulla egestas tellus lacus. Lacus dui donec morbi cras. Arcu at rhoncus sit congue molestie sit mauris odio ut. Venenatis viverra malesuada bibendum ut malesuada nulla egestas tellus lacus. Lacus dui donec morbi cras.
								</p>
							 </div>
							 <div class="col-md-6  certificate_signed_by_1">
								<h3 class="lead text-blue text-weight-bold mb-2 listing_certi_fied_1"><i class="fa fa-check-square-o" aria-hidden="true"></i> Listing certified</h3>
								<p class="lead text-blue text-weight-bold mb-2"> Certificate signed by</p>
								<p>Local Ambassador:<span> Venice</span>  <i class="fa fa-user-check" aria-hidden="true"></i></p>
								<p>Local Authority: <span>Authority name</span>  <i class="fa fa-user-check" aria-hidden="true"></i></p>
								<button id="my_btn_1" class="view_certificate_1">VIEW CERTIFICATE</button>
							 </div>
						</div>	 
						 <div class="row bot_faimess_1">
							<div class="col-md-12 s">
							   <h3 class="lead text-blue text-weight-bold mb-2">fairness Badges</h3>
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
                                              <h3>{{$badges->title}}</h3>
                                              {{ strip_tags($badges->description) }}
                                           </div>


										</div>
								   </div>
								</div>

							</div>
                     @endforeach
						 </div>
					  </div>
				   </div>
				</div>
			 
             <!-- faimess end here -->
            --}}
            <!-- location start here -->
            <div id="listing-location" class="mb-5">
               <h2 class="lead mb-2 text-weight-medium show_p_h2_1">Location</h2>
               <div class="card-body p-lg-3_5 listing_loca_tion_1">
                  
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
			   
                  <div id='calendar' ></div>
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

         <div class="col-lg-4 col-md-5 col-sm-12">
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

                     <ul class="certify-btns">

                        @if($listing->certified == 1)
                        <li><button class="btn btn-primary" id="uncertify" onClick="certifyList('uncertify')">Revoke
                              Certification</button></li>
                        <li><a class="btn btn-primary" href="{{ url('/listing/'.$slug)}}" id="certify"  >View As Guest</a></li>
                        @else
                        <li><button class="btn btn-primary" data-toggle="modal" data-target="#askMoreInfo">Ask More
                              Info</button></li>
                        <li><button class="btn btn-primary" id="certify" disabled
                              onClick="certifyList('certify')">Certify</button></li>
                        @endif

                     </ul>
                  </div>

               </div>
               @php $rules = json_decode($listing->listing_translation->rules);
               $read_only = ($listing->certified == 0 || $listing->certified == 2) ? '' : 'readonly';
               @endphp

               <div class="rules ">
                  <form id="rulesForm" name="rulesForm">

                     <h3 class="lead mb-1"><b>Hard Rules</b></h3>
                     <div id="hard_rules_check" class="rules-reply rounded mb-3">
                        <ul>
                           @foreach($listingRules as $key => $rule)
                           @if($rule->type_of_rule == 'hard-rule')

                           <li onClick="checkRules('hardrule', {{ $rule->id }})">
                              <input type="checkbox" id="hard_rule_{{ $rule->id }}"
                                 {{ (@$rules[$key]->value == '' ? '' : 'checked') }}>
                              <label for="hard_rule_{{ $rule->id }}">
                                 <h6><b> {{ $rule->rule_translation[0]->value }} </b></h6>
                              </label> 
                              @if($rule->rule_translation[0]->description != null)
                              <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip"
                                 data-placement="top"
                                 title="{{ strip_tags($rule->rule_translation[0]->description) }}"></i> @endif <br>
                              <label class="radio-inline">
                                 <input type="radio" name="{{ $rule->id }}" value="yes"
                                    {{ (@$rules[$key]->value == 'yes' ? 'checked' : '')}} required />Yes
                              </label>
                              <label class="radio-inline">
                                 <input type="radio" name="{{ $rule->id }}" value="no"
                                    {{ (@$rules[$key]->value == 'no' ? 'checked' : '') }} required />No
                              </label>
                           </li>

                           @endif
                           @endforeach
                        </ul>
                     </div>
                  </form>
                  <form id="softRulesForm" name="rulesForm">
                     <h3 class="lead mb-1"><b>Soft Rules</b></h3>
                     <div class="rules-reply rounded mb-3">
                        <ul>
                           @foreach($listingRules as $key => $rule)
                           @if($rule->type_of_rule == 'soft-rule')
                           <li onClick="checkRules('softrule', {{ $rule->id }})">
                              <input type="checkbox" id="soft_rule_{{ $rule->id }}"
                                 {{ (@$rules[$key]->value == '' ? '' : 'checked') }}>
                              <label for="soft_rule_{{ $rule->id }}">
                                 <h6><b> {{ $rule->rule_translation[0]->value }} </b></h6>
                              </label>  
                              @if($rule->rule_translation[0]->description != null)
                                 <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip"
                              data-placement="top"
                              title="{{ strip_tags($rule->rule_translation[0]->description) }}"></i><br>
                              @endif
                              <input type="text" class="form-control info-soft-rule" name="{{  $rule->id }}"
                                 placeholder="write more info..." value="{{ @$rules[$key]->value }}"
                                 id="infosoftrule_{{ $rule->id }}"
                                 style="display: {{ ($listing->certified == 0 || $listing->certified == 2) ? 'none' : 'block' }}"
                                 readonly>
                           </li>
                           <br>
                           @endif
                           @endforeach
                        </ul>
                     </div>
                  </form>

                  <div style="width: 100%;display: inline-block;">
                     	<div class="right_list_ing_1">
							{{--<div class="right_top_list_ing_1">
								<div class="col-md-6 right_list_lt_ing_1">
									<h3 class="lead text-blue text-weight-bold mb-2 listing_certi_fied_1"><i class="fa fa-check-square-o" aria-hidden="true"></i> Listing certified</h3>
								</div>
								<div class="col-md-6 right_list_rt_ing_1">
									<button class="view_more_12">view more</button>
								</div>
							</div> --}}
							<div class="col-md-12">
								<div class="fair_ness_bad_ges_1">
                                   <div style="display: flex; margin-bottom: 20px;">
                                      <div class="col-md-6">
                                       <p class="fairness_bad_ges_1" style="font-size: 1.5em">Fairness badges</p>
                                      </div>
                                      <div class="col-md-6">
                                       <button style="font-size: 0.8em; padding: 5px 10px;"  class="btn btn-primary"  id="assignbadges">Assign Badges</button>
                                      </div>
                                   </div>
                                   @if($getAssignbadgesData && count($getAssignbadgesData) > 0)
                                       @foreach($getAssignbadgesData as  $badges )
                                       <div data-toggle="tooltip" title="{{$badges->categories." (".ucfirst($badges->level).")"}}" style="margin-top: 0px;" class="col-md-2 img_icn_1 right_win_1 right_win_{{$badges->level}}_1 ">
                                           <img class="img_por_{{$badges->level}}_1" src="{{URL::to('/public') }}/badgesIcons/{{$badges->icon}}">
                                           <span class="right_{{$badges->level}}_1"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
                                           <!--span class="right_silver_1"><i class="fa fa-caret-right" aria-hidden="true"></i></span-->
                                       </div>
                                       @endforeach
									@else
                                       <p>No badges assigned yet</p>
                                    @endif
								</div>	
							</div>
						</div>	
					</div>
                <!--  end certiesfy badges -->
               </div>
            </div>
         </div>

         <!-- right side rules ends here -->

      </div>

   </div>

   <!-- Ask more info Modal -->
   <div class="modal fade" id="askMoreInfo" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Ask More Info</h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">

               <div class="form-group">
                  <label for="askmoreinfo_title">Title</label>
                  <input type="text" class="form-control" id="askmoreinfo_title" placeholder="" required />
                  <span class="error_class aks_mi_title">Please add title</span>
               </div>
               <div class="form-group">
                  <label for="description">Description</label>
                  <textarea rows="4" class="form-control" id="askmoreinfo_desc" required>  </textarea>
                  <span class="error_class ask_mi_desc">Please add description</span>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" id="submit_ask_moreinfo">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>

            </div>

         </div>
      </div>
   </div>
   <!-- End Ask more info Modal -->
   <!-- Assign Badges Modal -->
   <div class="modal fade" id="assignBadgesModel" role="dialog">
     
        
      <div class="modal-dialog modal-lg">
      <form   id="assignbadgesform" method="post">
         <input type='hidden' name="listing_id" id="badges_listing_id" value="{{ $listing->id }}">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Assign badges</h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="askmoreinfo_title">Badges</label>                   
                  <select class="form-control" multiple="multiple" name="badges[badges_ids]" id="badges">
                                <option value="" >Select badges</option>                                 
                               @foreach($getAllBadges as $badges)
                                <option value="{{$badges->id}}" >{{$badges->title}}</option>                   
                               @endforeach 
                  </select>
                  
               </div>

               <div class="modal-footer">
                  <button type="submit" class="btn btn-default" id="assignbudges">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
               </form>
            </div>

         </div>
      </div>
     
   </div>
   <!-- Assign Badges Modal -->
</section>

<!-- dashboard ends -->
@endsection

@push('scripts')
   <script src="{{ asset('modules/ledger/js/calendar.js') }}"></script>
 

<script type="module">
    $('#badges').multiselect({
          includeSelectAllOption: true,
        });
import {   zencode_exec } from "https://jspm.dev/zenroom@2.2.0-0659d7b";

window.checkRules = (type, id) => {

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

      checkCertBtnStatus();

   } else {
      $('input[type=radio][name=' + radioname + ']').attr("disabled", true);
      $('input[type=radio][name=' + radioname + ']').attr("required", false);
      if (certify == 0 || certify == 2) {
         $('#infosoftrule_' + id).val('').hide();
      }
      $('#certify').prop('disabled', true);
   }
}

window.certifyList = (status) => {
   
   var public_key = localStorage.getItem("public_key");
   var private_key = localStorage.getItem("private_key");
  
   if(public_key == null || private_key == null){

       Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Please generate Keypair for verification from Profile setting',
            showConfirmButton: true,
            //timer: 2000
         }).then(function() {
            window.location.href = "{{ route('ledger.profile.setting')}}";
         });
         

   }else{
      
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
}

window.checkCertBtnStatus = () => {
   var rules = [];
   var i = 0;
   $('#hard_rules_check').find(':checkbox').each(function(){
      var id = $(this).attr('id');
      var radioEl = $('input:radio[name="'+id.replace('hard_rule_','')+'"]');

      if(radioEl.is(':checked')) {
         var val = $('input:radio[name="'+id.replace('hard_rule_','')+'"]:checked').val()
         if(val == 'yes') {
            rules[i] = true;
         } else {
            rules[i] = false;
         }
      } else {
         rules[i] = false;
      }

      i++;
   });

   var btnDisabled = false;
   if(rules.length > 0) {
      rules.forEach(r => {
         if(!r) {
            btnDisabled = true;
         }
      });
   } else {
      btnDisabled = true;
   }

   $('#certify').prop('disabled', btnDisabled);
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
         var rulesData = $('#rulesForm').serializeArray();
         var softrulesData = $('#softRulesForm').serializeArray();

         var hr_object = {};
         var sr_object = {};

         for (const key of rulesData) {
            if(key.value.length){
               hr_object[key.name] = key.value;
            }
         }
         for (const key of softrulesData) {
            if(key.value.length){
               sr_object[key.name] = key.value;
            }
         }
         if(status == 'certify' ){

            signContract(JSON.stringify(sr_object),JSON.stringify(hr_object));
            
         }else{
            axiosCall(status);
         }
      } else if (result.isDenied) {

         axiosCall(status);
      }

   });
   return false;
}

function axiosCall(status, signature=null) {
   
   $('.pagination-loader').removeClass('d-none');
   var id = "{{ $listing->id }}";
   var rulesData = null;

   if (status == 'certify') {
      rulesData = JSON.stringify($('#rulesForm').serializeArray());
   }
   axios.post(" {{ route('ledger.listing.certify') }} ", {
      id: id,
      status: status,
      rules_data: rulesData,
      sign :signature
   }).then(res => {
      
      $('.pagination-loader').addClass('d-none123');
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
      //console.log(error);
      Swal.fire({
               position: 'center',
               icon: 'error',
               title: error,
               showConfirmButton: false,
               timer: 1500
            })
   });
}

function signContract(sr_obj, hr_obj) {
   //////// Listing certification //////////
   const conf = "memmanager=lw";
   var id = "{{ Auth::id() }}";
   var address = "{{ $listing_address }}";
   var code = '1254054';
   var listing_id = "{{ $listing->id }}"

   const contractListDtl = `Scenario 'ecdh': create the signature of an object
                        Given I am '` + id + `'
                        Given I have my 'keypair'
                        Given I have a 'string dictionary' named 'fairCertDetails'
                        When I create the signature of 'fairCertDetails'
                        When I rename the 'signature' to 'fairCertSignature'
                        Then print the 'fairCertDetails'
                        Then print the 'fairCertSignature'`;

   const zenKeysList = `{
                              "` + id + `": {
                                 "keypair": {
                                    "private_key": "` + localStorage.getItem("private_key") + `",
                                    "public_key": "` + localStorage.getItem("public_key") + `"
                                 }
                              }
                           }`;

   const zenDataList = `{
                  "fairCertDetails": {
                     "soft_rules": ` + sr_obj + `,
                     "hard_rules":  ` + hr_obj + `,
                     "listing_address": "` + address + `",
                     "property_code": "` + code + `",
                     "listing_id" : "`+ listing_id +`",
                     "la_id" : "`+ id +`",
                  }
            }`;

   //console.log('zenDataList', typeof zenDataList, zenDataList);
           
   zencode_exec(contractListDtl, {
      data: zenDataList,
      keys: zenKeysList,
      conf: conf
   }).then((resultListing) => {
      //console.log(resultListing);
      var listingResult = JSON.stringify(JSON.parse(resultListing.result));
      //Set value of signed contract into textarea
      var parsed_result = JSON.parse(resultListing.result);
      var details = parsed_result.fairCertDetails;
      var signature = parsed_result.fairCertSignature;

      /*const contractSawTooth = `Scenario sawroom: Store data into the blockchain
                        Given that I have a sawroom endpoint named 'sawroomEndpoint'
                        Given I have a 'string dictionary' named 'fairCertDetails'
                        Given I have a 'string dictionary' named 'fairCertSignature'
                        Given I have a 'string' named 'fairCertTimestamp'
                        When I create the hash of 'fairCertDetails' using 'sha256'
                        When I rename the 'hash' to 'fairCertHash'
                        Then print the 'fairCertTimestamp'
                        Then print the 'fairCertHash'
                        Then print the 'fairCertSignature'
                        Then I ask Sawroom to store the output into the tag 'sawtootId'`;*/


      axios.post("https://apiroom.net/api/fairbnb/sawtooth-store", {
         data: {
            sawroomEndpoint: "http://195.201.41.35:8008",
            fairCertTimestamp: new Date().toISOString(),
            fairCertDetails: details,
            fairCertSignature: signature
         },
         keys: {}
      }).then(res => {

         if (res.data) {
            var sawtoothHash = res.data.fairCertHash;
            var sawtoothId = res.data.sawtootId;

            storeCert('certify', details, signature, sawtoothHash, sawtoothId);
         } else {
            console.log('failure: no_data');
         }

      }).catch(function (error) {
         console.log('failure: %O', error);
      });

      /*zencode_exec(contractSawTooth, {
         data: zenSawToothDataList,
         keys: zenSawToothKeysList,
         conf: conf
      }).then((result) => {
         console.log(result);
      }).catch((error) => {
         console.log(error);
         //throw new Error(error);
         Swal.fire({
            position: 'center',
            icon: 'error',
            title: error,
            showConfirmButton: false,
            timer: 2500
         })
      });*/

      //$("#signed_contract").val(JSON.stringify(parsed_result, null, 2));
      //axiosCall('certify', parsed_result);

   }).catch((error) => {
      console.log(error);
      //throw new Error(error);
      Swal.fire({
            position: 'center',
            icon: 'error',
            title: error,
            showConfirmButton: false,
            timer: 2500
         })
   });

}

function storeCert(status, certificate, signature, sawtoothHash, sawtoothId) {
   $('.pagination-loader').removeClass('d-none');
   var id = "{{ $listing->id }}";
   var rulesData = null;
   var public_key = localStorage.getItem("public_key");

   if (status == 'certify') {
      rulesData = JSON.stringify($('#rulesForm').serializeArray());
   }
   axios.post(" {{ route('ledger.listing.certify') }} ", {
      id: id,
      certificate: JSON.stringify(certificate),
      signature: JSON.stringify(signature),
      pk: public_key,
      sawtooth_hash: btoa(sawtoothHash),
      sawtooth_id: sawtoothId,
      status: status,
      rules_data: rulesData,
      sign :signature
   }).then(res => {

      $('.pagination-loader').addClass('d-none123');
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
      //console.log(error);
      Swal.fire({
         position: 'center',
         icon: 'error',
         title: error,
         showConfirmButton: false,
         timer: 1500
      })
   });
}

</script>
<script>
      $(function () {
      $('[data-toggle="tooltip"]').tooltip();

         $('#hard_rules_check input:radio').change(function(){
            checkCertBtnStatus();
         });
   });

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
         //console.log(error);
         Swal.fire({
               position: 'center',
               icon: 'error',
               title: error,
               showConfirmButton: false,
               timer: 1500
            })
      });
   });

   $(document).ready(function () {
           
      $(".clickitem").on('click', function () {
         $(this).siblings().removeClass('active');
         $(this).addClass('active')
      })

        
      $(".addcls").on("click", function () {
         $(this).hide();
         $(this).prev('.numbercstom').show();
      });


    });
 
    
    $("#assignbadges").click(function () {           
            $("#assignBadgesModel").modal("show");
            return false;
        });


        $(document).on('click', '#assignbudges', function (e) {
          e.preventDefault();         
               var badges_ids = $('#badges').val();  
               var badges_listing_id = $('#badges_listing_id').val();  
               axios.post("{{ route('ledger.assignBadges') }}", {
                  params: { 
                     badges_id : badges_ids,
                     listing_id : badges_listing_id,  
                  },
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Content-Type": "multipart/form-data",  
                  }
            }).then(res => {
            $("#assignBadgesModel .close").click();
         
         if (res.data) {
            Swal.fire({
               position: 'top-end',
               icon: 'success',
               title: 'Assign Badges successfully',
               showConfirmButton: false,
               timer: 1500
            })

            location.reload();
         }

   }).catch(function (error) {
      console.log(error);
   });
 
         

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
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
@endpush
