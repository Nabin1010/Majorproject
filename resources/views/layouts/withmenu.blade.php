@extends('layouts.frontend')
@section('frontend')

    {{-- serach function start --}}

    <div id="search" class="offset">
        <div class="container">
            <form action="{{route('search')}}" method="get">
                <div class="row">
                    <div class="form-group col-md-11 search-box">
                        <input type="text" name="search" placeholder="Search in digital food" class="form-control ">
                    </div>
    
                    <button type="submit" class="btn btn-primary col-md-1 search-button mb-0"><i class="bi bi-search"></i></button>
                </div>
    
            </form>
        </div>
    </div>

    {{-- serach function end --}}

    <!-- Hero Section Begin -->
    <section>
        @if (!$foods->isEmpty())
        <h3 class="text-center">Menu</h3>
            @if(isset($search))
                <h6 class="mt-3 mb-3 ">Search result for "<strong>{{$search}}</strong>"</h6>
            @endif
        <div id="menu" class="mt-3 pt-2">
            <div class="container">

                <div class="col-12">
                    <div class="heading-underline"></div>


                    <div class="row">

                        <!--menu item starts-->
                        @if (isset($foods))
                            @foreach ($foods as $food)
                                <div class="col-md-3 menu-item p-1">
                                    <div class="card">
                                        <a href="{{ route('singlefood', $food->id) }}"><img
                                                src="{{ url('/images/foods/' . $food->photo) }}" class="card-img-top"
                                                alt="" height="200px" width="100px"></a>
                                        <div class="card-body">
                                            <h5 class="card-title menu-caption"><a href="#">{{ $food->title }}</a>
                                                <span class="price">NRs.
                                                    {{ $food->price }}</span>
                                            </h5>
                                            <p class="card-text">{{ $food->details }}</p>
                                        </div>
                                        <div class="row mx-auto">
                                            <form action="{{ route('addtocart', $food->id) }}" method="POST"
                                                class="d-block ml-2 mb-0">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="food_id" value="{{ $food->id }}">
                                                <button type="submit" class="btn btn-success">Add To Cart</button>
                                            </form>
                                            <form action="{{ route('singlefood', $food->id) }}" method="get"
                                                class="d-block ml-2 mb-0">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="food_id" value="{{ $food->id }}">
                                                <button type="submit" class="btn btn-primary">Buy Now</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @endif
                        <!--menu item ends-->
                    </div>
                    <!--row ends-->


                </div>
            </div>
        </div>
        @else
        <div class="alert alert-danger text-center" role="alert">
            No Record(s) Found. 
          </div>
    @endif
    </section>
    <!-- Hero Section End -->
@endsection
