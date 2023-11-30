<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.category.category',compact('categories'));
    }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'category_name' => 'required|string|max:255',
        'category_img' => 'required|mimes:jpg,jpeg,png'
    ],[

        'category_img.mimes' => 'required| file extension: jpg, jpeg or png'

    
    ]);

    $createimg = $request -> file('category_img');
    $filenameimg = $createimg -> getClientOriginalName();
    $folderimg = '/categoryimg/';
    $path = $createimg->storeAs($folderimg, $filenameimg, 'public');
    

    Category::create([
        'category_name' => $validatedData['category_name'],
        'user_id' => auth()->id(), 
        'category_img' => $path
    ]);

    return redirect()->route('AllCat')->with('success', 'Category created successfully.');
}

public function edit($id)
{
    $category = Category::findOrFail($id);
    return view('admin.category.edit', compact('category'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'category_name' => 'required|string|max:255',
    ]);

    $category = Category::findOrFail($id);
    $category->update([
        'category_name' => $validatedData['category_name'],
    ]);

    return redirect()->route('AllCat')->with('success', 'Category updated successfully.');
}

public function destroy($id)
{
    $category = Category::findOrFail($id);
    $category->delete();

    return redirect()->route('AllCat')->with('success', 'Category deleted successfully.');
}



}
