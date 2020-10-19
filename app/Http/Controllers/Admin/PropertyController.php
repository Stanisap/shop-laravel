<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Models\Property;
use Exception as ExceptionAlias;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $properties = Property::paginate(10);
        return view('auth.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('auth.properties.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PropertyRequest $request
     * @return RedirectResponse
     */
    public function store(PropertyRequest $request)
    {
        Property::create($request->all());
        return redirect()->route('properties.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Property $property
     * @return Application|Factory|View
     */
    public function show(Property $property)
    {
        return view('auth.properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Property $property
     * @return Application|Factory|View
     */
    public function edit(Property $property)
    {
        return view('auth.properties.form', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PropertyRequest $request
     * @param Property $property
     * @return RedirectResponse
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $property->update($request->all());
        return redirect()->route('properties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Property $property
     * @return RedirectResponse
     * @throws ExceptionAlias
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('properties.index');
    }
}
