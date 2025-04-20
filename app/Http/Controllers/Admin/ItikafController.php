<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItikafForm;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;

class ItikafController extends Controller
{
    public function index()
    {
        $itikafs = ItikafForm::paginate(10);
        return view('admin.itikaf.index', compact('itikafs'));
    }

    public function show($id)
    {
        Log::info('Fetching ItikafForm with ID:', ['id' => $id]);

        $itikaf = ItikafForm::find($id);

        if (!$itikaf) {
            Log::error('ItikafForm not found:', ['id' => $id]);
            return response()->json(['message' => 'Data not found'], 404);
        }

        Log::info('ItikafForm data:', $itikaf->toArray());

        return response()->json([
            'id' => $itikaf->id,
            'nama_lengkap' => $itikaf->nama_lengkap,
            'umur' => $itikaf->umur,
            'alamat' => $itikaf->alamat,
            'tanggal_masuk' => $itikaf->tanggal_masuk,
            'tanggal_keluar' => $itikaf->tanggal_keluar
        ]);
    }

    public function download($format)
    {
        $data = ItikafForm::all();

        switch ($format) {
            case 'pdf':
                return $this->downloadPDF($data);
            case 'xls':
                return $this->downloadExcel($data);
            case 'image':
                return $this->downloadImage($data);
            default:
                return redirect()->back()->with('error', 'Format tidak valid');
        }
    }

    // PDF langsung tanpa view
    private function downloadPDF($data)
    {
        $html = '<h2>Data I\'tikaf</h2><table border="1" cellspacing="0" cellpadding="5"><tr><th>No</th><th>Nama</th><th>Umur</th><th>Alamat</th><th>Tgl Masuk</th><th>Tgl Keluar</th></tr>';

        foreach ($data as $i => $item) {
            $html .= '<tr>
                        <td>' . ($i + 1) . '</td>
                        <td>' . $item->nama_lengkap . '</td>
                        <td>' . $item->umur . '</td>
                        <td>' . $item->alamat . '</td>
                        <td>' . $item->tanggal_masuk . '</td>
                        <td>' . $item->tanggal_keluar . '</td>
                      </tr>';
        }

        $html .= '</table>';

        $pdf = Pdf::loadHTML($html);
        return $pdf->download('itikaf-data.pdf');
    }

    // Excel langsung tanpa view
    private function downloadExcel($data)
    {
        $header = ['No', 'Nama Lengkap', 'Umur', 'Alamat', 'Tanggal Masuk', 'Tanggal Keluar'];
        $rows = [];

        foreach ($data as $i => $item) {
            $rows[] = [
                $i + 1,
                $item->nama_lengkap,
                $item->umur,
                $item->alamat,
                $item->tanggal_masuk,
                $item->tanggal_keluar
            ];
        }

        $export = new class($header, $rows) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $header, $rows;
            public function __construct($header, $rows)
            {
                $this->header = $header;
                $this->rows = $rows;
            }

            public function array(): array
            {
                return array_merge([$this->header], $this->rows);
            }
        };

        return Excel::download($export, 'itikaf-data.xlsx'); 
    }

    // Image langsung tanpa font custom
    private function downloadImage($data)
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->create(1000, max(600, 70 + count($data) * 30))->fill('#ffffff');

        $image->text('Data I\'tikaf', 50, 30, function ($font) {
            $font->size(20);
            $font->color('#000000');
        });

        $y = 70;
        foreach ($data as $i => $item) {
            $text = ($i + 1) . '. ' . $item->nama_lengkap . ' | ' . $item->umur . 'th | ' . $item->alamat;
            $image->text($text, 50, $y, function ($font) {
                $font->size(14);
                $font->color('#333333');
            });
            $y += 30;
        }

        return response()->streamDownload(function () use ($image) {
            echo $image->encode('png');
        }, 'itikaf-data.png');
    }
}
