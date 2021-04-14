@extends('layouts.admin')
@section('admin')
<table class="table">
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
        <th scope="col">User Name</th>
        <th scope="col">Order Date & Time</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    @foreach($myorders as $order)
    
      <tbody>
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
        <td>{{$order->user->name}}</td>
        <td>{{$order->created_at}}</td>
        
        
        <td>
                      <form action="{{ route('orderedit',$order->id)}}" >
                          {{csrf_field()}}
                          {{method_field('GET')}}
                          <button class="btn btn-info">edit</button>
                      </form>
      </td>
        </td>
      </tr>
    </tbody>
    @endforeach
   
  </table>
@endsection