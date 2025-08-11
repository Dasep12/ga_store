<div wire:key="product-table" wire:init="loadData">
    @section('title', 'Kategori')
    @if(!$isReady)
    <div class="text-center p-5 d-flex flex-column align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2">Loading...</p>
    </div>
    @else
    <div class="card mb-3">
        <div class="card-body position-relative">

            {{-- Spinner loading dengan target spesifik --}}
            <div wire:loading.delay.class="d-flex"
                wire:target="gotoPage, perPage"
                class="position-absolute top-50 start-50 translate-middle bg-white bg-opacity-75 p-4 rounded shadow justify-content-center align-items-center"
                style="z-index: 10; display: none;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>



            {{-- Controls --}}
            <div class="d-flex justify-content-between mb-2">
                <div>
                    <button wire:click="exportExcel" class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span> Export</button>
                    <button onclick="crudJson('create','*')" class="btn btn-sm bg-custom-navbar text-white"><i class="fa fa-plus-square"></i> Tambah Data</button>

                </div>
                <div>
                    <label class="fs-9">
                        Filter
                        <select wire:model.live="filterStatus" class="form-select-sm form-select d-inline-block w-auto">
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                        </select>
                    </label>
                </div>
            </div>

            {{-- Table tanpa wire:loading.remove --}}
            <div class="mb-2">

                <table class="table table-sm table-hover table-bordered fs-8 table-responsive scrollbar">
                    <thead class="bg-custom-navbar">
                        <tr>
                            <th class="text-white" scope="col">#</th>
                            <th class="text-white" scope="col">Nama</th>
                            <th class="text-white text-center" scope="col">Status</th>
                            <th class="text-white" scope="col">Created</th>
                            <th class="text-white text-center" style="width: 80px;" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @forelse($datas as $data)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $data->name }}</td>
                            <td align="center"><span class="badge badge-phoenix badge-phoenix-{{ $data->is_actived == true ? 'success' : 'danger'}}">{{ $data->is_actived == true ? 'Active' : 'Inactive' }}</span></td>
                            <td>{{ $data->created_at }}</td>
                            <td align="center">
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-cog fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2">
                                        <button onclick="crudJson('edit','{{ $data->id }}')" class="dropdown-item text-primary btnEdit"><i class="fa fa-eye"></i> View</button>
                                        <div class="dropdown-divider"></div>
                                        <button onclick="crudJson('delete','{{ $data->id }}')" class="dropdown-item text-danger btnDelete" href="#!"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No products found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination dengan wire:target --}}
            <div class="d-flex justify-content-between align-items-center ">
                <div class="fs-9 text-muted">


                    <label class="fs-9">
                        Row
                        <select wire:model.live="perPage" class="form-select-sm form-select d-inline-block w-auto">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        per pages
                    </label><br>
                    Showing {{ $datas->firstItem() }} to {{ $datas->lastItem() }} of {{ $datas->total() }} entries
                </div>
                <div>

                    <nav>

                        <ul class="pagination mb-0">
                            <li class="page-item {{ $datas->onFirstPage() ? 'disabled' : '' }}">
                                <a style="cursor:pointer" class="page-link"
                                    wire:click="gotoPage(1)"
                                    wire:target="gotoPage"
                                    aria-label="First">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>

                            @foreach ($datas->getUrlRange(
                            max(1, $datas->currentPage() - 1),
                            min($datas->lastPage(), $datas->currentPage() + 1)
                            ) as $page => $url)
                            <li class="page-item {{ $datas->currentPage() == $page ? 'active ' : '' }}">
                                <a style="cursor:pointer" class="page-link {{ $datas->currentPage() == $page ? 'active ' : '' }}"
                                    wire:click="gotoPage({{ $page }})"
                                    wire:target="gotoPage">
                                    {{ $page }}
                                </a>
                            </li>
                            @endforeach

                            <li class="page-item {{ !$datas->hasMorePages() ? 'disabled' : '' }}">
                                <a style="cursor:pointer" class="page-link "
                                    wire:click="gotoPage({{ $datas->lastPage() }})"
                                    wire:target="gotoPage"
                                    aria-label="Last">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalCrud" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Add {{ $title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formSubmit" class="form-loading" name="formSubmit" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="text" id="id" hidden name="id">
                            <input type="text" id="crudAction" hidden name="crudAction">
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" id="name" name="name" class="form-control">
                                <small class="text-danger" id="error-name"></small>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="is_actived" name="is_actived" value="1">
                                <label class="form-check-label">Active</label><br>
                                <small class="text-danger" id="error-is_actived"></small>
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

    </div>
    @endif

    @push('scripts')
    <script>
        function crudJson(action, id = null) {
            $('#formSubmit')[0].reset();
            $('#crudAction').val(action);
            $('form.form-loading :input').removeAttr('readonly');
            if (action === 'create') {
                $('#modalCrud').modal('show');
                $('#modalTitle').text('Add {{ $title }}');
                $('#dept_id').val('');
                $('#error-name').text('');
                $('#error-code').text('');
                $('#is_actived').prop('checked', true);
                $('#btnSave').html('<i class="fa fa-save"></i> Simpan');
                $("#btnSave").removeClass("btn-danger").addClass("bg-custom-navbar");
            } else if (action === 'edit') {
                $.ajax({
                    url: `/kategori/${id}`,
                    method: 'GET',
                    success: function(data) {
                        $('#modalTitle').text('Edit {{ $title }}');
                        $('#id').val(data.id);
                        $('#name').val(data.name);
                        $('#code').val(data.code);
                        $('#is_actived').prop('checked', data.is_actived);
                        $('#btnSave').html('<i class="fa fa-save"></i> Simpan');
                        $("#btnSave").removeClass("btn-danger").addClass("bg-custom-navbar");
                        $('#modalCrud').modal('show');
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            } else if (action === 'delete') {
                $.ajax({
                    url: `/kategori/${id}`,
                    method: 'GET',
                    success: function(data) {
                        $('#modalTitle').text('Delete Department');
                        $('#id').val(data.id);
                        $('#name').val(data.name);
                        $('#code').val(data.code);
                        $('#is_actived').prop('checked', data.is_actived);
                        $('#btnSave').html('<i class="fa fa-trash"></i> Delete');
                        $("#btnSave").removeClass("bg-custom-navbar").addClass("btn-danger");
                        $('#modalCrud').modal('show');
                        $('form.form-loading :input').attr('readonly', 'readonly');
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }



        $(document).on('submit', '#formSubmit', function(e) {
            e.preventDefault();
            let dept_id = $('#id').val();

            $('#error-name').text('');
            $('#error-code').text('');
            $('#btnSave').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Simpan');

            $.ajax({
                url: "{{ route('kategori.crud') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(res) {
                    $('#btnSave').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    if (res.success) {
                        $('#modalCrud').modal('hide');
                        Swal.fire('Berhasil', res.message, 'success');
                        $('#formSubmit')[0].reset(); // <-- ini sudah benar

                        Livewire.dispatch('reload-table');
                    }
                },
                error: function(xhr) {
                    $('#btnSave').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.name) {
                            $('#error-name').text(errors.name[0]);
                        }
                        if (errors.code) {
                            $('#error-code').text(errors.code[0]);
                        }
                    }
                }
            });
        });

        // ...existing code...
        $(document).on("click", "#btnSave", function() {
            $('#formSubmit').submit();
        });
    </script>
    @endpush
</div>