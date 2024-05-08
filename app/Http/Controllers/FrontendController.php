<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorie;
use App\Models\sub_categorie;
use App\Models\product;
use App\Models\color;
use App\Models\guest_user;
use App\Models\product_color_info;
use App\Models\product_size_info;
use App\Models\product_image_info;
use App\Models\size_setting;
use App\Models\price_range;
use App\Models\product_cart;
use App\Models\division_information;
use App\Models\district_information;
use App\Models\upazila_information;
use App\Models\draft_order_info;
use App\Models\shipping;
use App\Models\cuppon;
use App\Models\order;
use App\Models\order_info;
use App\Models\wishlist;
use App\Models\slider;
use App\Models\message;
use App\Models\about_us;
use Session;
use Hash;
use Auth;
use DB;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index()
    {
        $data = product::all();
        return view("frontend.index",compact('data'));
    }
    public function shop()
    {
        $data = product::orderBy('id','DESC')->get();
        return view("frontend.shop",compact('data'));
    }
    public function cart()
    {
        return view("frontend.cart");
    }
    public function about()
    {
        $about_us = about_us::find(1);

        return view("frontend.about",compact('about_us'));
    }
    public function single_product()
    {
        return view("frontend.single_product");
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function registration()
    {
        return view('frontend.registration');
    }
    public function categorie_product($id)
    {
        // return $id;
        $categories = categorie::where('id',$id)->first();
        $products = product::where('cat_id',$id)->where('status',1)->get();
        $total_products = product::where('cat_id',$id)->where('status',1)->count();
        // return $categorie;
        $color = color::where('status',1)->get();
        $size = size_setting::where('status',1)->get();
        $p_range = price_range::where('status',1)->get();
        return view('frontend.categorie_product',compact('id','categories','products','total_products','color','size','p_range'));
    }
    public function sub_categorie_product($id)
    {
        $sub_categories = sub_categorie::where('id',$id)->first();

        $products = product::where('sub_cat_id',$id)->where('status',1)->get();
        $total_products = product::where('sub_cat_id',$id)->where('status',1)->count();
        $size = size_setting::where('status',1)->get();
        $p_range = price_range::where('status',1)->get();
        $color = color::where('status',1)->get();

        return view('frontend.sub_categorie_product',compact('id','sub_categories','products','total_products','color','size','p_range'));
    }

    public function shop_details($id)
    {
        $data = product::where('id',$id)->first();

        $color = product_color_info::where('product_id',$id)->get();
        $size = product_size_info::where('product_id',$id)->get();
        $image = product_image_info::where('product_id',$id)->skip(1)->take(50)->get();
        // return $image;
        $activeImage = product_image_info::where('product_id',$id)->first();
        // return $activeImage;
        return view('frontend.shop_details',compact('data','id','color','size','image','activeImage'));
    }

    public function register_guest(Request $request)
    {
          $data = array(
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'password'=>Hash::make($request->password),
          );

          $insert = guest_user::create($data);

          if($insert)
          {

            $file = $request->file('image');
            if($file)
            {
                $imageName = rand().'.'.$file->getClientOriginalExtension();

                $file->move(public_path().'/backend/img/guestUserImage/',$imageName);

                guest_user::find($insert->id)->update(['image'=>$imageName]);

            }
          }

        if(Auth::guard('guest')->attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('/guest_dashboard');
        }
        else
        {
            return redirect()->back();
        }
    }

    public function guest_user_update(Request $request)
    {
        $data = array(
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
        );

        $update = guest_user::find(Auth::guard('guest')->user()->id)->update($data);

        $file = $request->file('image');

        if($file)
        {
            $path = public_path().'/backend/img/guestUserImage/'.$request->image;
                if(file_exists($path))
                {
                    unlink($path);
                }
        }

        if($file)
        {

            $imageName = rand().'.'.$file->getClientOriginalExtension();

            $file->move(public_path().'/backend/img/guestUserImage/',$imageName);

            guest_user::find(Auth::guard('guest')->user()->id)->update(['image'=>$imageName]);
        }

        return redirect()->back();

    }

    public function login_guest()
    {
        if(Auth::guard('guest')->check())
        {
            return view('frontend.guest.home');
        }
        else{

            return view('frontend.login');
        }
    }

    public function check_order()
    {
        if(Auth::guard('guest')->check())
        {
            $cart = order_info::leftjoin('products','products.id','order_infos.product_id')
            ->leftjoin('size_settings','size_settings.id','order_infos.size_id')
            ->leftjoin('colors','colors.id','order_infos.color_id')
            ->where('order_infos.guest_id',Auth::guard('guest')->user()->id)
            ->select('products.product_name_en','products.product_name_bn','products.regular_price','products.discount_amount','size_settings.size_name_en','size_settings.size_name_bn','colors.color_name_en','colors.color_name_bn','order_infos.*')
            ->get();

            $orders = order::where('guest_id',Auth::guard('guest')->user()->id)->get();
            return view('frontend.guest.orders',compact('cart','orders'));
        }
        else
        {
            return redirect('/');
        }
    }

    public function guest_dashboard()
    {
        if(Auth::guard('guest')->check())
        {

            return view('frontend.guest.home');
        }
        else
        {
            return redirect('/');
        }
    }
    
    public function updateinformation()
    {
        if(Auth::guard('guest')->check())
        {

            return view('frontend.guest.updateinformation');
        }
        else
        {
            return redirect('/');
        }
    }

    public function productCart(Request $request)
    {
        // return $request->product_id;
        if(Auth::guard('guest')->check())
        {
            if($request->size != '' && $request->color != '')
            {

                $count = product_cart::where('product_id',$request->product_id)->where('size_id',$request->size)->where('color_id',$request->color)->count();

                // return $count();

                if($count > 0)
                {
                    $previous_data = product_cart::where('product_id',$request->product_id)->where('size_id',$request->size)->where('color_id',$request->color)->first();

                    $updateQty = $previous_data->qty + $request->qty;

                    $insert = product_cart::where('product_id',$request->product_id)->where('size_id',$request->size)->where('color_id',$request->color)->update(['qty'=>$updateQty]);
                }
                else
                {
                    $insert = product_cart::create([
                        'product_id'=>$request->product_id,
                        'size_id'=>$request->size,
                        'color_id'=>$request->color,
                        'qty'=>$request->qty,
                        'price'=>$request->price,
                        'guest_id'=>Auth::guard('guest')->user()->id
                    ]);
                    
                }

            }
            else
            {
                return 3;
            }

            if($insert)
            {
                return 1;
            }
            else
            {
                return 0;
            }

            return 1;
        }
        else
        {
            return 2;
        }
    }

    public function AddWishList(Request $request)
    {
        if(Auth::guard('guest')->check())
        {
            if($request->size != '' && $request->color != '')
            {

                $count = wishlist::where('product_id',$request->product_id)->where('size_id',$request->size)->where('color_id',$request->color)->count();

                // return $count();

                if($count > 0)
                {
                    $previous_data = wishlist::where('product_id',$request->product_id)->where('size_id',$request->size)->where('color_id',$request->color)->first();

                    $updateQty = $previous_data->qty + $request->qty;

                    $insert = wishlist::where('product_id',$request->product_id)->where('size_id',$request->size)->where('color_id',$request->color)->update(['qty'=>$updateQty]);
                }
                else
                {
                    $insert = wishlist::create([
                        'product_id'=>$request->product_id,
                        'size_id'=>$request->size,
                        'color_id'=>$request->color,
                        'qty'=>$request->qty,
                        'price'=>$request->price,
                        'guest_id'=>Auth::guard('guest')->user()->id
                    ]);
                    
                }

            }
            else
            {
                return 3;
            }

            if($insert)
            {
                return 1;
            }
            else
            {
                return 0;
            }

            return 1;
        }
        else
        {
            return 2;
        }
    }

    public function getCartData()
    {
        $id = Auth::guard('guest')->user()->id;
        $cart = product_cart::leftjoin('products','products.id','product_carts.product_id')
        ->leftjoin('size_settings','size_settings.id','product_carts.size_id')
        ->leftjoin('colors','colors.id','product_carts.color_id')
        ->where('product_carts.guest_id',$id)
        ->select('products.product_name_en','products.product_name_bn','products.regular_price','products.discount_amount','size_settings.size_name_en','size_settings.size_name_bn','colors.color_name_en','colors.color_name_bn','product_carts.*')
        ->get();

        return view('frontend.show_cart_data',compact('cart'));
    }

    public function add_cart_user($id)
    {
        $cart = product_cart::leftjoin('products','products.id','product_carts.product_id')
        ->leftjoin('size_settings','size_settings.id','product_carts.size_id')
        ->leftjoin('colors','colors.id','product_carts.color_id')
        ->where('product_carts.guest_id',$id)
        ->select('products.product_name_en','products.product_name_bn','products.regular_price','products.discount_amount','size_settings.size_name_en','size_settings.size_name_bn','colors.color_name_en','colors.color_name_bn','product_carts.*')
        ->get();
        return view('frontend.add_cart_user',compact('cart'));
    }

    public function wishlist($id)
    {
        $cart = wishlist::leftjoin('products','products.id','wishlists.product_id')
        ->leftjoin('size_settings','size_settings.id','wishlists.size_id')
        ->leftjoin('colors','colors.id','wishlists.color_id')
        ->where('wishlists.guest_id',$id)
        ->select('products.product_name_en','products.product_name_bn','products.regular_price','products.discount_amount','size_settings.size_name_en','size_settings.size_name_bn','colors.color_name_en','colors.color_name_bn','wishlists.*')
        ->get();
        return view('frontend.guest.wishlist',compact('cart'));
    }

    public function getWishList()
    {
        $id = Auth::guard('guest')->user()->id;
        $cart = wishlist::leftjoin('products','products.id','wishlists.product_id')
        ->leftjoin('size_settings','size_settings.id','wishlists.size_id')
        ->leftjoin('colors','colors.id','wishlists.color_id')
        ->where('wishlists.guest_id',$id)
        ->select('products.product_name_en','products.product_name_bn','products.regular_price','products.discount_amount','size_settings.size_name_en','size_settings.size_name_bn','colors.color_name_en','colors.color_name_bn','wishlists.*')
        ->get();

        return view('frontend.guest.loadWishList',compact('cart'));
    }

    public function WishListDelete($id)
    {
        wishlist::where('id',$id)->delete();

        return 1;
    }

    public function wishListToCart($id)
    {
        if(Auth::guard('guest')->check())
        {
            $wishlist = wishlist::where('guest_id',$id)->get();
            if($wishlist)
            {
                foreach($wishlist as $w)
                {
                    
                        $count = product_cart::where('product_id',$w->product_id)->where('size_id',$w->size_id)->where('color_id',$w->color_id)->count();

                        if($count > 0)
                        {
                            $previous_data = product_cart::where('product_id',$w->product_id)->where('size_id',$w->size_id)->where('color_id',$w->color_id)->first();

                            $updateQty = $previous_data->qty + $w->qty;

                            $update = product_cart::where('product_id',$w->product_id)->where('size_id',$w->size_id)->where('color_id',$w->color_id)->update(['qty'=>$updateQty]);
                        }
                        else
                        {

                            $data = array(
                                'product_id'=>$w->product_id,
                                'size_id'=>$w->size_id,
                                'color_id'=>$w->color_id,
                                'qty'=>$w->qty,
                                'price'=>$w->price,
                                'guest_id'=>$w->guest_id,
                            );
                            $insert = product_cart::create($data);
                            
                        }
                   
                }
                 wishlist::where('guest_id',$id)->delete();
            }
        }

         return view('frontend.add_cart_user',compact('id'));
    }

    public function checkout($id)
    {
        $division = division_information::all();

        $product_cart = product_cart::where('guest_id',$id)->get();

        $total = 0;

        foreach($product_cart as $v)
        {
            $total = $total + ($v->price * $v->qty);
        }
        $session_id = Session::getId();

        // return $session_id;
        $countSession = draft_order_info::where('session_id',$session_id)->count();
        if($countSession == 0)
        {

            draft_order_info::create([
                'total'=>$total,
                'session_id'=>$session_id,
            ]);
        }

        return view('frontend.checkout',compact('division'));
    }

    public function loadCheckoutData()
    {
        $id = Auth::guard('guest')->user()->id;
        $cart = product_cart::leftjoin('products','products.id','product_carts.product_id')
        ->leftjoin('size_settings','size_settings.id','product_carts.size_id')
        ->leftjoin('colors','colors.id','product_carts.color_id')
        ->where('product_carts.guest_id',$id)
        ->select('products.product_name_en','products.product_name_bn','products.regular_price','products.discount_amount','size_settings.size_name_en','size_settings.size_name_bn','colors.color_name_en','colors.color_name_bn','product_carts.*')
        ->get();

        $session_id = Session::getId();

        $draft_order = draft_order_info::where('session_id',$session_id)->first();

        return view('frontend.load_checkout_data',compact('cart','draft_order'));
    }

    public function getProductCart()
    {
        if(Auth::guard('guest')->check())
        {
            $guestId = Auth::guard('guest')->user()->id;

            $count = DB::table('product_carts')->where('guest_id',$guestId)->count();

            return $count;
        }
        else
        {
            return 0;
        }
    }

    public function totalWishList()
    {
        if(Auth::guard('guest')->check())
        {
            $guestId = Auth::guard('guest')->user()->id;

            $count = DB::table('wishlists')->where('guest_id',$guestId)->count();

            return $count;
        }
    }

    public function productQtyUpdate(Request $request,$id)
    {
        // return $request->quantity;
        product_cart::where('id',$id)->update(['qty'=>$request->quantity]);

        return 1;
    }
    public function deleteProduct($id)
    {
        // return $request->quantity;
        product_cart::where('id',$id)->delete();

        return 1;
    }

    public function loadDistrict(Request $request)
    {
        $data = district_information::where('division_id',$request->division_id)->get();
        $output = '<option value="">Select One</option>';
        foreach($data as $v)
        {
            $check  = shipping::where('district_id',$v->id)->count();
            if($check > 0)
            {
                $output .='<option value="'.$v->id.'">'.$v->district_name.'</option>';
            }
            else
            {
                $output.='';
            }
        }

        return $output;
    }

    public function loadUpazila(Request $request)
    {
        $data = upazila_information::where('district_id',$request->district_id)->get();
        $output = '<option value="">Select One</option>';
        foreach($data as $v)
        {
            $output .='<option value="'.$v->id.'">'.$v->upazila_name.'</option>';
        }

        return $output;
    }

    public function shipingCostUpdate(Request $request)
    {
        $shiping_cost = shipping::where('district_id',$request->district_id)->select('charge')->first();

        $session_id = Session::getId();

        draft_order_info::where('session_id',$session_id)->update(['shipping_cost'=>$shiping_cost->charge]);

        return 1;
    }

    public function updateCupponAmount(Request $request)
    {
        $count = cuppon::where('cuppon_code',$request->cuppon_code)->where('status',1)->count();

        if($count > 0)
        {
            $session_id = Session::getId();

            $cuppon = cuppon::where('cuppon_code',$request->cuppon_code)->select('discount_amount')->first();

            draft_order_info::where('session_id',$session_id)->update(['cuppon_amount'=>$cuppon->discount_amount]);

            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function submitOrder(Request $request)
    {
        $insert = order::create([
            "name" => $request->name,
            "email" => $request->email,
            "mobile_no" => $request->mobile_no,
            "division_id" => $request->division_id,
            "district_id" => $request->district_id,
            "upazila_id" => $request->upazila_id,
            "address" => $request->address,
            "payment_method" => $request->payment_method,
            "guest_id"=>Auth::guard('guest')->user()->id,
            'status'=>0,
        ]);

        $id = $insert->id;

        $session_id = Session::getId();

        $draft = draft_order_info::where('session_id',$session_id)->first();

        order::find($id)->update([
            "total" => $draft->total,
            "shipping_cost" => $draft->shipping_cost,
            "cuppon_amount" => $draft->cuppon_amount,
        ]);

        $products_data = product_cart::where('guest_id',Auth::guard('guest')->user()->id)->get();

        foreach($products_data as $pd)
        {
        $data = array(
            'product_id'=>$pd->product_id,
            'size_id'=>$pd->size_id,
            'color_id'=>$pd->color_id,
            'qty'=>$pd->qty,
            'price'=>$pd->price,
            'guest_id'=>$pd->guest_id,
            'order_id'=>$id,
        );
        $info_id = order_info::create($data);
        }


        product_cart::where('guest_id',Auth::guard('guest')->user()->id)->delete();

        return redirect('guest_dashboard');

    }

    public function sendMessage(Request $request)
    {
        $data = array(
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=>$request->message,
        );
       
        $insert = message::create($data);
       
        if($insert)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function searchproducts(Request $request)

    {
        $search  = $request->search;
    
        $searchproducts = product::where('product_name_en', 'like', '%' . $search . '%')
        ->where('status', '1')
        ->paginate(18);
        
        return view('frontend.searchproducts', compact('searchproducts'));
    }
    
    public function search_Product_List(Request $request)
    {
        $search  = $request->searchtext;
        $cate_id  = $request->cate_id;
    
        $searchproducts = product::where('product_name_en', 'like', '%' . $search . '%')
        ->orwhere('product_id', 'like', '%' . $search . '%')
        ->where('status', '1')
        ->where('category_id', $cate_id)
        ->get();
    
        return view('frontend.home_search_Product_List', compact('searchproducts'));
    }
}
