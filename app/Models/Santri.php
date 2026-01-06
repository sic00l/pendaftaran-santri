<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Santri extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'santri';

    protected $fillable = [
        'nomor_pendaftaran',
        'password',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nik',
        'alamat',
        'email',
        'no_hp',
        'asal_sekolah',
        'nilai_rata',
        'foto',
        'ijazah',
        'akta',
        'status',
        'rejection_reason',
        'verified_at',
        'accepted_at',
        'gelombang',
        'tahun_ajaran',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'nilai_rata' => 'decimal:2',
        'verified_at' => 'datetime',
        'accepted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'umur',
        'status_badge',
    ];

    /**
     * Relasi ke OrangTua
     */
    public function orangTua()
    {
        return $this->hasOne(OrangTua::class);
    }

    /**
     * Relasi ke Pembayaran
     */
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($santri) {
            // Generate nomor pendaftaran otomatis
            if (empty($santri->nomor_pendaftaran)) {
                $santri->nomor_pendaftaran = self::generateNomorPendaftaran();
            }

            // Generate password default jika kosong
            if (empty($santri->password)) {
                $santri->password = bcrypt('santri123');
            }

            // Set tahun ajaran otomatis
            if (empty($santri->tahun_ajaran)) {
                $santri->tahun_ajaran = date('Y');
            }
        });
    }

    /**
     * Generate nomor pendaftaran unik
     */
    public static function generateNomorPendaftaran()
    {
        do {
            $nomor = 'PPDB-' . date('Y') . '-' . strtoupper(Str::random(6));
        } while (self::where('nomor_pendaftaran', $nomor)->exists());

        return $nomor;
    }

    /**
     * Accessor: Hitung umur
     */
    public function getUmurAttribute()
    {
        if (!$this->tanggal_lahir) {
            return null;
        }

        return $this->tanggal_lahir->age;
    }

    /**
     * Accessor: Status label
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Pending',
            'verified' => 'Verified',
            'rejected' => 'Rejected',
            'accepted' => 'Accepted',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Scope: Filter by status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope: Filter by gelombang
     */
    public function scopeGelombang($query, $gelombang)
    {
        return $query->where('gelombang', $gelombang);
    }

    /**
     * Scope: Filter by tahun ajaran
     */
    public function scopeTahunAjaran($query, $tahun)
    {
        return $query->where('tahun_ajaran', $tahun);
    }

    /**
     * Scope: Santri tahun ini
     */
    public function scopeTahunIni($query)
    {
        return $query->where('tahun_ajaran', date('Y'));
    }

    /**
     * Check if santri sudah verified
     */
    public function isVerified()
    {
        return $this->status === 'verified' || $this->status === 'accepted';
    }

    /**
     * Check if santri sudah accepted
     */
    public function isAccepted()
    {
        return $this->status === 'accepted';
    }

    /**
     * Verify santri
     */
    public function verify()
    {
        $this->update([
            'status' => 'verified',
            'verified_at' => now(),
        ]);
    }

    /**
     * Accept santri
     */
    public function accept()
    {
        $this->update([
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);
    }

    /**
     * Reject santri
     */
    public function reject($reason = null)
    {
        $this->update([
            'status' => 'rejected',
            'rejection_reason' => $reason,
        ]);
    }
}
