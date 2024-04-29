<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\message;
use Auth;
use DataTables;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = message::all();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('read',function($row)
                {
                    if($row->read == 1)
                    {
                        return '<span class="badge bg-success rounded-pill">Read</span>';
                    }
                    else
                    {
                        return '<span class="badge bg-danger rounded-pill">Draft</span>';
                    }
                })
                ->addColumn('read_by',function($row)
                {
                    if($row->read_by != NULL)
                    {
                        $reader = DB::table('users')->where('id',$row->read_by)->first();

                        return '<b>'.$reader->name.'</b>';
                    }
                })
                ->addColumn('action', function($row)
                {
                    $btn = '<div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a href="'.route('messages.show',$row->id).'" class="dropdown-item" id="view_message"><i class="fa fa-eye"></i> View Message</a>
                            <form action="'.route('messages.destroy',$row->id).'" method="post">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button onclick="return Confirm()" type="submit" class="dropdown-item text-danger"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>';
                    return $btn;
                })
                ->rawColumns(['action','read','read_by'])
                ->make(true);


        }
        return view('backend.messages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $update = message::find($id)->update([
            'read'=>1,
            'read_by'=>Auth::user()->id,
        ]);
        $data = message::find($id);
        return view('backend.messages.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        message::find($id)->delete();

        Toastr::success('Message Delete Successfully', 'Error');
        return redirect(route('messages.index'));
    }

    public function retrive_message($id)
    {
        message::withTrashed()->find($id)->restore();

        Toastr::success('Message Retrive Successfullly', 'Success');
            return redirect(route('messages.index'));
    }

    public function permenantMessageDelete($id)
    {
        $delete = message::withTrashed()->find($id)->forceDelete();
        Toastr::success('Message Permenantly Delete Successfullly', 'Success');
            return redirect(route('messages.index'));
    }
}
