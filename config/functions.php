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

// get date now
function dateToFullDate() {
  date_default_timezone_set('Asia/Jakarta');
  $date = date('D-d-m-Y');
  $format = explode('-', $date);
  $months = [
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
  $days = [
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
  ];
  $format[0] = strtr($format[0], $days);
  $format[2] = strtr($format[2], $months);
  return $format[0] . ', ' . $format[1] . ' ' . $format[2] . ' ' . $format[3];
}

?>