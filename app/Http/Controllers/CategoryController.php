<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchCategory(Request $request)
    {
        $search = $request->search;

        $categories = Category::where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('categories.index', compact('categories', 'search'));
    }

    public function index()
    {
        $categories = Category::all();
        $user = auth()->user();
        return view('categories.index', compact('categories', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());


        $request->validate([
            'name'          => 'required|max:255',
            'description'   => 'required',
            'image'         => 'required|max:10000',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/categories', 'public');
        }
        $category = Category::create([
            'image'             =>      $imagePath,
            'name'              =>      $request->name,
            'description'      =>       $request->description,

        ]);

        $log_entry = Auth::user()->name . " added a new category name: " . $category->name . " with the id# " . $category->id;
        event(new UserLog($log_entry));

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id . '|max:255',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif', // Add image validation rules
            // Add any other validation rules you need
        ]);

        // If a new image is uploaded, delete the old image and upload the new one
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($category->image);

            $imagePath = $request->file('image')->store('images/categories', 'public');
        } else {
            // If no new image is uploaded, keep the existing image path
            $imagePath = $category->image;
        }

        // Update the category with the new data
        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath,
        ]);


        $log_entry = Auth::user()->name . " updated an category name: " . $category->name . " with the id# " . $category->id;
        event(new UserLog($log_entry));

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $log_entry = Auth::user()->name . " deleted the category name: " . $category->name . " with the id# " . $category->id;
        event(new UserLog($log_entry));

        Storage::disk('public')->delete($category->image);
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
