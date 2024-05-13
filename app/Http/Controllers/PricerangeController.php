<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\price_range;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use App\Models\User;
use Auth;
Use Alert;

class PricerangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->lang = config ("app.locale");
        $this->sl = 0;
        if ($request->ajax()) {
            $data = price_range::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        // $i = 1;
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('from',function($v){
                        return $v->from;
                    })
                    ->addColumn('to',function($v){
                        return $v->to;
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

                        return '<label class="form-check form-switch">
                                <input role="switch" class="form-check-input" type="checkbox" id="pricerangeStatus-'.$v->id.'" '.$checked.' onclick="return pricerangeStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){

                        if(Auth::user()->can('Menu edit'))
                        {
                            $edit_btn = '<a class="dropdown-item" href="'.route('price_range.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>';
                        }
                        else
                        {
                            $edit_btn ='';
                        }
                        if(Auth::user()->can('Menu destroy'))
                        {
                            $destroy_btn = '<form action="'.route('price_range.destroy',$row->id).'" id="deleteForm" method="post">
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
                                <a class="d-none dropdown-item" href="'.route('price_range.show',$row->id).'"><i class="fa fa-eye"></i> '.__('common.show').'</a>
                                
                                '.$destroy_btn.'
                            </div>
                        </div>';
                        return $btn;
                    })
                    ->rawColumns(['sl','from','to','order_by','status','action'])
                    ->make(true);
        }
        return view('backend.price_range.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.price_range.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = array(
            'from'=>$request->from,
            'to'=>$request->to,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        price_range::create($data);
        Toastr::success(__('price_range.create_message'), __('common.success'));
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
        $data = price_range::find($id);
        return view('backend.price_range.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = array(
            'from'=>$request->from,
            'to'=>$request->to,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        price_range::find($id)->update($data);
        Toastr::success(__('price_range.update_message'), __('common.success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        price_range::find($id)->delete();
        Toastr::success(__('price_range.delete_message'), __('common.success'));
        return redirect()->back();
    }

    public function retrive_price_range($id)
    {
        price_range::where('id',$id)->withTrashed()->restore();
        Toastr::success(__('price_range.retrive_message'), __('common.success'));
        return redirect()->back();
    }

    public function price_range_per_delete($id)
    {
        price_range::where('id',$id)->withTrashed()->forceDelete();
        Toastr::success(__('price_range.permenant_delete'), __('common.success'));
        return redirect()->back();
    }

    public function PriceRangeStatusChange($id)
    {
       $check = price_range::find($id);

       if($check->status == 1)
       {
            price_range::find($id)->update(['status'=>0]);
       }
       else
       {
            price_range::find($id)->update(['status'=>1]);
       }

       return 1;
    }
}
