<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'santri_id',
        'jenis_pembayaran',
        'jumlah',
        'tanggal_bayar',
        'bukti_transfer',
        'nama_pengirim',
        'bank_pengirim',
        'status',
        'keterangan',
        'confirmed_at',
        'confirmed_by',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
        'jumlah' => 'decimal:2',
        'confirmed_at' => 'datetime',
    ];

    /**
     * Relasi ke Santri
     */
    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    /**
     * Relasi ke User (admin yang confirm)
     */
    public function confirmedBy()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    /**
     * Scope: Filter by status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope: Pembayaran pending
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope: Pembayaran confirmed
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Confirm pembayaran
     */
    public function confirm($adminId)
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
            'confirmed_by' => $adminId,
        ]);
    }

    /**
     * Reject pembayaran
     */
    public function reject($keterangan = null)
    {
        $this->update([
            'status' => 'rejected',
            'keterangan' => $keterangan,
        ]);
    }

    /**
     * Format jumlah ke Rupiah
     */
    public function getFormattedJumlahAttribute()
    {
        return 'Rp ' . number_format($this->jumlah, 0, ',', '.');
    }
}
