<?php include 'config/functions.php'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <a href="?page=tambah_divisi" class="mb-3 btn btn-primary float-right">Tambah</a>
        <div class="table-responsive">
          <table class="table table-bordered text-nowrap">
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
                // ada data
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
              <?php } }else { ?>
                <!-- ga ada data -->
                <tr>
                  <td colspan="3" class="text-center">Tidak ada data divisi</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>