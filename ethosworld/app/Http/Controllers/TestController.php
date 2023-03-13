<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;


class TestController extends Controller
{
    public function index()
    {
        $news = News::all();
        $categories = Category::all();
        $data = array(
            'news' => $news,
            'categories' => $categories
        );
        return view('category.test', $data);
    }

    public function store(Request $request)
    {
        $news = new News;
        $news->title = $request->title;
        $news->category_id = $request->category_id;
        $news->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $news->image = $filename;
        }

        $news->save();

        return response()->json([
            'success' => true,
            'message' => 'News created successfully!'
        ]);
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $news->title = $request->title;
        $news->category_id = $request->category_id;
        $news->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $news->image = $filename;
        }

        $news->save();

        return response()->json([
            'success' => true,
            'message' => 'News updated successfully!'
        ]);
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return response()->json([
            'success' => true,
            'message' => 'News deleted successfully!'
            ]);
    }
}