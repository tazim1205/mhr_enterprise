<?php
namespace App\Repositories;
use App\Interfaces\RoleInterface;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\RoleEditHistory;
use App\Models\RoleDeleteHistory;
use App\Models\RoleRestoreHistory;
use App\Models\ActivityLog;
use App\Models\Menu;
use DataTables;
use Auth;
use App\Models\User;

class RoleRepository implements RoleInterface{
    protected $path;
    protected $sl;
    public function __construct()
    {
        $this->path = 'backend.role';
        $this->sl = 0;
    }
    public function index($datatable)
    {
        if($datatable == 1)
        {
            $data = Role::all();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sl',function($row){
                return $this->sl = $this->sl +1;
            })
            ->addColumn('role_name',function($row){
                if(config('app.locale') == 'en')
                {
                    return $row->name ?: $row->name_bn;
                }
                else
                {
                    return $row->name_bn ?: $row->name;
                }
            })
            ->addColumn('permission',function($row){
                if(Auth::user()->can('Role show'))
                {
                    return '<a href="'.route('role.show',$row->id).'" class="btn btn-sm btn-info"><i class="fa fa-key"></i></a>';
                }
                else
                {
                    return '';
                }
            })
            ->addColumn('action', function($row){

                    if(Auth::user()->can('Role edit'))
                    {
                        $edit_btn = '<a class="dropdown-item" href="'.route('role.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>';
                    }
                    else
                    {
                        $edit_btn ='';
                    }

                    if(Auth::user()->can('Role properties'))
                    {
                        $prop_btn = ' <a class="dropdown-item" href="'.route('role.properties',$row->id).'"><i class="fa fa-bars"></i> '.__('common.properties').'</a>';
                    }
                    else
                    {
                        $prop_btn = '';
                    }

                    if(Auth::user()->can('Role destroy'))
                    {
                        $destroy_btn = '<form action="'.route('role.destroy',$row->id).'" id="deleteForm" method="post">
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
                        <a class="d-none dropdown-item" href="'.route('role.show',$row->id).'"><i class="fa fa-eye"></i> '.__('common.show').'</a>
                        '.$prop_btn.'
                        '.$destroy_btn.'
                    </div>
                </div>';

                    return $btn;
            })
            ->rawColumns(['action','role_name','sl','permission'])
            ->make(true);

        }
        return view($this->path.'.index');
    }
    public function trash_list($datatable)
    {
        if($datatable == 1)
        {
            $data = Role::onlyTrashed();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sl',function($row){
                return $this->sl = $this->sl +1;
            })
            ->addColumn('role_name',function($row){
                if(config('app.locale') == 'en')
                {
                    return $row->name ?: $row->name_bn;
                }
                else
                {
                    return $row->name_bn ?: $row->name;
                }
            })
            ->addColumn('action', function($row){

                    if(Auth::user()->can('Role restore'))
                    {
                        $restore_btn = '<a class="dropdown-item" href="'.route('role.restore',$row->id).'"><i class="fa fa-arrow-left"></i> '.__('common.restore').'</a>';
                    }
                    else
                    {
                        $restore_btn ='';
                    }

                    if(Auth::user()->can('Role properties'))
                    {
                        $prop_btn = '<a class="dropdown-item" href="'.route('role.properties',$row->id).'"><i class="fa fa-bars"></i> '.__('common.properties').'</a>';
                    }
                    else
                    {
                        $prop_btn = '';
                    }

                    if(Auth::user()->can('Role delete'))
                    {
                        $delete_btn = '<a onclick="return Sure()" class="text-danger dropdown-item" href="'.route('role.delete',$row->id).'"><i class="fa fa-trash"></i> '.__('common.delete').'</a>';
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
            ->rawColumns(['action','role_name','sl'])
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
        $create_data = array(
            'name' => $data->role_name_en,
            'name_bn' => $data->role_name_bn,
            'guard_name' => 'web',
        );
        $create = Role::create($create_data);
        ActivityLog::create([
            'activity' => 'create',
            'slug' => 'role',
            'description_en' => 'Create A Role Which Is '.$data->role_name_en,
            'description_bn' => 'একটি রোল তৈরি করেছেন যার নাম  '.$data->role_name_en,
        ]);
        toastr()->success( __('role.insert_message'),__('common.success'));
        return redirect()->back();
    }

    public function show($id)
    {
        $data =[];
        $data['role'] = Role::find($id);
        $data['menus'] = Menu::where('type','!=',1)->get();
        return view($this->path.'.show',compact('data'));
    }

    public function properties($id)
    {
        $data = [];
        $data['role'] = Role::withTrashed()->find($id);
        $data['edit_history'] = RoleEditHistory::where('role_id',$id)->with('editor')->orderBy('id','DESC')->get();
        $data['delete_history'] = RoleDeleteHistory::where('role_id',$id)->with('deletor')->orderBy('id','DESC')->get();
        $data['restore_history'] = RoleRestoreHistory::where('role_id',$id)->with('restorer')->orderBy('id','DESC')->get();
        $data['user'] = User::withTrashed()->role($data['role']->name)->get();
        $data['sl'] = 1;
        return view($this->path.'.properties',compact('data'));
    }

    public function edit($id){
        $data = Role::find($id);
        return view($this->path.'.edit',compact('data'));
    }

    public function update($data, $id)
    {
        $update_data = array(
            'name' => $data->role_name_en,
            'name_bn' => $data->role_name_bn,
            'guard_name' => 'web',
        );
        Role::find($id)->update($update_data);
        RoleEditHistory::create([
            'role_id' => $id,
        ]);
        ActivityLog::create([
            'activity' => 'edit',
            'slug' => 'role',
            'description_en' => 'Edit A Role Which Is '.$data->role_name_en,
            'description_bn' => 'একটি রোল সম্পাদন করেছেন যার নাম  '.$data->role_name_en,
        ]);
        toastr()->success( __('role.update_message'),__('common.success'));
        return redirect()->back();
    }

    public function destroy($id){
        // return $id;
        $role = Role::find($id);
        $count = User::withTrashed()->role($role->name)->count();
        if($count > 0)
        {
            if(config('app.locale') == 'en')
            {
                $warn_message = 'This Role Has '.$count.' Admin';
            }
            else
            {
                $warn_message = 'এই রোলের '.$count.' জন ইউজার রয়েছে।';
            }
            toastr()->warning($warn_message,__('common.error'));
            return redirect(route('role.properties',$id));
        }
        Role::find($id)->delete();
        RoleDeleteHistory::create([
            'role_id' => $id,
        ]);
        $data = Role::withTrashed()->find($id);
        ActivityLog::create([
            'activity' => 'destroy',
            'slug' => 'role',
            'description_en' => 'Destroy A Role Which Is '.$data->name,
            'description_bn' => 'একটি রোল ডিলিট করেছেন যার নাম  '.$data->name,
        ]);
        toastr()->success( __('role.destroy_message'),__('common.success'));
        return redirect()->back();
    }

    public function restore($id){
        Role::withTrashed()->find($id)->restore();
        RoleRestoreHistory::create([
            'role_id' => $id,
        ]);
        $data = Role::withTrashed()->find($id);
        ActivityLog::create([
            'activity' => 'restore',
            'slug' => 'role',
            'description_en' => 'Restore A Role Which Is '.$data->name,
            'description_bn' => 'একটি রোল পুনুরুদ্ধার করেছেন যার নাম  '.$data->name,
        ]);
        toastr()->success( __('role.restore_message'),__('common.success'));
        return redirect()->back();
    }

    public function delete($id){
        RoleEditHistory::where('role_id',$id)->delete();
        RoleDeleteHistory::where('role_id',$id)->delete();
        RoleRestoreHistory::where('role_id',$id)->delete();
        $role = Role::withTrashed()->find($id);
        ActivityLog::create([
            'activity' => 'delete',
            'slug' => 'role',
            'description_en' => 'Permenantly Delete A Role Which Was '.$role->name,
            'description_bn' => 'একটি রোল সম্পূুর্ণ রিমুভ করেছেন যার নাম ছিলো  '.$role->name,
        ]);
        Role::withTrashed()->find($id)->forceDelete();
        toastr()->success( __('role.delete_message'),__('common.success'));
        return redirect()->back();
    }

    public function print(){

    }

    public function permission($data,$id)
    {
        $role = Role::find($id);
        $role->syncPermissions($data->permissions);
        ActivityLog::create([
            'activity' => 'permission',
            'slug' => 'role',
            'description_en' => 'Have Change Permission of '.$role->name,
            'description_bn' => 'একটি রোলে এর পারমিশন পরিবর্তন করেছেন যার নাম  '.$role->name,
        ]);
        toastr()->success( __('role.permission_message'),__('common.success'));
        return redirect()->back();
    }

}
