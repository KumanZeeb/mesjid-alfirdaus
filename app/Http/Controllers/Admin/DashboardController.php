<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Announcement;
use App\Models\Program;
use App\Models\Galeri;
use App\Models\Video;
use App\Models\ItikafForm;

class DashboardController extends Controller
{
    public function index()
    {
        $totalArticles = Article::count();
        $totalAnnouncements = Announcement::count();
        $totalPrograms = Program::count();
        $totalGalleries = Galeri::count();
        $totalVideos = Video::count();
        $totalItikaf = ItikafForm::count();

        return view('admin.dashboard', compact(
            'totalArticles',
            'totalAnnouncements',
            'totalPrograms',
            'totalGalleries',
            'totalVideos',
            'totalItikaf'

        ));
    }
}