<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\slider;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use App\Models\User;
use Auth;
Use Alert;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->lang = config ("app.locale");
        $this->sl = 0;
        if ($request->ajax()) {
            $data = slider::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('sl',function($row){
                        // $i = 1;
                        return $this->sl = $this->sl+1;
                    })
                    ->addColumn('title',function($row){
                        if(config('app.locale') == 'en')
                        {
                            return $row->title ?: $row->title_bn;
                        }
                        else
                        {
                            return $row->title_bn ?: $row->title;
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

                        return '<label class="switch rounded">
                                <input type="checkbox" id="sizeStatus-'.$v->id.'" '.$checked.' onclick="return sizeStatusChange('.$v->id.')">
                                <span class="slider round"></span>
                            </label>';
                    })
                    ->addColumn('image', function ($v) { 
                        $url=asset("/Backend/img/slider/$v->image");
                        return ' <a href="'.$url.'" download="'.$v->title.'" class="btn btn-success btn-sm">Download</a>';
                    })
                    ->addColumn('action', function($row){

                        if(Auth::user()->can('Menu edit'))
                        {
                            $edit_btn = '<a class="dropdown-item" href="'.route('slider.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>';
                        }
                        else
                        {
                            $edit_btn ='';
                        }
                        if(Auth::user()->can('Menu destroy'))
                        {
                            $destroy_btn = '<form action="'.route('slider.destroy',$row->id).'" id="deleteForm" method="post">
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
                                <a class="d-none dropdown-item" href="'.route('slider.show',$row->id).'"><i class="fa fa-eye"></i> '.__('common.show').'</a>
                                
                                '.$destroy_btn.'
                            </div>
                        </div>';
                        return $btn;
                    })
                    ->rawColumns(['sl','size_name','order_by','status','action'])
                    ->make(true);
        }
        return view('backend.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = array(
            'title'=>$request->title,
            'title_bn'=>$request->title_bn,
            'slider'=>$request->slider,
            'status'=>$request->status,
        );

        $file = $request->file('image');

        if($file)
        {
            $imageName = rand().'.'.$file->getClientOriginalExtension();

            $file->move(public_path().'/Backend/img/slider/',$imageName);

            $data['image'] = $imageName;

        }

        $insert = slider::create($data);

        if($insert)
        {
            Toastr::success(__('slider.create_message'), __('common.success'));
            return redirect()->back();
        }
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
        $data = slider::where('id',$id)->first();

        return view('backend.slider.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $file = $request->file('image');

        if($file)
        {
            $pathImage = slider::find($id);

            $path = public_path().'/Backend/img/slider/'.$pathImage->image;

            if(file_exists($path))
            {
                unlink($path);
            }

        }

        if($file)
        {
            $imageName = rand().'.'.$file->getClientOriginalExtension();

            $file->move(public_path().'/Backend/img/slider/',$imageName);

            slider::where('id',$id)->update(['image'=>$imageName]);

        }

        $update = slider::find($id)->update([
            'title'=>$request->title,
            'title_bn'=>$request->title_bn,
            'slider'=>$request->slider,
            'status'=>$request->status,
        ]);

        if($update)
        {
            Toastr::success(__('slider.create_message'), __('common.success'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
