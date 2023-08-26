@extends('cashier.layouts.app')

@section('title', 'Dashboard - Laravel Cashier')


@section('contents')
<div class="row">
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Order ID</th>
      <th>Customer Name</th>
      <th>Products</th>
      <th>Quantity</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>John Doe</td>
      <td>Pizza, Burger, Fries</td>
      <td>1, 2, 3</td>
      <td>Pending</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Jane Doe</td>
      <td>Salad, Soup, Sandwich</td>
      <td>1, 1, 2</td>
      <td>Completed</td>
    </tr>
    <tr>
      <td>3</td>
      <td>John Smith</td>
      <td>Coffee, Cake, Ice Cream</td>
      <td>1, 1, 1</td>
      <td>Cancelled</td>
    </tr>
  </tbody>
</table>
</div>
@endsection