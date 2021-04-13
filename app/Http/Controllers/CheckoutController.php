<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use App\Order;
use Stripe\Stripe;
use App\Shippingaddress;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function Checkout(Request $request){
    //   return $request;
       $price = $request->price;
       $cart= Cart::find($request->id);
       $address=$request->address;
       $food_id=$request->food_id;
            $validate = $request->validate([
                'payment' => 'required',
            ]);
    
            $data = array();
            $data['payment'] = $request->payment;
            // dd($data);
    
            if($request->payment == 'stripe')
            {
    
                
                   
                    // Enter Your Stripe Secret
                    \Stripe\Stripe::setApiKey('sk_test_51Ifc3NAnDOqEhsZzchTbxyrhQ0Fe6FOMQc8w9B67t4eE3xc0DMUYFRTWP2PlPC4VwesUCI2hLgZcYGetQ5ep8k7z00VK0KheuT');
                            

                    $amount = $request->price;
                    
                    $payment_intent = \Stripe\PaymentIntent::create([
                        'description' => 'Stripe Test Payment',
                        'amount' => (int) $amount,
                        'currency' => 'USD',
                        'description' => 'Payment From Codehunger',
                        'payment_method_types' => ['card'],
                    ]);
                    $intent = $payment_intent->client_secret;
            
                    return view('cart.credit-card',compact('intent','price','cart','address','food_id'));

            }
            else if($request->payment == 'oncash') {
                
                $hhh =Shippingaddress::where('id',$request->address)->first();
                $abc = Shippingaddress::where('user_id',Auth::user()->id)->first();
                    $userID = Auth::user()->id;
                    $shippingaddress = Shippingaddress::where('user_id',$userID)->where('is_home','=','1')->get();
                    $allCart= Cart::where('user_id',$userID)->get();
                    $phonenumber = User::where('id',$userID)->pluck('phonenumber');
                    $order = new Order();
                    $order->user_id=$userID;
                    $order->status="pending";
                    $order->payment_method="cash on delivery";
                    $order->payment_status="pending";
                    if($request->address){
                       
                        $order->address = ($hhh->state)  .'-'.($hhh->city) .'-' .($hhh->area) .'-'.($hhh->address1) .'-'.($hhh->address2);
                        
                    }
                    
                    elseif($shippingaddress){
    
                        foreach($shippingaddress as $shipping){
                            $order->address = ($shipping->state)  .'-'.($shipping->city) .'-' .($shipping->area) .'-'.($shipping->address1) .'-'.($shipping->address2);
                        }
                    }
                    else{
                        $order->address = ($abc->state)  .'-'.($abc->city) .'-' .($abc->area) .'-'.($abc->address1) .'-'.($abc->address2);
    
                    }
                    $order->phonenumber=rtrim(ltrim($phonenumber,'["'),'"]');
                    $order->price =$request->price;
                    $order->cart=$allCart;
                    $order->save();  
                foreach($allCart as $cart){
                   
                    $order->foods()->attach($cart->food_id,['quantity'=>$cart->quantity]);
                }
                Cart::where('user_id',$userID)->delete(); 
                return redirect()->route('thankyou');
        }
    
    
         
            else{
                echo "cash on delivery";
            }
        }
   
        public function Bcheckout(Request $request){
            //   return $request;
               $price = $request->price;
                $address=$request->address;
                 $food_id=$request->food_id;
                   $quantity = $request->quantity;
                    $validate = $request->validate([
                        'payment' => 'required',
                    ]);
                    $data = array();
                    $data['payment'] = $request->payment;
                    // dd($data);
                    if($request->payment == 'stripe')
                    {
                            // Enter Your Stripe Secret
                            \Stripe\Stripe::setApiKey('sk_test_51Ifc3NAnDOqEhsZzchTbxyrhQ0Fe6FOMQc8w9B67t4eE3xc0DMUYFRTWP2PlPC4VwesUCI2hLgZcYGetQ5ep8k7z00VK0KheuT');
                            $amount = $request->price;
                            $payment_intent = \Stripe\PaymentIntent::create([
                                'description' => 'Stripe Test Payment',
                                'amount' => (int) $amount,
                                'currency' => 'USD',
                                'description' => 'Payment From Codehunger',
                                'payment_method_types' => ['card'],
                            ]);
                            $intent = $payment_intent->client_secret;
                    
                            return view('cart.creditcartbuynow',compact('intent','price','address','food_id','quantity'));
        
                    }
                    else if($request->payment == 'oncash') {
                        
                        $hhh =Shippingaddress::where('id',$request->address)->first();
                        $userID = Auth::user()->id;
                        $abc = Shippingaddress::where('user_id',Auth::user()->id)->first();
                        $shippingaddress = Shippingaddress::where('user_id',$userID)->where('is_home','=','1')->get();
                        $phonenumber = User::where('id',$userID)->pluck('phonenumber');
                        $order = new Order();
                        $order->user_id=$userID;
                        $order->status="pending";
                        $order->payment_method="cash on delivery";
                        $order->payment_status="pending";
                        if($request->address){
                   
                        $order->address = ($hhh->state)  .'-'.($hhh->city) .'-' .($hhh->area) .'-'.($hhh->address1) .'-'.($hhh->address2);
                    
                        }
                
                        elseif($shippingaddress){

                            foreach($shippingaddress as $shipping){
                                $order->address = ($shipping->state)  .'-'.($shipping->city) .'-' .($shipping->area) .'-'.($shipping->address1) .'-'.($shipping->address2);
                            }
                        }
                        else{
                            $order->address = ($abc->state)  .'-'.($abc->city) .'-' .($abc->area) .'-'.($abc->address1) .'-'.($abc->address2);
                        }
                        $order->phonenumber=rtrim(ltrim($phonenumber,'["'),'"]');
                        $order->price =$request->price;
                        $order->cart="no cart";
                         $order->save();
                        if($request->has('food_id')){

                  
                       $order->foods()->attach($request->food_id,['quantity'=>$request->quantity]);                                        
                    }
                        return redirect()->route('thankyou');
                }
                    else{
                        echo "cash on delivery";
                    }
                }
        
    
}
