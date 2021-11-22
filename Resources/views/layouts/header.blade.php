  	<!-- header start here-->
   <header class="header_stk_1">
      <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="#"><img src="{{ asset('images/logo.jpg') }}" alt="logo"/></a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span></span>
		  <span></span>
		  <span></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarCollapse" style="">
			<div class="ml-auto">
				 <ul class="navbar-nav ml-auto lagder-nav align-items-center">
				    @if (Route::has('login')) 
							@auth
							<li class="after-login-li"> 
								<div class="dropdown ladger-dropdown">
									<button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									@if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
										<!-- <img class="" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" /> -->
										<h2 class="color user_name_1"><i class="fa fa-user-circle " aria-hidden="true"></i> {{ Auth::user()->first_name }}</h2>
								    @else
									    <i class="fa fa-user-circle " aria-hidden="true"></i> {{ Auth::user()->first_name }}
								    @endif	 
									</button>
								 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									 <!--<x-jet-nav-link  class="dropdown-item" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
										{{ __('Dashboard') }}
									</x-jet-nav-link>
									
									   <!-- Authentication -->
									<form method="POST" action="{{ route('logout') }}">
										@csrf

										<x-jet-dropdown-link  class="dropdown-item" href="{{ route('logout') }}"
												 onclick="event.preventDefault();
														this.closest('form').submit();">
											{{ __('Log Out') }}
										</x-jet-dropdown-link>
									</form>
								 </div>
								</div>
							</li >
							
							@else
							 <li class="nav-item"><a class="nav-link" href="{{ route('login') }}" >Log in</a> </li>
								@if (Route::has('register'))
								 <li class="nav-item">	<a class="nav-link" href="{{ route('register') }}" >Register</a> </li>
								@endif
							@endauth 
				    @endif  
					<button class="navbar-toggler border-0 ml-2_5 d-none d-lg-block collapsed" type="button" data-toggle="collapse" data-target="#header_nav" aria-controls="header_nav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-bar navbar-toggler-bar-top"></span>
						<span class="navbar-toggler-bar navbar-toggler-bar-middle"></span>
						<span class="navbar-toggler-bar navbar-toggler-bar-bottom"></span>
					</button>
					<div class="navbar-main-nav bg-white collapse head_er_top_1" id="header_nav" style="">
						<ul class="nav flex-column additional-nav additional-nav-default nav-fill flex-lg-column justify-content-start py-lg-0_5">
								<li class="nav-item text-left text-lg-right flex-grow-0 py-lg-0_5" > 
									<a class="nav-link d-inline-block d-lg-block" href="{{ route('ledger.profile.setting') }}">
											Profile
									</a> 
								</li>	
								<li class="nav-item text-left text-lg-right flex-grow-0 py-lg-0_5"> 
									<a
										class="nav-link d-inline-block d-lg-block" href="{{ route('ledger.listing') }}">
										Listing
									</a> </li>
									<li class="nav-item text-left text-lg-right flex-grow-0 py-lg-0_5">
											<a class="nav-link d-inline-block d-lg-block" href="{{ route('ledger.badges.index') }}">
												Badges
											</a>
										</li>
								<!--li class="nav-item text-left text-lg-right flex-grow-0 py-lg-0_5"> 
									<a
										class="nav-link d-inline-block d-lg-block" href="{{ route('ledger.hostlisting') }}">
										Hosts
									</a> </li-->
								<li class="nav-item text-left text-lg-right flex-grow-0 py-lg-0_5"> <a
										class="nav-link d-inline-block d-lg-block" href="{{ route('ledger.rules.index') }}">
										Rules
									</a> </li>
								<li class="nav-item text-left text-lg-right flex-grow-0 py-lg-0_5"> <a
										class="nav-link d-inline-block d-lg-block" href="#">
										Who are we ?
									</a> </li>
								<li class="nav-item text-left text-lg-right flex-grow-0 py-lg-0_5"> <a
										class="nav-link d-inline-block d-lg-block" href="#">
										Any question ?
									</a> </li>
								
						</ul>

					</div>
					<!-- <div class="toggle-desktop-menus">
						<button class="toggle-btn">
							<span></span>
							<span></span>
							<span></span>
						</button>
						<ul class="toggle-sub-menu">
							<li><a href="{{ route('ledger.hostlisting') }}">Host Listing</a></li>
							<li><a href="{{ route('ledger.rules.index') }}">Rule Listing</a></li>
							<li><a href="#">Favorites</a></li>
							<li><a href="#">Fairbnb.coop</a></li>
							<li><a href="#">Who are we ?</a></li>
							<li><a href="#">Any question ?</a></li>
						</ul>
					</div> -->
				</ul>
			  </div>
        
		</div>
      </nav>
	  <script type="module">
      import { zencode_exec } from "https://jspm.dev/zenroom@next";
      
      const conf = "memmanager=lw";
      
      window.encrypt = () => {
        const password = document.getElementById('encryptPassword').value
        const message = document.getElementById('plainMessage').value
        const keys = JSON.stringify({ password });
        const data = JSON.stringify({ message });
        const contract = `Scenario 'ecdh': Encrypt a message with a password/secret 
          Given that I have a 'string' named 'password' 
          and that I have a 'string' named 'message' 
          When I encrypt the secret message 'message' with 'password' 
          Then print the 'secret message'`;
        zencode_exec(contract, { data, keys, conf }).then(({result}) => {
          const rel = document.getElementById('encrypted')
          rel.value = result
        })
      }
    </script>
    </header>