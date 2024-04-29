<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorie;
use App\Models\sub_categorie;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use App\Models\User;
use Auth;
Use Alert;

class SubcategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->lang = config ("app.locale");
        $this->sl = 0;
        if ($request->ajax()) {
            $data = sub_categorie::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        // $i = 1;
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('categorie',function($v){
                        if($v->cat_id > 0)
                        {
                            $cat_name = categorie::where('id',$v->cat_id)->first();
                        }
                        else
                        {
                            $cat_name = '-';
                        }

                        if($v->cat_id > 0)
                        {
                            if($this->lang == 'en')
                            {
                                return $cat_name->cat_name_en;
                            }
                            elseif($this->lang == 'bn')
                            {
                                return $cat_name->cat_name_bn;
                            }
                        }
                        else
                        {
                            $cat_name = '-';
                        }

                    })
                    ->addColumn('sub_categorie_name',function($v){
                        if($this->lang == 'en')
                        {
                            return $v->sub_cat_name_en;
                        }
                        elseif($this->lang == 'bn')
                        {
                            return $v->sub_cat_name_bn;
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
                                <input type="checkbox" id="subcategorieStatus-'.$v->id.'" '.$checked.' onclick="return subcategorieStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('action', function($row){

                        if(Auth::user()->can('Menu edit'))
                        {
                            $edit_btn = '<a class="dropdown-item" href="'.route('sub_categorie.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>';
                        }
                        else
                        {
                            $edit_btn ='';
                        }
                        if(Auth::user()->can('Menu destroy'))
                        {
                            $destroy_btn = '<form action="'.route('sub_categorie.destroy',$row->id).'" id="deleteForm" method="post">
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
                                <a class="d-none dropdown-item" href="'.route('sub_categorie.show',$row->id).'"><i class="fa fa-eye"></i> '.__('common.show').'</a>
                                
                                '.$destroy_btn.'
                            </div>
                        </div>';
                        return $btn;
                    })
                    ->rawColumns(['sl','categorie_name','sub_categorie_name','order_by','status','action'])
                    ->make(true);
        }
        return view('backend.sub_categorie.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cat_name = categorie::all();

        return view('backend.sub_categorie.create',compact('cat_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = array(
            'cat_id'=>$request->cat_id,
            'sub_cat_name_en'=>$request->sub_cat_name_en,
            'sub_cat_name_bn'=>$request->sub_cat_name_bn,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        sub_categorie::create($data);
        Toastr::success(__('sub_categorie.create_message'), __('common.success'));
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
        $categorie_data = categorie::all();
        $data = sub_categorie::find($id);
        return view('backend.sub_categorie.edit',compact('data','categorie_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = array(
            'cat_id'=>$request->cat_id,
            'sub_cat_name_en'=>$request->sub_cat_name_en,
            'sub_cat_name_bn'=>$request->sub_cat_name_bn,
            'order_by'=>$request->order_by,
            'status'=>$request->status,
        );
        sub_categorie::find($id)->update($data);
        Toastr::success(__('sub_categorie.update_message'), __('common.success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function subcategorieStatusChange($id)
    {
       $check = sub_categorie::find($id);

       if($check->status == 1)
       {
            sub_categorie::find($id)->update(['status'=>0]);
       }
       else
       {
            sub_categorie::find($id)->update(['status'=>1]);
       }

       return 1;
    }
}
