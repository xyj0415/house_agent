<?php

namespace App\Http\Controllers;

use Auth;
use User;
use House;
use Image;
use Message;
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

    protected static function get_house($type, $id)
    {
        return House::ofType($type)->find($id);
    }

    protected static function make_builder($builder, $request)
    {
        if ($request->input('selection') != 'all')
        {
            $builder = $builder->where('status', 'available');
        }
        if ($request->has('name'))
        {
            $builder = $builder->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->has('city'))
        {
            $builder = $builder->where('city', $request->input('city'));
        }
        if ($request->has('minarea'))
        {
            $builder = $builder->where('area', '>=', $request->input('minarea'));
        }
        if ($request->has('maxarea'))
        {
            $builder = $builder->where('area', '<=', $request->input('maxarea'));
        }
        if ($request->has('minprice'))
        {
            $builder = $builder->where('price', '>=', $request->input('minprice'));
        }
        if ($request->has('maxprice'))
        {
            $builder = $builder->where('price', '<=', $request->input('maxprice'));
        }
        return $builder;
    }

    public function index($type, Request $request)
    {
        $builder = House::ofType($type);

        $builder = self::make_builder($builder, $request);

    	$houses = $builder->get();

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

        messageGen()->house_authentication($request);

    	flash()->success('Your request has been sent!', 'Please wait for the authentication.');

    	return redirect()->back();
    }

    public function show($type, $id)
    {
        $house = self::get_house($type, $id);
        $images = Image::where('house_id', $id)->get();

    	return view('houses.show', compact('house', 'type', 'images'));
    }

    public function edit($type, $id)
    {
        $house = self::get_house($type, $id);

        if (Auth::user()->cannot('edit', $house))
        {
            flash()->error('Error!', 'You are not allowed to edit the information!');
            return redirect()->back();
        }

    	return view('houses.edit', compact('house', 'type'));
    }

    public function update($type, $id, Request $request)
    {
        $house = self::get_house($type, $id);

    	$house->update($request->all());

        flash()->success('Success', 'House information updated!');

    	return redirect()->back();
    }

    public function addPhoto($type, $id, Request $request)
    {
        $file = $request->file('file');

        $name = time() . $file->getClientOriginalName();

        $file->move('images', $name);

        $house = self::get_house($type, $id);

        $image = new Image;

        $image->house_id = $id;
        $image->path = '/images/' . $name;

        $image->save();

        return redirect()->back();
    }

    public function destroy($type, $id)
    {
        $house = self::get_house($type, $id);
        $house->update(['status' => 'removed']);

        return redirect()->back();
    }
}
