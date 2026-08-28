<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 lg:p-8 space-y-8">

                <!-- Header Banner -->
                <div class="bg-gradient-to-r from-blue-900 to-blue-600 text-white p-6 rounded-xl shadow-md">
                    <h1 class="text-2xl font-bold mb-2">Dokumentasi Pengembangan Aplikasi</h1>
                    <p class="text-sm text-blue-100">Panduan lengkap arsitektur sistem, rancangan database, dan tata cara menjalankan aplikasi di lokal.</p>
                </div>

                <!-- Bagian 1: Ringkasan Proyek -->
                <section class="space-y-3">
                    <h2 class="text-lg font-bold text-blue-900 border-l-4 border-blue-600 pl-3">1. Ringkasan Proyek</h2>
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Aplikasi ini dibangun menggunakan framework <strong>Laravel</strong> versi 12 dengan pendekatan arsitektur MVC (Model-View-Controller), antarmuka Tailwind CSS, serta Alpine.js untuk interaktivitas komponen dinamis. Sistem ini dirancang untuk mengelola data karyawan secara komprehensif, mencatat log histori perubahan aktivitas, memantau statistik dashboard secara <em>real-time</em>, serta menghasilkan laporan bulanan dalam format Excel.
                    </p>
                </section>

                <!-- Bagian 2: Rancangan Database & Relasi -->
                <section class="space-y-3">
                    <h2 class="text-lg font-bold text-blue-900 border-l-4 border-blue-600 pl-3">2. Rancangan Database & Relasi Tabel</h2>
                    <p class="text-sm text-gray-700">Sistem ini dirancang menggunakan beberapa tabel utama yang saling berelasi untuk memastikan integritas data:</p>
                    
                    <div class="overflow-x-auto border rounded-lg">
                        <table class="min-w-full bg-white text-sm text-left text-gray-600">
                            <thead class="bg-gray-100 text-xs uppercase text-gray-700 border-b">
                                <tr>
                                    <th class="py-3 px-4">Nama Tabel</th>
                                    <th class="py-3 px-4">Kolom Tabel</th>
                                    <th class="py-3 px-4">Keterangan & Relasi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="py-3 px-4 font-mono font-semibold text-indigo-600">users</td>
                                    <td class="py-3 px-4 font-mono text-xs">id, name, email, email_verified_at, password, remember_token, timestamps</td>
                                    <td class="py-3 px-4">Menyimpan data akun user/admin yang memiliki hak akses login ke dalam sistem.</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 font-mono font-semibold text-indigo-600">employees</td>
                                    <td class="py-3 px-4 font-mono text-xs">employee_code, name, department, position, email, status, timestamps</td>
                                    <td class="py-3 px-4">Menyimpan data utama profil karyawan perusahaan (status: Aktif/Non-Aktif).</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 font-mono font-semibold text-indigo-600">activity_log</td>
                                    <td class="py-3 px-4 font-mono text-xs">log_name, description, subject_type, event, subject_id, causer_id, properties, batch_uuid, timestamps</td>
                                    <td class="py-3 px-4">Tabel bawaan package Spatie Activity Log untuk merekam histori perubahan data karyawan.</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 font-mono font-semibold text-indigo-600">reports</td>
                                    <td class="py-3 px-4 font-mono text-xs">id, period_month, timestamps</td>
                                    <td class="py-3 px-4">Menyimpan riwayat data pembuatan laporan rekapitulasi bulanan berdasarkan periode (format <code>YYYY-MM</code>).</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg text-sm text-blue-900">
                        <strong>Hubungan Relasi:</strong> Tabel <code>employees</code> berdiri sendiri dan terhubung secara polimorfik dengan tabel <code>activity_log</code> guna melacak seluruh aktivitas penambahan, pembaruan, atau penghapusan data karyawan.
                    </div>
                </section>

                <!-- Bagian 3: Tata Cara Run Aplikasi di Lokal -->
                <section class="space-y-4">
                    <h2 class="text-lg font-bold text-blue-900 border-l-4 border-blue-600 pl-3">3. Tata Cara Menjalankan Aplikasi di Lokal</h2>
                    <p class="text-sm text-gray-700">Ikuti langkah-langkah berikut untuk mengonfigurasi dan menjalankan proyek ini di komputer lokal Anda:</p>

                    <h3 class="font-semibold text-gray-800 text-sm">Prasyarat Sistem:</h3>
                    <ul class="list-disc list-inside text-sm text-gray-700 space-y-1 pl-2">
                        <li>PHP versi 8.2 atau lebih baru</li>
                        <li>Composer (PHP Package Manager)</li>
                        <li>Node.js & NPM (untuk kompilasi asset Tailwind CSS/Vite)</li>
                        <li>Database Server (MySQL / MariaDB via XAMPP, Laragon, atau Native)</li>
                    </ul>

                    <h3 class="font-semibold text-gray-800 text-sm mt-4">Langkah Instalasi:</h3>
                    
                    <ol class="list-decimal list-inside text-sm text-gray-700 space-y-3 pl-2">
                        <li>
                            <strong>Clone atau Ekstrak Proyek:</strong><br>
                            Buka terminal atau command prompt pada direktori proyek Anda.
                        </li>
                        <li>
                            <strong>Install Dependencies PHP (Composer):</strong><br>
                            Jalankan perintah berikut untuk mengunduh seluruh package yang dibutuhkan:
                            <pre class="bg-slate-900 text-slate-100 p-3 rounded-lg text-xs font-mono mt-1 overflow-x-auto"><code>composer install</code></pre>
                        </li>
                        <li>
                            <strong>Install Dependencies JavaScript (NPM):</strong><br>
                            Jalankan perintah untuk menginstal package frontend:
                            <pre class="bg-slate-900 text-slate-100 p-3 rounded-lg text-xs font-mono mt-1 overflow-x-auto"><code>npm install</code></pre>
                        </li>
                        <li>
                            <strong>Konfigurasi File Environment (.env):</strong><br>
                            Duplikat file contoh konfigurasi dan buat kunci aplikasi:
                            <pre class="bg-slate-900 text-slate-100 p-3 rounded-lg text-xs font-mono mt-1 overflow-x-auto"><code>cp .env.example .env
php artisan key:generate</code></pre>
                            Buka file <code>.env</code> lalu sesuaikan pengaturan database Anda:
                            <pre class="bg-slate-900 text-slate-100 p-3 rounded-lg text-xs font-mono mt-1 overflow-x-auto"><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=</code></pre>
                        </li>
                        <li>
                            <strong>Jalankan Migrasi Database:</strong><br>
                            Buat tabel-tabel di database lokal menggunakan perintah artisan:
                            <pre class="bg-slate-900 text-slate-100 p-3 rounded-lg text-xs font-mono mt-1 overflow-x-auto"><code>php artisan migrate</code></pre>
                        </li>
                         <li>
                            <strong>Jalankan Seeder Database:</strong><br>
                            Isi data seeder pada tabel di database menggunakan perintah artisan:
                            <pre class="bg-slate-900 text-slate-100 p-3 rounded-lg text-xs font-mono mt-1 overflow-x-auto"><code>php artisan db:seed</code></pre>
                        </li>
                        <li>
                            <strong>Kompilasi Asset Frontend (Vite):</strong><br>
                            Jalankan server Vite untuk memproses Tailwind CSS secara <em>real-time</em>:
                            <pre class="bg-slate-900 text-slate-100 p-3 rounded-lg text-xs font-mono mt-1 overflow-x-auto"><code>npm run dev</code></pre>
                        </li>
                        <li>
                            <strong>Jalankan Server Lokal Laravel:</strong><br>
                            Buka terminal terpisah, lalu jalankan perintah server utama:
                            <pre class="bg-slate-900 text-slate-100 p-3 rounded-lg text-xs font-mono mt-1 overflow-x-auto"><code>php artisan serve</code></pre>
                            Akses aplikasi melalui browser di alamat: <code class="bg-gray-100 px-2 py-0.5 mt-2 rounded text-indigo-600 text-xs font-semibold">http://127.0.0.1:8000</code>
                        </li>
                    </ol>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>