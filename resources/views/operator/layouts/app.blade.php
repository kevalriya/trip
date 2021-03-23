<!DOCTYPE html>
<html lang="en">
<head>
	@include('operator.layouts.head')
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">
	@include('operator.layouts.header')
	@include('operator.layouts.sidebar')
	@section('main-content')
		@show
	@include('operator.layouts.footer')
</div>
</body>
</html>