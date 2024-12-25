<?php include 'config/functions.php'; $level = $_SESSION['pengguna']['level'];
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
  if (isset($_GET['id'])) {
    $idKaryawan = $_GET['id'];
    $queryKaryawan = querySQL("SELECT * FROM users WHERE id_user = '$idKaryawan'");
    $dataKaryawan = mysqli_fetch_assoc($queryKaryawan);

    if (isset($_POST['ubah_karyawan'])) {
      if (isset($_POST['divisi']) && isset($_POST['jamKerja'])) {
        try {
          $divisi = $_POST['divisi'];
          $jamKerja = $_POST['jamKerja'];
  
          if ($idKaryawan == $_SESSION['pengguna']['id_user']) {
            $_SESSION['pengguna']['divisi_id'] = $divisi;
            $_SESSION['pengguna']['jk_id'] = $jamKerja;
          }
  
          $queryUpdate = querySQL("UPDATE users SET divisi_id = '$divisi', jk_id = '$jamKerja' WHERE id_user = '$idKaryawan'");
          if ($queryUpdate) {
            echo "<script>alertPopUp('?page=data_karyawan', 'success', 'Berhasil menghubah data karyawan', 'Mengalihkan ke halaman data karyawan...');</script>";
          } else {
            echo "<script>alertPopUp(null, 'error', 'Gagal menghubah data karyawan');</script>";
          }
        } catch (Exception $e) {
          echo "<script>alertPopUp('?page=data_karyawan', 'warning', 'Tidak dapat menghubah data karyawan', 'Mengalihkan ke halaman data karyawan...');</script>";
        }
      } else {
        echo "<script>alertPopUp(null, 'warning', 'Tidak dapat mengubah data karyawan');</script>";
      }
    }
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb">Ubah Data Karyawan</h3>
    <div class="card card-outline card-warning">
      <div class="card-body">
        <form id="ubah_data_karyawan" method="post">
          <div class="form-group">
            <label for="namaLengkap">Nama Lengkap</label>
            <input type="text" name="namaLengkap" id="namaLengkap" required value="<?= $dataKaryawan['nama_lengkap']; ?>" readonly class="form-control">
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required value="<?= $dataKaryawan['username']; ?>" readonly class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required value="<?= $dataKaryawan['email']; ?>" readonly class="form-control">
          </div>
          <div class="form-group">
            <label for="divisi">Divisi</label>
            <select name="divisi" id="divisi" class="form-control">
              <option selected disabled value="null">Pilih Divisi</option>
              <?php 
                $queryDivisi = querySQL("SELECT * FROM divisi");
                if (mysqli_num_rows($queryDivisi) > 0) {
                  while ($dataDivisi = mysqli_fetch_assoc($queryDivisi)) {
              ?>
                <option value="<?= $dataDivisi['id_divisi']; ?>" <?= ($dataKaryawan['divisi_id'] == $dataDivisi['id_divisi']) ? 'selected' : '' ?>><?= $dataDivisi['nama_divisi']; ?></option>
              <?php } } else { ?>
                <option disabled>Tidak ada data divisi</option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="jamKerja">Jam Kerja</label>
            <select name="jamKerja" id="jamKerja" class="form-control">
              <option selected disabled value="null">Pilih Jam Kerja</option>
              <?php 
                $queryJamKerja = querySQL("SELECT * FROM jam_kerja");
                if (mysqli_num_rows($queryJamKerja) > 0) {
                  while ($dataJamKerja = mysqli_fetch_assoc($queryJamKerja)) {
              ?>
                <option value="<?= $dataJamKerja['id_jk']; ?>" <?= ($dataKaryawan['jk_id'] == $dataJamKerja['id_jk']) ? 'selected' : '' ?>><?= $dataJamKerja['jam_masuk'] . ' - ' . $dataJamKerja['jam_keluar']; ?></option>
              <?php } } else { ?>
                <option disabled>Tidak ada data jam kerja</option>
              <?php } ?>
            </select>
          </div>
        </form>
      </div>
      <div class="card-footer">
        <a href="?page=data_karyawan" class="btn btn-secondary">Kembali</a>
        <button type="submit" name="ubah_karyawan" form="ubah_data_karyawan" class="btn btn-warning">Ubah Data Karyawan</button>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
  <script>
    alertPopUp('?page=data_karyawan', 'error', 'Tidak ada data karyawan yang dipilih', 'Mengalihkan ke halaman data karyawan...');
  </script>
<?php } } ?>