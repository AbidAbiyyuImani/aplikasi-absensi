function popUp(cancelButton = false, href = null, title, text, icon, timer = 2000, rdHref = null, confirmText = null, cancelText = null) {
  if (cancelButton == false) {
    if (href !== null) {
      Swal.fire({
        title: title,
        text: text,
        icon: icon,
        timer: timer,
        showConfirmButton: cancelButton,
      }).then(function () {
        window.location.href = href;
      });
    } else {
      Swal.fire({
        title: title,
        text: text,
        icon: icon,
        timer: timer,
        showConfirmButton: cancelButton,
      });
    }
  } else if (cancelButton == true && href == null) {
    Swal.fire({
      title: title,
      text: text,
      icon: icon,
      showConfirmButton: cancelButton,
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'index.php';
      }
    });
  } else {
    Swal.fire({
      title: title,
      text: text,
      icon: icon,
      showCancelButton: cancelButton,
      confirmButtonText: confirmText,
      cancelButtonText: cancelText
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = href;
      } else {
        if (backHref !== null) {
          window.location.href = backHref;
        } else {
          window.location.href = 'index.php';
        }
      }
    });
  }
}
// popUp(false, null, 'title', 'text', 'success');
// popUp(true, '?page=absen_masuk', 'title', 'redirecting to absen masuk', 'success', 5000, null);