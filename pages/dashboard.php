<?php include 'config/functions.php'; $level = $_SESSION['pengguna']['level'];
switch ($level) {
  case "Super Admin": ?>
<?php case "Admin": ?>

<div class="row">
  <div class="col-12">
    <h3 class="mb-3"><?= getDateTimeNow(); ?></h3>
  </div>
  <div class="col-12 col-sm-6 col-md-4">
    <a href="?page=data_karyawan">
      <div class="info-box bg-gradient-info">
        <span class="info-box-icon"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Karyawan</span>
          <span class="info-box-number"><?= getTotal("users"); ?></span>
        </div>
      </div>
    </a>
  </div>
  <div class="col-12 col-sm-6 col-md-4">
    <a href="?page=data_divisi">
      <div class="info-box bg-gradient-info">
        <span class="info-box-icon"><i class="fas fa-user"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Divisi</span>
          <span class="info-box-number"><?= getTotal("divisi"); ?></span>
        </div>
      </div>
    </a>
  </div>
  <div class="col-12 col-sm-6 col-md-4">
    <a href="?page=data_jam">
      <div class="info-box bg-gradient-info">
        <span class="info-box-icon"><i class="fas fa-clock"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Jam Kerja</span>
          <span class="info-box-number"><?= getTotal("jam_kerja") ?></span>
        </div>
      </div>
    </a>
  </div>
</div>

<?php break; case "User": ?>
<h1>User Dashboard</h1>
<?php break; } ?>