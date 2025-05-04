@extends("layauts.site")
@section("content")
<!-- Jadval -->
<table class="table table-bordered" id="teacherTable">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Ism</th>
            <th>Familiya</th>
            <th>Email</th>
            <th>Til</th>
        </tr>
    </thead>
    <tbody>
        <!-- Ma'lumotlar AJAX orqali keladi -->
    </tbody>
</table>

<!-- Sahifalash tugmalari chiqadigan joy -->
<nav>
    <ul class="pagination justify-content-center" id="pagination">
        <!-- Sahifa tugmalari shu yerda hosil bo'ladi -->
    </ul>
</nav>

<!-- Modal (ixtiyoriy agar kerak bo'lsa) -->
<div class="modal fade" id="teacherModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ma'lumotlar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Jadval quyida ko'rsatiladi.</p>
      </div>
    </div>
  </div>
</div>

@endsection


<!-- JQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function loadTeachers(page = 1) {
        $.ajax({
            url: '/fetch-teachers?page=' + page,
            method: 'GET',
            success: function (response) {
                let rows = '';
                response.data.forEach(function (teacher) {
                    rows += `<tr>
                        <td>${teacher.id}</td>
                        <td>${teacher.first_name}</td>
                        <td>${teacher.last_name}</td>
                        <td>${teacher.email}</td>
                        <td>${teacher.language}</td>
                    </tr>`;
                });
                $('#teacherTable tbody').html(rows);

                // Paginatsiya hosil qilish
                let pagination = '';
                for (let i = 1; i <= response.last_page; i++) {
                    pagination += `<li class="page-item ${i === response.current_page ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="loadTeachers(${i})">${i}</a>
                    </li>`;
                }
                $('#pagination').html(pagination);
            },
            error: function () {
                alert("Xatolik yuz berdi.");
            }
        });
    }

    $(document).ready(function () {
        loadTeachers();
    });
    </script>
