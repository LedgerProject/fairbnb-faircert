@extends('ledger::layouts.master')
@section('content')
<!-- dashboard start here -->
<section class="ladger-section pt-3">
    <div class="container">
        <div class="row">
            <!-- right side start here -->
            <div class="col-lg-12">
                <div class="right-top-search">
                    <div class="row no-gutters justify-content-between align-items-center">
                        <div class="col-12 col-xl-auto flex-grow-1">
                            <!-- breadcrumbs -->
                            <ol id="breadcrumbs" class="breadcrumb text-size-md pt-1_5 pb-0_5 mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('ledger.listing') }}" rel=""><span><i class="fas fa-home"></i></span></a>
                                    <!--i class="fas fa-angle-right"></i-->
                                </li>
                            </ol>
                        </div>
                        <div class="col-xl col-xl-auto">
                            <div class="search">
                                <div class="input-group d-block d-md-flex flex-md-nowrap align-items-center">
                                    <div class="mb-0_5 mb-md-0 ml-2">
                                        <div class="input-group input-group-alternate  bg-default mb-0">
                                            <div class="input-group-prepend">
                                                <div
                                                    class="input-group-text bg-default border text-blue px-1_5 text-size-default">
                                                    <i class="fas fa-search"></i>
                                                </div>
                                            </div>
                                            <input type="search" id="location" name="listing"
                                                class="form-control bg-default border border-left-0 px-0_5 pac-target-input"
                                                placeholder="Search...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- list	start hete -->
                <div class="list-box dynamic-listing">
                    @include('ledger::booking/booking-ajax-list')
                </div>
                <!-- single listing ends here-->
            </div>
            <!-- right side ends here -->
        </div>
    </div>
</section>
<!-- dashboard ends -->
@endsection
@push('scripts')
<script type="text/javascript">

    $(document).on('click', '.pagination a', function (event) 
    {
        $('.pagination-loader').removeClass('d-none');
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        $('li').removeClass('active');
        $(this).parent().addClass('active');
        listingData(page);
    });

    function listingData(page) 
    {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('ledger.booking.list') }}?page=" + page,
            method: "GET",
            success: function (data) {
                $('.pagination-loader').addClass('d-none');
                if (data.isSucceeded) {
                    $('.dynamic-listing').empty().html(data.data);
                } else {
                    $('.dynamic-listing').html(data.data);
                }
            }
        });
    }
</script>
@endpush