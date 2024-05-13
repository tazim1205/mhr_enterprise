<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\trend;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Auth;
Use Alert;

class TrendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->lang = config ("app.locale");
        $this->sl = 0;
        if ($request->ajax()) {
            $data = trend::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        // $i = 1;
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('trend_name',function($v){
                        if($this->lang == 'en')
                        {
                            return $v->trend_name_en;
                        }
                        elseif($this->lang == 'bn')
                        {
                            return $v->trend_name_bn;
                        }
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
                                <input role="switch" class="form-check-input" type="checkbox" id="trendStatus-'.$v->id.'" '.$checked.' onclick="return trendStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){

                        if(Auth::user()->can('Menu edit'))
                        {
                            $edit_btn = '<a class="dropdown-item" href="'.route('trend.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>';
                        }
                        else
                        {
                            $edit_btn ='';
                        }
                        if(Auth::user()->can('Menu destroy'))
                        {
                            $destroy_btn = '<form action="'.route('trend.destroy',$row->id).'" id="deleteForm" method="post">
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
                                <a class="d-none dropdown-item" href="'.route('trend.show',$row->id).'"><i class="fa fa-eye"></i> '.__('common.show').'</a>
                                
                                '.$destroy_btn.'
                            </div>
                        </div>';
                        return $btn;
                    })
                    ->rawColumns(['sl','trend_code','discount_amount','status','action'])
                    ->make(true);
        }
        return view('backend.trend.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.trend.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = array(
            'trend_name_en'=>$request->trend_name_en,
            'trend_name_bn'=>$request->trend_name_bn,
            'status'=>$request->status,
        );

        trend::create($data);
        Toastr::success(__('trend.create_message'), __('common.success'));
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
        $data = trend::find($id);

        return view('backend.trend.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = array(
            'trend_name_en'=>$request->trend_name_en,
            'trend_name_bn'=>$request->trend_name_bn,
            'status'=>$request->status,
        );

        trend::find($id)->update($data);
        Toastr::success(__('trend.update_message'), __('common.success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        trend::find($id)->delete();
        Toastr::success(__('trend.delete_message'), __('common.success'));
        return redirect()->back();
    }

    public function retrive_trend($id)
    {
        trend::where('id',$id)->withTrashed()->restore();
        Toastr::success(__('trend.retrive_message'), __('common.success'));
        return redirect()->back();
    }

    public function trend_per_delete($id)
    {
        trend::where('id',$id)->withTrashed()->forceDelete();
        Toastr::success(__('trend.permenant_delete'), __('common.success'));
        return redirect()->back();
    }

    public function trendStatusChange($id)
    {
       $check = trend::find($id);

       if($check->status == 1)
       {
            trend::find($id)->update(['status'=>0]);
       }
       else
       {
            trend::find($id)->update(['status'=>1]);
       }

       return 1;
    }
}
