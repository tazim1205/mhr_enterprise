<?php
namespace App\Repositories;

use App\Interfaces\SoftwareSettingsInterface;
use App\Models\SoftwareSettings;
use App\Models\SoftwareSettingsEditHistory;
use App\Models\ActivityLog;
use DataTables;
use Artisan;
use Auth;
use App\Traits\Date;

class SoftwareSettingsRepository implements SoftwareSettingsInterface{
    protected $path;
    use Date;
    public function __construct()
    {
        $this->path = 'backend.software_settings';
    }
    public function index($datatable)
    {
        if($datatable == 1)
        {
            $data = SoftwareSettingsEditHistory::orderBy('date','ASC')->orderBy('time','DESC')->with('editor')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('date_time',function($row){
                $data = Date::DbToOriginal('-',$row->date).' '.Date::twelveHrTime($row->time);
                return $data;
            })
            ->addColumn('editor',function($row){

                    $path = public_path().'/Backend/profile/'.$row->editor->profile;
                    $output ='';
                    if(file_exists($path))
                    {
                        $output .='<img src="'.asset('Backend/profile').'/'.$row->editor->profile.'" alt="" style="height: 40px;width:40px;border-radius:100%;">';
                    }
                    else
                    {
                        $output .= '<img src="'.asset('Backend/img/avatars').'/user_avatar.png" alt="" style="height: 40px;width:40px;border-radius:100%;">';
                    }


                    $output.= $row->editor->name;

                    return $output;
            })
            ->rawColumns(['date_time','editor'])
            ->make(true);
        }

        return view($this->path.'.index');
    }

    public function create()
    {
        $data = SoftwareSettings::first();
        return view($this->path.'.create',compact('data'));
    }

    public function store($data){

    }

    public function show($id){

    }

    public function properties($id){

    }

    public function edit($id){

    }

    public function update($data, $id)
    {
        // dd($data);
        $insert_data = [];
        $insert_data['title_en'] = $data->title_en;
        $insert_data['title_bn'] = $data->title_bn;

        $logo = $data->file('logo');
        $favicon = $data->file('favicon');
        //logo
        if($logo)
        {
            $pathImage = SoftwareSettings::find($id);
            $path = public_path().'/Backend/settings/'.$pathImage->logo;
            if(file_exists($path))
            {
                unlink($path);
            }
        }
        if($logo)
        {
            $imageName = rand().'.'.$logo->getClientOriginalExtension();
            $logo->move(public_path().'/Backend/settings/',$imageName);
            $insert_data['logo'] = $imageName;
        }
        // favicon
        if($favicon)
        {
            $pathImage = SoftwareSettings::find($id);
            $path = public_path().'/Backend/settings/'.$pathImage->favicon;
            if(file_exists($path))
            {
                unlink($path);
            }
        }
        if($favicon)
        {
            $imageName = rand().'.'.$favicon->getClientOriginalExtension();
            $favicon->move(public_path().'/Backend/settings/',$imageName);
            $insert_data['favicon'] = $imageName;
        }

        SoftwareSettings::find($id)->update($insert_data);
        SoftwareSettingsEditHistory::create();
        ActivityLog::create([
            'activity' => 'edit',
            'slug' => 'Software Settings',
            'description_en' => 'Have Updated Software Settings',
            'description_bn' => 'সফটওয়্যার সেটিংস তথ্য সম্পাদন করেছেন',
        ]);
        toastr()->success( __('software_info.update_message'),__('common.success'));
        return redirect()->back();
    }

    public function destroy($id){

    }

    public function trash_list($datatable){

    }

    public function restore($id){

    }

    public function delete($id){

    }

    public function print(){

    }

}
