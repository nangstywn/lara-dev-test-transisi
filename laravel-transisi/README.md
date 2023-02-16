## Laravel
Requirement : 

1. Aplikasi memiliki proses autentikasi untuk administrator. Gunakan database seeds untuk membuat user dengan email :
admin@transisi.id dan password : transisi :heavy_check_mark:
2. Aplikasi memiliki fungsionalitas CRUD untuk data companies dan employees. Gunakan Laravel Resource Controllers dengan default
methods. Pada companies/employees list gunakan laravel pagination, tampilkan 5 data per halaman. :heavy_check_mark:
3. Data companies yang disimpan adalah : Nama (wajib), email (wajib), logo (wajib, minimum 100x100 px, png, ukuran maks 2 MB),
website (wajib). Simpan company logo pada folder storage/app/company. :heavy_check_mark:
4. Data employees yang disimpan adalah : Nama (wajib), Company (foreign key ke company), email (wajib). :heavy_check_mark:
5. Gunakan database migrations untuk membuat schema yang diperlukan. :heavy_check_mark:
6. Gunakan laravel validation function menggunakan Request classes, untuk proses validasi data companies & employees. :heavy_check_mark:
7. Query/eloquent dalam proses CRUD dijadikan class tersendiri (terpisah dari controller). :heavy_check_mark:
8. Gunakan laravel/ui package sebagai basis user interface. :heavy_check_mark:
9. Aplikasi memiliki fungsionalitas export pdf untuk data employees pada setiap company, gunakan dompdf
(https://github.com/barryvdh/laravel-dompdf). :heavy_check_mark:
10. Aplikasi memiliki fungsionalitas import excel dengan minimum 100 records data excel (chunk per 10 data insert), sertakan contoh
file import 100 records data excel dalam pengiriman hasil tes. :heavy_check_mark: , chunk per 10 data :x:
11. Menggunakan form request untuk melakukan validasi data. :heavy_check_mark:
12. Ketika validasi salah maka old input di form tidak hilang. :heavy_check_mark:
13. Menggunakan select2 untuk dropdown company ketika menambah employee (load data menggunakan ajax dan harus terdapat
pagination). :heavy_check_mark:
