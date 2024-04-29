<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="{{ asset('') }}frontend/assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="{{ asset('') }}frontend/assets/css/tiny-slider.css" rel="stylesheet">
		<link href="{{ asset('') }}frontend/assets/css/style.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.16.22/dist/css/uikit.min.css" />
		
		@php
		$favicon = public_path().'/Backend/settings/'.$settings->favicon;
		@endphp
		@if(file_exists($favicon))
		<link rel="shortcut icon" href="{{asset('Backend/settings')}}/{{$settings->favicon}}" />
		@endif
		<title>
			@if(config('app.locale') == 'en')
			{{$settings->title_en ?: $settings->title_bn}}
			@else
			{{$settings->title_bn ?: $settings->title_en}}
			@endif
		</title>
	</head>