<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Food;
use App\Order;
use App\Category;
use App\Food_Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FoodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $foods = Food::with('category')->get();
        return view('foods.index',compact('foods'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

        $categories = Category::all();
        return view('foods.create',compact('categories'));
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $validated = $request->validate([
            'title' => 'required',
            'details' => 'required',
            'price' => 'required',
            'photo'=>'required',
            'cat_id'=>'required',
        ]);
        $foods =$request->all();
        if($file = $request->file('photo')){
            $name = time().$file->getClientOriginalName();
            $file->move('images/foods',$name);
             $foods['photo'] = $name;
        }
            //  return $foods;
             Food::create($foods);
             return redirect('/foods');
       
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $foods = Food::find($id);
         $categories = Category::all();
        // return $categories;
        return view('foods.edit',compact('foods','categories'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'details' => 'required',
            'price' => 'required',
            'photo'=>'required',
            'cat_id'=>'required',
        ]);
        $foods = Food::find($id);
        $foods->title = $request->get('title');
        $foods->details = $request->get('details');
        $foods->price = $request->get('price');
        $foods->cat_id = $request->get('cat_id');
        if($file = $request->file('photo')){
            $name = time().$file->getClientOriginalName();
            $file->move('images/foods',$name);
             $foods['photo'] = $name;
        }
             $foods->save();
             return redirect('/foods');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foods = Food::find($id);
        $foods->delete();
        return redirect('/foods');
    }
    


    }
    

