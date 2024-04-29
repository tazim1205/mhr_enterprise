<?php
namespace App\Repositories;
use App\Interfaces\UserInterface;
use Spatie\Permission\Models\Role;
use App\Models\UserEditHistory;
use App\Models\UserRestoreHistory;
use App\Models\UserDeleteHistory;
use App\Models\UserChangePasswordHistory;
use App\Models\ActivityLog;
use App\Models\Branch;
use App\Models\UserTheme;
use Hash;
use App\Models\User;
use DataTables;
use Auth;
use App\Models\UserPassOtp;
use Session;
use Mail;
use App\Mail\EmailSender;
use App\Traits\SendMail;
use App\Traits\Date;
use App\Models\Menu;

class UserRepository implements UserInterface{
    protected $path;
    protected $sl;
    use SendMail;
    use Date;
    public function __construct()
    {
        $this->path = 'backend.user';
        $sl = 0;
    }

    public function index($datatable)
    {
        if($datatable == 1)
        {
            $data = User::all();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sl',function($row){
                return $this->sl = $this->sl +1;
            })
            ->addColumn('profile',function($row){
                $path = public_path().'/Backend/profile/'.$row->profile;
                $avatar = public_path().'/Backend/img/avatars/user_avatar.png';
                if(file_exists($path))
                {
                    return '<img src="'.asset('Backend/profile/'.$row->profile).'" class="img-fluid" style="height:50px;width : 50px;border-radius:100%">';
                }
                else
                {
                    return '<img src="'.asset('Backend/img/avatars/user_avatar.png').'" border="0" width="40" class="img-rounded" align="center" style="height:40px;width : 40px;border-radius:100%" />';

                }
            })
            ->addColumn('role',function($row){
                $user = User::find($row->id);
                if(config('app.locale') == 'en')
                {
                    return $user->roles()->pluck('name')->first();
                }
                else
                {
                    return $user->roles()->pluck('name_bn')->first();
                }
            })
            ->addColumn('name',function($row){
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

                        $user = User::find($row->id);
                        $disabled='';
                        if($user->roles()->pluck('name')->first() == 'Super Admin')
                        {
                            $disabled = 'disabled';
                        }
                        else
                        {
                            $disabled = '';
                        }
                        $class = '';
                        if($row->id == Auth::user()->id)
                        {
                            $class = '';
                        }
                        else
                        {
                            $class = 'd-none';
                        }

                        if(Auth::user()->can('Admin edit'))
                        {
                            $edit_btn = '<a class="dropdown-item" href="'.route('user.edit',$row->id).'"><i class="fa fa-edit"></i> '.__('common.edit').'</a>';
                        }
                        else
                        {
                            $edit_btn ='';
                        }

                        if(Auth::user()->can('Admin show'))
                        {
                            $show_btn = '<a class="dropdown-item '.$class.'" href="'.route('user.show',$row->id).'"><i class="fa fa-eye"></i> '.__('common.show').'</a>';
                        }
                        else
                        {
                            $show_btn = '';
                        }

                        if(Auth::user()->can('Admin properties'))
                        {
                            $prop_btn = '<a class="dropdown-item" href="'.route('user.properties',$row->id).'"><i class="fa fa-bars"></i> '.__('common.properties').'</a>';
                        }
                        else
                        {
                            $prop_btn ='';
                        }

                        if(Auth::user()->can('Admin destroy'))
                        {
                            $destroy_btn = '<form action="'.route('user.destroy',$row->id).'" id="deleteForm" method="post">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button '.$disabled.' onclick="return Sure()" id="" type="submit" class="text-danger dropdown-item" href="#"><i class="fa fa-trash"></i> '.__('common.destroy').'</button>
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
            ->rawColumns(['action','profile','sl','role'])
            ->make(true);

        }
        return view($this->path.'.index');
    }
    public function trash_list($datatable)
    {
        if($datatable == 1)
        {
            $data = User::onlyTrashed()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sl',function($row){
                return $this->sl = $this->sl +1;
            })
            ->addColumn('profile',function($row){
                $path = public_path().'/Backend/profile/'.$row->profile;
                $avatar = public_path().'/Backend/img/avatars/user_avatar.png';
                if(file_exists($path))
                {
                    return '<img src="'.asset('Backend/profile/'.$row->profile).'" class="img-fluid" style="height:50px;width : 50px;border-radius:100%">';
                }
                else
                {
                    return '<img src="'.asset('Backend/img/avatars/user_avatar.png').'" border="0" width="40" class="img-rounded" align="center" style="height:40px;width : 40px;border-radius:100%" />';

                }
            })
            ->addColumn('role',function($row){
                $user = User::withTrashed()->find($row->id);
                if(config('app.locale') == 'en')
                {
                    return $user->roles()->pluck('name')->first();
                }
                else
                {
                    return $user->roles()->pluck('name_bn')->first();
                }
            })
            ->addColumn('name',function($row){
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
                    if(Auth::user()->can('Admin restore'))
                    {
                        $restore_btn = '<a class="dropdown-item" href="'.route('user.restore',$row->id).'"><i class="fa fa-arrow-left"></i> '.__('common.restore').'</a>';
                    }
                    else
                    {
                        $restore_btn = '';
                    }
                    if(Auth::user()->can('Admin delete'))
                    {
                        $delete_btn = '<a onclick="return Sure()" class="text-danger dropdown-item" href="'.route('user.delete',$row->id).'"><i class="fa fa-trash"></i> '.__('common.delete').'</a>';
                    }
                    else
                    {
                        $delete_btn = '';
                    }
                    $btn = '<div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            '.__('common.actions').'
                        </button>
                        <div class="dropdown-menu">
                        '.$restore_btn.'
                        '.$delete_btn.'
                        </div>
                    </div>';


                    return $btn;
            })
            ->rawColumns(['action','profile','sl','role'])
            ->make(true);

        }
        return view($this->path.'.trash_list');
    }

    public function create()
    {
        $data = [];
        $data['role']  = Role::all();
        $data['branch']  = Branch::all();
        return view($this->path.'.create',compact('data'));
    }

    public function store($data)
    {
        $insert_data = array(
            'branch_id' => $data->branch_id,
            'name'      => $data->user_name_en,
            'name_bn'   => $data->user_name_bn,
            'email'     => $data->email,
            'password'  => Hash::make($data->password),
            'phone'     => $data->phone,
            'gender'    => $data->gender,
        );

        $user = User::create($insert_data);
        $role = Role::find($data->role_id);
        $user->assignRole($role);
        ActivityLog::create([
            'activity' => 'create',
            'slug' => 'user',
            'description_en' => 'Create A User Who Is '.$data->user_name_en,
            'description_bn' => 'একজন ইউজার তৈরি করেছেন যার নাম  '.$data->user_name_en,
        ]);
        UserTheme::create([
            'user_id'=>$user->id,
            'theme' =>'default',
            'sidebar_layout' => 'default',
            'sidebar_position' => 'left',
            'layout' => 'fluid',
        ]);
        toastr()->success( __('user.insert_message'),__('common.success'));
        return redirect()->back();
    }

    public function show($id)
    {
        $data=[];
        $data['user'] = User::find($id);
        $data['activities'] = ActivityLog::where('user_id',$id)->with('activityBy')->orderBy('id','DESC')->simplePaginate(10);
        // return $data['activities'];
        return view($this->path.'.show',compact('data'));
    }

    public function properties($id)
    {
        $data = [];
        $data['user'] = User::find($id);
        $data['edit_history'] = UserEditHistory::where('user_id',$id)->orderBy('id','DESC')->with('editor')->get();
        $data['delete_history'] = UserDeleteHistory::where('user_id',$id)->orderBy('id','DESC')->with('deletor')->get();
        $data['restore_history'] = UserRestoreHistory::where('user_id',$id)->orderBy('id','DESC')->with('restorer')->get();
        $data['pass_change_history'] = UserChangePasswordHistory::where('user_id',$id)->orderBy('id','DESC')->get();
        $data['activity'] =  ActivityLog::where('user_id',$id)->where('date',date('Y-m-d'))->orderBy('id',"ASC")->get();
        return view($this->path.'.properties',compact('data'));
    }

    public function edit($id)
    {
        $data =[];
        $data['user'] = User::find($id);
        $data['role'] = Role::all();
        $data['branch'] = Branch::all();
        return view($this->path.'.edit',compact('data'));
    }

    public function update($data, $id)
    {

        $update_date = array(
            'branch_id' => $data->branch_id,
            'name'      => $data->user_name_en,
            'name_bn'   => $data->user_name_bn,
            'email'     => $data->email,
            'phone'     => $data->phone,
            'gender'    => $data->gender,
        );
        User::where('id',$id)->update($update_date);
        $user = User::find($id);
        //removing role
        $previous_role = $user->roles()->pluck('id')->first();
        if(isset($previous_role))
        {

            $user->removeRole($previous_role);
        }


        // asign new role
        $role = Role::find($data->role_id);
        $user->assignRole($role);

        UserEditHistory::create([
            'user_id' => $id,
        ]);

        $content = [
            'subject' => 'Profile Updatess',
            'body' => '<div style="background:lightblue;padding:10px;">
                Hello '.$data->user_name_en.'. Your Profile is Updated at '.date('d M Y').'('.date('h:i:s a').')<br>
                Update By : '.Auth::user()->name.'
                </div>',
        ];

        Mail::to($data->email)->send(new EmailSender($content));

        ActivityLog::create([
            'activity' => 'edit',
            'slug' => 'user',
            'foreign_id' => $id,
            'description_en' => 'Edit A User Who Is '.$data->user_name_en,
            'description_bn' => 'একজন ইউজার সম্পাদন করেছেন যার নাম  '.$data->user_name_en,
        ]);

        toastr()->success( __('user.update_message'),__('common.success'));
        return redirect()->back();
    }

    public function destroy($id)
    {
        // return $id;
        $checkActivity = User::hasAnyActivity($id);
        if($checkActivity > 0)
        {
            if(config('app.locale') == 'en')
            {
                $warn_message = 'This User Has '.$checkActivity.' Activity';
            }
            else
            {
                $warn_message = 'এই ইউজারের মোট '.$checkActivity.' টি একটিভিটি রয়েছে';
            }

            toastr()->warning($warn_message,__('common.error'));
            return redirect(route('user.properties',$id));
        }
        UserDeleteHistory::create([
            'user_id' => $id,
        ]);
        $data = User::withTrashed()->find($id);
        User::where('id',$id)->delete();
        ActivityLog::create([
            'activity' => 'destroy',
            'slug' => 'user',
            'description_en' => 'Destroy A User Who Is '.$data->name,
            'description_bn' => 'একজন ইউজার ডিলেট করেছেন যার নাম  '.$data->name,
        ]);
        UserTheme::where('user_id',$id)->delete();
        toastr()->success( __('user.destroy_message'),__('common.success'));
        return redirect()->back();
    }

    public function restore($id)
    {
        User::withTrashed()->where('id',$id)->restore();
        UserRestoreHistory::create(['user_id'=>$id]);
        $data = User::withTrashed()->find($id);
        ActivityLog::create([
            'activity' => 'restore',
            'slug' => 'user',
            'description_en' => 'Restore A User Who Is '.$data->name,
            'description_bn' => 'একজন ইউজার পনুরুদ্ধার করেছেন যার নাম  '.$data->name,
        ]);
        toastr()->success( __('user.restore_message'),__('common.success'));
        return redirect()->back();
    }

    public function delete($id){
        $previouse_file = User::withTrashed()->find(Auth::user()->id);

        $previous_path = public_path().'/Backend/profile/'.$previouse_file->profile;

        if(file_exists($previous_path))
        {
            unlink($previous_path);
        }

        $user = User::withTrashed()->find($id);
        //removing role
        $previous_role = $user->roles()->pluck('id')->first();
        if(isset($previous_role))
        {

            $user->removeRole($previous_role);
        }

        UserEditHistory::where('user_id',$id)->delete();
        UserDeleteHistory::where('user_id',$id)->delete();
        UserRestoreHistory::where('user_id',$id)->delete();
        UserChangePasswordHistory::where('user_id',$id)->delete();
        $user = User::withTrashed()->find($id);
        ActivityLog::create([
            'activity' => 'delete',
            'slug' => 'user',
            'description_en' => 'Permenantly Delete A User Who Was '.$user->name,
            'description_bn' => 'একজন ইউজার সম্পূর্ণ ভাবে ডিলেট করেছেন যার নাম ছিলো  '.$user->name,
        ]);

        User::withTrashed()->where('id',$id)->forceDelete();
        toastr()->success( __('user.delete_message'),__('common.success'));
        return redirect()->back();
    }

    public function print(){

    }

    public function user_image_upload($request)
    {
        $folderPath = public_path('Backend/profile/'); //create folder upload public/upload

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = rand() . '.png';

        $imageFullPath = $folderPath.$imageName;

        file_put_contents($imageFullPath, $image_base64);

        $previouse_file = User::find(Auth::user()->id);

        $previous_path = public_path().'/Backend/profile/'.$previouse_file->profile;

        if(file_exists($previous_path))
        {
            unlink($previous_path);
        }

        User::find(Auth::user()->id)->update([
            'profile'=>$imageName
        ]);

        UserEditHistory::create([
            'user_id' => Auth::user()->id,
        ]);

        // SendMail::UserProfilePicuteUpdate();
        if($request->type)
        {
            toastr()->success( __('user.profile_change'),__('common.success'));
            return redirect(route('user.show',Auth::user()->id));
        }
        else
        {

            return response()->json(['success'=>'Crop Image Saved/Uploaded Successfully']);
        }
    }

    public function reset_pass()
    {
        return view($this->path.'.reset_pass');
    }

    public function send_otp($request)
    {
        $session_id = Session::getId();
        $otp = rand('100000','999999');
        SendMail::UserChangeOtp($otp,$request->email);
        UserPassOtp::create([
            'email' => $request->email,
            'otp'=>$otp,
            'session_id'=>$session_id,
        ]);
        toastr()->success( __('user.resend_otp_message'),__('common.success'));
        return redirect(route('user.check_otp',$request->email));
    }

    public function check_otp($email)
    {
        return view($this->path.'.check_otp',compact('email'));
    }

    public function resend_otp($email)
    {
        $session_id = Session::getId();
        $otp = rand('100000','999999');
        // return $otp;

        $checkHasAny = UserPassOtp::hasAny($email,$session_id);
        if($checkHasAny)
        {
            UserPassOtp::DeleteThis($email,$session_id);
        }
        SendMail::UserChangeOtp($otp,$email);
        UserPassOtp::create([
            'email' => $email,
            'otp'=>$otp,
            'session_id'=>$session_id,
        ]);

        toastr()->success( __('user.resend_otp_message'),__('common.success'));
        return redirect(route('user.check_otp',$email));
    }

    public function submit_otp($request,$email)
    {
        $session_id = Session::getId();
        $otp = $request->otp[0].''.$request->otp[1].''.$request->otp[2].''.$request->otp[3].''.$request->otp[4].''.$request->otp[5];
        $checkHasAnyOtp = UserPassOtp::hasAnyOtp($email,$otp,$session_id);
        if($checkHasAnyOtp)
        {
            $checkTime = UserPassOtp::checkTime($email,$otp,$session_id);
            if($checkTime == true)
            {
                UserPassOtp::Verify($email,$otp,$session_id);
                toastr()->success( __('user.otp_matched'),__('common.success'));
                return redirect(route('user.new_pass',$email));
            }else
            {
                toastr()->error( __('user.otp_expired'),__('common.error'));
            return redirect()->back();
            }
        }
        else
        {
            toastr()->error( __('user.otp_not_matched'),__('common.error'));
            return redirect()->back();
        }
    }

    public function new_pass($email)
    {
        $session_id = Session::getId();
        $checkVerify = UserPassOtp::isVerfiy($email,$session_id);
        if($checkVerify)
        {
            return view($this->path.'.new_pass',compact('email'));
        }
        else
        {
            toastr()->error( __('user.not_verified'),__('common.error'));
            return redirect('/login');
        }
    }

    public function submit_pass($request)
    {
        // dd($request->all());
        if($request->password == $request->confirm_password)
        {
            $user = User::where('email',$request->email)->first();
            User::ChangePassword($request->email,$request->password);
            Session::regenerate();
            UserChangePasswordHistory::create([
                'user_id' =>$user->id
            ]);
            SendMail::PasswordChanged($request->email);
            Auth::logout();
            toastr()->success( __('user.password_changed'),__('common.success'));
            return redirect('/login');
        }
        else
        {
            toastr()->error( __('user.password_not_matched'),__('common.error'));
            return redirect()->back();
        }
    }

    public function search_activity($request)
    {
        // $today_date = date('Y-m-d');
        $search_date = Date::originalToDB(' ',$request->date);
        $user_id = $request->user_id;
        $data['activity'] =  ActivityLog::where('user_id',$user_id)->where('date',$search_date)->orderBy('date',"DESC")->orderBy('time',"DESC")->get();
        $data['count'] =  ActivityLog::where('user_id',$user_id)->where('date',$search_date)->orderBy('date',"DESC")->orderBy('time',"DESC")->count();
        return view($this->path.'.load_activity',compact('data'));
    }

    public function getQuickMenu($data)
    {
        $menu = Menu::where('status',1)->where('menu_name_en','LIKE','%'.$data.'%')->orWhere('menu_name_bn','LIKE','%'.$data.'%')->where('type','!=','1')->get();
        return view($this->path.'.get_quick_menu',compact('menu'));
    }

    public function checkingOtp($otp,$email)
    {
        // return $otp;
        // return $email;
        $session_id = Session::getId();
        $checkHasAnyOtp = UserPassOtp::hasAnyOtp($email,$otp,$session_id);
        if($checkHasAnyOtp)
        {
            $checkTime = UserPassOtp::checkTime($email,$otp,$session_id);
            if($checkTime == true)
            {
                // UserPassOtp::Verify($email,$otp,$session_id);
                return 1; //if true
            }
            else
            {
                return 2; //if expired
            }
        }
        else
        {
            return 0; //if not matched
        }

    }
}
