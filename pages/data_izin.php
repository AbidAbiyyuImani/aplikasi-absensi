<?php include 'config/functions.php';
// redirect user (admin only)
if ($_SESSION['pengguna']['level'] === 'User') { echo "<script>alert('Hanya admin yang dapat mengakses');location.href='index.php';</script>"; };
?>
<?php $namaHalaman = "Izin"; $linkHalaman = "Data Izin"; include 'components/breadcrumb.php';?>
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-primary">
      <div class="card-body"></div>
    </div>
  </div>
</div>