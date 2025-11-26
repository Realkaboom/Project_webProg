<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable|string',
        ]);

        category::create($data);

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        $category = category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = category::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable|string',
        ]);

        $category->update($data);

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        category::destroy($id);
        return redirect()->route('categories.index');
    }
}
