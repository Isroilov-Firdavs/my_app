function loadTeachers(page = 1) {
    $.get(`/fetch-teachers?page=${page}`, function (res) {
        let rows = '';
        res.data.forEach(t => {
            rows += `
                <tr>
                    <td>${t.id}</td>
                    <td>${t.first_name}</td>
                    <td>${t.last_name}</td>
                    <td>${t.email}</td>
                    <td>${t.language}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editTeacher(${t.id})">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteTeacher(${t.id})">Delete</button>
                    </td>
                </tr>`;
        });
        $('#teacherTable tbody').html(rows);

        let pagination = '';
        for (let i = 1; i <= res.last_page; i++) {
            pagination += `<li class="page-item ${i === res.current_page ? 'active' : ''}">
                <a class="page-link" href="#" onclick="loadTeachers(${i})">${i}</a>
            </li>`;
        }
        $('#pagination').html(pagination);
    });
}

function showAddModal() {
    $('#teacherForm')[0].reset();
    $('#teacherId').val('');
    $('#modalTitle').text('Yangi o‘qituvchi qo‘shish');
    $('#teacherModal').modal('show');
}

$('#teacherForm').on('submit', function (e) {
    e.preventDefault();
    let id = $('#teacherId').val();
    let url = id ? `/teachers/${id}` : '/teachers';
    let method = id ? 'PUT' : 'POST';

    $.ajax({
        url,
        type: method,
        data: $(this).serialize(),
        success: function () {
            $('#teacherModal').modal('hide');
            loadTeachers();
        },
        error: function () {
            alert("Xatolik yuz berdi!");
        }
    });
});

function editTeacher(id) {
    $.get(`/teachers/${id}`, function (t) {
        $('#teacherId').val(t.id);
        $('#first_name').val(t.first_name);
        $('#last_name').val(t.last_name);
        $('#email').val(t.email);
        $('#language').val(t.language);
        $('#modalTitle').text("O'qituvchini tahrirlash");
        $('#teacherModal').modal('show');
    });
}

function deleteTeacher(id) {
    if (confirm("Ishonchingiz komilmi?")) {
        $.ajax({
            url: `/teachers/${id}`,
            type: 'DELETE',
            data: {_token: '{{ csrf_token() }}'},
            success: function () {
                loadTeachers();
            }
        });
    }
}

$(function () {
    loadTeachers();
});
