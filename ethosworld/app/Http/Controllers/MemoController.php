<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\News;
use App\Models\Category;



class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Memo::all();
        return view('memo/index_memo', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('memo/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if ($request) {
            Memo::create($request->all());
            echo json_encode(['code' => 200, 'status' => 'success', 'message' => 'Success Add']);
        } else {
            echo json_encode(['code' => 400, 'status' => 'error', 'message' => 'Error Add']);
        }
        // $data = Memo::create($request->all());
        // return redirect()->route('memo')->with('Succes', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $data = Memo::findOrFail($id, ['title','from_who','to_who','subject','description']);
        // return response()->json($data);
        // $data = Memo::findorfail($id);
        // return view('memo/index_memo')->with([
        //     'data' => $data
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Memo::findOrFail($id, ['id','title','from_who','to_who','subject','description']);
        return response()->json($data);
        // $data = Memo::find($id);
        // return view('memo/edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Memo::findOrFail($id);
        $data->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Memo::findOrFail($id);
        $data->delete();
    }
}
