<?php include 'config/functions.php'; $level = $_SESSION['pengguna']['level']; $idKaryawan = $_SESSION['pengguna']['id_user'];
// mengalihkan karyawan ke halaman utama
if ($_SESSION['pengguna']['level'] === 'Karyawan') {
  echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";
} else {
?>
<div class="row">
  <div class="col-12">
    <h3 class="mb-3">Data Karyawan</h3>
    <div class="card card-outline card-info">
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-data" class="table table-bordered text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Email</th>
                <th>Divisi</th>
                <th>Jam Kerja</th>
                <th>Level</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                $queryUsers = querySQL("SELECT * FROM users LEFT JOIN divisi ON users.divisi_id = divisi.id_divisi LEFT JOIN jam_kerja ON users.jk_id = jam_kerja.id_jk");
                while ($dataUser = mysqli_fetch_assoc($queryUsers)) {
              ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $dataUser['nama_lengkap'] ?></td>
                  <td><?= $dataUser['username'] ?></td>
                  <td><?= $dataUser['email'] ?></td>
                  <td><?= ($dataUser['nama_divisi']) ? $dataUser['nama_divisi'] : '-' ?></td>
                  <td><?= $dataUser['jam_masuk'] ?> - <?= $dataUser['jam_pulang'] ?></td>
                  <td><?= $dataUser['level'] ?></td>
                  <td>
                    <a href="?page=ubah_karyawan&id=<?= $dataUser['id_user'] ?>" class="btn btn-warning">Ubah</a>
                    <?php if ($dataUser['id_user'] == $_SESSION['pengguna']['id_user']) { ?>
                      <button disabled class="btn btn-success">Aktif</button>
                    <?php } else { ?>
                      <button onclick="return confirmPopUp('warning', 'Hapus Karyawan', 'Apakah anda yakin ingin menghapus data karyawan ini?', 'Yakin', 'Tidak', '?page=hapus_karyawan&id=<?= $dataUser['id_user'] ?>', '?page=data_karyawan');" class="btn btn-danger">Hapus</button>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <a href="register.php" class="btn btn-primary float-right">Tambahkan Karyawan</a>
      </div>
    </div>
  </div>
</div>
<?php } ?>