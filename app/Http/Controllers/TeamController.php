<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\TeamInterface;

class TeamController extends Controller
{
    protected $interface;

    public function __construct(TeamInterface $interface)
    {
        $this->interface = $interface;
        $this->middleware(['permission:Team index'])->only(['index']);
        $this->middleware(['permission:Team create'])->only(['create']);
        $this->middleware(['permission:Team show'])->only(['show']);
        $this->middleware(['permission:Team edit'])->only(['edit']);
        $this->middleware(['permission:Team destroy'])->only(['destroy']);
        $this->middleware(['permission:Team trash'])->only(['trash_list']);
        $this->middleware(['permission:Team restore'])->only(['restore']);
        $this->middleware(['permission:Team properties'])->only(['properties']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
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
