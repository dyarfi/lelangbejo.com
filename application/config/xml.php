<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
**KEY untuk menambahkan keamana password
*/
$config["encryption_key"] = "LOADKICKASS*****!!";

/*
 * Folder File UPLOAD
 */
$config["dir_media"] = "media/";
$config["dir_item"] = "items/";


/*
 * Date UTC +7, waktu (jam) penyamaan pertandingan dengan waktu (jam) indonesia
 */
$config['utc_id'] = 7;

/*
 * Jumlah point untuk setiap category
 */
$config['point_register'] = 5; //5 point saat register pertama kali
$config['point_code'] = 3; // 3 point saat menukar code transaksi
$config['point_facebook'] = 1; //1 point saat share ke facebook
$config['point_twitter'] = 1; //1 point saat share ke twitter
$config['point_invitation'] = 1; //1 point saat undang teman
$config['point_bidding'] = 20; //berkurang 20 point saat bidding
$config['max_per_period'] = 0; //Jika value 0 maka takterbatas. Jika value lebih dari 0 maka point per priode untuk share fb, tw dan undang temen ditentukan
$config['max_per_day'] = 1; //Maksimal perhari 1 point untuk share fb, tw dan undang temen

$config['point_label_register'] = 'Login Pertama';
$config['point_label_code'] = 'Transaksi Kode';
$config['point_label_facebook'] = 'Share Facebook';
$config['point_label_twitter'] = 'Share Twitter';
$config['point_label_invitation'] = 'Undang Teman';
$config['point_label_bidding'] = "Lelang";

/*
 * Text untuk SOSMED
 */
$config['share_twitter'] = "Uji kadar bejomu di LELANG BEJO biar bisa beli LAPTOP HP dengan HARGA SESUKAMU! Klik www.lelangbejo.com";
$config['share_facebook'] = "Yo Konco-Konco uji kadar Bejomu di LELANG BEJO biar bisa beli LAPTOP HP dengan harga yang kalian suka! Tunggu apalagi, langsung klik www.lelangbejo.com";
$config['share_facebook_invite'] = "YYo Konco-Konco uji kadar Bejomu di LELANG BEJO biar bisa beli LAPTOP HP dengan harga yang kalian suka! Tunggu apalagi, langsung klik www.lelangbejo.com";