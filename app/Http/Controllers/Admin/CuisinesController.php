<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCuisineRequest;
use App\Http\Requests\StoreCuisineRequest;
use App\Http\Requests\UpdateCuisineRequest;
use App\Models\Cuisine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CuisinesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cuisine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuisines = Cuisine::all();

        return view('admin.cuisines.index', compact('cuisines'));
    }

    public function create()
    {
        abort_if(Gate::denies('cuisine_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cuisines.create');
    }

    public function store(StoreCuisineRequest $request)
    {
        $cuisine = Cuisine::create($request->all());

        return redirect()->route('admin.cuisines.index');
    }

    public function edit(Cuisine $cuisine)
    {
        abort_if(Gate::denies('cuisine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cuisines.edit', compact('cuisine'));
    }

    public function update(UpdateCuisineRequest $request, Cuisine $cuisine)
    {
        $cuisine->update($request->all());

        return redirect()->route('admin.cuisines.index');
    }

    public function show(Cuisine $cuisine)
    {
        abort_if(Gate::denies('cuisine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuisine->load('cuisineFoodTrucks');

        return view('admin.cuisines.show', compact('cuisine'));
    }

    public function destroy(Cuisine $cuisine)
    {
        abort_if(Gate::denies('cuisine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuisine->delete();

        return back();
    }

    public function massDestroy(MassDestroyCuisineRequest $request)
    {
        Cuisine::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
