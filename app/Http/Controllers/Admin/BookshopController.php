<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookShop;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book_shops = BookShop::all();
        return view('admin.book_shop.book_shop', compact('book_shops'));
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
            'shop_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required'
        ]);

        $logo = null;
        if ($request->has('logo')) {
            $request->validate([
                'logo' => 'required | image | max:50'
            ]);
            $logo = $request->file('logo')->store('shop_logo');
        }

        BookShop::create([
            'shop_name' => $request->shop_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'logo' => $logo
        ]);

        Toastr::success('Book shop Created Successfully', 'Success');
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
        $book_shop = BookShop::findOrFail($id);
        $request->validate([
            'shop_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required'
        ]);

        $logo = $book_shop->logo;
        if ($request->has('logo')) {
            $request->validate([
                'logo' => 'required | image | max:50'
            ]);
            !is_null($book_shop->logo) && Storage::delete($book_shop->logo);
            $logo = $request->file('logo')->store('shop_logo');
        }

        $book_shop->update([
            'shop_name' => $request->shop_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'logo' => $logo
        ]);

        Toastr::success('Book shop Updated Successfully', 'Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book_shop = BookShop::findOrFail($id);
        !is_null($book_shop->logo) && Storage::delete($book_shop->logo);

        $book_shop->delete();

        Toastr::success('Book shop Deleted!!', 'Success');
        return back();
    }
}