<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Database Project</title>
	<link rel="stylesheet" href="/css/libs.css">
  	<link rel="stylesheet" href="/css/app.css">
  	<style>
		@yield('styles')
	</style>
</head>
<body>

	@include('components.navbar')

	<div class="container">
		@yield('content')
	</div>

	<script src="/js/libs.js "></script>

	@include('components.flash')
	<script>
		@yield('scripts')
	</script>
	@include('components.footer')
</body>
</html>