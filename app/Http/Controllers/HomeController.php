<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Program;
use App\Models\Video;
use App\Models\Galeri;
use App\Models\Article;

class HomeController extends Controller
{
    // Method untuk halaman home (landing page)
    public function index()
    {
        $announcements = Announcement::latest()->take(5)->get();
        $programs = Program::latest()->get();
        $videos = Video::latest()->get();
        $galleries = Galeri::latest()->get();
        $articles = Article::latest()->take(3)->get();

        return view('home', compact(
            'announcements',
            'programs',
            'videos',
            'galleries',
            'articles'
        ));
    }

    // Method untuk halaman artikel (public)
    public function artikel()
    {
        $featuredArticle = Article::latest()->first();
        $articles = Article::latest()->paginate(6);
        $categories = Article::distinct()->pluck('category');
        
        return view('partials.artikel', compact('articles',  'featuredArticle', 'categories'));
    }

    // Method untuk menampilkan video berdasarkan kategori
    public function showVideosByCategory($category)
    {
        // Ambil video berdasarkan kategori
        $videos = Video::where('category', $category)
                       ->orderBy('date', 'desc')
                       ->get();

        // Tampilkan view sesuai kategori
        return view('kajian.' . $category, compact('videos'));
    }
}