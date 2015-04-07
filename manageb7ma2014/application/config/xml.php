<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
**KEY untuk menambahkan keamana password
*/
$config["encryption_key"] = "LOADKICKASS****!!";

/*
 * Folder File UPLOAD
 */
$config["dir_item"] = "/home/tab4better/public_html/lelangbejo.com/items/";
$config["url_item"] = "https://lelangbejo.com/items/";
$config["url_media"] = "https://lelangbejo.com/media/";

/*
 * Max login
 */
$config['max_login'] = 3;

/*
 * Jumlah jam untuk buka kunci (bisa login kembali)
 */
$config['en_hours'] = 5;


$config['role_dev'] = 1;
$config['role_adm'] = 2;

/*
 * Nilai point
 */
$config['point'] = 3;