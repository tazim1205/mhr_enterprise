<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cuppon;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Auth;
Use Alert;


class CupponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->lang = config ("app.locale");
        $this->sl = 0;
        if ($request->ajax()) {
            $data = cuppon::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        // $i = 1;
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('cuppon_code',function($v){
                        return $v->cuppon_code;
                    })
                    ->addColumn('discount_amount',function($v){
                        return $v->discount_amount;
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

                        return '<label class="switch rounded">
                                <input type="checkbox" id="cupponStatus-'.$v->id.'" '.$checked.' onclick="return cupponStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){

                        if(Auth::user()->can('Menu edit'))
                        {
                            $edit_btn = '<a class="dropdown-item" href="'.route('cuppon.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>';
                        }
                        else
                        {
                            $edit_btn ='';
                        }
                        if(Auth::user()->can('Menu destroy'))
                        {
                            $destroy_btn = '<form action="'.route('cuppon.destroy',$row->id).'" id="deleteForm" method="post">
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
                                <a class="d-none dropdown-item" href="'.route('cuppon.show',$row->id).'"><i class="fa fa-eye"></i> '.__('common.show').'</a>
                                
                                '.$destroy_btn.'
                            </div>
                        </div>';
                        return $btn;
                    })
                    ->rawColumns(['sl','cuppon_code','discount_amount','status','action'])
                    ->make(true);
        }
        return view('backend.cuppon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.cuppon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = array(
            'cuppon_code'=>$request->cuppon_code,
            'discount_amount'=>$request->discount_amount,
            'status'=>$request->status,
        );
        cuppon::create($data);
        Toastr::success(__('cuppon.create_message'), __('common.success'));
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
        $data = cuppon::find($id);

        return view('backend.cuppon.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = array(
            'cuppon_code'=>$request->cuppon_code,
            'discount_amount'=>$request->discount_amount,
            'status'=>$request->status,
        );

        cuppon::find($id)->update($data);
        Toastr::success(__('cuppon.update_message'), __('common.success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cupponStatusChange($id)
    {
       $check = cuppon::find($id);

       if($check->status == 1)
       {
           cuppon::find($id)->update(['status'=>0]);
       }
       else
       {
           cuppon::find($id)->update(['status'=>1]);
       }

       return 1;
    }
}
