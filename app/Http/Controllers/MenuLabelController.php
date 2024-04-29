<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MenuLabelRequest;
use App\Interfaces\MenuLabelInterface;
use App\Models\MenuLabel;

class MenuLabelController extends Controller
{
    public $path;

    protected $interface;

    public function __construct(MenuLabelInterface $interface)
    {
        $this->interface = $interface;
        $this->middleware(['permission:Menu Label index'])->only(['index']);
        $this->middleware(['permission:Menu Label create'])->only(['create']);
        $this->middleware(['permission:Menu Label show'])->only(['show']);
        $this->middleware(['permission:Menu Label edit'])->only(['edit']);
        $this->middleware(['permission:Menu Label destroy'])->only(['destroy']);
        $this->middleware(['permission:Menu Label trash'])->only(['trash_list']);
        $this->middleware(['permission:Menu Label restore'])->only(['restore']);
        $this->middleware(['permission:Menu Label properties'])->only(['properties']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $datatable ='';
        if($request->ajax()){
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
    public function store(MenuLabelRequest $request)
    {
        return $this->interface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        return $this->interface->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // return $id;
        return $this->interface->destroy($id);
    }

    /*
        To Restore the destoryed data...
    */

    public function restore($id)
    {
        return $this->interface->restore($id);
    }

    /*
        To Delete the destoryed data...
    */
    public function delete($id)
    {
        return $this->interface->delete($id);
    }

    /*
        To Get properties of data;
    */
    public function properties($id)
    {
        return $this->interface->properties($id);
    }
}
