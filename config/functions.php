<?php 
// query
function querySQL($sql) {
  global $db;
  $query = mysqli_query($db, $sql);
  return $query;
}

// control upload files
function upload($source, $allowed, $destination) {
  $namaFile = $_FILES[$source]['name'];
  $tmp = $_FILES[$source]['tmp_name'];
  $error = $_FILES[$source]['error'];

  if($error === 4) {
    echo '<script>alert("Pilih foto terlebih dahulu!");</script>';
    return false;
  }

  $ekstensiValid = $allowed;
  $ekstensi = explode('.', $namaFile);
  $ekstensi = strtolower(end($ekstensi));

  if(!in_array($ekstensi, $ekstensiValid)) {
    echo '<script>alert("Ekstensi file tidak valid!");</script>';
    return false;
  }

  $namaFile = time();
  $namaFile .= '.';
  $namaFile .= $ekstensi;

  move_uploaded_file($tmp, $destination . $namaFile);

  return $namaFile;
}

// get total data
function getTotal($table) {
  global $db;
  return mysqli_num_rows(mysqli_query($db, "SELECT * FROM $table"));
}

// get date time now
function getDateTimeNow() {
  date_default_timezone_set('Asia/Jakarta');
  $dateNow = date('D-d-F-Y');
  $timeNow = date('H:i');
  $days = [
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
  ];
  $months = [
    'January' => 'Januari',
    'February' => 'Februari',
    'March' => 'Maret',
    'April' => 'April',
    'May' => 'Mei',
    'June' => 'Juni',
    'July' => 'Juli',
    'August' => 'Agustus',
    'September' => 'September',
    'October' => 'Oktober',
    'November' => 'November',
    'December' => 'Desember'
  ];
  $exp = explode('-', $dateNow);
  $hari = $exp[0]; $month = $exp[2];
  $month = strtr($month, $months); $hari = strtr($hari, $days);
  $hari .= ', '. $exp[1] . ' ' . $month . ' ' . $exp[3] . ' ' . $timeNow;
  return $hari;
}

function dateToFullDate($date) {
  $format = explode('-', $date);
  $month = [
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
  ];
  $month = strtr($format[1], $month);
  return $format[2] . ' ' . $month . ' ' . $format[0];
}

?>