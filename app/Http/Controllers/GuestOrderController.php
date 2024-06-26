<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use App\Models\division_information;
use App\Models\district_information;
use App\Models\order_info;
use App\Models\upazila_information;
Use Alert;

class GuestOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->lang = config ("app.locale");
        $this->sl = 0;
        if ($request->ajax()) {
            $data = order::orderBy('id','DESC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('order_date',function($v){
                        return date("d-m-Y", strtotime($v->created_at)).'<br>'.date("h:i A", strtotime($v->created_at));
                    })
                    ->addColumn('name',function($v){

                        return $v->name;  
                    })
                    ->addColumn('mobile',function($v){

                        return $v->mobile_no;  
                    })
                    ->addColumn('product_info',function($v){
                        $products  = order_info::leftjoin('products','products.id','order_infos.product_id')
                        ->leftjoin('size_settings','size_settings.id','order_infos.size_id')
                        ->leftjoin('colors','colors.id','order_infos.color_id')
                        ->select('products.product_name_en','size_settings.size_name_en','colors.color_name_en','order_infos.*')
                        ->where('order_infos.order_id',$v->id)->get();
                            $output = '';
                        foreach($products as $p)
                        {
                            $output .='<li>'.$p->product_name_en.'('.$p->size_name_en.', '.$p->color_name_en.') [ '.$p->qty.' * '.$p->price.' ] = '.$p->qty * $p->price.'</li>';
                        }

                        return $output;
                    })
                    ->addColumn('division_id',function($v){
                        if($v->division_id > 0)
                        {
                            $division_name = division_information::where('id',$v->division_id)->first();
                        }
                        else
                        {
                            $division_name = '-';
                        }

                        return $division_name->division_name;

                    })
                    ->addColumn('district_id',function($v){
                        if($v->district_id > 0)
                        {
                            $district_name = district_information::where('id',$v->district_id)->first();
                        }
                        else
                        {
                            $district_name = '-';
                        }

                        return $district_name->district_name;

                    })
                    
                    ->addColumn('address',function($v){

                            return $v->address;  
                    })
                    ->addColumn('total',function($v){

                        $total = $v->total;
                        $total += $v->shipping_cost;
                        $total -= $v->cuppon_amount;
                        
                        return $total;  
                    })
                    ->addColumn('status',function($v){
                        if($v->status == 0)
                        {
                            return '<span class="btn btn-danger">Pending</span>';
                        }
                        elseif($v->status == 1)
                        {
                            return '<span class="btn btn-warning">Processing</span>';
                        }
                        elseif($v->status == 2)
                        {
                            return '<span class="btn btn-primary">In Delivery</span>';
                        }
                        elseif($v->status == 3)
                        {
                            return '<span class="btn btn-info">Completed</span>';
                        }
                        elseif($v->status == 4)
                        {
                            return '<span class="btn btn-danger">Canceled</span>';
                        }
                        else
                        {
                            return $v->status;
                        }
                    })
                    ->addColumn('action', function($v){
                        return '<a href="'.route('user_order.order_detials',$v->id).'" class="btn btn-primary">View</a>';

                    })
                    ->rawColumns(['sl','order_date','name','mobile','division_id','district_id','address','total','product_info','status','action'])
                    ->make(true);
        }
        return view('backend.user_order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    public function OrderDetails($order_id)
    {
        $order = order::find($order_id);
        if(!empty($order))
        {
            return view('backend.user_order.order_details',compact('order'));
        }

    }

    public function UpdateStatus(Request $request)
    {
        $order = order::find($request->order_id);
        if(!empty($order))
        {
            $order->status = $request->status;
            $order->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Order Status Update Successful'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Order Status Update Failed'
            ]);
        }
    }
}
