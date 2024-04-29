<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserEditHistory;
use App\Models\UserDeleteHistory;
use App\Models\UserRestoreHistory;
use App\Interfaces\UserInterface;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ChangePass;
use Spatie\Permission\Models\Role;
use Auth;

class UserController extends Controller
{
    protected $interface;
    protected $path;

    public function __construct(UserInterface $interface)
    {
        $this->interface = $interface;
        $this->middleware(['permission:Admin index'])->only(['index']);
        $this->middleware(['permission:Admin create'])->only(['create']);
        $this->middleware(['permission:Admin show'])->only(['show']);
        $this->middleware(['permission:Admin edit'])->only(['edit']);
        $this->middleware(['permission:Admin destroy'])->only(['destroy']);
        $this->middleware(['permission:Admin trash'])->only(['trash_list']);
        $this->middleware(['permission:Admin restore'])->only(['restore']);
        $this->middleware(['permission:Admin properties'])->only(['properties']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $datatable = '';
        if($request->ajax())
        {
            $datatable = 1;
        }

        return $this->interface->index($datatable);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->interface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        return $this->interface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->interface->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->interface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        // dd($request->all());
        return $this->interface->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->interface->destroy($id);
    }

    public function user_image_upload(Request $request)
    {
        return $this->interface->user_image_upload($request);
    }

    public function trash_list(Request $request)
    {
        $datatable = '';
        if($request->ajax())
        {
            $datatable = 1;
        }
        return $this->interface->trash_list($datatable);
    }

    public function restore($id)
    {
        return $this->interface->restore($id);
    }

    public function delete($id)
    {
        return $this->interface->delete($id);
    }

    public function properties($id)
    {
        return $this->interface->properties($id);
    }

    public function reset_pass()
    {
        return $this->interface->reset_pass();
    }

    public function submit_email(Request $request)
    {
        $checkMail = User::checkHasMail($request->email);
        if($checkMail)
        {
            return $this->interface->send_otp($request);
        }
        else
        {
            toastr()->error( __('user.email_not_found'),__('common.error'));
            return redirect()->back();
        }
    }
    public function check_otp($email)
    {
        return $this->interface->check_otp($email);
    }

    public function resend_otp($email)
    {
        return $this->interface->resend_otp($email);
    }

    public function submit_otp(Request $request,$email)
    {
        return $this->interface->submit_otp($request,$email);
    }

    public function new_pass($email)
    {
        return $this->interface->new_pass($email);
    }

    public function submit_pass(ChangePass $request)
    {
        return $this->interface->submit_pass($request);
    }

    public function user_activity(Request $request)
    {
        return $this->interface->search_activity($request);
    }

    public function getQuickMenu(Request $request)
    {
        return $this->interface->getQuickMenu($request->data);
    }

    public function checkingOtp($otp,$email)
    {
        return $this->interface->checkingOtp($otp,$email);
    }
}
