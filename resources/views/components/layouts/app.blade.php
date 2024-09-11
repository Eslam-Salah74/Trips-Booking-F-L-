<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<title>{{ $title ?? 'Page Title' }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
	<meta name="description" content="This is meta description">
	<meta name="author" content="Themefisher">
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
	<link rel="icon" href="images/favicon.png" type="image/x-icon">

	<!-- # Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

	<!-- # CSS Plugins -->
	<link rel="stylesheet" href="{{asset('Frontend/plugins/slick/slick.css')}}">
	<link rel="stylesheet" href="{{asset('Frontend/plugins/font-awesome/fontawesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('Frontend/plugins/font-awesome/brands.css')}}">
	<link rel="stylesheet" href="{{asset('Frontend/plugins/font-awesome/solid.css')}}">

	<!-- # Main Style Sheet -->
	<link rel="stylesheet" href="{{asset('Frontend/css/style.css')}}">
  @livewireStyles
</head>

<body>

<!-- navigation -->
<header class="navigation bg-tertiary">
	<nav class="navbar navbar-expand-xl navbar-light text-center py-3">
		<div class="container">
			<a class="navbar-brand" href="{{route('home')}}" wire:navigate>
				<img loading="prelaod" decoding="async" class="img-fluid" width="160" src="{{asset('Frontend/images/logo.png')}}" alt="Wallet">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav m-auto mb-2 mb-lg-0">
					<li class="nav-item"> <a class="nav-link" href="{{route('home')}}" wire:navigate>Home</a></li>
					<li class="nav-item "> <a class="nav-link"  href="{{route('aboutus')}}" wire:navigate>About Us</a></li>
					<li class="nav-item "> <a class="nav-link" href="{{route('services')}}" wire:navigate>Services</a></li>
					<li class="nav-item "> <a class="nav-link" href="{{route('members')}}" wire:navigate>Our Team</a></li>
					<li class="nav-item "><a class="nav-link " href="{{route('trips')}}" wire:navigate>Trips</a></li>
					{{-- <li class="nav-item "><a class="nav-link " href="blog.html">Blog</a></li> --}}
					<li class="nav-item "><a class="nav-link " href="{{route('faqs')}}" wire:navigate>FAQ</a></li>
				</ul>
				<a href="{{route('contact')}}" wire:navigate class="btn btn-outline-primary">Contact Us</a>				
			</div>
		</div>
	</nav>
</header>
<!-- /navigation -->


{{ $slot }}






<footer class="section-sm bg-tertiary">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">Service</h5>
					<ul class="list-unstyled">
						@foreach (getServices() as $service )
						<li class="mb-2">
							<a href="{{route('servicedetails',$service->id)}}" wire:navigat>{{$service->title}}</a>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">Quick Links</h5>
					<ul class="list-unstyled">
						<li class="mb-2"><a href="{{route('aboutus')}}" wire:navigate>About Us</a>
						</li>
						<li class="mb-2"><a href="{{route('contact')}}" wire:navigate>Contact Us</a>
						</li>
						<li class="mb-2"><a href="{{route('trips')}}" wire:navigate>Blog</a>
						</li>
						<li class="mb-2"><a href="{{route('members')}}" wire:navigate>Team</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">Other Links</h5>
					<ul class="list-unstyled">
						<li class="list-inline-item me-4"><a class="text-black" href="privacy-policy.html">Privacy Policy</a>
                        </li>
						<li class="list-inline-item me-4"><a class="text-black" href="terms.html">Terms &amp; Conditions</a>
                        </li>
					</ul>
				</div>
			</div>			
		</div>
		
	</div>
</footer>

<!-- # JS Plugins -->
<script src="{{asset('Frontend/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('Frontend/plugins/bootstrap/bootstrap.min.js')}}"></script>

<!-- Main Script -->
<script src="{{asset('Frontend/js/script.js')}}"></script>
@livewireScripts 
</body>
</html>