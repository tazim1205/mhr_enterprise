<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student_admission;
use Auth;
use DataTables;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class AdmissionDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = student_admission::all();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('course',function($row){
                    if($row->course == 1)
                    {
                        return 'Basic Computer';
                    }
                    elseif($row->course == 2)
                    {
                        return 'Professional Graphic Design';
                    }
                    elseif($row->course == 3)
                    {
                        return 'Web Design';
                    }
                    elseif($row->course == 4)
                    {
                        return 'Web Development';
                    }
                    elseif($row->course == 5)
                    {
                        return 'Android App Development';
                    }
                    elseif($row->course == 6)
                    {
                        return 'Search Engine Optimization (SEO)';
                    }
                })
                ->addColumn('course_type',function($row){
                    if($row->course_type == 1)
                    {
                        return 'Industrial';
                    }
                    elseif($row->course_type == 2)
                    {
                        return 'Regular';
                    }
                })
                ->addColumn('read',function($row)
                {
                    if($row->read == 1)
                    {
                        return '<span class="badge bg-success rounded-pill">Checked</span>';
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
                        <a href="'.route('admission_data.show',$row->id).'" class="dropdown-item" id="view_admission_data"><i class="fa fa-eye"></i> View Admission Data</a>
                            <form action="'.route('admission_data.destroy',$row->id).'" method="post">
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
        return view('backend.admission_data.index');
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
        $update = student_admission::find($id)->update([
            'read'=>1,
            'read_by'=>Auth::user()->id,
        ]);
        $data = student_admission::find($id);
        return view('backend.admission_data.show',compact('data'));
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
        //
    }
}
