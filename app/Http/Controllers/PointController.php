<?php

namespace App\Http\Controllers;

use App\Point;
use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function getPointsForOne()
    {
        return response()->json(Point::pluck('points_for_one', 'currency'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'currency' => 'required|string|size:3',
            'points' => 'required|integer|min:1',
        ]);


        Point::create([
            'currency' => strtoupper($request->input('currency')),
            'points_for_one' => $request->input('points'),
        ]);

        return redirect()->back()->with('success', 'Currency and points added successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Point $point)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'currency' => 'required|string|max:255',
            'points' => 'required|integer',
        ]);

        $point = Point::findOrFail($id);
        $point->currency = strtoupper($request->currency);
        $point->points_for_one = $request->points;
        $point->save();

        return redirect()->route('setting.index')->with('success', 'Point updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $point = Point::findOrFail($id);
        $point->delete();
        return redirect()->route('setting.index')->with('delete', 'Point deleted successfully.');
    }
}
