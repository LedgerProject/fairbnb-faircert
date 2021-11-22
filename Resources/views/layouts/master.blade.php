<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Fairbnb Ledger</title>

       {{-- Laravel Mix - CSS File --}} 
       <!-- <link rel="stylesheet" href="{{ asset('ledger_module/css/bootstrap.css') }}"> -->
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
       <link rel="stylesheet" href="{{ asset('ledger_module/css/ledger.css') }}">
       <link rel="stylesheet" href="{{ asset('ledger_module/css/fairbnb_custom.css') }}">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"  />
       <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" crossorigin=""/>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    </head>
    <body>
            @include('ledger::layouts.header')
            @include('ledger::layouts.banner')
        
            @yield('content')

            @include('ledger::layouts.footer')

        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ asset('ledger_module/js/ledger.js') }}"></script> --}}
        
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
        <script src="https://kit.fontawesome.com/16499c553d.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" ></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js" > </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.3.0/main.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" crossorigin=""></script>
        
        <script>
            var HOST_URL="{{route('/')}}";

        </script>
		 @stack('scripts')



        <div class="pagination-loader d-none">
            <div class="loader-box">
                <img class="" src="{{ Module::asset('ledger:images/loder.gif') }}">
            </div>
        </div>
    </body>
</html>
