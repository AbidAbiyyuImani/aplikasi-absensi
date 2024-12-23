<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
  if (isset($_GET['id'])) {
    try {
      $idIzin = $_GET['id'];
      $queryDelete = querySQL("DELETE FROM absensi_izin WHERE id_absensi_izin = $idIzin");
      if ($queryDelete) {
        echo "<script>alertPopUp('?page=data_absensi_izin', 'success', 'Berhasil menghapus data permohonan izin', 'Mengalihkan ke halaman data izin...');</script>";
      } else {
        echo "<script>alertPopUp('?page=data_absensi_izin', 'error', 'Gagal menghapus data permohonan izin', 'Mengalihkan ke halaman data izin...');</script>";
      }
    } catch (Exception $e) {
      echo "<script>alertPopUp('?page=data_absensi_izin', 'warning', 'Tidak dapat menghapus data permohonan izin', 'Mengalihkan ke halaman data izin...');</script>";
    }
  } else {
    echo "<script>alertPopUp('?page=data_absensi_izin', 'error', 'Tidak ada data permohonan izin yang dipilih', 'Mengalihkan ke halaman data izin...');</script>";
  }
}
?>