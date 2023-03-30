<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Writer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $writers = Writer::all();
        return view('admin.writer.writer', compact('writers'));
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
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'description' => 'required',
            'writers_speech' => 'required',
        ]);

        if($request->has('profile_picture')){
            $request->validate([
                'profile_picture' => 'image | max: 200'
            ]);
            $profile_picture = $request->file('profile_picture')->store('writer_profile');
        }


        $writer = Writer::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'description' => $request->description,
            'profile_picture' => $profile_picture,
            'writers_speech' => $request->writers_speech
        ]);

        $slug = Str::slug($request->name);
        if (Writer::where('slug', $slug)->exists()) {
            $slug.= '-'. $writer->id;
        }

        $writer->slug = $slug;
        $writer->save();

        Toastr::success('Writer Created successfully', 'Success');
        return back();
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
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'description' => 'required',
            'writers_speech' => 'required',
        ]);

        $writer = Writer::findOrFail($id);
        $profile_picture = $writer->profile_picture;
        if ($request->has('profile_picture')) {
            $request->validate([
                'profile_picture' => 'image | max: 200'
            ]);
            !is_Null($writer->profile_picture) && Storage::delete($writer->profile_picture);
            $profile_picture = $request->file('profile_picture')->store('writer_profile');
        }

        $writer->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'designation' => $request->designation,
            'description' => $request->description,
            'profile_picture' => $profile_picture,
            'writers_speech' => $request->writers_speech
        ]);

        if($writer->slug == null){
            $slug = Str::slug($request->name);
            if (Writer::where([['slug', $slug], ['id','!=', $writer->id]])->exists()) {
                $slug .= '-' . $writer->id;
            }

            $writer->slug = $slug;
            $writer->save();
        }

        Toastr::success('Writer Updated successfully', 'Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $writer = Writer::findOrFail($id);
        !is_null($writer->profile_picture) && Storage::delete($writer->profile_picture);

        $writer->delete();

        Toastr::success('Writer Deleted Successfully', 'DELETED');
        return back();
    }
}