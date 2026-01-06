<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class SantriController extends Controller
{
    /**
     * Display santri list
     */
    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Data Santri', 'url' => ''],
        ];

        return view('admin.santri.index', compact('breadcrumbs'));
    }

    /**
     * Get santri data for DataTables
     */
    public function getData(Request $request)
    {
        $query = Santri::with('orangTua')->select('santri.*');

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('gelombang')) {
            $query->where('gelombang', $request->gelombang);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun_ajaran', $request->tahun);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('tanggal_daftar', function ($santri) {
                return $santri->created_at->format('d M Y');
            })
            ->addColumn('action', function ($santri) {
                return ''; // Will be handled by JavaScript
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * Show santri detail
     */
    public function show($id)
    {
        $santri = Santri::with('orangTua', 'pembayaran')->findOrFail($id);

        return response()->json($santri);
    }

    /**
     * Verify santri
     */
    public function verify($id)
    {
        $santri = Santri::findOrFail($id);
        $santri->verify();

        return response()->json([
            'success' => true,
            'message' => 'Santri berhasil diverifikasi'
        ]);
    }

    /**
     * Accept santri
     */
    public function accept($id)
    {
        $santri = Santri::findOrFail($id);
        $santri->accept();

        return response()->json([
            'success' => true,
            'message' => 'Santri berhasil diterima'
        ]);
    }

    /**
     * Reject santri
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string'
        ]);

        $santri = Santri::findOrFail($id);
        $santri->reject($request->rejection_reason);

        return response()->json([
            'success' => true,
            'message' => 'Santri ditolak'
        ]);
    }

    /**
     * Delete santri
     */
    public function destroy($id)
    {
        $santri = Santri::findOrFail($id);
        
        // Delete uploaded files
        if ($santri->foto) {
            \Storage::disk('public')->delete($santri->foto);
        }
        if ($santri->ijazah) {
            \Storage::disk('public')->delete($santri->ijazah);
        }
        if ($santri->akta) {
            \Storage::disk('public')->delete($santri->akta);
        }

        $santri->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }

    /**
     * Export to Excel
     */
    public function exportExcel(Request $request)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\SantriExport($request->status, $request->gelombang, $request->tahun), 
            'data-santri-' . date('Y-m-d') . '.xlsx'
        );
    }

    /**
     * Export to PDF
     */
    public function exportPdf(Request $request)
    {
        $santri = Santri::all();
        $pdf = Pdf::loadView('admin.santri.pdf', compact('santri'));
        return $pdf->download('data-santri-' . date('Y-m-d') . '.pdf');
    }
}
