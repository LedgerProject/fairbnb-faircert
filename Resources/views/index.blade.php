@extends('ledger::layouts.master')
@section('content')

<!-- dashboard start here --> 
<section class="ladger-section pt-3">
    <div class="container">
        <div class="row">
            <!-- aside start here --> 
            <div class="col-lg-auto">
                <div class="aside-block mt-n-2">
                    <button type="button" class="btn btn-primary p-1 rounded-0 d-lg-none aside-opener btn-sm">
                    <i class="icon icon-chevron-left d-inline-block align-middle"></i>
                    </button>
                    <div class="sticky-wrap-aside sticky-wrap-py-2">
                        <div class="aside">
                            <div class="aside-holder px-1 px-lg-0">
                                <ul class="aside-nav list-group" id="ladger-aside">
                                    <li class="list-group-item active">
                                        <div class="py-0_5 px-1">
                                            <a href="{{ route('ledger.hostlisting') }}" class="d-flex align-items-center active">
                                            <span class="aside-nav-icon flex-shrink-0 pr-3">
                                            <i class="fas fa-user"></i></span>
                                            <span class="text-weight-medium">
                                            Host Listings
                                            </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="py-0_5 px-1">
                                            <a href="#" class="d-flex align-items-center">
                                            <span class="aside-nav-icon flex-shrink-0 pr-3">
                                            <i class="fas fa-certificate"></i></span>
                                            <span class="text-weight-medium">
                                            Certified Listings
                                            </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="list-group-item ">
                                        <div class="py-0_5 px-1">
                                            <a href="#" class="d-flex align-items-center ">
                                            <span class="aside-nav-icon flex-shrink-0 pr-3">
                                            <i class="fas fa-hourglass-half"></i>
                                            </span>
                                            <span class="text-weight-medium">
                                            Waiting for Certification
                                            </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="list-group-item ">
                                        <div class="py-0_5 px-1">
                                            <a href="#" class="d-flex align-items-center ">
                                            <span class="aside-nav-icon flex-shrink-0 pr-3">
                                            <i class="far fa-file-alt"></i>
                                            </span>
                                            <span class="text-weight-medium">
                                            Waiting for Re-certification
                                            </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="list-group-item ">
                                        <div class="py-0_5 px-1">
                                            <a href="#" class="d-flex align-items-center ">
                                            <span class="aside-nav-icon flex-shrink-0 pr-3"><i class="far fa-bookmark"></i></span>
                                            <span class="text-weight-medium">
                                            Bookings
                                            </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="list-group-item ">
                                        <div class="py-0_5 px-1">
                                            <a href="#" class="d-flex align-items-center ">
                                            <span class="aside-nav-icon flex-shrink-0 pr-3"><i class="fas fa-ban"></i></span>
                                            <span class="text-weight-medium">
                                            Rejected Bookings
                                            </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="list-group-item ">
                                        <div class="py-0_5 px-1">
                                            <a href="#" class="d-flex align-items-center ">
                                            <span class="aside-nav-icon flex-shrink-0 pr-3"><i class="far fa-comment-dots"></i></span>
                                            <span class="text-weight-medium">
                                            Reviews
                                            </span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- aside ends here -->
            <!-- right side start here -->
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
                                            <input type="search" id="location" name="listing" class="form-control bg-default border border-left-0 px-0_5 pac-target-input" placeholder="Search...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- list	start hete -->		
                <div class="list-box">
  
                    <!-- single listing ends here -->
                    <div class="single-list">
                        <div class="row align-items-center">
                            <div class="col-md-7 order-md-2">
                                <h2 class="featurette-heading d-flex align-items-center">
                                    <img src="{{ asset('images/user.jpg') }}" class="rounded-circle" alt="img" /> 
                                    <p class="text-muted ml-2">Casa Navagero - Room with attic <span class="location">VENEZIA</span></p>
                                </h2>
                                <p class="desc">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                            </div>
                            <div class="col-md-5 order-md-1">
                                <img class="featurette-image img-fluid mx-auto rounded" src="{{ asset('images/accomodation.jpg') }}">
                            </div>
                        </div>
                    </div>
                    <!-- single listing ends here-->
                    <div class="single-list">
                        <div class="row align-items-center">
                            <div class="col-md-7 order-md-2">
                                <h2 class="featurette-heading d-flex align-items-center">
                                    <img src="{{ asset('images/user.jpg') }}" class="rounded-circle" alt="img" /> 
                                    <p class="text-muted ml-2">Casa Navagero - Room with attic <span class="location">VENEZIA</span></p>
                                </h2>
                                <p class="desc">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                            </div>
                            <div class="col-md-5 order-md-1">
                                <img class="featurette-image img-fluid mx-auto rounded" src="{{ asset('images/accomodation.jpg') }}">
                            </div>
                        </div>
                    </div>
                    <!-- single listing ends here-->
                    <div class="single-list">
                        <div class="row align-items-center">
                            <div class="col-md-7 order-md-2">
                                <h2 class="featurette-heading d-flex align-items-center">
                                    <img src="{{ asset('images/user.jpg') }}" class="rounded-circle" alt="img" /> 
                                    <p class="text-muted ml-2">Casa Navagero - Room with attic <span class="location">VENEZIA</span></p>
                                </h2>
                                <p class="desc">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                            </div>
                            <div class="col-md-5 order-md-1">
                                <img class="featurette-image img-fluid mx-auto rounded" src="{{ asset('images/accomodation.jpg') }}">
                            </div>
                        </div>
                    </div>
                    <!-- single listing ends here-->
                    <div class="single-list">
                        <div class="row align-items-center">
                            <div class="col-md-7 order-md-2">
                                <h2 class="featurette-heading d-flex align-items-center">
                                    <img src="{{ asset('images/user.jpg') }}" class="rounded-circle" alt="img" /> 
                                    <p class="text-muted ml-2">Casa Navagero - Room with attic <span class="location">VENEZIA</span></p>
                                </h2>
                                <p class="desc">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                            </div>
                            <div class="col-md-5 order-md-1">
                                <img class="featurette-image img-fluid mx-auto rounded" src="{{ asset('images/accomodation.jpg') }}">
                            </div>
                        </div>
                    </div>
                    <!-- single listing ends here-->
                    <div class="single-list">
                        <div class="row align-items-center">
                            <div class="col-md-7 order-md-2">
                                <h2 class="featurette-heading d-flex align-items-center">
                                    <img src="{{ asset('images/user.jpg') }}" class="rounded-circle" alt="img" /> 
                                    <p class="text-muted ml-2">Casa Navagero - Room with attic <span class="location">VENEZIA</span></p>
                                </h2>
                                <p class="desc">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                            </div>
                            <div class="col-md-5 order-md-1">
                                <img class="featurette-image img-fluid mx-auto rounded" src="{{ asset('images/accomodation.jpg') }}">
                            </div>
                        </div>
                    </div>
                    <!-- single listing ends here-->
                </div>
            </div>
            <!-- right side ends here -->
        </div>
    </div>
</section>
<!-- dashboard ends -->
@endsection