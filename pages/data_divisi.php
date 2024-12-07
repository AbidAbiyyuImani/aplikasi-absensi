<?php include 'config/functions.php'; ?>
<?php $namaHalaman = "Divisi"; $linkHalaman = "Data Divisi"; include 'components/breadcrumb.php';?>
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <div class="table-responsive">
          <table id="divisi" class="table table-bordered text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Divisi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i = 1;
                $queryDivisi = querySQL("SELECT * FROM divisi");
                if(mysqli_num_rows($queryDivisi) > 0) {
                while ($dataDivisi = mysqli_fetch_assoc($queryDivisi)) {
              ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= $dataDivisi['nama_divisi'] ?></td>
                  <td>
                    <a href="?page=ubah_divisi&id=<?= $dataDivisi['id_divisi'] ?>" class="btn btn-warning">Ubah</a>
                    <a href="?page=hapus_divisi&id=<?= $dataDivisi['id_divisi'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data divisi ini?')" class="btn btn-danger">Hapus</a>
                  </td>
                </tr>
              <?php } } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <a href="?page=tambah_divisi" class="btn btn-primary float-right">Tambah</a>
      </div>
    </div>
  </div>
</div>