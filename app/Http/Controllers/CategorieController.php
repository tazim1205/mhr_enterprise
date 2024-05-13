<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorie;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use App\Models\User;
use Auth;
Use Alert;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->lang = config ("app.locale");
        $this->sl = 0;
        if ($request->ajax()) {
            $data = categorie::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        // $i = 1;
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('categorie_name',function($v){
                        if($this->lang == 'en')
                        {
                            return $v->cat_name_en;
                        }
                        elseif($this->lang == 'bn')
                        {
                            return $v->cat_name_bn;
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

                        return '<label class="form-check form-switch">
                                <input role="switch" class="form-check-input" type="checkbox" id="categorieStatus-'.$v->id.'" '.$checked.' onclick="return categorieStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){

                        if(Auth::user()->can('Menu edit'))
                        {
                            $edit_btn = '<a class="dropdown-item" href="'.route('categorie.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>';
                        }
                        else
                        {
                            $edit_btn ='';
                        }
                        if(Auth::user()->can('Menu destroy'))
                        {
                            $destroy_btn = '<form action="'.route('categorie.destroy',$row->id).'" id="deleteForm" method="post">
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
                                <a class="d-none dropdown-item" href="'.route('categorie.show',$row->id).'"><i class="fa fa-eye"></i> '.__('common.show').'</a>
                                
                                '.$destroy_btn.'
                            </div>
                        </div>';
                        return $btn;
                    })
                    ->rawColumns(['sl','categorie_name','order_by','status','action'])
                    ->make(true);
        }
        return view('backend.categorie.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = array(
            'cat_name_en'=>$request->cat_name_en,
            'cat_name_bn'=>$request->cat_name_bn,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        categorie::create($data);
        Toastr::success(__('categorie.create_message'), __('common.success'));
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
        $data = categorie::find($id);
        return view('backend.categorie.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = array(
            'cat_name_en'=>$request->cat_name_en,
            'cat_name_bn'=>$request->cat_name_bn,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        categorie::find($id)->update($data);
        Toastr::success(__('categorie.update_message'), __('common.success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        categorie::find($id)->delete();
        Toastr::success(__('categorie.delete_message'), __('common.success'));
        return redirect()->back();
    }

    public function retrive_categorie($id)
    {
        categorie::where('id',$id)->withTrashed()->restore();
        Toastr::success(__('categorie.retrive_message'), __('common.success'));
        return redirect()->back();
    }

    public function categorie_per_delete($id)
    {
        categorie::where('id',$id)->withTrashed()->forceDelete();
        Toastr::success(__('categorie.permenant_delete'), __('common.success'));
        return redirect()->back();
    }

    public function categorieStatusChange($id)
    {
       $check = categorie::find($id);

       if($check->status == 1)
       {
            categorie::find($id)->update(['status'=>0]);
       }
       else
       {
            categorie::find($id)->update(['status'=>1]);
       }

       return 1;
    }
}
