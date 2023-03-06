<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = News::all();
        return view('news/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('news/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = News::create($request->all());
        // if($request->hasFile('image')){
        //     $request->file('image')->move('foto/', $request->file('image')->getClientOriginalName());
        //     $data->foto = $request->file('image')->getClientOriginalName();
        //     $data->save();
        // }
        return redirect()->route('news')->with('Succes', 'Data Berhasil Ditambahkan');
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
        $data = News::find($id);
        return view('news/edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = News::find($id);
        $data->update($request->all());

        return redirect()->route('news')->with('success', "Data has been modified");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = News::find($id);
        $data->delete();
        return redirect()->route('news')->with('success', "Data has been deleted");
    }
}
