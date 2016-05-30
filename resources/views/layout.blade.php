<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Database Project</title>
	<link rel="stylesheet" href="/css/libs.css">
  	<link rel="stylesheet" href="/css/app.css">
	@yield('styles')
</head>
<body>

	@include('components.navbar')

	<div class="container">
		@yield('content')
	</div>

	<script src="/js/libs.js "></script>

	@include('components.flash')

	@yield('scripts')

	@include('components.footer')
</body>
</html>