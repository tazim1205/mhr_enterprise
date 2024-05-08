<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\color;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use App\Models\User;
use Auth;
Use Alert;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->lang = config ("app.locale");
        $this->sl = 0;
        if ($request->ajax()) {
            $data = color::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        // $i = 1;
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('color_name',function($v){
                        if($this->lang == 'en')
                        {
                            return $v->color_name_en;
                        }
                        elseif($this->lang == 'bn')
                        {
                            return $v->color_name_bn;
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

                        return '<label class="switch rounded">
                                <input type="checkbox" id="colorStatus-'.$v->id.'" '.$checked.' onclick="return colorStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){

                        if(Auth::user()->can('Menu edit'))
                        {
                            $edit_btn = '<a class="dropdown-item" href="'.route('color.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>';
                        }
                        else
                        {
                            $edit_btn ='';
                        }
                        if(Auth::user()->can('Menu destroy'))
                        {
                            $destroy_btn = '<form action="'.route('color.destroy',$row->id).'" id="deleteForm" method="post">
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
                                <a class="d-none dropdown-item" href="'.route('color.show',$row->id).'"><i class="fa fa-eye"></i> '.__('common.show').'</a>
                                
                                '.$destroy_btn.'
                            </div>
                        </div>';
                        return $btn;
                    })
                    ->rawColumns(['sl','color_name','order_by','status','action'])
                    ->make(true);
        }
        return view('backend.color.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.color.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = array(
            'color_name_en'=>$request->color_name_en,
            'color_name_bn'=>$request->color_name_bn,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        color::create($data);
        Toastr::success(__('color.create_message'), __('common.success'));
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
        $data = color::find($id);
        return view('backend.color.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = array(
            'color_name_en'=>$request->color_name_en,
            'color_name_bn'=>$request->color_name_bn,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        color::find($id)->update($data);
        Toastr::success(__('color.update_message'), __('common.success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        color::find($id)->delete();
        Toastr::success(__('color.delete_message'), __('common.success'));
        return redirect()->back();
    }

    public function retrive_color($id)
    {
        color::where('id',$id)->withTrashed()->restore();
        Toastr::success(__('color.retrive_message'), __('common.success'));
        return redirect()->back();
    }

    public function color_per_delete($id)
    {
        color::where('id',$id)->withTrashed()->forceDelete();
        Toastr::success(__('color.permenant_delete'), __('common.success'));
        return redirect()->back();
    }

    public function colorStatusChange($id)
    {
       $check = color::find($id);

       if($check->status == 1)
       {
            color::find($id)->update(['status'=>0]);
       }
       else
       {
            color::find($id)->update(['status'=>1]);
       }

       return 1;
    }
}
