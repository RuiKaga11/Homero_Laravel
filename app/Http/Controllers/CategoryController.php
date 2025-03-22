<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * カテゴリ一覧表示
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * 新規作成フォーム表示
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * 新規カテゴリの保存
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50|unique:categories',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index');
    }

    /**
     * 編集フォーム表示
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * カテゴリの更新
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:50|unique:categories,name,' . $category->id,
        ]);

        $category->update($validated);

        return redirect()->route('categories.index');
    }

    /**
     * カテゴリの削除
     */
    public function destroy(Category $category)
    {
        // カテゴリに関連するツイートがないか確認
        if ($category->tweets()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'このカテゴリは使用中のため削除できません');
        }

        $category->delete();

        return redirect()->route('categories.index');
    }
}
