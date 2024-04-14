<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.category', [
            "title" => "Kategori",
            "data" => category::all()
        ]);
    }

    public function store(Request $request): RedirectResponse
{
        $request->validate([
            "name" => "required",
            "description" => "nullable",
        ]);

        Category::create($request->all());

        return redirect()->route('kategori.index')->with('success','Kategori Berhasil Ditambahkan.');
}


    public function edit(Category $kategori): View
    {
        return view('category.edit', compact('kategori'))->with(["title" => "Edit Kategori"]);
    }

    public function update(Request $request, Category $kategori):RedirectResponse
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
        ]);

        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('updated','Kategori Berhasil Diubah.');
    }

}
