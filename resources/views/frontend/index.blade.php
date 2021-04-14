   @extends('layouts.frontend')
   @section('frontend')



       <section class="pt-5 pb-5 mt-0 align-items-end d-flex bg-dark"
           style="min-height: 75vh; background-position: center center; background-size: cover; background-image: url(https://www.google.com/url?sa=i&url=https%3A%2F%2Funsplash.com%2Fimages%2Ffood&psig=AOvVaw1XIR6U_ITcSGxPQOrcDnDC&ust=1618464295231000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCNjbqr7__O8CFQAAAAAdAAAAABAD);">

           <div class="container " style="">

               <div class="row mt-auto">
                   <div class="col-lg-8 col-sm-12 ">
                       <div class="text-center text-lg-left">
                           <p class="text-uppercase text-danger font-weight-bold mb-2 text-secondary text-shadow">Your best
                               experience</p>
                           <h1 class="display-3 text-white font-weight-bold text-shadow">Taste like a homely food</h1>
                       </div>

                   </div>
               </div>
               <div class="row mb-5">
                   <div class=" col-md-9">

                   </div>
               </div>
               <!-- row.// -->

           </div>
       </section>




       <section>

           <div id="menu" class="mt-3 pt-2">
               <div class="container">

                   <div class="col-12">
                       <h3 class="heading text-center">Latest Food</h3>
                       <div class="heading-underline"></div>


                       <div class="row">

                           <!--menu item starts-->
                           @if (isset($latestfoods))
                               @foreach ($latestfoods as $food)
                                   <div class="col-md-3 menu-item p-1">
                                       <div class="card">
                                           <a href="{{ route('singlefood', $food->id) }}"><img
                                                   src="{{ url('/images/foods/' . $food->photo) }}" class="card-img-top"
                                                   alt="" height="200px" width="100px"></a>
                                           <div class="card-body">
                                               <h5 class="card-title menu-caption"><a href="#">{{ $food->title }}</a>
                                                   <span class="price">NRs.
                                                       {{ $food->price }}</span></h5>
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

                       <div class="row">
                           <a href="{{ route('menus') }}" class="btn btn-primary mx-auto mt-4 mb-5 see-all">See all
                               items</a>
                       </div>
                   </div>
               </div>
           </div>
       </section>



       <!-- Categories Section Begin -->
       <section>

        <div id="menu" class="mt-3 pt-2">
            <div class="container">

                <div class="col-12">
                    <h3 class="heading text-center">Category</h3>
                    <div class="heading-underline"></div>


                    <div class="row">

                        <!--menu item starts-->
                        @if (isset($categories))
                            @foreach ($categories as $category)
                            <div class="col-md-2 menu-item p-1">
                                <div class="card" style="background: rgb(240, 240, 240)">
                                    <div class="card-body">
                                        <a href="{{ route('singlecategory', $category->id) }}" class="text-center cat-link d-block py-3">   <p class="lead">{{ $category->title }}</p> </a>
                                    </div>
        
                                </div>
                            </div>

                            @endforeach
                        @endif
                        <!--menu item ends-->
                    </div>
                    <!--row ends-->

                    <div class="row">
                        <a href="{{ route('menus') }}" class="btn btn-primary mx-auto mt-4 mb-5 see-all">See all
                            items</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
       {{-- <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @if (isset($categories))
                        @foreach ($categories as $category)
                            <div class="col-lg-3">
                                <div class="categories__item set-bg" data-setbg="frontend/img/categories/cat-1.jpg">
                                    <h5><a href="#">{{$category->title}}</a></h5>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section> --}}
       <!-- Categories Section End -->

       <!-- Featured Section Begin -->
       {{-- <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                </div>
            </div>
            <div class="row ">
            @if (isset($foods))
				@foreach ($foods as $food)
				<div class="col-md-3 menu-item p-1">
					<div class="card">
						<a href="#"><img src="{{ url('/images/foods/'.$food->photo) }}" class="card-img-top" alt="" width="100px" height="150px"></a>
						<div class="card-body">
							<h5 class="card-title menu-caption"><a href="#">{{$food->title}}</a> <span
									class="price">NRs.
									{{$food->price}}</span></h5>
							<p class="card-text">{{$food->details}}</p>
						</div>
						<div class="row mx-auto">
							<form action="{{route('addtocart',$food->id)}}" method="POST" class="d-block ml-2 mb-0">
								{{csrf_field()}}
								<input type="hidden" name="food_id" value="{{$food->id}}">
								<button type="submit" class="btn btn-success">Add To Cart</button>
							</form>
							<form action="{{route('singlefood',$food->id)}}" method="get" class="d-block ml-2 mb-0">
								{{csrf_field()}}
								<input type="hidden" name="food_id" value="{{$food->id}}">
								<button type="submit" class="btn btn-primary">Buy Now</button>
							</form>
						</div>
					</div>
				</div>
				
				@endforeach
				@endif
				
            </div>
        </div>
    </section> --}}


   @endsection
