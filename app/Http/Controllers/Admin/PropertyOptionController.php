<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyOptionRequest;
use App\Models\Property;
use App\Models\PropertyOption;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PropertyOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Property $property
     * @return Application|Factory|View
     */
    public function index(Property $property)
    {
        $propertyOptions = $property->propertyOptions()->paginate(10);

        return view('auth.property-options.index', compact('property', 'propertyOptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Property $property
     * @return Application|Factory|View
     */
    public function create(Property $property)
    {
        return view('auth.property-options.form', compact('property'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PropertyOptionRequest $request
     * @param Property $property
     * @return RedirectResponse
     */
    public function store(PropertyOptionRequest $request, Property $property)
    {
        $params = $request->all();
        $params['property_id'] = $property->id;
        PropertyOption::create($params);
        return redirect()->route('property-options.index', compact('property'));
    }

    /**
     * Display the specified resource.
     *
     * @param Property $property
     * @param PropertyOption $propertyOption
     * @return Application|Factory|View
     */
    public function show(Property $property, PropertyOption $propertyOption)
    {
        return view('auth.property-options.show', compact('property', 'propertyOption'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Property $property
     * @param PropertyOption $propertyOption
     * @return Application|Factory|View
     */
    public function edit(Property $property, PropertyOption $propertyOption)
    {
        return view('auth.property-options.form', compact('property', 'propertyOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Property $property
     * @param PropertyOptionRequest $request
     * @param PropertyOption $propertyOption
     * @return RedirectResponse
     */
    public function update(PropertyOptionRequest $request, Property $property, PropertyOption $propertyOption)
    {
        $propertyOption->update($request->all());
        return redirect()->route('property-options.index', compact('property'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Property $property
     * @param PropertyOption $propertyOption
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Property $property, PropertyOption $propertyOption)
    {
        $propertyOption->delete();
        return redirect()->route('property-options.index', compact('property'));
    }
}
