function alertPopUp(href=null, icon, title, text, timer = 3000) {
  if (href !== null) {
    Swal.fire({
      icon: icon,
      title: title,
      text: text,
      timer: timer,
      showConfirmButton: false
    }).then((result) => {
      window.location.href = href;
    });
  } else {
    Swal.fire({
      icon: icon,
      title: title,
      text: text,
      timer: timer,
      showConfirmButton: false
    });
  }
}
// echo "<script>alertPopUp('href', 'icon', 'title', 'text', 'timer');</script>";
// mengalihkan user ke halaman utama
// echo "<script>alertPopUp('index.php', 'error', 'Gagal', 'Anda tidak memiliki akses ke halaman ini.');</script>";

function confirmPopUp(icon, title, text, confirmText, cancelText, href, rdHref = null) {
  Swal.fire({
    title: title,
    text: text,
    icon: icon,
    showCancelButton: true,
    confirmButtonText: confirmText,
    cancelButtonText: cancelText
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = href;
    } else {
      if (rdHref !== null) {
        window.location.href = rdHref;
      } else {
        window.location.href = 'index.php';
      }
    }
  });
}
// echo "<script>confirmPopUp('icon', 'title', 'text', 'confirmText', 'cancelText', 'href', 'rdHref');</script>";