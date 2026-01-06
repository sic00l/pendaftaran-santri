@extends('layouts.admin')

@section('title', 'Data Santri')
@section('page_title', 'Manajemen Data Santri')

@section('header_actions')
<div class="flex gap-2">
    <button onclick="AdminDataTables.exportToExcel()" class="btn btn-success btn-sm">
        <i class="fas fa-file-excel mr-1"></i> Excel
    </button>
    <button onclick="AdminDataTables.exportToPDF()" class="btn btn-error btn-sm">
        <i class="fas fa-file-pdf mr-1"></i> PDF
    </button>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header border-b">
        <div class="flex flex-wrap gap-4 items-center">
            <div class="form-group mb-0">
                <select id="filter-status" class="form-control form-control-sm">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="verified">Verified</option>
                    <option value="accepted">Accepted</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <div class="form-group mb-0">
                <select id="filter-gelombang" class="form-control form-control-sm">
                    <option value="">Semua Gelombang</option>
                    <option value="1">Gelombang 1</option>
                    <option value="2">Gelombang 2</option>
                    <option value="3">Gelombang 3</option>
                    <option value="4">Gelombang 4</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table-santri" class="table table-hover w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Daftar</th>
                        <th>Nama Lengkap</th>
                        <th>L/P</th>
                        <th>Asal Sekolah</th>
                        <th>Status</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- DataTables will populate this -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="modal-detail" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Detail Calon Santri</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body" id="detail-content">
                <!-- Content will be loaded via AJAX -->
                <div class="skeleton-list">
                    <div class="skeleton-item h-40 w-full mb-4"></div>
                    <div class="skeleton-item h-6 w-3/4 mb-2"></div>
                    <div class="skeleton-item h-6 w-1/2"></div>
                </div>
            </div>
            <div class="modal-footer" id="detail-footer">
                <button class="btn btn-secondary modal-close">Tutup</button>
                <div id="action-buttons" class="flex gap-2">
                    <!-- Action buttons dynamically added -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Reason Modal -->
<div id="modal-reject" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Alasan Penolakan</h3>
                <button class="modal-close">&times;</button>
            </div>
            <form id="form-reject">
                <div class="modal-body">
                    <input type="hidden" id="reject-id">
                    <div class="form-group">
                        <label class="form-label">Berikan alasan mengapa pendaftaran ini ditolak:</label>
                        <textarea id="rejection_reason" class="form-control" rows="4" required placeholder="Contoh: Dokumen tidak lengkap, Nilai tidak memenuhi syarat, dll."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-close">Batal</button>
                    <button type="submit" class="btn btn-error" id="btn-confirm-reject">Konfirmasi Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Configuration for admin-datatable.js
    window.santriDataUrl = "{{ route('admin.santri.data') }}";
</script>
@endpush
