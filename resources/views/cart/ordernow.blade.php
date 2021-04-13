@extends('layouts.frontend')
@section('frontend')

    <div id="" class="mt-2 offset">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12">

                            <h4 class="d-block">Shipping Details</h4>
                        </div>
                        <div class="card">
                            @if (!$shippingaddress->isEmpty())
                                @if (isset($hhh))
                                    <div class="card-body">
                                        <p class="small-text">
                                            {{ $hhh->state }} - {{ $hhh->city }} - {{ $hhh->area }} -
                                            {{ $hhh->address1 }}
                                        </p>
                                        <a href="{{ route('setaddress') }}" class="btn btn-success pl-3 pr-3 mt-3 ml-2">
                                            Change Address</a>
                                    </div>
                                @else
                                    @foreach ($shippingaddress as $shipping)
                                        <div class="card-body">
                                            <p class="small-text">
                                                <span class="badge badge-pill badge-warning">Home</span>
                                                {{ $shipping->state }} - {{ $shipping->city }} - {{ $shipping->area }} -
                                                {{ $shipping->address1 }}
                                            </p>
                                            <a href="{{ route('setaddress') }}" class="btn btn-success pl-3 pr-3 mt-3 ml-2">
                                                Change Address</a>
                                        </div>
                                    @endforeach
                                @endif

                            @elseif(isset($hhh))
                                <div class="card-body">
                                    <p class="small-text">
                                        {{ $hhh->state }} - {{ $hhh->city }} - {{ $hhh->area }} -
                                        {{ $hhh->address1 }}
                                    </p>
                                    <a href="{{ route('setaddress') }}" class="btn btn-success pl-3 pr-3 mt-3 ml-2"> Change
                                        Address</a>
                                </div>


                            @elseif(isset($abc))
                                <div class="card-body">
                                    <p class="small-text">
                                        {{ $abc->state }} - {{ $abc->city }} - {{ $abc->area }} -
                                        {{ $abc->address1 }}
                                    </p>
                                    <a href="{{ route('setaddress') }}" class="btn btn-success pl-3 pr-3 mt-3 ml-2"> Change
                                        Address</a>
                                </div>


                            @else
                                <div class="card-body">
                                    <p class="lead">No Address Found !</p>

                                    <a data-toggle="modal" data-target="#addAddress"
                                        class="btn btn-primary pl-3 pr-3 mt-3 ml-2"> Add Address</a>
                                    <span class="text-danger">{{ $errors->first('address') }}</span>

                                </div>
                            @endif

                        </div>
                    </div>
                    <hr>
                    <div class="row mx-auto">
                       
                        <form action="{{ route('checkout') }}" method="post">
                            @csrf
                            <?php 
                                $address_id = "";
                                if($hhh){
                                    $address_id = $hhh->id;
                                }
        
                                elseif($abc){
                                    $address_id = $abc->id;
                                }
                            ?>
                            <input type="hidden" name="price" value="{{ ($total) - (($total) * 0.1 )}} ">
                            @if (isset($hhh) || isset($abc))
                            <input type="hidden" name="address" value="{{ $address_id}} ">
                            @if(isset($carts))
                            @foreach ($carts as $item)
                            <input type="hidden" name="cart" value="{{ $item->id}} ">
                            @endforeach
                            @endif
                            <div class="row mt-3">
                                <div class="contact_form_title text-center">Payment BY</div>
                                    <div class="form-group">
                                        <ul class="logos_list">
                                            <li><input type="radio" name="payment" value="stripe" checked><img src="{{ asset('/images/stripe.png') }}" style="width:106px; height:86px;"></li>
                                            <li><input type="radio" name="payment" value="oncash">  <img src="{{ asset('/images/cod.jpg') }}" style="width:135px; height:55px;"></li>
                                            
        
                                        </ul>
                                    </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Proceed to pay</button>
        
                        @else
                            <small class="text-muted alert alert-danger d-block">Please add Address First to Confirm your Order</small>
                            <button type="button" class="btn btn-primary" disabled>Proceed to pay</button>
                        @endif
        
                        </form>
                    </div>

                </div>

                <div class="col-md-6">
                    <h4>Order Summary</h4>
                    <table id="order-summary" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Items</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        @if (isset($carts))
                            @foreach ($carts as $cart)
                                <tbody>
                                    <tr>
                                        <td>{{ $cart->ftitle }}</td>
                                        <td class="text-left">{{ $cart->fprice }}</td>
                                        <td class="text-center">{{ $cart->quantity }}</td>
                                        <td class="text-right">{{ $cart->price }}</td>
                                    </tr>
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="4"></td>
                        </tr>

                        <tr>
                            <td>
                                <p>Discount (10%)</p>
                            </td>
                            <td colspan=3 class="text-right">{{ ($total) * 0.1 }}</td>
                        </tr>
                        <tr>
                            <td>
                                <b>Sub Total</b>
                            </td>
                            <td colspan=3 class="text-right">{{ $total -(($total) * 0.1) }}</td>
                        </tr>

                        <tr>
                            <td>
                                <p>Delivery Charge</p>
                            </td>
                            <td colspan=3 class="text-right">0</td>
                        </tr>
                       
                        
                        <tr>
                            <td>
                                <p class="lead">Grand Total</p>
                            </td>
                            <td colspan=3 class="text-right">
                                <p class="lead"> NRs.{{ ($total -(($total) * 0.1)) }} </p>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>
            </div>
            <hr>

            
            
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('shippingaddress.store') }}" method="post">
                    <div class="form-group mb-2">
                        <label for="state">State*</label>
                        <select name="state" id="state" class="form-control dynamic" data-dependent="city">
                            <option value="" disabled selected>Select State</option>
                            @foreach ($state_list as $state)
                                <option value="{{ $state->state }}">{{ $state->state }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{ csrf_field() }}
                    <div class="form-group mt-4 mb-2">
                        <label for="city">City*</label>
                        <select name="city" id="city" class="form-control input-lg dynamic" data-dependent="area">
                            <option value="" disabled>Select City</option>
                        </select>
                    </div>

                    <div class="form-group mt-4 mb-2">
                        <label for="area">Area*</label>
                        <select name="area" id="area" class="form-control input-lg">
                            <option value="" disabled>Select Area</option>
                        </select>
                    </div>

                    <div class="form-group mt-4 mb-2">
                        <label for="address1">Address 1</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter address like tole name ,road info " name="address1">
                    </div>

                    <div class="form-group mt-4 mb-2">
                        <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
                        <label for="address2">Address 2(optional)</label>
                        <input type="address2" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp"
                            placeholder="Enter the famous place near you like college,hotel,hospital,brige,park.. etc "
                            name="address2">
                    </div>
                    <div class="row mt-5">

                        <button type="submit" class="btn btn-primary mx-auto">Add New Address</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<!-- modal end-->


    

<script>
    $(document).ready(function() {

        $('.dynamic').change(function() {
            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('Shippingaddress.fetch') }}",
                    method: "POST",
                    data: {
                        select: select,
                        value: value,
                        _token: _token,
                        dependent: dependent
                    },
                    success: function(result) {
                        $('#' + dependent).html(result);
                    }

                })
            }
        });

        $('#country').change(function() {
            $('#state').val('');
            $('#city').val('');
        });

        $('#state').change(function() {
            $('#city').val('');
        });


    });

</script>

@endsection
