<?php include 'config/functions.php';
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
  if (isset($_GET['id'])) {
    try {
      $idKaryawan = $_GET['id'];
      $queryDelete = querySQL("DELETE FROM users WHERE id_user = $idKaryawan");
      if($idKaryawan == $_SESSION['pengguna']['id_user']) {
        echo "<script>alertPopUp('logout.php', 'success', 'Berhasil menghapus data karyawan');</script>";
      } else if($queryDelete) {
        echo "<script>alertPopUp('?page=data_karyawan', 'success', 'Berhasil menghapus data karyawan', 'Mengalihkan ke halaman data karyawan...');</script>";
      } else {
        echo "<script>alertPopUp('?page=data_karyawan', 'error', 'Gagal menghapus data karyawan', 'Mengalihkan ke halaman data karyawan...');</script>";
      }
    } catch (Exception $e) {
      echo "<script>alertPopUp('?page=data_karyawan', 'warning', 'Tidak dapat menghapus data karyawan', 'Mengalihkan ke halaman data karyawan...');</script>";
    }
  } else {
    echo "<script>alertPopUp('?page=data_karyawan', 'error', 'Tidak ada data karyawan yang dipilih', 'Mengalihkan ke halaman data karyawan...');</script>";
  }
}
?>