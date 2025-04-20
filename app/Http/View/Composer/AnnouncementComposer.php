<?php

namespace App\Http\View\Composers;

use App\Models\Announcement;
use Illuminate\View\View;

class AnnouncementComposer
{
    /**
     * Bind data ke view
     */
    public function compose(View $view)
    {
        // Ambil 5 pengumuman terbaru
        $announcements = Announcement::latest()
            ->take(5)
            ->get();

        // Jika ingin caching (opsional)
        // $announcements = cache()->remember('latest_announcements', 3600, function () {
        //     return Announcement::latest()->take(5)->get();
        // });

        $view->with('announcements', $announcements);
    }
}