<?php
namespace App\Exports;

use App\Models\ItikafForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItikafExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama',
            'Umur',
            'Alamat',
            'Tanggal Masuk',
            'Tanggal Keluar',
        ];
    }
}