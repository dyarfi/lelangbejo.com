<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
| ['hostname'] Nama host dari server database Anda.
| ['Username'] The username yang digunakan untuk menghubungkan ke database
| ['Password'] Password digunakan untuk menyambung ke database
| ['Database'] Nama database Anda ingin terhubung ke
| ['Dbdriver'] Jenis database. yaitu: mysql. Saat ini didukung:mysql, mysqli, Postgre, ODBC, MSSQL, sqlite, oci8
| ['Dbprefix'] Anda dapat menambahkan prefiks opsional, yang akan ditambahkan
| Ke nama tabel ketika menggunakan kelas Rekaman Aktif
| ['Pconnect'] BENAR / SALAH - Apakah akan menggunakan koneksi persistent
| ['Db_debug'] BENAR / SALAH - Apakah kesalahan database harus ditampilkan.
| ['Cache_on'] BENAR / SALAH - Mengaktifkan / menonaktifkan permintaan caching
| ['Cachedir'] Jalan ke folder di mana file cache harus disimpan
| ['Char_set'] Karakter set yang digunakan dalam berkomunikasi dengan database
| ['Dbcollat??'] The pemeriksaan karakter yang digunakan dalam berkomunikasi dengan database
| ['Swap_pre'] Sebuah tabel default awalan yang harus ditukarkan dengan dbprefix
| ['Autoinit'] Apakah atau tidak untuk secara otomatis menginisialisasi database.
| ['Stricton'] BENAR / SALAH - 'Mode Ketat' kekuatan koneksi
| 							 - Baik untuk memastikan SQL yang ketat ketika mengembangkan
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'lelangbejo';
$db['default']['password'] = 'load2014!!';
$db['default']['database'] = 'lelangbejo';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = FALSE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */