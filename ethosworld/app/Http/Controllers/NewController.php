<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\News;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();
        $categories = Category::all();
        $data = array(
            'news' => $news,
            'categories' => $categories
        );
        return view('news/index', $data );
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('news/create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = News::create($request->all());
        if($request->hasFile('image')){
            $originalNameImg = $request->file('image')->getClientOriginalName();
            $request->file('image')->move('images/news/', $originalNameImg);
            $data->image = $originalNameImg;
            $data->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'News created successfully!'
        ]);
        // return redirect()->route('news')->with('Success', 'Data has been created');
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
        $data = News::findOrFail($id, ['id','title','category_id','image','description']);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = News::findOrFail($id);
        $data->title = $request->title;
        $data->category_id = $request->category_id;
        $data->description = $request->description;
        
        // if($request->hasFile('image')){
        //     $originalNameImg = $request->file('image')->getClientOriginalName();
        //     $request->file('image')->move('images/news/', $originalNameImg);
        //     $data->image = $originalNameImg;
        // }

        $data->save();

        return response()->json(['success'=>true]);    
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
