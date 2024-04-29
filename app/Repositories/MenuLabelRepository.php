<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Interfaces\MenuLabelInterface;
use App\Models\MenuLabel;
use App\Models\MenuLabelEditHistory;
use App\Models\MenuLabelSoftDeleteHistory;
use App\Models\MenuLabelRestoreHistory;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Menu;
use Toastr;
use DataTables;
use Auth;
Use Alert;


class MenuLabelRepository implements MenuLabelInterface{
    protected $path;
    protected $sl;
    public function __construct()
    {
        $this->path = 'backend.menu_label';
        $this->sl = 0;
    }
    public function index($datatable)
    {
        if($datatable == 1)
        {
            $data = MenuLabel::all();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sl',function($row){
                return $this->sl = $this->sl +1;
            })
            ->addColumn('label_name',function($row){
                if(config('app.locale') == 'en')
                {
                    return $row->label_name_en ?: $row->label_name_bn;
                }
                else
                {
                    return $row->label_name_bn ?: $row->label_name_en;
                }
            })
            ->addColumn('action', function($row){

                    if(Auth::user()->can('Menu Label edit'))
                    {
                        $edit_btn = '<a class="dropdown-item" href="'.route('menu_label.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>';
                    }
                    else
                    {
                        $edit_btn ='';
                    }

                    if(Auth::user()->can('Menu Label properties'))
                    {
                        $prop_btn = '<a class="dropdown-item" href="'.route('menu_label.properties',$row->id).'"><i class="fa fa-bars"></i> '.__('common.properties').'</a>';
                    }
                    else
                    {
                        $prop_btn = '';
                    }

                    if(Auth::user()->can('Menu Label destroy'))
                    {
                        $destroy_btn = '<form action="'.route('menu_label.destroy',$row->id).'" id="deleteForm" method="post">
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
                        <a class="d-none dropdown-item" href="'.route('menu_label.show',$row->id).'"><i class="fa fa-eye"></i> '.__('common.show').'</a>
                        '.$prop_btn.'
                        '.$destroy_btn.'
                    </div>
                </div>';

                    return $btn;
            })
            ->rawColumns(['action','label_name','sl'])
            ->make(true);

        }
        return view($this->path.'.index');
    }
    public function trash_list($datatable)
    {
        if($datatable == 1)
        {
            $data = MenuLabel::onlyTrashed();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sl',function($row){
                return $this->sl = $this->sl +1;
            })
            ->addColumn('label_name',function($row){
                if(config('app.locale') == 'en')
                {
                    return $row->label_name_en ?: $row->label_name_bn;
                }
                else
                {
                    return $row->label_name_bn ?: $row->label_name_en;
                }
            })
            ->addColumn('delete_by',function($row){
                $data = MenuLabel::onlyTrashed()->find($row->id);
                return $data->deleted_by->name;
            })
            ->addColumn('action', function($row){
                    if(Auth::user()->can('Menu Label restore'))
                    {
                        $restore_btn = ' <a class="dropdown-item" href="'.route('menu_label.restore',$row->id).'"><i class="fa fa-arrow-alt-circle-left"></i> '.__('common.restore').'</a>';
                    }
                    else
                    {
                        $restore_btn ='';
                    }
                    if(Auth::user()->can('Menu Label properties'))
                    {
                        $prop_btn = '<a class="dropdown-item" href="'.route('menu_label.properties',$row->id).'"><i class="fa fa-bars"></i> '.__('common.properties').'</a>';
                    }
                    else
                    {
                        $prop_btn ='';
                    }
                    if(Auth::user()->can('Menu Label delete'))
                    {
                        $delete_btn = '<a onclick="return Sure()" class="text-danger dropdown-item" href="'.route('menu_label.delete',$row->id).'"><i class="fa fa-trash"></i> '.__('common.delete').'</a>';
                    }
                    else
                    {
                        $delete_btn ='';
                    }
                    $btn = '<div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        '.__('common.actions').'
                    </button>
                    <div class="dropdown-menu">
                        <a class="d-none dropdown-item" href="'.route('menu_label.show',$row->id).'"><i class="fa fa-eye"></i> '.__('common.show').'</a>
                        '.$prop_btn.'
                        '.$restore_btn.'
                        '.$delete_btn.'
                    </div>
                </div>';

                    return $btn;
            })
            ->rawColumns(['action','label_name','sl'])
            ->make(true);

        }
        return view($this->path.'.trash_list');
    }

    public function create()
    {
        return view($this->path.'.create');
    }

    public function store($data)
    {
        $insert_data  = array(
            'label_name_en' => $data->label_name_en,
            'label_name_bn' => $data->label_name_bn,
            'order_by'      => $data->order_by,
        );
        $create = MenuLabel::create($insert_data);
        ActivityLog::create([
            'activity' => 'create',
            'slug' => 'menu_label',
            'description_en' => 'Created A Menu Label Which Is '.$data->label_name_en,
            'description_bn' => 'একটি মেনু স্তর তৈরি করেছেন যার নাম  '.$data->label_name_en,
        ]);
        toastr()->success( __('menu_label.insert_message'),__('common.success'));
        return redirect()->back();
    }

    public function show($id){}

    public function properties($id)
    {
        $data = [];
        $data['menu_label'] = MenuLabel::withTrashed()->find($id);
        $data['edit_history'] = MenuLabelEditHistory::where('menu_label_id',$id)->with('editor')->orderBy('id','DESC')->get();
        $data['delete_history'] = MenuLabelSoftDeleteHistory::where('menu_label_id',$id)->with('deletor')->orderBy('id','DESC')->get();
        $data['restore_history'] = MenuLabelRestoreHistory::where('menu_label_id',$id)->with('restorer')->orderBy('id','DESC')->get();
        $data['menu'] = Menu::withTrashed()->where('label_id',$id)->with('parent','childdren')->get();
        return view($this->path.'.properties',compact('data'));
    }

    public function edit($id)
    {
        $data = MenuLabel::find($id);

        return view($this->path.'.edit',compact('data'));
    }

    public function update($data, $id)
    {
        $update_data  = array(
            'label_name_en' => $data->label_name_en,
            'label_name_bn' => $data->label_name_bn,
            'order_by'      => $data->order_by,
            'edit_by'       => Auth::user()->id,
        );
        MenuLabelEditHistory::create([
            'menu_label_id' => $id,
        ]);
        $create = MenuLabel::find($id)->update($update_data);
        ActivityLog::create([
            'activity' => 'edit',
            'slug' => 'menu_label',
            'description_en' => 'Edited A Menu Label Which Is '.$data->label_name_en,
            'description_bn' => 'একটি মেনু স্তর সম্পাদন করেছেন যার নাম  '.$data->label_name_en,
        ]);
        toastr()->success( __('menu_label.update_message'),__('common.success'));
        return redirect()->back();
    }

    public function destroy($id)
    {
        $check = MenuLabel::hasAnyMenu($id);
        if($check > 0)
        {
            if(config('app.locale') == 'en')
            {
                $warn_message = 'This Menu Lable Has '.$check.' Menu';
            }
            else
            {
                $warn_message = 'এই মেনু স্তরের '.$check.' টি মেনু রয়েছে';
            }
            toastr()->error($warn_message,__('common.error'));
            return redirect(route('menu_label.properties',$id));
        }
        else
        {
            $delete = MenuLabel::moveToTrash($id);
            MenuLabel::DeleteBy($id);
            MenuLabelSoftDeleteHistory::create([
                'menu_label_id' => $id,
            ]);
            $data = MenuLabel::withTrashed()->find($id);
            ActivityLog::create([
                'activity' => 'destroy',
                'slug' => 'menu_label',
                'description_en' => 'Destroy A Menu Label Which Is '.$data->label_name_en,
                'description_bn' => 'একটি মেনু স্তর ডিলেট করেছেন যার নাম  '.$data->label_name_en,
            ]);
            toastr()->success( __('menu_label.destroy_message'),__('common.success'));
            return redirect()->back();
        }
    }

    public function restore($id)
    {
        $restore = MenuLabel::withTrashed()->find($id)->restore();
        MenuLabel::RestoreBy($id);
        MenuLabelRestoreHistory::create([
            'menu_label_id' => $id,
        ]);
        $data = MenuLabel::withTrashed()->find($id);
        ActivityLog::create([
            'activity' => 'restore',
            'slug' => 'menu_label',
            'description_en' => 'Restore A Menu Label Which Is '.$data->label_name_en,
            'description_bn' => 'একটি মেনু স্তর পুনুরুদ্ধার করেছেন যার নাম '.$data->label_name_en,
        ]);
        toastr()->success( __('menu_label.restore_message'),__('common.success'));
        return redirect('/menu_label');
    }

    public function delete($id)
    {
        MenuLabelEditHistory::where('menu_label_id',$id)->delete();
        MenuLabelSoftDeleteHistory::where('menu_label_id',$id)->delete();
        MenuLabelRestoreHistory::where('menu_label_id',$id)->delete();

        $data= Menulabel::withTrashed()->find($id);
        ActivityLog::create([
            'activity' => 'delete',
            'slug' => 'menu_label',
            'description_en' => 'Permenantly Delete A Menu Label Which Was '.$data->label_name_en,
            'description_bn' => 'একটি মেনু স্তর সম্পূর্ণ ডিলেট করেছেন যার নাম ছিলো  '.$data->label_name_en,
        ]);

        MenuLabel::withTrashed()->find($id)->forceDelete();
        toastr()->success( __('menu_label.delete_message'),__('common.success'));
        return redirect('/menu_label');
    }

    public function print(){}
}
