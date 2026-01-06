/* ============================================
   Admin DataTables Module
   Configuration untuk DataTables di admin panel
   ============================================ */

const AdminDataTables = {
    // Default DataTables configuration
    defaultConfig: {
        processing: true,
        serverSide: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
            processing: '<div class="spinner"></div> Memuat data...',
            search: 'Cari:',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Menampilkan 0 sampai 0 dari 0 data',
            infoFiltered: '(disaring dari _MAX_ total data)',
            zeroRecords: 'Tidak ada data yang cocok',
            emptyTable: 'Tidak ada data tersedia',
            paginate: {
                first: 'Pertama',
                last: 'Terakhir',
                next: 'Selanjutnya',
                previous: 'Sebelumnya'
            }
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        dom: '<"table-toolbar"<"table-toolbar-left"l><"table-toolbar-right"f>>rtip',
        order: [[0, 'desc']], // Default sort by first column descending
    },

    // Initialize Santri DataTable
    initSantriTable(tableSelector) {
        const table = $(tableSelector).DataTable({
            ...this.defaultConfig,
            ajax: {
                url: '/admin/santri/data',
                data: function (d) {
                    // Add custom filters
                    d.status = $('#filter-status').val();
                    d.gelombang = $('#filter-gelombang').val();
                    d.tahun = $('#filter-tahun').val();
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    width: '50px'
                },
                {
                    data: 'nomor_pendaftaran',
                    name: 'nomor_pendaftaran',
                    render: function (data) {
                        return `<span class="font-semibold text-primary">${data}</span>`;
                    }
                },
                {
                    data: 'nama_lengkap',
                    name: 'nama_lengkap',
                    render: function (data, type, row) {
                        return `
                            <div class="flex items-center gap-3">
                                <img src="${row.foto || '/img/avatar-default.png'}" 
                                     class="w-8 h-8 rounded-full" 
                                     alt="${data}">
                                <span>${data}</span>
                            </div>
                        `;
                    }
                },
                { data: 'email', name: 'email' },
                { data: 'no_hp', name: 'no_hp' },
                {
                    data: 'status',
                    name: 'status',
                    render: (data) => this.getStatusBadge(data)
                },
                {
                    data: 'tanggal_daftar',
                    name: 'created_at',
                    render: function (data) {
                        return new Date(data).toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric'
                        });
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-right',
                    render: function (data, type, row) {
                        return `
                            <div class="table-actions">
                                <button class="table-action-btn" 
                                        onclick="AdminDataTables.viewDetail('${row.id}')"
                                        title="Lihat Detail">
                                    👁️
                                </button>
                                ${row.status === 'pending' ? `
                                    <button class="table-action-btn" 
                                            onclick="AdminDataTables.verifyStudent('${row.id}')"
                                            title="Verifikasi">
                                        ✅
                                    </button>
                                ` : ''}
                                <button class="table-action-btn danger" 
                                        onclick="AdminDataTables.deleteStudent('${row.id}')"
                                        title="Hapus">
                                    🗑️
                                </button>
                            </div>
                        `;
                    }
                }
            ]
        });

        // Setup filters
        this.setupFilters(table, ['#filter-status', '#filter-gelombang', '#filter-tahun']);

        return table;
    },

    // Initialize Payment DataTable
    initPaymentTable(tableSelector) {
        return $(tableSelector).DataTable({
            ...this.defaultConfig,
            ajax: '/admin/pembayaran/data',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'nomor_pendaftaran', name: 'santri.nomor_pendaftaran' },
                { data: 'nama_santri', name: 'santri.nama_lengkap' },
                {
                    data: 'jumlah',
                    name: 'jumlah',
                    render: function (data) {
                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(data);
                    }
                },
                {
                    data: 'tanggal_bayar',
                    name: 'tanggal_bayar',
                    render: function (data) {
                        return data ? new Date(data).toLocaleDateString('id-ID') : '-';
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function (data) {
                        const badges = {
                            'pending': '<span class="badge badge-warning">Pending</span>',
                            'confirmed': '<span class="badge badge-success">Confirmed</span>',
                            'rejected': '<span class="badge badge-error">Rejected</span>'
                        };
                        return badges[data] || data;
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `
                            <div class="table-actions">
                                <button class="table-action-btn" onclick="AdminDataTables.viewPayment('${row.id}')">👁️</button>
                                <button class="table-action-btn" onclick="AdminDataTables.confirmPayment('${row.id}')">✅</button>
                            </div>
                        `;
                    }
                }
            ]
        });
    },

    // Setup filter listeners
    setupFilters(table, filterSelectors) {
        filterSelectors.forEach(selector => {
            $(selector).on('change', function () {
                table.ajax.reload();
            });
        });

        // Add clear filters button
        $('#clear-filters').on('click', function () {
            filterSelectors.forEach(selector => {
                $(selector).val('');
            });
            table.ajax.reload();
        });
    },

    // View student detail
    viewDetail(id) {
        fetch(`/admin/santri/${id}`)
            .then(response => response.json())
            .then(data => {
                this.showDetailModal(data);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memuat data');
            });
    },

    // Show detail modal
    showDetailModal(data) {
        // Populate modal with data
        document.getElementById('detail-modal-content').innerHTML = `
            <div class="detail-section">
                <div class="detail-section-header">
                    <h3 class="detail-section-title">📋 Data Diri</h3>
                </div>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Nomor Pendaftaran</span>
                        <span class="detail-value">${data.nomor_pendaftaran}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Nama Lengkap</span>
                        <span class="detail-value">${data.nama_lengkap}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">NIK</span>
                        <span class="detail-value">${data.nik}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">${data.email}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">No. HP</span>
                        <span class="detail-value">${data.no_hp}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status</span>
                        <span class="detail-value">
                            ${this.getStatusBadge(data.status)}
                        </span>
                    </div>
                </div>
            </div>
        `;

        // Show modal
        document.getElementById('detail-modal').classList.add('active');
    },

    // Helper for status badge
    getStatusBadge(status) {
        const badges = {
            'pending': '<span class="badge badge-warning">⏳ Pending</span>',
            'verified': '<span class="badge badge-success">✅ Verified</span>',
            'rejected': '<span class="badge badge-error">❌ Rejected</span>',
            'accepted': '<span class="badge badge-info">🎉 Accepted</span>'
        };
        return badges[status] || status;
    },

    // Verify student
    verifyStudent(id) {
        if (!confirm('Apakah Anda yakin ingin memverifikasi santri ini?')) {
            return;
        }

        fetch(`/admin/santri/${id}/verify`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Santri berhasil diverifikasi');
                    $('#table-santri').DataTable().ajax.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memverifikasi santri');
            });
    },

    // Delete student
    deleteStudent(id) {
        if (!confirm('Apakah Anda yakin ingin menghapus data santri ini?')) {
            return;
        }

        fetch(`/admin/santri/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Data berhasil dihapus');
                    $('#table-santri').DataTable().ajax.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal menghapus data');
            });
    },

    // Export to Excel
    exportToExcel(tableId) {
        const filters = {
            status: $('#filter-status').val(),
            gelombang: $('#filter-gelombang').val(),
            tahun: $('#filter-tahun').val()
        };

        const queryString = new URLSearchParams(filters).toString();
        window.location.href = `/admin/santri/export/excel?${queryString}`;
    },

    // Export to PDF
    exportToPDF(tableId) {
        const filters = {
            status: $('#filter-status').val(),
            gelombang: $('#filter-gelombang').val(),
            tahun: $('#filter-tahun').val()
        };

        const queryString = new URLSearchParams(filters).toString();
        window.location.href = `/admin/santri/export/pdf?${queryString}`;
    },

    // Initialize all tables
    init() {
        if ($('#table-santri').length) {
            this.initSantriTable('#table-santri');
        }

        if ($('#table-payment').length) {
            this.initPaymentTable('#table-payment');
        }
    }
};

// Auto-initialize when DOM is ready
$(document).ready(function () {
    AdminDataTables.init();
});

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = AdminDataTables;
}
