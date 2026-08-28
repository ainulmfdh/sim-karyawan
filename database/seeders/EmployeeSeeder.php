<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    // Buat 10 data seeder di database
    public function run(): void
    {
        $employees = [
            ['employee_code' => '001', 'name' => 'Andi Saputra', 'department' => 'Finance', 'position' => 'Staff Finance', 'email' => 'andi@properindoenviro.co.id', 'status' => 'Aktif'],
            ['employee_code' => '002', 'name' => 'Budi Santoso', 'department' => 'IT', 'position' => 'Programmer Junior', 'email' => 'budi@properindoenviro.co.id', 'status' => 'Aktif'],
            ['employee_code' => '003', 'name' => 'Citra Lestari', 'department' => 'HR', 'position' => 'HR Administrator', 'email' => 'citra@properindoenviro.co.id', 'status' => 'Aktif'],
            ['employee_code' => '004', 'name' => 'Dewi Anggraini', 'department' => 'Environment', 'position' => 'Environmental Staff', 'email' => 'dewi@properindoenviro.co.id', 'status' => 'Aktif'],
            ['employee_code' => '005', 'name' => 'Eko Pratama', 'department' => 'Operation', 'position' => 'Operational Staff', 'email' => 'eko@properindoenviro.co.id', 'status' => 'Aktif'],
            ['employee_code' => '006', 'name' => 'Hendra Wijaya', 'department' => 'IT', 'position' => 'Database Administrator', 'email' => 'hendra@properindoenviro.co.id', 'status' => 'Aktif'],
            ['employee_code' => '007', 'name' => 'Lukman Hakim', 'department' => 'IT', 'position' => 'System Analyst', 'email' => 'lukman@properindoenviro.co.id', 'status' => 'Aktif'],
            ['employee_code' => '008', 'name' => 'Maya Putri', 'department' => 'HR', 'position' => 'HR Supervisor', 'email' => 'maya@properindoenviro.co.id', 'status' => 'Aktif'],
            ['employee_code' => '009', 'name' => 'Taufik Hidayat', 'department' => 'Environment', 'position' => 'Environmental Analyst', 'email' => 'taufik@properindoenviro.co.id', 'status' => 'Aktif'],
            ['employee_code' => '010', 'name' => 'Rizky Maulana', 'department' => 'IT', 'position' => 'Web Developer', 'email' => 'rizky@properindoenviro.co.id', 'status' => 'Aktif'],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
