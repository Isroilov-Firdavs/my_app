@extends("layauts.site")

@section("content")
<div class="container mt-4">
    <h2>O'qituvchilar ro'yxati</h2>

    <!-- Create Form -->
    <form id="createForm" class="row g-2 mb-4">
        <div class="col-md-3"><input type="text" class="form-control" name="first_name" placeholder="Ism"></div>
        <div class="col-md-3"><input type="text" class="form-control" name="last_name" placeholder="Familiya"></div>
        <div class="col-md-3"><input type="email" class="form-control" name="email" placeholder="Email"></div>
        <div class="col-md-2"><input type="text" class="form-control" name="language" placeholder="Til"></div>
        <div class="col-md-1"><button type="submit" class="btn btn-success">Qo'shish</button></div>
    </form>

    <table class="table table-bordered">
        <thead><tr>
            <th>ID</th><th>Ism</th><th>Familiya</th><th>Email</th><th>Tili</th><th>Amallar</th>
        </tr></thead>
        <tbody id="teacherTable"></tbody>
    </table>

    <ul class="pagination" id="pagination"></ul>
</div>

<script>
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    // Fetch data
    function fetchData(page = 1) {
        $.get(`/ajax-data?page=${page}`, function(res) {
            let rows = '';
            $.each(res.data, function(i, t) {
                rows += `<tr>
                    <td>${t.id}</td>
                    <td><input type="text" value="${t.first_name}" data-id="${t.id}" class="form-control edit-firstname"></td>
                    <td><input type="text" value="${t.last_name}" data-id="${t.id}" class="form-control edit-lastname"></td>
                    <td><input type="email" value="${t.email}" data-id="${t.id}" class="form-control edit-email"></td>
                    <td><input type="text" value="${t.language}" data-id="${t.id}" class="form-control edit-language"></td>
                    <td>
                        <button class="btn btn-primary btn-sm update" data-id="${t.id}">Saqlash</button>
                        <button class="btn btn-danger btn-sm delete" data-id="${t.id}">O'chirish</button>
                    </td>
                </tr>`;
            });
            $('#teacherTable').html(rows);

            // Pagination
            let pag = '';
            for (let i = 1; i <= res.last_page; i++) {
                pag += `<li class="page-item ${res.current_page == i ? 'active' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="fetchData(${i})">${i}</a></li>`;
            }
            $('#pagination').html(pag);
        });
    }

    fetchData();

    // Store
    $('#createForm').submit(function(e) {
        e.preventDefault();
        const data = $(this).serialize();
        $.post("/ajax", data, function(res) {
            alert(res.success);
            fetchData();
            $('#createForm')[0].reset();
        });
    });

    // Update
    $(document).on('click', '.update', function () {
        const id = $(this).data('id');
        const row = $(this).closest('tr');
        const data = {
            first_name: row.find('.edit-firstname').val(),
            last_name: row.find('.edit-lastname').val(),
            email: row.find('.edit-email').val(),
            language: row.find('.edit-language').val(),
        };

        $.ajax({
            url: `/ajax/${id}`,
            type: 'PUT',
            data: data,
            success: function (res) {
                alert(res.success);
                fetchData();
            }
        });
    });

    // Delete
    $(document).on('click', '.delete', function () {
        const id = $(this).data('id');
        if (confirm('O‘chirishni istaysizmi?')) {
            $.ajax({
                url: `/ajax/${id}`,
                type: 'DELETE',
                success: function (res) {
                    alert(res.success);
                    fetchData();
                }
            });
        }
    });
</script>
@endsection
