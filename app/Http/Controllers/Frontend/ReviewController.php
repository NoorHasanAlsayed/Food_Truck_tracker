<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReviewRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\FoodTruck;
use App\Models\Review;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reviews = Review::with(['user', 'truck'])->get();

        return view('frontend.reviews.index', compact('reviews'));
    }

    public function create()
    {
         abort_if(Gate::denies('review_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trucks = FoodTruck::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.reviews.create', compact('users', 'trucks'));
    }

    public function store(StoreReviewRequest $request)
    {

        $reviews=Review::where('truck_id',$request->truck_id)->where('user_id',Auth::user()->id)->count();
        if($reviews>=2){
            return redirect()->back()->with('message',"you have reach maximum reviews for this truck");
        }
        $review = Review::create($request->all());

         return redirect()->back();
    }

    public function edit(Review $review)
    {
        abort_if(Gate::denies('review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trucks = FoodTruck::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $review->load('user', 'truck');

        return view('frontend.reviews.edit', compact('users', 'trucks', 'review'));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->all());

        return redirect()->route('frontend.reviews.index');
    }

    public function show(Review $review)
    {
        abort_if(Gate::denies('review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->load('user', 'truck');

        return view('frontend.reviews.show', compact('review'));
    }

    public function destroy(Review $review)
    {
        abort_if(Gate::denies('review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->delete();

        return back();
    }

    public function massDestroy(MassDestroyReviewRequest $request)
    {
        Review::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
