<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventReviewResource;
use App\Http\Resources\EventReviewResourceCollection;
use App\Http\Resources\UserResource;
use App\Models\EventReview;
use App\Models\User;
use Illuminate\Http\Request;

class EventReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return EventReviewResourceCollection
     */
    public function index()
    {
        return new EventReviewResourceCollection(EventReview::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return EventReviewResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'review_content'=> 'required',
            'event_rating'=> 'required'
        ]);

        $eventReview = EventReview::create($request->all());

        return new EventReviewResource($eventReview);
    }

    /**
     * Display the specified resource.
     *
     * @param EventReview $eventReview
     * @return EventReviewResource
     */
    public function show(EventReview $eventReview): EventReviewResource
    {
        return new EventReviewResource($eventReview);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param EventReview $eventReview
     * @return EventReviewResource
     */
    public function update(Request $request, EventReview $eventReview): EventReviewResource
    {
        $request->validate([
            'review_content'=> 'required',
            'event_rating'=> 'required'
        ]);

        $eventReview ->update($request->all());

        return new EventReviewResource($eventReview);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
