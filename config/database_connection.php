<?php 
if(!isset($_SESSION)) {
  session_start();
}
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBPORT', 3306);
define('DBNAME', 'absensi_karyawan');

$db = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME, DBPORT);

if(!$db) {
  die('Gagal terhubung dengan database: ' . mysqli_connect_error());
}

?>