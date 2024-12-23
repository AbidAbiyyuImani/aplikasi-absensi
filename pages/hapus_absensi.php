<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
  if (isset($_GET['id'])) {
    try {
      $idAbsensi = $_GET['id'];
      $queryDelete = querySQL("DELETE FROM absensi WHERE id_absensi = $idAbsensi");
      if ($queryDelete) {
        echo "<script>alertPopUp('?page=data_absensi', 'success', 'Berhasil menghapus data absensi', 'Mengalihkan ke halaman data absensi...');</script>";
      } else {
        echo "<script>alertPopUp('?page=data_absensi', 'error', 'Gagal menghapus data absensi', 'Mengalihkan ke halaman data absensi...');</script>";
      }
    } catch (Exception $e) {
      echo "<script>alertPopUp('?page=data_absensi', 'warning', 'Tidak dapat menghapus data absensi', 'Mengalihkan ke halaman data absensi...');</script>";
    }
  } else {
    echo "<script>alertPopUp('?page=data_absensi', 'error', 'Tidak ada data absensi yang dipilih', 'Mengalihkan ke halaman data absensi...');</script>";
  }
}
?>