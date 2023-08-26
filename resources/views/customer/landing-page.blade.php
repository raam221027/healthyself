@extends('customer.layouts.app-without-sidebar')

@section('title', '')

@section('contents')
<div class="container">
  <!-- <header>
    <h1>heal<span>THY</span>self</h1>
  </header> -->

       <div class="start-button">
        <button><a href="{{ route('customer.dashboard') }}">Start Order!</a></button>
    </div>
</div>
  </div>

<ul class="slideshow">
  <li><span class="welcome"></span><div><h3>WELCOME!</h3></div></li>
  <li><span class="slideshow0"></span></li>
  <li><span class="slideshow1"></span></li>
  <li><span class="slideshow2"></span></li>
  <li><span class="slideshow3"></span></li>
  <li><span class="slideshow4"></span></li>
  <!-- Add the rest of the list items -->
</ul>
@endsection
