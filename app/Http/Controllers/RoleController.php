<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\RoleInterface;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    protected $interface;
    public function __construct(RoleInterface $interface)
    {
        $this->interface = $interface;
        $this->middleware(['permission:Role index'])->only(['index']);
        $this->middleware(['permission:Role create'])->only(['create']);
        $this->middleware(['permission:Role show'])->only(['show']);
        $this->middleware(['permission:Role edit'])->only(['edit']);
        $this->middleware(['permission:Role destroy'])->only(['destroy']);
        $this->middleware(['permission:Role trash'])->only(['trash_list']);
        $this->middleware(['permission:Role restore'])->only(['restore']);
        $this->middleware(['permission:Role properties'])->only(['properties']);
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

    public function trash_list(Request $request)
    {
        $datatable = '';
        if($request->ajax())
        {
            $datatable = 1;
        }

        return $this->interface->trash_list($datatable);
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
    public function store(RoleRequest $request)
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
    public function update(RoleRequest $request,$id)
    {
        return $this->interface->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->interface->destroy($id);
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

    public function permission(Request $request,$id)
    {
        return $this->interface->permission($request,$id);
    }

}
