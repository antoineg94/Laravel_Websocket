<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LumiereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            $lumiere = new Lumiere();
            $lumiere->device_id = $request->device_id;

            $lumiere->save();
        }
        catch (\Exception $e) {
            return redirect()->back()->with('errors', 'Error saving Lumiere data');
        }
        finally {
            return redirect()->route('profile.edit')->with('status', 'Lumiere saved successfully');

        }
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
