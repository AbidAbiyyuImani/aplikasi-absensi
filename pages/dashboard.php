<?php include 'config/functions.php'; $level = $_SESSION['pengguna']['level'];
switch ($level) {
  case "Super Admin": ?>
<h1>Super Admin Dashboard</h1>
<?php case "Admin": ?>
<h1>Admin Dashboard</h1>
<?php break; case "User": ?>
<h1>User Dashboard</h1>
<?php break; } ?>