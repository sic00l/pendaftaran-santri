<?php

namespace App\Exports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SantriExport implements FromCollection, WithHeadings, WithMapping
{
    protected $status;
    protected $gelombang;
    protected $tahun;

    public function __construct($status = null, $gelombang = null, $tahun = null)
    {
        $this->status = $status;
        $this->gelombang = $gelombang;
        $this->tahun = $tahun;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Santri::query();

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->gelombang) {
            $query->where('gelombang', $this->gelombang);
        }

        if ($this->tahun) {
            $query->where('tahun_ajaran', $this->tahun);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Nomor Pendaftaran',
            'Nama Lengkap',
            'NIK',
            'Jenis Kelamin',
            'Asal Sekolah',
            'Nilai Rata-rata',
            'Status',
            'Tanggal Daftar',
        ];
    }

    public function map($santri): array
    {
        return [
            $santri->nomor_pendaftaran,
            $santri->nama_lengkap,
            $santri->nik,
            $santri->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            $santri->asal_sekolah,
            $santri->nilai_rata,
            ucfirst($santri->status),
            $santri->created_at->format('d/m/Y'),
        ];
    }
}
