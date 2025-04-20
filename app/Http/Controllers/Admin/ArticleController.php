<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // ArticleController.php
    public function index()
    {
        $featuredArticle = Article::latest()->first();
        $articles = Article::latest()->paginate(6);
        $categories = Article::distinct()->pluck('category');

        return view('admin.articles.index', compact('articles', 'featuredArticle', 'categories'));
    }

    // Tampilkan form buat artikel baru
    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        // Debugging: Cek data request
        logger($request->all());
    
        // Validasi
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);
    
        // Upload gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }
    
        // Buat slug
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
    
        while (Article::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
    
        // Simpan artikel
        Article::create([
            'title' => $request->title,
            'slug' => $slug,
            'category' => $request->category,
            'content' => $request->content,
            'image' => $imagePath,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
    
        // Redirect
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan!');
    }
    
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $featuredArticle = Article::latest()->first();
        $articles = Article::latest()->paginate(6);
        return view('articles.show', compact('article', 'featuredArticle', 'articles'));
    }
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    // Update artikel
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $imagePath = $article->image;
        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        $slug = $article->slug;
        if ($request->title !== $article->title) {
            $slug = Str::slug($request->title);
            $count = Article::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
        }

        // Update artikel
        $article->update([
            'title' => $request->title,
            'slug' => $slug,
            'category' => $request->category,
            'content' => $request->content,
            'image' => $imagePath,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diupdate!');
    }

    // Hapus artikel
    public function destroy(Article $article)
    {
        // Hapus gambar
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}