<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Employee extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'employee_code',
        'name',
        'department',
        'position',
        'email',
        'status'
    ];

    // Konfigurasi apa saja yang dicatat oleh Spatie
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // Mencatat semua kolom pada tabel
            ->logOnlyDirty() // Hanya mencatat kolom yang benar-benar berubah saat di-update
            ->dontSubmitEmptyLogs(); // Jangan buat log jika tidak ada perubahan data
    }
}
