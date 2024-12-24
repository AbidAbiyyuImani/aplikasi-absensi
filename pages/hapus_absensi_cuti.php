<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
  if (isset($_GET['id'])) {
    try {
      $idCuti = $_GET['id'];
      $queryDelete = querySQL("DELETE FROM absensi_cuti WHERE id_absensi_cuti = $idCuti");
      if ($queryDelete) {
        echo "<script>alertPopUp('?page=data_absensi_cuti', 'success', 'Berhasil menghapus data permohonan cuti', 'Mengalihkan ke halaman data cuti...');</script>";
      } else {
        echo "<script>alertPopUp('?page=data_absensi_cuti', 'error', 'Gagal menghapus data permohonan cuti', 'Mengalihkan ke halaman data cuti...');</script>";
      }
    } catch (Exception $e) {
      echo "<script>alertPopUp('?page=data_absensi_cuti', 'warning', 'Tidak dapat menghapus data permohonan cuti', 'Mengalihkan ke halaman data cuti...');</script>";
    }
  } else {
    echo "<script>alertPopUp('?page=data_absensi_cuti', 'error', 'Tidak ada data permohonan cuti yang dipilih', 'Mengalihkan ke halaman data cuti...');</script>";
  }
}
?>