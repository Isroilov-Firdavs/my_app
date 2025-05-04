<div class="modal fade" id="teacherModal" tabindex="-1">
    <div class="modal-dialog">
      <form id="teacherForm">
          @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTitle">Qo‘shish</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="teacherId">
                <input type="text" name="first_name" id="first_name" class="form-control mb-2" placeholder="Ism" required>
                <input type="text" name="last_name" id="last_name" class="form-control mb-2" placeholder="Familiya" required>
                <input type="email" name="email" id="email" class="form-control mb-2" placeholder="Email" required>
                <input type="text" name="language" id="language" class="form-control mb-2" placeholder="Til" required>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Saqlash</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
            </div>
          </div>
      </form>
    </div>
  </div>
