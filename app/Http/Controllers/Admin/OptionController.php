<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.option.options');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $options = Option::all();
        foreach($options as $option){
            $field_name = $option->title;

            if($option->id == 4 || $option->id == 5){
                $this->uploadImage($option, $request);
                continue;
            }

            $option->update([
                'value' => $request->$field_name
            ]);
            // Option::where('title', $option->title)->update([
            //     'value' => $request->$field_name
            // ]);
        }


        Toastr::success('Updated Successfully', 'Success');
        return back();

    }

    public function uploadImage($option, $request) {

        if($option->title == "logo"){
            if($request->has('logo')){
                $request->validate([
                    'logo' => 'image | max:100'
                ]);
                Storage::delete($option->value);
                $logo = $request->file('logo')->store('options');
                $option->update([
                    'value' => $logo
                ]);
            }
        }
        if($option->title == "favicon"){
            if($request->has('favicon')){
                $request->validate([
                    'favicon' => 'image | max:10'
                ]);
                Storage::delete($option->value);
                $favicon = $request->file('favicon')->store('favicon');
                $option->update([
                    'value' => $favicon
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}