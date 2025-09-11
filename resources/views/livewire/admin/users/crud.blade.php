<!-- Modal -->
<div class="modal fade" id="modalCrud" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formSubmit" enctype="multipart/form-data" class="form-loading" name="formSubmit" method="post">
                @csrf
                <div class="modal-body">
                    <input type="text" hidden id="id" name="id">
                    <input type="text" hidden id="crudAction" name="crudAction">
                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label for="noreg" class="form-label">NOREG *</label>
                            <input type="text" class="form-control form-control-sm" id="noreg" name="noreg" placeholder="Noreg">
                            <span class="text-danger fs-9 error-text" id="error-noreg"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="nama" class="form-label">NAMA</label>
                            <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Nama">
                            <span class="text-danger fs-9 error-text" id="error-nama"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="password" class="form-label">PASSWORD *</label>
                            <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Password">
                            <span class="text-danger fs-9 error-text" id="error-password"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Email">
                            <span class="text-danger fs-9 error-text" id="error-email"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="department_id" class="form-label">Department</label>
                            <select name="department_id" class="form-select form-select-sm" id="department_id">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->code  .' : '. $department->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger fs-9 error-text" id="error-department_id"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="role_id" class="form-label">Role</label>
                            <select name="role_id" class="form-select form-select-sm" id="role_id">
                                <option value="">Select Roles</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->role_id }}">{{ $role->name_role }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger fs-9 error-text" id="error-role_id"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="level_id" class="form-label">Level</label>
                            <select name="level_id" class="form-select form-select-sm" id="level_id">
                                <option value="">Select Level</option>
                                @foreach($levels as $level)
                                <option value="{{ $level->level_id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger fs-9 error-text" id="error-level_id"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control form-control-sm" id="photo" name="photo" placeholder="photo">
                            <span class="text-danger fs-9 error-text" id="error-photo"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnSave" type="button" class="btn btn-sm btn-success bg-custom-navbar text-white">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>