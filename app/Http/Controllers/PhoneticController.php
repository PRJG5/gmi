<?php

namespace App\Http\Controllers;

use App\Phonetic;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;

class PhoneticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  Phonetic  $phonetic
     * @return Response
     */
    public function show(Phonetic $phonetic)
    {
        return;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Phonetic  $phonetic
     * @return Response
     */
    public function edit(Phonetic $phonetic)
    {
        return;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Phonetic  $phonetic
     * @return Response
     */
    public function update(Request $request, Phonetic $phonetic)
    {
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Phonetic  $phonetic
     * @return Response
     */
    public function destroy(Phonetic $phonetic)
    {
        return;
    }

    /**
     * Validates the data recieved.
     * @param Request the request to validate
     * @return array the validated data in a phonetic object.
     * @author 44424
     */
    private function validateData(Request $request)
    {
        return $request->validate([
            'textDescription' => 'required'
        ]);
    }
}
