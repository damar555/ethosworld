<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a view of the resource.
     */
    public function index()
    {
        return view('category/index');
    }

    /**
     * Display a listing of the resource.
     */
    public function listCategory()
    {
        $data = Category::all();
        return view('category/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data = Category::create($request->all());
        // return redirect()->route('kategori')->with('Succes', 'Data Berhasil Ditambahkan');
        
        // mapping request
        // $data['_token'] = csrf_token();
        // $data['title'] = $request->title;
        Category::create($request->all());
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
