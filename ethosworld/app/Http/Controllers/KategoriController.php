<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::all();
        return view('kategori/index_kategori', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = Category::create($request->all());
        // if($request->hasFile('image')){
        //     $request->file('image')->move('foto/', $request->file('image')->getClientOriginalName());
        //     $data->image = $request->file('image')->getClientOriginalName();
        //     $data->save();
        // }
        return redirect()->route('kategori')->with('Succes', 'Data Berhasil Ditambahkan');
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
        $data = Category::find($id);
        return view('kategori/edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Category::find($id);
        $data->update($request->all());

        return redirect()->route('kategori')->with('success', "Data has been modified");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->route('kategori')->with('success', "Data has been deleted");
    }
}
