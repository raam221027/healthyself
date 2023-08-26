@extends('customer.layouts.sidebar')


@section('title', '')

@section('contents')
<div class="order-options">
    <label>
        <input type="radio" name="order_type" value="Dine In" checked> DINE IN
    </label>
    <label>
        <input type="radio" name="order_type" value="Takeout"> TAKEOUT
    </label>
</div>
@endsection