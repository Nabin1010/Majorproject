@extends('layouts.admin ')
@section('admin')
    

<form action="{{route('order.update',$orders->id)}}" method="post">

{{csrf_field()}}
        {{method_field('PUT')}}

        <h4>Payment status</h4>
<select name='payment_status' class="form-select" aria-label="Default select example">
  <option  value="Pending">Pending</option>
  <option  value="Received">Received</option>
</select>

<h4>Order status</h4>
<select required name='order_status' class="form-select" aria-label="Default select example">
  <option  value="pending">Pending</option>
  <option  value="order Accept">Order Accept</option>
  <option  value="Order Delivered">Order Delivered</option>
</select>
<br>
<button type = "submit" class = "btn btn-primary mt-1">Submit</button>


</form>

@endsection
