<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Report;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{

    // Dashboard
    public function dashboard()
    {
        $totalEmployees = Employee::count();
        
        // Menghitung jumlah departemen unik (tidak duplikat)
        $totalDepartments = Employee::whereNotNull('department')
                                    ->where('department', '!=', '')
                                    ->distinct('department')
                                    ->count('department');

        // Menghitung jumlah jabatan/posisi unik (tidak duplikat)
        $totalPositions = Employee::whereNotNull('position')
                              ->where('position', '!=', '')
                              ->pluck('position')
                              ->unique()
                              ->count();

        // Menghitung jumlah karyawan Aktif
        $totalAktif         = Employee::where('status', 'Aktif')->count();

        // Menghitung jumlah karyawan Non-Aktif
        $totalNonAktif      = Employee::where('status', 'Non-Aktif')->count();
        
        // (Opsional) Data departemen dan posisi yang sudah kita buat sebelumnya
        $totalDepartments   = Employee::whereNotNull('department')->where('department', '!=', '')->pluck('department')->unique()->count();
        $totalPositions     = Employee::whereNotNull('position')->where('position', '!=', '')->pluck('position')->unique()->count();
       // BARU: Menghitung total seluruh histori/aktivitas yang tercatat di sistem
        $totalHistories     = Activity::where('subject_type', Employee::class)->count();

        // Menampilkan 5 karyawan terbaru
        $employees          = Employee::orderBy('id', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'totalEmployees', 
            'totalAktif', 
            'totalNonAktif', 
            'totalDepartments', 
            'totalPositions',
            'totalHistories',
            'employees'
        ));
    }

    // View Data Karyawan
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default tampilkan 10 per halaman
        $search  = $request->input('search');

        $employees = Employee::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                        ->orWhere('employee_code', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('position', 'like', "%{$search}%")
                        ->orWhere('department', 'like', "%{$search}%");
        })->paginate($perPage)->withQueryString();

        return view('employees.index', compact('employees', 'perPage'));
    }

    // View modal tambah karyawan
    public function create()
    {
        return view('employees.create');
    }

    // Menambahkan data karyawan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_code' => 'required|unique:employees,employee_code',
            'name' => 'required|string|max:255',
            'department' => 'required|string',
            'position' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'status' => 'required|in:Aktif,Non-Aktif',
        ]);

        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    // Menampilkan data karyawan
    public function show(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // Edit Data karyawan
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // Update data karyawan
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'employee_code'  => 'required|unique:employees,employee_code,'.$employee->id,
            'name'           => 'required|string|max:255',
            'department'     => 'required|string',
            'position'       => 'required|string',
            'email'          => 'required|email|unique:employees,email,'.$employee->id,
            'status'         => 'required|in:Aktif,Non-Aktif',
        ]);

        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    // Hapus Data karyawan
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil dihapus.');
    }

    // Histori data keseluruhan
    public function allHistory(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        // Mengambil semua aktivitas yang subjeknya adalah model Employee, diurutkan dari terbaru
        $activities = Activity::where('subject_type', \App\Models\Employee::class)
                            ->latest()
                            ->paginate(15);

        return view('employees.all-history', compact('activities'));
    }

    // Menampilkan Halaman View & Tabel Riwayat Laporan
    public function exportForm()
    {
        // Ambil daftar riwayat laporan dari database diurutkan dari yang terbaru
        $reports = Report::latest()->paginate(10);

        return view('employees.export', compact('reports'));
    }

    // Menyimpan Riwayat Laporan Baru dari Modal
    public function storeReport(Request $request)
    {
        $request->validate([
            'period_month' => 'required', // Menerima input 'YYYY-MM' dari HTML input type="month"
        ]);

        Report::create([
            'period_month' => $request->period_month,
        ]);

        return redirect()->route('employees.export.form')->with('success', 'Data Laporan berhasil dibuat!');
    }

    // Download File Excel Berdasarkan Periode dari Tabel
    public function exportExcel($period)
    {
        // $period berformat 'YYYY-MM'
        $date  = explode('-', $period);
        $year  = $date[0] ?? date('Y');
        $month = $date[1] ?? date('m');

        $fileName = 'laporan-karyawan-' . $period . '.xlsx';

        return Excel::download(new class($month, $year) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings, \Maatwebsite\Excel\Concerns\WithMapping, \Maatwebsite\Excel\Concerns\ShouldAutoSize {
            protected $month;
            protected $year;

            public function __construct($month, $year) {
                $this->month = $month;
                $this->year  = $year;
            }

            public function collection() {
                return Employee::whereMonth('created_at', $this->month)
                            ->whereYear('created_at', $this->year)
                            ->get();
            }

            public function headings(): array {
                return ['ID Karyawan', 'Nama', 'Departemen', 'Jabatan', 'Email', 'Status', 'Tanggal Dibuat'];
            }

            public function map($employee): array {
                return [
                    $employee->employee_code,
                    $employee->name,
                    $employee->department,
                    $employee->position,
                    $employee->email,
                    $employee->status,
                    $employee->created_at->format('d-m-Y H:i:s'),
                ];
            }
        }, $fileName);
    }

    // View Dokumentasi
    public function docs()
    {
        return view('employees.docs');
    }

    // Delete Laporan
    public function destroyReport($id)
    {
        // Cari data laporan berdasarkan ID
        $report = Report::findOrFail($id);
        
        // Hapus data tersebut dari database
        $report->delete();

        // Arahkan kembali ke halaman sebelumnya dengan pesan notifikasi sukses
        return redirect()->back()->with('success', 'Data riwayat laporan berhasil dihapus!');
    }
}
