<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\SoftwareSettingsInterface;

class SoftwareSettingsController extends Controller
{
    public $interface;
    public function __construct(SoftwareSettingsInterface $interface)
    {
        $this->interface = $interface;
        $this->middleware(['permission:Software Info create'])->only(['create']);
        $this->middleware(['permission:Software Info index'])->only(['index']);
        // $this->middleware(['permission:Role edit'])->only(['edit']);
        // $this->middleware(['permission:Role destroy'])->only(['destroy']);
        // $this->middleware(['permission:Role trash'])->only(['trash_list']);
        // $this->middleware(['permission:Role restore'])->only(['restore']);
        // $this->middleware(['permission:Role properties'])->only(['properties']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $datatable = '';
        if($request->ajax())
        {
            $datatable =1;
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
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->interface->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
