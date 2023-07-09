const table = new DataTable("#table", {
    ordering: true,
    processing: true,
    serverSide: false,
    ajax: "/api/data",
    columns: [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            width: "10px",
            orderable: false,
            searchable: false,
        },
        { data: "name", name: "name" },
        { data: "luas", name: "luas" },
        { data: "jumlah_penduduk", name: "jumlah_penduduk" },
        { data: "created_at", name: "created_at" },
        { data: "action", name: "action", orderable: false, searchable: false },
    ],
});

function onDeleteCity(e) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    $.ajax({
        url: '/' + e.dataset.id,
        type: "DELETE",
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (result) {
            table.ajax.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        },
    });
}
