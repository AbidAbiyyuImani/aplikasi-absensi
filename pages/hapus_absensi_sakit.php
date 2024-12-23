<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
  if (isset($_GET['id'])) {
    try {
      $idSakit = $_GET['id'];
      $queryDelete = querySQL("DELETE FROM absensi_sakit WHERE id_absensi_sakit = $idSakit");
      if ($queryDelete) {
        echo "<script>alertPopUp('?page=data_absensi_sakit', 'success', 'Berhasil menghapus data permohonan sakit', 'Mengalihkan ke halaman data sakit...');</script>";
      } else {
        echo "<script>alertPopUp('?page=data_absensi_sakit', 'error', 'Gagal menghapus data permohonan sakit', 'Mengalihkan ke halaman data sakit...');</script>";
      }
    } catch (Exception $e) {
      echo "<script>alertPopUp('?page=data_absensi_sakit', 'warning', 'Tidak dapat menghapus data permohonan sakit', 'Mengalihkan ke halaman data sakit...');</script>";
    }
  } else {
    echo "<script>alertPopUp('?page=data_absensi_sakit', 'error', 'Tidak ada data permohonan sakit yang dipilih', 'Mengalihkan ke halaman data sakit...');</script>";
  }
}
?>