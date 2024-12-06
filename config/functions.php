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

  $namaFile = uniqid();
  $namaFile .= '.';
  $namaFile .= $ekstensi;

  move_uploaded_file($tmp, $destination . $namaFile);

  return $namaFile;
}

?>