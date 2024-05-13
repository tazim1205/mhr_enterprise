<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\division_information;
use App\Models\district_information;
use App\Models\shipping;
use App\Models\upazila_information;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Auth;
Use Alert;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->lang = config ("app.locale");
        $this->sl = 0;
        if ($request->ajax()) {
            $data = shipping::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){

                        return $this->sl = $this->sl+1;
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
                    ->addColumn('upazila_id',function($v){
                        if($v->upazila_id > 0)
                        {
                            $upazila_name = upazila_information::where('id',$v->upazila_id)->first();
                        }
                        else
                        {
                            $upazila_name = '-';
                        }

                        return $upazila_name->upazila_name;

                    })
                    ->addColumn('charge',function($v){
                        
                        return $v->charge;
                    })
                    ->addColumn('status',function($v){
                        if($v->status == 1)
                        {
                            $checked = 'checked';
                        }
                        else
                        {
                            $checked = '';
                        }

                        return '<label class="form-check form-switch">
                                <input role="switch" class="form-check-input" type="checkbox" id="shippingStatus-'.$v->id.'" '.$checked.' onclick="return shippingStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){

                        if(Auth::user()->can('Menu edit'))
                        {
                            $edit_btn = '<a class="dropdown-item" href="'.route('shipping.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>';
                        }
                        else
                        {
                            $edit_btn ='';
                        }
                        if(Auth::user()->can('Menu destroy'))
                        {
                            $destroy_btn = '<form action="'.route('shipping.destroy',$row->id).'" id="deleteForm" method="post">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button onclick="return Sure()" id="" type="submit" class="text-danger dropdown-item" href="#"><i class="fa fa-trash"></i> '.__('common.destroy').'</button>
                            </form>';
                        }
                        else
                        {
                            $destroy_btn ='';
                        }
    
                        $btn = '<div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                '.__('common.actions').'
                            </button>
                            <div class="dropdown-menu">
                                '.$edit_btn.'
                                <a class="d-none dropdown-item" href="'.route('shipping.show',$row->id).'"><i class="fa fa-eye"></i> '.__('common.show').'</a>
                                
                                '.$destroy_btn.'
                            </div>
                        </div>';
                        return $btn;
                    })
                    ->rawColumns(['sl','division_id','district_id','upazila_id','charge','status','action'])
                    ->make(true);
        }
        return view('backend.shipping.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $division = division_information::all();
        return view('backend.shipping.create',compact('division'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = array(
            'division_id'=>$request->division_id,
            'district_id'=>$request->district_id,
            'upazila_id'=>$request->upazila_id,
            'charge'=>$request->charge,
            'status'=>$request->status
        );

        $insert = shipping::create($data);

        Toastr::success(__('shipping.create_message'), __('common.success'));
        return redirect()->back();
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
        shipping::find($id)->delete();
        Toastr::success(__('shipping.delete_message'), __('common.success'));
        return redirect()->back();
    }

    public function retrive_shipping($id)
    {
        shipping::where('id',$id)->withTrashed()->restore();
        Toastr::success(__('shipping.retrive_message'), __('common.success'));
        return redirect()->back();
    }

    public function shipping_per_delete($id)
    {
        shipping::where('id',$id)->withTrashed()->forceDelete();
        Toastr::success(__('shipping.permenant_delete'), __('common.success'));
        return redirect()->back();
    }

    public function GetDistrict($division_id)
    {

        $this->lang = config('app.locale');
        $data = district_information::where('division_id',$division_id)->get();

        if($this->lang == 'en')
        {
            $sl_data = '<option value="">Select One</option>';
        }
        elseif($this->lang == 'bn')
        {
            $sl_data = '<option value="">নির্বাচন করুন</option>';
        }


        foreach($data as $v)
        {
            
            $sl_data .= '<option value="'.$v->id.'">'.$v->district_name.'</option>';

        }
        return $sl_data;
    }

    public function GetUpazila($district_id)
    {
        $this->lang = config('app.locale');
        $data = upazila_information::where('district_id',$district_id)->get();

        if($this->lang == 'en')
        {
            $sl_data = '<option value="">Select One</option>';
        }
        elseif($this->lang == 'bn')
        {
            $sl_data = '<option value="">নির্বাচন করুন</option>';
        }


        foreach($data as $v)
        {
            
            $sl_data .= '<option value="'.$v->id.'">'.$v->upazila_name.'</option>';

        }
        return $sl_data;
    }


    public function shippingStatusChange($id)
    {
       $check = shipping::find($id);

       if($check->status == 1)
       {
        shipping::find($id)->update(['status'=>0]);
       }
       else
       {
        shipping::find($id)->update(['status'=>1]);
       }

       return 1;
    }
}
