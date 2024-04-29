<?php
namespace App\Repositories;
use App\Interfaces\MenuInterface;
use App\Models\MenuActions;
use App\Models\Menu;
use App\Models\MenuLabel;
use App\Models\ActivityLog;
use App\Models\MenuEditHistory;
use App\Models\MenuDeleteHistory;
use App\Models\MenuRestoreHistory;
use Spatie\Permission\Models\Permission;
use DataTables;
use Artisan;
use Auth;

class MenuRepository implements MenuInterface{
    protected $path;
    public $sl;
    public function __construct()
    {
        $this->path ='backend.menu';
        $this->sl = 0;
    }
    public function index($datatable)
    {
        if($datatable == 1)
        {
            $data = Menu::with('parent','childdren')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sl',function($row){
                return $this->sl = $this->sl +1;
            })
            ->addColumn('label',function($row){
                if($row->label_id != NULL)
                {
                    if(config('app.locale') == 'en')
                    {
                        return $row->label->label_name_en ?: $row->label->label_name_bn;
                    }
                    else
                    {
                        return $row->label->label_name_bn ?: $row->label->label_name_en;
                    }
                }
                else
                {
                    return '';
                }
            })
            ->addColumn('parent_name',function($row){
                if($row->parent_id != NULL)
                {
                    if(config('app.locale') == 'en')
                    {
                        return $row->parent->menu_name_en ?: $row->parent->menu_name_bn;
                    }
                    else
                    {
                        return $row->parent->menu_name_bn ?: $row->parent->menu_name_en;
                    }
                }
                else
                {
                    return '';
                }
            })
            ->addColumn('menu_name',function($row){
                if(config('app.locale') == 'en')
                {
                    return $row->menu_name_en ?: $row->menu_name_bn;
                }
                else
                {

                    return $row->menu_name_bn ?: $row->menu_name_en;
                }
            })
            ->addColumn('type',function($row){
                if($row->type == 1)
                {
                    return __('menu.parent');
                }
                elseif($row->type == 2)
                {
                    return __('menu.module');
                }
                else
                {
                    return __('menu.single');
                }
            })
            ->addColumn('status',function($row){
                if(Auth::user()->can('Menu status'))
                {
                    if($row->status == 1)
                    {
                        $status = 'checked';
                    }
                    else
                    {
                        $status = '';
                    }
                    return '<div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" onclick="return ChangeMenuStatus('.$row->id.')" id="MenuStatusChange-'.$row->id.'" '.$status.'>
                </div>';
                }
                else
                {
                    return '';
                }
            })
            ->addColumn('action', function($row){

                $d_none = '';
                if($row->type == 1)
                {
                    $d_none = 'd-none';
                }

                if(Auth::user()->can('Menu edit'))
                {
                    $edit_btn = ' <a class="dropdown-item" href="'.route('menu.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>';
                }
                else
                {
                    $edit_btn ='';
                }

                if(Auth::user()->can('Menu show'))
                {
                    $show_btn = '<a  class=" '.$d_none.' dropdown-item" href="'.route('menu.show',$row->id).'"><i class="fa fa-eye"></i> '.__('common.show').'</a>';
                }
                else
                {
                    $show_btn ='';
                }
                if(Auth::user()->can('Menu properties'))
                {
                    $prop_btn = '<a class="dropdown-item" href="'.route('menu.properties',$row->id).'"><i class="fa fa-bars"></i> '.__('common.properties').'</a>';
                }
                else
                {
                    $prop_btn ='';
                }
                if(Auth::user()->can('Menu destroy'))
                {
                    $destroy_btn = '<form action="'.route('menu.destroy',$row->id).'" id="deleteForm" method="post">
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
                        '.$show_btn.'
                        '.$prop_btn.'
                        '.$destroy_btn.'

                    </div>
                </div>';

                    return $btn;
            })
            ->rawColumns(['action','parent_name','menu_name','status','sl'])
            ->make(true);

        }
        return view($this->path.'.index');
    }

    public function create()
    {
        $data =[];
        $data['menu_actions'] = MenuActions::all();
        $data['parent_menu'] = Menu::SelectParent();
        $data['menu_label'] = MenuLabel::all();
        // return $data['parent_menu'];
        return view($this->path.'.create',compact('data'));
    }

    public function store($data){
        // dd($data->all());
        $insert_data= [];
        $insert_data['menu_name_en'] = $data->menu_name_en;
        $insert_data['menu_name_bn'] = $data->menu_name_bn;
        $insert_data['status'] = $data->status;
        $insert_data['type'] = $data->type;
        $insert_data['order_by'] = $data->order_by;
        $insert_data['system_name'] = $data->system_name;
        $insert_data['slug'] = $data->slug;

        if($data->type == 1)
        {
            $insert_data['icon'] = $data->icon;
            $insert_data['label_id'] = $data->label_id;
        }

        if($data->type == 2)
        {
            $insert_data['parent_id'] = $data->parent_id;
            $insert_data['route'] = $data->route;
        }

        if($data->type == 3)
        {
            $insert_data['route'] = $data->route;
            $insert_data['label_id'] = $data->label_id;
            $insert_data['icon'] = $data->icon;
        }

        $insert = Menu::create($insert_data);
        if($data->type != 1)
        {
            for ($i=0; $i < count($data->permissions) ; $i++)
            {
                Permission::create([
                    'name' => $data->system_name.' '.$data->permissions[$i],
                    'parent' => $data->system_name,
                    'guard_name' => 'web',
                ]);
            }
        }
        ActivityLog::create([
            'activity' => 'create',
            'slug' => 'menu',
            'description_en' => 'Created A Menu Which Is '.$data->menu_name_en,
            'description_bn' => 'একটি মেনু তৈরি করেছেন যার নাম '.$data->menu_name_en,
            'foreign_id' => $insert->id,
        ]);
        Artisan::call('cache:forget spatie.permission.cache');
        toastr()->success( __('menu.insert_message'),__('common.success'));
        return redirect()->back();
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        $data = Permission::where('parent',$menu->system_name)->get();
        $sl = $this->sl+1;
        // return $data;
        return view($this->path.'.show',compact('data','sl','menu'));
    }

    public function properties($id)
    {
        $data=[];
        $data['menu'] = Menu::withTrashed()->find($id);
        $data['edit_history'] = MenuEditHistory::where('menu_id',$id)->with('editor')->orderBy('id','DESC')->get();
        $data['delete_history'] = MenuDeleteHistory::where('menu_id',$id)->with('deletor')->orderBy('id','DESC')->get();
        $data['restore_history'] = MenuRestoreHistory::where('menu_id',$id)->with('restorer')->orderBy('id','DESC')->get();
        $menu = Menu::find($id);
        if($menu->type == 1)
        {
            $data['children_menu'] = Menu::withTrashed()->where('parent_id',$id)->get();
        }
        return view($this->path.'.properties',compact('data'));
    }

    public function edit($id)
    {
        $data =[];
        $data['menu_actions'] = MenuActions::all();
        $data['parent_menu'] = Menu::SelectParent();
        $data['menu'] = Menu::find($id);
        $data['menu_label'] = MenuLabel::all();
        return view($this->path.'.edit',compact('data'));
    }

    public function update($data, $id){
        $insert_data= [];
        $insert_data['menu_name_en'] = $data->menu_name_en;
        $insert_data['menu_name_bn'] = $data->menu_name_bn;
        $insert_data['status'] = $data->status;
        $insert_data['type'] = $data->type;
        $insert_data['order_by'] = $data->order_by;
        $insert_data['slug'] = $data->slug;


        if($data->type == 1)
        {
            $insert_data['icon'] = $data->icon;
            $insert_data['label_id'] = $data->label_id;
        }

        if($data->type == 2)
        {
            $insert_data['parent_id'] = $data->parent_id;
            $insert_data['route'] = $data->route;
        }

        if($data->type == 3)
        {
            $insert_data['route'] = $data->route;
            $insert_data['label_id'] = $data->label_id;
            $insert_data['icon'] = $data->icon;
        }

        $insert = Menu::find($id)->update($insert_data);
        if($data->type != 1)
        {
            $menu = Menu::find($id);
            Permission::where('parent',$menu->system_name)->delete();
            Artisan::call('cache:forget spatie.permission.cache');
            for ($i=0; $i < count($data->permissions) ; $i++)
            {
                Permission::create([
                    'name' => $menu->system_name.' '.$data->permissions[$i],
                    'parent' => $menu->system_name,
                    'guard_name' => 'web',
                ]);
            }
        }
        MenuEditHistory::create([
            'menu_id' => $id,
        ]);
        ActivityLog::create([
            'activity' => 'edit',
            'slug' => 'menu',
            'description_en' => 'Edited A Menu Which Is '.$data->menu_name_en,
            'description_bn' => 'একটি মেনু সম্পাদন করেছেন যার নাম '.$data->menu_name_en,
            'foreign_id' => $id,
        ]);
        toastr()->success( __('menu.update_message'),__('common.success'));
        return redirect()->back();
    }

    public function destroy($id)
    {
        // return $id;
        $menu = Menu::find($id);
        if($menu->type == 1)
        {
            $check = Menu::hasAnyChilldren($id);
            if($check > 0)
            {
                if(config('app.locale') == 'en')
                {
                    $warn_message = 'This Parent Menu Has '.$check.' Chilldren Menu';
                }
                else
                {
                    $warn_message = 'এই পেরেন্ট মেনুর '.$check.' টি মডিউল মেনু রয়েছে';
                }
                toastr()->warning($warn_message,__('common.warn'));
                return redirect(route('menu.properties',$id));

            }
        }
        Menu::find($id)->delete();
        MenuDeleteHistory::create([
            'menu_id'=>$id,
        ]);
        $data = Menu::withTrashed()->find($id);
        ActivityLog::create([
            'activity' => 'destroy',
            'slug' => 'menu',
            'description_en' => 'Destroy A Menu Which Is '.$data->menu_name_en,
            'description_bn' => 'একটি মেনু ডিলেট করেছেন যার নাম '.$data->menu_name_en,
            'foreign_id' => $id,
        ]);
        toastr()->success( __('menu.destroy_message'),__('common.success'));
        return redirect()->back();
    }

    public function trash_list($datatable)
    {
        if($datatable == 1)
        {
            $data = Menu::onlyTrashed()->with('parent','childdren')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sl',function($row){
                return $this->sl = $this->sl +1;
            })
            ->addColumn('label',function($row){
                if($row->label_id != NULL)
                {
                    if(config('app.locale') == 'en')
                    {
                        return $row->label->label_name_en ?: $row->label->label_name_bn;
                    }
                    else
                    {
                        return $row->label->label_name_bn ?: $row->label->label_name_en;
                    }
                }
                else
                {
                    return '';
                }
            })
            ->addColumn('menu_name',function($row){
                if(config('app.locale') == 'en')
                {
                    return $row->menu_name_en ?: $row->menu_name_bn;
                }
                else
                {

                    return $row->menu_name_bn ?: $row->menu_name_en;
                }
            })
            ->addColumn('type',function($row){
                if($row->type == 1)
                {
                    return __('menu.parent');
                }
                elseif($row->type == 2)
                {
                    return __('menu.module');
                }
                else
                {
                    return __('menu.single');
                }
            })
            ->addColumn('action', function($row){

                $d_none = '';
                if($row->type == 1)
                {
                    $d_none = 'd-none';
                }

                if(Auth::user()->can('Menu restore'))
                {
                    $restore_btn = '<a class="dropdown-item" href="'.route('menu.restore',$row->id).'"><i class="fa fa-arrow-left"></i> '.__('common.restore').'</a>';
                }
                else
                {
                    $restore_btn ='';
                }

                if(Auth::user()->can('Menu properties'))
                {
                    $prop_btn = '<a class="dropdown-item" href="'.route('menu.properties',$row->id).'"><i class="fa fa-bars"></i> '.__('common.properties').'</a>';
                }
                else
                {
                    $prop_btn ='';
                }

                if(Auth::user()->can('Menu delete'))
                {
                    $delete_btn = '<a onclick="return Sure()" class="dropdown-item text-danger" href="'.route('menu.delete',$row->id).'"><i class="fa fa-trash"></i> '.__('common.delete').'</a>';
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
                        '.$restore_btn.'
                        '.$prop_btn.'
                        '.$delete_btn.'
                    </div>
                </div>';

                    return $btn;
            })
            ->rawColumns(['action','label','parent_name','menu_name','sl'])
            ->make(true);

        }
        return view($this->path.'.trash_list');
    }

    public function restore($id)
    {
        Menu::withTrashed()->find($id)->restore();
        $data = Menu::withTrashed()->find($id);
        ActivityLog::create([
            'activity' => 'restore',
            'slug' => 'menu',
            'description_en' => 'Restore A Menu Which Is '.$data->menu_name_en,
            'description_bn' => 'একটি মেনু পুনরুদ্ধার করেছেন যার নাম '.$data->menu_name_en,
            'foreign_id' => $id,
        ]);
        MenuRestoreHistory::create([
            'menu_id' => $id,
        ]);
        toastr()->success( __('menu.restore_message'),__('common.success'));
        return redirect()->back();
    }

    public function delete($id)
    {
        $menu = Menu::withTrashed()->find($id);
        ActivityLog::create([
            'activity' => 'delete',
            'slug' => 'menu',
            'description_en' => 'Delete A Menu Which Was '.$menu->menu_name_en,
            'description_bn' => 'একটি মেনু সম্পূর্ণ ডিলেট করেছেন যার নাম '.$menu->menu_name_bn,
        ]);
        MenuEditHistory::where('menu_id',$id)->delete();
        MenuDeleteHistory::where('menu_id',$id)->delete();
        MenuRestoreHistory::where('menu_id',$id)->delete();
        Permission::where('parent',$menu->system_name)->delete();
        Menu::withTrashed()->find($id)->forceDelete();
        Artisan::call('cache:forget spatie.permission.cache');
        toastr()->success( __('menu.delete_message'),__('common.success'));
        return redirect()->back();
    }

    public function print(){

    }

    public function status($id)
    {
        $check = Menu::find($id);
        if($check->status == 1)
        {
            Menu::makeInactive($id);
        }
        else
        {
            Menu::makeActive($id);
        }

        ActivityLog::create([
            'activity' => 'change_status',
            'slug' => 'menu',
            'description_en' => 'Have Changed Status Of A Menu ',
            'description_bn' => 'একটি মেনুর স্ট্যাটাস চেন্জ করেছেন যার নাম ',
            'foreign_id' => $id,
        ]);

       return 1;
    }

}
