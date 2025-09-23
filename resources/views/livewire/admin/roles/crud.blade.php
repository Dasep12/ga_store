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
                        <div class="col-md-6">
                            <div class="col-md-12 mb-3">
                                <label for="role_id" class="form-label">Role ID *</label>
                                <input type="text" class="form-control form-control-sm" id="role_id" name="role_id" placeholder="Role ID">
                                <span class="text-danger fs-9 error-text" id="error-role_id"></span>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="name_role" class="form-label">NAMA</label>
                                <input type="text" class="form-control form-control-sm" id="name_role" name="name_role" placeholder="Nama">
                                <span class="text-danger fs-9 error-text" id="error-name_role"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered small table-sm">
                                <thead class="bg-custom-navbar text-white">
                                    <tr>
                                        <th class="text-white">No</th>
                                        <th class="text-white">Menu</th>
                                        <th class="text-white text-center" align="center">
                                            <input class="form-check-input" id="check_all" type="checkbox" wire:ignore />
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($menu as $index => $m)
                                    <tr>
                                        <td align="center">{{ $index + 1 }}</td>
                                        <td>
                                            @if($m->icon)
                                            <span class="nav-link-icon"><span style="height:15px !important" data-feather="{{ $m->icon }}"></span></span>
                                            @endif
                                            @if($m->level == 'root' || $m->level == 'menu')
                                            <span style="margin-left: 0px !important;">{{ $m->menu }}</span>
                                            @elseif($m->level == 'submenu')
                                            <li style="margin-left: 40px !important;">
                                                <span>{{ $m->menu }}</span>
                                            </li>
                                            @elseif($m->level == 'subsubmenu')
                                            <li style="margin-left: 60px !important;">
                                                <span>{{ $m->menu }}</span>
                                            </li>
                                            @else
                                            <span style="margin-left: 30px !important;">{{ $m->menu }}</span>
                                            @endif
                                        </td>
                                        <td align="center">
                                            <input class="form-check-input menu-checkbox" id="{{ $m->menu_id }}" name="menu_id[]" type="checkbox" />
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row error-info"></div>
                    <div class="modal-footer">
                        <button id="btnSave" type="button" class="btn btn-sm btn-success bg-custom-navbar text-white">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>