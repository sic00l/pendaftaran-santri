@extends('layouts.app')

@section('title', 'Form Pendaftaran Santri Baru')

@section('content')
<div class="registration-container">
    <!-- Progress Bar -->
    <div class="form-progress">
        <div class="form-progress-bar" id="form-progress-bar" style="width: 0%"></div>
    </div>

    <!-- Step Indicator -->
    <div class="step-indicator">
        <div class="step-indicator-item active" id="indicator-1">
            <div class="step-indicator-circle">1</div>
            <div class="step-indicator-label">Data Diri</div>
        </div>
        <div class="step-indicator-item" id="indicator-2">
            <div class="step-indicator-circle">2</div>
            <div class="step-indicator-label">Orang Tua</div>
        </div>
        <div class="step-indicator-item" id="indicator-3">
            <div class="step-indicator-circle">3</div>
            <div class="step-indicator-label">Pendidikan</div>
        </div>
        <div class="step-indicator-item" id="indicator-4">
            <div class="step-indicator-circle">4</div>
            <div class="step-indicator-label">Dokumen</div>
        </div>
        <div class="step-indicator-item" id="indicator-5">
            <div class="step-indicator-circle">5</div>
            <div class="step-indicator-label">Review</div>
        </div>
    </div>

    <!-- Form -->
    <form id="registration-form" action="{{ route('registration.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Step 1: Data Diri -->
        <div class="form-step active" id="step-1">
            <div class="form-step-card">
                <div class="form-step-header">
                    <h2 class="form-step-title">Data Diri Santri</h2>
                    <p class="form-step-description">Lengkapi data diri calon santri dengan benar</p>
                </div>

                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i> Nama Lengkap
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-id-card"></i> NIK
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="nik" id="nik" class="form-input" maxlength="16" required>
                        <span class="form-help">16 digit angka</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin <span class="required">*</span></label>
                        <div class="form-radio-group-inline">
                            <label class="form-radio">
                                <input type="radio" name="jenis_kelamin" value="L" required>
                                <span>Laki-laki</span>
                            </label>
                            <label class="form-radio">
                                <input type="radio" name="jenis_kelamin" value="P" required>
                                <span>Perempuan</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt"></i> Tempat Lahir
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="tempat_lahir" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-calendar"></i> Tanggal Lahir
                            <span class="required">*</span>
                        </label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-input" required>
                        <span class="form-help">Usia minimal 12 tahun, maksimal 18 tahun</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i> Email
                            <span class="required">*</span>
                        </label>
                        <input type="email" name="email" id="email" class="form-input" required>
                        <span class="form-help">Untuk login ke dashboard</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-phone"></i> No. HP/WhatsApp
                            <span class="required">*</span>
                        </label>
                        <input type="tel" name="no_hp" class="form-input" placeholder="08xxxxxxxxx" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-home"></i> Alamat Lengkap
                        <span class="required">*</span>
                    </label>
                    <textarea name="alamat" class="form-textarea" rows="3" required></textarea>
                </div>

                <div class="form-navigation">
                    <div></div>
                    <button type="button" class="btn btn-primary" data-next>
                        Lanjut <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Step 2: Data Orang Tua -->
        <div class="form-step" id="step-2">
            <div class="form-step-card">
                <div class="form-step-header">
                    <h2 class="form-step-title">Data Orang Tua/Wali</h2>
                    <p class="form-step-description">Lengkapi data orang tua atau wali calon santri</p>
                </div>

                <h4 class="mb-4">👨 Data Ayah</h4>
                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Nama Ayah <span class="required">*</span></label>
                        <input type="text" name="nama_ayah" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pekerjaan Ayah <span class="required">*</span></label>
                        <input type="text" name="pekerjaan_ayah" class="form-input" required>
                    </div>
                </div>

                <h4 class="mb-4 mt-6">👩 Data Ibu</h4>
                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Nama Ibu <span class="required">*</span></label>
                        <input type="text" name="nama_ibu" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pekerjaan Ibu <span class="required">*</span></label>
                        <input type="text" name="pekerjaan_ibu" class="form-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-phone"></i> No. HP Orang Tua
                        <span class="required">*</span>
                    </label>
                    <input type="tel" name="no_hp_orangtua" class="form-input" required>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn btn-outline" data-prev>
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </button>
                    <button type="button" class="btn btn-primary" data-next>
                        Lanjut <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Step 3: Data Pendidikan -->
        <div class="form-step" id="step-3">
            <div class="form-step-card">
                <div class="form-step-header">
                    <h2 class="form-step-title">Data Pendidikan</h2>
                    <p class="form-step-description">Informasi pendidikan terakhir</p>
                </div>

                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Asal Sekolah <span class="required">*</span></label>
                        <input type="text" name="asal_sekolah" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nilai Rata-rata <span class="required">*</span></label>
                        <input type="number" name="nilai_rata" class="form-input" step="0.01" max="100" required>
                        <span class="form-help">Nilai rata-rata rapor (0-100)</span>
                    </div>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn btn-outline" data-prev>
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </button>
                    <button type="button" class="btn btn-primary" data-next>
                        Lanjut <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Step 4: Upload Dokumen -->
        <div class="form-step" id="step-4">
            <div class="form-step-card">
                <div class="form-step-header">
                    <h2 class="form-step-title">Upload Dokumen</h2>
                    <p class="form-step-description">Upload dokumen yang diperlukan</p>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-camera"></i> Foto 3x4
                        <span class="required">*</span>
                    </label>
                    <input type="file" name="foto" id="foto" class="form-input" accept="image/*" required>
                    <span class="form-help">Max 2MB, format JPG/PNG</span>
                    <div id="foto-preview" class="file-preview-container"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-file-pdf"></i> Scan Ijazah/SKHUN
                    </label>
                    <input type="file" name="ijazah" id="ijazah" class="form-input" accept="application/pdf,image/*">
                    <span class="form-help">Max 5MB, format PDF/JPG</span>
                    <div id="ijazah-preview" class="file-preview-container"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-file-pdf"></i> Scan Akta Kelahiran
                    </label>
                    <input type="file" name="akta" id="akta" class="form-input" accept="application/pdf,image/*">
                    <span class="form-help">Max 5MB, format PDF/JPG</span>
                    <div id="akta-preview" class="file-preview-container"></div>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn btn-outline" data-prev>
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </button>
                    <button type="button" class="btn btn-primary" data-next>
                        Lanjut <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Step 5: Review -->
        <div class="form-step" id="step-5">
            <div class="form-step-card">
                <div class="form-step-header">
                    <h2 class="form-step-title">Review Data Pendaftaran</h2>
                    <p class="form-step-description">Periksa kembali data yang telah Anda isi</p>
                </div>

                <div class="review-section">
                    <div class="review-section-title">
                        <h3>📋 Data Diri</h3>
                        <a href="#" class="review-edit-btn" data-edit-step="1">Edit</a>
                    </div>
                    <div class="review-data-grid">
                        <div class="review-data-item">
                            <span class="review-data-label">Nama Lengkap</span>
                            <span class="review-data-value" data-review="nama_lengkap">-</span>
                        </div>
                        <div class="review-data-item">
                            <span class="review-data-label">NIK</span>
                            <span class="review-data-value" data-review="nik">-</span>
                        </div>
                        <div class="review-data-item">
                            <span class="review-data-label">Email</span>
                            <span class="review-data-value" data-review="email">-</span>
                        </div>
                        <div class="review-data-item">
                            <span class="review-data-label">No. HP</span>
                            <span class="review-data-value" data-review="no_hp">-</span>
                        </div>
                    </div>
                </div>

                <div class="review-section">
                    <div class="review-section-title">
                        <h3>👨‍👩‍👦 Data Orang Tua</h3>
                        <a href="#" class="review-edit-btn" data-edit-step="2">Edit</a>
                    </div>
                    <div class="review-data-grid">
                        <div class="review-data-item">
                            <span class="review-data-label">Nama Ayah</span>
                            <span class="review-data-value" data-review="nama_ayah">-</span>
                        </div>
                        <div class="review-data-item">
                            <span class="review-data-label">Nama Ibu</span>
                            <span class="review-data-value" data-review="nama_ibu">-</span>
                        </div>
                    </div>
                </div>

                <div class="terms-checkbox">
                    <label class="form-checkbox">
                        <input type="checkbox" name="agree_terms" required>
                        <span>Saya menyetujui <a href="{{ route('terms') }}" target="_blank">syarat dan ketentuan</a> yang berlaku</span>
                    </label>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn btn-outline" data-prev>
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane mr-2"></i> Submit Pendaftaran
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
@vite([
    'resources/js/validation.js',
    'resources/js/ajax-check.js',
    'resources/js/image-preview.js',
    'resources/js/multi-step-form.js'
])
@endpush
