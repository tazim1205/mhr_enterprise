<?php

namespace App\Repositories;
use App\Interfaces\BranchInterface;
use App\Models\Branch;
use DataTables;
use App\Models\BranchEditHistory;
use App\Models\BranchDeleteHistory;
use App\Models\BranchRestoreHistory;
use App\Models\ActivityLog;
use Auth;
use App\Models\User;

class BranchRepository implements BranchInterface
{
    protected $path;

    protected $sl;

    public function __construct()
    {
        $this->path = 'backend.branch';
        $this->sl = 0;
    }

    public function index($datatable)
    {
        if($datatable == 1)
        {
            $data = Branch::all();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sl',function($row){
                return $this->sl = $this->sl +1;
            })
            ->addColumn('branch_name',function($row){
                if(config('app.locale') == 'en')
                {
                    return $row->branch_name_en ?: $row->branch_name_bn;
                }
                else
                {
                    return $row->branch_name_bn ?: $row->branch_name_en;
                }
            })
            ->addColumn('action', function($row){
                    if(Auth::user()->can('Branch edit'))
                    {
                        $edit_btn = '<a class="dropdown-item" href="'.route('branch.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>';
                    }
                    else
                    {
                        $edit_btn ='';
                    }
                    if(Auth::user()->can('Branch properties'))
                    {
                        $prop_btn = '<a class="dropdown-item" href="'.route('branch.properties',$row->id).'"><i class="fa fa-bars"></i> '.__('common.properties').'</a>';
                    }
                    else
                    {
                        $prop_btn ='';
                    }
                    if(Auth::user()->can('Branch destroy'))
                    {
                        $destroy_btn ='<form action="'.route('branch.destroy',$row->id).'" id="deleteForm" method="post">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button onclick="return Sure()" id="" type="submit" class="text-danger dropdown-item" href="#"><i class="fa fa-trash"></i> '.__('common.destroy').'</button>';
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
                        '.$prop_btn.'
                        '.$destroy_btn.'
                        </form>
                    </div>
                </div>';

                    return $btn;
            })
            ->rawColumns(['action','role_name','sl'])
            ->make(true);

        }
        return view($this->path.'.index');
    }

    public function create()
    {
        return view($this->path.'.create');
    }

    public function store($data){
        $insertdata = array(
            'branch_name_en' => $data->branch_name_en,
            'branch_name_bn' => $data->branch_name_bn,
        );
        $create = Branch::create($insertdata);

        ActivityLog::create([
            'activity' => 'create',
            'slug' => 'branch',
            'description_en' => 'Create A Branch Which Is '.$data->branch_name_en,
            'description_bn' => 'একটি শাখা তৈরি করেছেন যার নাম  '.$data->branch_name_en,
        ]);

        toastr()->success( __('branch.insert_message'),__('common.success'));
        return redirect()->back();
    }

    public function show($id){

    }

    public function properties($id){
        $data=[];
        $data['branch'] = Branch::withTrashed()->find($id);
        $data['edit_history'] = BranchEditHistory::where('branch_id',$id)->with('editor')->orderBy('id','DESC')->get();
        $data['delete_history'] = BranchDeleteHistory::where('branch_id',$id)->with('deletor')->orderBy('id','DESC')->get();
        $data['restore_history'] = BranchRestoreHistory::where('branch_id',$id)->with('restorer')->orderBy('id','DESC')->get();
        $data['user'] = User::withTrashed()->where('branch_id',$id)->get();
        $data['sl'] = 1;
        return view($this->path.'.properties',compact('data'));
    }

    public function edit($id)
    {
        $data = Branch::find($id);
        return view($this->path.'.edit',compact('data'));
    }

    public function update($data, $id){
        $insertdata = array(
            'branch_name_en' => $data->branch_name_en,
            'branch_name_bn' => $data->branch_name_bn,
        );
        Branch::find($id)->update($insertdata);
        BranchEditHistory::create([
            'branch_id' => $id,
        ]);
        ActivityLog::create([
            'activity' => 'edit',
            'slug' => 'branch',
            'foreign_id' => $id,
            'description_en' => 'Update A Branch Which Is '.$data->branch_name_en,
            'description_bn' => 'একটি শাখা সম্পাদন করেছেন যার নাম  '.$data->branch_name_en,
        ]);
        toastr()->success( __('branch.update_message'),__('common.success'));
        return redirect()->back();
    }

    public function destroy($id){
        $checkAnyUser = Branch::hasAnyUser($id);
        if($checkAnyUser > 0)
        {
            if(config('app.locale') == 'en')
            {
                $warn_message = 'This Branch Has '. $checkAnyUser .' User';
            }
            else
            {
                $warn_message = 'এই শাখার অধীনে '. $checkAnyUser .' জন ইউজার রয়েছে';
            }

            toastr()->warning( $warn_message,__('common.error'));
            return redirect(route('branch.properties',$id));
        }
        Branch::find($id)->delete();
        BranchDeleteHistory::create([
            'branch_id' => $id,
        ]);
        $data = Branch::withTrashed()->find($id);
        ActivityLog::create([
            'activity' => 'destroy',
            'slug' => 'branch',
            'description_en' => 'Destroy A Branch Which Is '.$data->branch_name_en,
            'description_bn' => 'একটি শাখা ডিলিট করেছেন যার নাম  '.$data->branch_name_en,
        ]);
        toastr()->success( __('branch.destroy_message'),__('common.success'));
        return redirect()->back();
    }

    public function trash_list($datatable)
    {
        if($datatable == 1)
        {
            $data = Branch::onlyTrashed();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sl',function($row){
                return $this->sl = $this->sl +1;
            })
            ->addColumn('branch_name',function($row){
                if(config('app.locale') == 'en')
                {
                    return $row->branch_name_en ?: $row->branch_name_bn;
                }
                else
                {
                    return $row->branch_name_bn ?: $row->branch_name_en;
                }
            })
            ->addColumn('action', function($row){
                    if(Auth::user()->can('Branch restore'))
                    {
                        $restore_btn = '<a class="dropdown-item" href="'.route('branch.restore',$row->id).'"><i class="fa fa-arrow-left"></i> '.__('common.restore').'</a>';
                    }
                    else
                    {
                        $restore_btn ='';
                    }
                    if(Auth::user()->can('Branch properties'))
                    {
                        $prop_btn = '<a class="dropdown-item" href="'.route('branch.properties',$row->id).'"><i class="fa fa-bars"></i> '.__('common.properties').'</a>';
                    }
                    else
                    {
                        $prop_btn ='';
                    }
                    if(Auth::user()->can('Branch delete'))
                    {
                        $delete_btn = '<a onclick="return Sure()" class="dropdown-item text-danger" href="'.route('branch.delete',$row->id).'"><i class="fa fa-trash"></i> '.__('common.delete').'</a>';
                    }
                    else
                    {
                        $delete_btn='';
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

    public function restore($id)
    {
        Branch::withTrashed()->find($id)->restore();
        BranchRestoreHistory::create([
            'branch_id'=>$id,
        ]);
        $data = Branch::withTrashed()->find($id);
        ActivityLog::create([
            'activity' => 'restore',
            'slug' => 'branch',
            'description_en' => 'Restore A Branch Which Is '.$data->branch_name_en,
            'description_bn' => 'একটি শাখা পুনুরুদ্ধার করেছেন যার নাম  '.$data->branch_name_en,
        ]);
        toastr()->success( __('branch.restore_message'),__('common.success'));
        return redirect()->back();
    }

    public function delete($id){
        BranchEditHistory::where('branch_id',$id)->delete();
        BranchDeleteHistory::where('branch_id',$id)->delete();
        BranchRestoreHistory::where('branch_id',$id)->delete();
        $branch = Branch::withTrashed()->find($id);
        ActivityLog::create([
            'activity' => 'delete',
            'slug' => 'branch',
            'description_en' => 'Permenantly Delete A Branch Which Was '.$branch->branch_name_en,
            'description_bn' => 'একটি শাখা পুনুরুদ্ধার করেছেন যার নাম ছিলো '.$branch->branch_name_en,
        ]);
        Branch::withTrashed()->find($id)->forceDelete();
        toastr()->success( __('branch.delete_message'),__('common.success'));
        return redirect()->back();
    }

    public function print(){

    }

}
