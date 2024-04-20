<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    //
    public function index()
    {
        return view('category.category', [
            "title" => "Kategori",
            "data" => Category::all()

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
