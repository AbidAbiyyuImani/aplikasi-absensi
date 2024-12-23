$(function () {
  $("#table-data").DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: false,
    info: true,
    autoWidth: false,
    responsive: true,
  });
});

// export to csv, excel, pdf datatables
$(function () {
  $("#export-table-data").DataTable({
    paging: true,
    lengthChange: false,
    searching: true,
    ordering: false,
    info: true,
    autoWidth: false,
    responsive: true,
    buttons: [
      {
        extend: "pageLength",
        className: "btn btn-default"
      },
      {
        extend: "csv",
        className: "btn btn-default",
        exportOptions: {
          columns: "th:not(:last-child)",
        },
      },
      {
        extend: "excel",
        className: "btn btn-default",
        exportOptions: {
          columns: "th:not(:last-child)",
        },
      },
      {
        extend: "pdf",
        className: "btn btn-default",
        exportOptions: {
          columns: "th:not(:last-child)",
        },
      },
      {
        extend: "colvis",
        className: "btn btn-default"
      }
    ]
  }).buttons(0, null).container().appendTo("#export-table-data_wrapper .col-md-6:eq(0)");
});


// exportOptions: {
//   columns: "th:not(:last-child)",
// },