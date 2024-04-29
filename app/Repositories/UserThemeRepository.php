<?php
namespace App\Repositories;
use App\Interfaces\UserThemeInterface;
use App\Models\UserTheme;
use App\Models\ActivityLog;
use Auth;

class UserThemeRepository implements UserThemeInterface{
    protected $path;
    public function __construct()
    {
        $this->path = 'backend.user_theme';
    }
    public function index($datatable)
    {

    }

    public function create()
    {
        $data['theme'] = UserTheme::where('user_id',Auth::user()->id)->first();
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
        // dd($data->theme);
        UserTheme::where('user_id',Auth::user()->id)->update([
            'theme' => $data->theme,
            'sidebar_layout' => $data->sidebar_layout,
            'sidebar_position' => $data->sidebar_position,
            'layout' => $data->layout,
        ]);
        ActivityLog::create([
            'activity' => 'edit',
            'slug' => 'theme',
            'description_en' => 'Have Changed Your Dashboard Theme',
            'description_bn' => 'আপনার ড্যাশবোর্ডের থিম পরিবর্তন করেছেন',
        ]);
        toastr()->success( __('user_theme.update_message'),__('common.success'));
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
