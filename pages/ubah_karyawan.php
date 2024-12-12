<?php include 'config/functions.php'; $level = $_SESSION['pengguna']['level'];
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };

$idUser = $_GET['id'];
$queryUser = querySQL("SELECT * FROM users WHERE id_user = '$idUser'");
$dataUser = mysqli_fetch_assoc($queryUser);

if(isset($_POST['ubah_karyawan'])) {
  try {
    switch ($level) {
      case "Super Admin":
        $namaLengkap = $_POST['namaLengkap'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $divisi = $_POST['divisi'];
        $jamKerja = $_POST['jamKerja'];
      
        if($idUser == $_SESSION['pengguna']['id_user']) {
          $_SESSION['pengguna']['nama_lengkap'] = $namaLengkap;
          $_SESSION['pengguna']['username'] = $username;
          $_SESSION['pengguna']['email'] = $email;
          $_SESSION['pengguna']['divisi_id'] = $divisi;
          $_SESSION['pengguna']['jam_id'] = $jamKerja;
        }
      
        $queryUpdate = querySQL("UPDATE users SET nama_lengkap = '$namaLengkap', username = '$username', email = '$email', divisi_id = '$divisi', jam_id = '$jamKerja' WHERE id_user = '$idUser'");
        if($queryUpdate) {
          echo "<script>alert('Ubah Data Karyawan Berhasil');location.href='?page=data_karyawan';</script>";
        } else {
          echo "<script>alert('Ubah Data Karyawan Gagal');</script>";
        }
      break;
      case "Admin":
        $divisi = $_POST['divisi'];
        $jamKerja = $_POST['jamKerja'];
      
        if($idUser == $_SESSION['pengguna']['id_user']) {
          $_SESSION['pengguna']['divisi_id'] = $divisi;
          $_SESSION['pengguna']['jam_id'] = $jamKerja;
        }
      
        $queryUpdate = querySQL("UPDATE users SET divisi_id = '$divisi', jam_id = '$jamKerja' WHERE id_user = '$idUser'");
        if($queryUpdate) {
          echo "<script>alert('Ubah Data Karyawan Berhasil');location.href='?page=data_karyawan';</script>";
        } else {
          echo "<script>alert('Ubah Data Karyawan Gagal');</script>";
        }
      break;
    }
  } catch (Exception $e) {
    echo "<script>alert('Ubah Data Karyawan Gagal');location.href='?page=data_karyawan';</script>";
  }
}
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h3 class="mb-3">Ubah Data Karyawan</h3>
        <form method="post">
          <div class="form-group">
            <label for="namaLengkap">Nama Lengkap</label>
            <input type="text" name="namaLengkap" id="namaLengkap" required value="<?= $dataUser['nama_lengkap']; ?>" <?= ($level === "Admin") ? 'readonly' : '' ?> class="form-control">
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required value="<?= $dataUser['username']; ?>" <?= ($level === "Admin") ? 'readonly' : '' ?> class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required value="<?= $dataUser['email']; ?>" <?= ($level === "Admin") ? 'readonly' : '' ?> class="form-control">
          </div>
          <div class="form-group">
            <label for="divisi">Divisi</label>
            <?php if ($dataUser['divisi_id'] == null) { ?>
              <!-- ga ada isi -->
              <select name="divisi" id="divisi" class="form-control">
                <option selected disabled>Pilih Divisi</option>
                <?php
                  $queryDivisi = querySQL("SELECT * FROM divisi");
                  if (mysqli_num_rows($queryDivisi) > 0) {
                    while ($dataDivisi = mysqli_fetch_assoc($queryDivisi)) {
                ?>
                  <option value="<?= $dataDivisi['id_divisi']; ?>"><?= $dataDivisi['nama_divisi']; ?></option>
                <?php } } else { ?>
                  <option disabled>Tidak ada divisi</option>
                <?php } ?>
              </select>
            <?php } else { ?>
              <!-- ada isi -->
              <select name="divisi" id="divisi" class="form-control">
                <option selected disabled>Pilih Divisi</option>
                <?php
                  $queryDivisi = querySQL("SELECT * FROM divisi");
                  if (mysqli_num_rows($queryDivisi) > 0) {
                    while ($dataDivisi = mysqli_fetch_assoc($queryDivisi)) {
                ?>
                  <option value="<?= $dataDivisi['id_divisi']; ?>" <?= ($dataUser['divisi_id'] == $dataDivisi['id_divisi']) ? 'selected' : '' ?>><?= $dataDivisi['nama_divisi']; ?></option>
                <?php } }?>
              </select>
            <?php } ?>
          </div>
          <div class="form-group">
            <label for="jamKerja">Jam Kerja</label>
            <?php if ($dataUser['jam_id'] == null) { ?>
              <!-- ga ada isi -->
              <select name="jamKerja" id="jamKerja" class="form-control">
                <option selected disabled>Pilih Jam Masuk</option>
                <?php 
                  $queryJamKerja = querySQL("SELECT * FROM jam_kerja");
                  if (mysqli_num_rows($queryJamKerja) > 0) {
                    while ($dataJamKerja = mysqli_fetch_assoc($queryJamKerja)) {
                ?>
                  <option value="<?= $dataJamKerja['id_jam']; ?>"><?= $dataJamKerja['jam_masuk']; ?> - <?= $dataJamKerja['jam_keluar']; ?></option>
                <?php } } else { ?>
                  <option disabled>Tidak ada jam kerja</option>
                <?php } ?>
              </select>
            <?php } else { ?>
              <!-- ada isi -->
               <select name="jamKerja" id="jamKerja" class="form-control">
                <option selected disabled>Pilih Jam Masuk</option>
                <?php 
                  $queryJamKerja = querySQL("SELECT * FROM jam_kerja");
                  if (mysqli_num_rows($queryJamKerja) > 0) {
                    while ($dataJamKerja = mysqli_fetch_assoc($queryJamKerja)) {
                ?>
                  <option value="<?= $dataJamKerja['id_jam']; ?>" <?= ($dataUser['jam_id'] == $dataJamKerja['id_jam']) ? 'selected' : '' ?>><?= $dataJamKerja['jam_masuk']; ?> - <?= $dataJamKerja['jam_keluar']; ?></option>
                <?php } } ?>
              </select>
            <?php } ?>
          </div>
          <a href="?page=data_karyawan" class="btn btn-secondary">Kembali</a>
          <button type="submit" name="ubah_karyawan" class="btn btn-warning">Ubah Data Karyawan</button>
        </form>
      </div>
    </div>
  </div>
</div>