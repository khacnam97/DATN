@extends('layouts.app')

@section('content')
<!-- SLIDER -->
<section class="page-section image breadcrumbs overlay">
    <div class="container">
        <h1>EVENT DETAIL PAGE</h1>
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Events</a></li>
            <li class="active">Event Detail Page</li>
        </ul>
    </div>
</section>
<!-- /SLIDER -->
</div>
<main class="container" >
  @yield('content-section')
</main>
@endsection