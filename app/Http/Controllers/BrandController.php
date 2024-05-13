<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\brand;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use App\Models\User;
use Auth;
Use Alert;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->lang = config ("app.locale");
        $this->sl = 0;
        if ($request->ajax()) {
            $data = brand::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        // $i = 1;
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('brand_name',function($v){
                        if($this->lang == 'en')
                        {
                            return $v->brand_name_en;
                        }
                        elseif($this->lang == 'bn')
                        {
                            return $v->brand_name_bn;
                        }
                    })
                    ->addColumn('order_by',function($v){
                        return $v->order_by;
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

                        return '<label  class="form-check form-switch">
                                <input role="switch" class="form-check-input" type="checkbox" id="brandStatus-'.$v->id.'" '.$checked.' onclick="return brandStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){

                        if(Auth::user()->can('Menu edit'))
                        {
                            $edit_btn = '<a class="dropdown-item" href="'.route('brand.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>';
                        }
                        else
                        {
                            $edit_btn ='';
                        }
                        if(Auth::user()->can('Menu destroy'))
                        {
                            $destroy_btn = '<form action="'.route('brand.destroy',$row->id).'" id="deleteForm" method="post">
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
                                <a class="d-none dropdown-item" href="'.route('brand.show',$row->id).'"><i class="fa fa-eye"></i> '.__('common.show').'</a>
                                
                                '.$destroy_btn.'
                            </div>
                        </div>';
                        return $btn;
                    })
                    ->rawColumns(['sl','brand_name','order_by','status','action'])
                    ->make(true);
        }
        return view('backend.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = array(
            'brand_name_en'=>$request->brand_name_en,
            'brand_name_bn'=>$request->brand_name_bn,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        brand::create($data);
        Toastr::success(__('brand.create_message'), __('common.success'));
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
        $data = brand::find($id);
        return view('backend.brand.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = array(
            'brand_name_en'=>$request->brand_name_en,
            'brand_name_bn'=>$request->brand_name_bn,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        brand::find($id)->update($data);
        Toastr::success(__('brand.update_message'), __('common.success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        brand::find($id)->delete();
        Toastr::success(__('brand.delete_message'), __('common.success'));
        return redirect()->back();
    }

    public function retrive_brand($id)
    {
        brand::where('id',$id)->withTrashed()->restore();
        Toastr::success(__('brand.retrive_message'), __('common.success'));
        return redirect()->back();
    }

    public function brand_per_delete($id)
    {
        brand::where('id',$id)->withTrashed()->forceDelete();
        Toastr::success(__('brand.permenant_delete'), __('common.success'));
        return redirect()->back();
    }

    public function brandStatusChange($id)
    {
       $check = brand::find($id);

       if($check->status == 1)
       {
        brand::find($id)->update(['status'=>0]);
       }
       else
       {
        brand::find($id)->update(['status'=>1]);
       }

       return 1;
    }
}
