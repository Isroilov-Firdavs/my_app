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
$(document).ready(function () {
    $.ajax({
        url: '/fetch-teachers',
        method: 'GET',
        success: function (data) {
            let rows = '';
            data.forEach(function (teacher) {
                rows += `<tr>
                    <td>${teacher.id}</td>
                    <td>${teacher.first_name}</td>
                    <td>${teacher.last_name}</td>
                    <td>${teacher.email}</td>
                    <td>${teacher.language}</td>
                </tr>`;
            });
            $('#teacherTable tbody').html(rows);
        },
        error: function (err) {
            alert('Maʼlumotlarni yuklashda xatolik yuz berdi');
            console.log(err);
        }
    });
});
</script>
