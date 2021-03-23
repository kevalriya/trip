<!DOCTYPE html>
<html lang="en">
<head>
	@include('front.layouts.head')
</head>
<body >
<div class="global-wrap">
	@include('front.layouts.header')
	
	@section('main-content')
		@show
	@include('front.layouts.footer')

	@section('footerSection')
    @show
</div>
</body>
</html>