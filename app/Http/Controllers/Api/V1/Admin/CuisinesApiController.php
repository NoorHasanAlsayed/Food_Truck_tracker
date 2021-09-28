<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCuisineRequest;
use App\Http\Requests\UpdateCuisineRequest;
use App\Http\Resources\Admin\CuisineResource;
use App\Models\Cuisine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CuisinesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cuisine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CuisineResource(Cuisine::all());
    }

    public function store(StoreCuisineRequest $request)
    {
        $cuisine = Cuisine::create($request->all());

        return (new CuisineResource($cuisine))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Cuisine $cuisine)
    {
        abort_if(Gate::denies('cuisine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CuisineResource($cuisine);
    }

    public function update(UpdateCuisineRequest $request, Cuisine $cuisine)
    {
        $cuisine->update($request->all());

        return (new CuisineResource($cuisine))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Cuisine $cuisine)
    {
        abort_if(Gate::denies('cuisine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuisine->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
