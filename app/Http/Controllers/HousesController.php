<?php

namespace App\Http\Controllers;

use App\User;
use App\House;
use Illuminate\Http\Request;
use App\Http\Requests\HouseRequest;


class HousesController extends Controller
{
     public function __construct()
    {
        parent::__construct();

        $this->middleware('auth', ['except' => ['index', 'show']]);

        $this->middleware('seller', ['only' => ['create']]);
    }

    public function index($type)
    {
    	$houses = House::ofType($type)->where('status', 'available')->get();

    	return view('houses.index', compact('houses', 'type'));
    }

    public function create($type)
    {
        $agents = User::where('type', 'agent')->select('name', 'id')->get();

        return view('houses.create', compact('agents', 'type'));
    }

    public function store($type, HouseRequest $request)
    {
    	House::create($request->all());

    	flash()->success('Your request has been sent!', 'Please wait for the authentication.');

    	return redirect()->back();
    }

    public function show($type, $id)
    {
    	$house = House::ofType($type)->find($id);

    	return view('houses.show', compact('house', 'type'));
    }

    public function edit($type, $id)
    {
    	$house = House::ofType($type)->find($id);

    	return view('houses.edit', compact('house', 'type'));
    }

    public function update($type, $id, Request $request)
    {
    	$house = House::ofType($type)->find($id);

    	$house->update($request->all());

        flash()->success('Success', 'House information updated!');

    	return redirect()->back();
    }
}
