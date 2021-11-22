@extends('ledger::layouts.master')
@section('content')

<!-- dashboard start here -->

<section class="ladger-section pt-3">
    <div class="container">

        <div class="row">

            <!-- aside start here -->

            <div class="col-lg-12">

                <div class="aside-block mt-n-2">
                    <div class="sticky-wrap-aside sticky-wrap-py-2">
                        <div class="aside">
                            <div class="aside-holder px-1 px-lg-0">
                                <ul class="aside-nav list-group" id="ladger-aside">


                                    <li class="list-group-item listing-type active active-list" data-type="listing"
                                        data-value="1" data-url="{{route('ledger.ambassadorlisting')}}">
                                        <div class="py-0_5 px-1">
                                            <a href="javascript:void(0);" class="d-flex align-items-center active">
                                                <span class="text-weight-medium">
                                                    Certified Listings
                                                    <span>{{$certifiedlistingCount}}</span>
                                                </span>
                                                <span class="aside-nav-icon flex-shrink-0">
                                                    <i class="fas fa-certificate"></i></span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="list-group-item listing-type" data-type="listing" data-value="0"
                                        data-url="{{route('ledger.ambassadorlisting')}}">
                                        <div class="py-0_5 px-1">
                                            <a href="javascript:void(0);" class="d-flex align-items-center ">

                                                <span class="text-weight-medium">
                                                    Waiting for Certification
                                                    <span>{{$nonecertifiedlistingCount}}</span>
                                                </span>
                                                <span class="aside-nav-icon flex-shrink-0">
                                                    <i class="fas fa-hourglass-half"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="list-group-item listing-type" data-type="listing" data-value="2"
                                        data-url="{{route('ledger.ambassadorlisting')}}">
                                        <div class="py-0_5 px-1">
                                            <a href="javascript:void(0);" class="d-flex align-items-center ">

                                                <span class="text-weight-medium">
                                                    Re-certification
                                                    <span>{{$recertifiedlistingCount}}</span>
                                                </span>
                                                <span class="aside-nav-icon flex-shrink-0">
                                                    <i class="far fa-file-alt"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="list-group-item listing-type" data-type="booking" data-value="1"
                                        data-url="{{route('ledger.booking.list')}}">
                                        <div class="py-0_5 px-1">
                                            <a href="javascript:void(0);" class="d-flex align-items-center ">

                                                <span class="text-weight-medium">
                                                    Bookings
                                                    <span>{{$bookingCount}}</span>
                                                </span>
                                                <span class="aside-nav-icon flex-shrink-0"><i
                                                        class="far fa-bookmark"></i></span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="list-group-item listing-type" data-type="booking" data-value="0"
                                        data-url="{{route('ledger.booking.rejected.list')}}">
                                        <div class="py-0_5 px-1">
                                            <a href="javascript:void(0);" class="d-flex align-items-center ">

                                                <span class="text-weight-medium">
                                                    Rejected Bookings
                                                    <span>{{$rejBookingCount}}</span>
                                                </span>
                                                <span class="aside-nav-icon flex-shrink-0"><i
                                                        class="fas fa-ban"></i></span>
                                            </a>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="py-0_5 px-1">
                                            <a href="javascript:void(0);" class="d-flex align-items-center ">

                                                <span class="text-weight-medium">
                                                    Reviews
                                                    <span>20</span>
                                                </span>
                                                <span class="aside-nav-icon flex-shrink-0"><i
                                                        class="far fa-comment-dots"></i></span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
             <div class="col">
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
                                        <div class="input-group input-group-alternate  bg-default mb-0">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-default border text-blue px-1_5 text-size-default">
                                                    <i class="fas fa-search"></i>
                                                </div>
                                            </div>
                                             <input type="search" id="ledger_search" name="ledger_search"
                                        class="form-control bg-default border border-left-0 px-0_5"
                                        placeholder="Search...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 

                <!-- right side start here -->

                <div class="list-box dynamic-listing">
                    @include('ledger::listing.ajax-ambassador-listing')

                    <ol id="breadcrumbs" class="breadcrumb text-size-md pt-1_5 pb-0_5 mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/en/dashboard/" rel=""><span><i class="fas fa-home"></i></span>Home</a>
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
                 </div>
               
        </div>

    </div>
    <!-- right side ends here -->
    </div>
    </div>
</section>

<!-- dashboard ends -->
@endsection
@push('scripts')
<script type="text/javascript">
         

        // function fetch_ledger_listing(query = '') {         
         
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: "{{ route('ledger.ajax.listing') }}",
        //         method: 'GET',
        //         data: { query: query },
        //         success: function (data) { 
                    
        //             if (data.isSucceeded) {
        //                 $('.dynamic-listing').empty().html(data.data);
        //             } else {
        //                 $('.dynamic-listing').html(data.data);
        //             }
        //         },
        //         error: function(err) {
        //             alert("ledger list cannot be loaded");
        //             console.log(err);
        //         }
        //     })
        // }

        // $(document).on('keyup', '#ledger_search', function () {
        //     var query = $(this).val();
        //     fetch_ledger_listing(query);
            
        // });
</script>
<script src="{{ asset('ledger_module/js/listing.js')}}"></script>
@endpush
