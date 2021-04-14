@extends('layouts.frontend')
@section('frontend')
<div class="container table offset mt-5">
<h4 class="text-center">My Order Table</h4>
<table id="myorder" class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Food-(quantity)</th>
      <th scope="col">Order Status</th>
      <th scope="col">payment_method</th>
      <th scope="col">payment_status</th>
      <th scope="col">Address</th>
      <th scope="col">phonenumber</th>
      <th scope="col">price</th>
      <th scope="col">Order Date & Time</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
    <tbody>
  @foreach($myorders as $order)
      <tr>
        <th scope="row">{{$order->id}}</th>
        <td>
          <ul>
              @foreach($order->foods as $food)
                <li>{{$food->title}}-({{$food->pivot->quantity}})</li>
              @endforeach
          </ul>
        </td>
        <td>{{$order->status}}</td>
        <td>{{$order->payment_method}}</td>
        <td>{{$order->payment_status}}</td>
       
        <td>{{$order->address}}</td>
       
        <td>{{$order->phonenumber}}</td>
        <td>{{$order->price}}</td>
        <td>{{$order->created_at}}</td>
        <td>
          @if($order->status =="pending")
              <form action="{{ route('ordercancelled', $order->id) }}" method="get">
                  {{ csrf_field() }}
                  <button class="btn btn-danger">Cancel Order</button>
              </form>
              @elseif($order->status =="Dropped")
              <button class="btn btn-default" disabled>Order Cancelled</button>
              @else
              <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Confirmed/Dispatched Order can't be cancelled" disabled>Cancel Order</button>
              @endif
          </td>
      </tr>
  @endforeach 
    </tbody>
</table>
</div>
@endsection