<div wire:key="product-table" wire:init="loadData">
    @section('title', 'Users Management')
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
                wire:target="gotoPage, perPage,filterData, search, filterType"
                class="position-absolute top-50 start-50 translate-middle bg-white bg-opacity-75 p-4 rounded shadow justify-content-center align-items-center"
                style="z-index: 10; display: none;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>




            {{-- Controls --}}
            <div class="d-flex justify-content-between mb-2">
                <div>
                    <!-- <button onclick="crudJson('import','*')" type="button" class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-import fs-9 me-2"></span> Import</button> -->
                    <button wire:click="exportExcel" class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span> Export</button>
                    <button onclick="crudJson('create','*')" class="btn btn-sm bg-custom-navbar text-white"><i class="fa fa-plus-square"></i> Tambah Data</button>

                </div>
                <div>
                    <label class="fs-9">
                        <select wire:model.live="filterType" class="form-select-sm form-select d-inline-block w-auto d-none">
                            <option value="ALL">ALL</option>
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
                            <th class="text-white text-center" scope="col">Pic</th>
                            <th class="text-white" scope="col">Noreg</th>
                            <th class="text-white" scope="col">Nama</th>
                            <th class="text-white" scope="col">Email</th>
                            <th class="text-white" scope="col">Role</th>
                            <th class="text-white" scope="col">Department</th>
                            <th class="text-white" scope="col">Level</th>
                            <th class="text-white" scope="col">Created</th>
                            <th class="text-white text-center" style="width: 80px;" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @forelse($datas as $data)
                        <?php
                        $img =  $data->photo == '' ? 'assets/assets/img/icons/image-icon.png' : $data->photo
                        ?>
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td class="text-center">
                                <a class="" href="javascript:void(0)"><img src="{{ asset(  $img ) }}" alt="" height="30" width="30"></a>
                            </td>
                            <td>{{ $data->noreg }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->role_name }}</td>
                            <td>{{ $data->department_name }}</td>
                            <td>{{ $data->level_name }}</td>
                            <td>{{ $data->created_at }}</td>
                            <td align="center">
                                <div class="position-static"><a class=" dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-cog fs-10"></span></a>
                                    <div class="dropdown-menu dropdown-menu-end py-2">
                                        <a onclick="crudJson('edit','{{ $data->id }}')" class="dropdown-item text-primary btnEdit"><i class="fa fa-eye"></i> View</a>
                                        <div class="dropdown-divider"></div>
                                        <a onclick="crudJson('delete','{{ $data->id }}')" class="dropdown-item text-danger btnDelete" href="#!"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No data found.</td>
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

        {{-- Modal untuk CRUD --}}
        @include('livewire.admin.users.crud')

    </div>
    @endif

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</div>




@push('scripts')
<script>
    function crudJson(action, id = null) {
        $('#formSubmit')[0].reset();
        $('.error-text').html('');
        $('#crudAction').val(action);
        $('#id').val('');
        if (action === 'create') {
            $("#kode_barang").attr("readonly", true);
            $('#modalCrud').modal('show');
            $('#modalTitle').text('Add {{ $title }}')
            $('#btnSave').html('<i class="fa fa-save"></i> Simpan');
            $("#btnSave").removeClass("btn-danger").addClass("bg-custom-navbar");
        } else if (action === 'edit') {
            $.ajax({
                url: `/users/${id}`,
                method: 'GET',
                success: function(data) {
                    $('#modalTitle').text('Update');
                    $.each(data, result => {
                        $("#id").val(data[result].id);
                        $('#department_id').val(data[result].department_id).trigger("change");
                        $('#role_id').val(data[result].role_id).trigger("change");
                        $('#level_id').val(data[result].level_id).trigger("change");
                        $('#noreg').val(data[result].noreg);
                        $('#nama').val(data[result].nama);
                        $('#email').val(data[result].email);
                    })

                    $('#btnSave').html('<i class="fa fa-edit"></i> Update');
                    $("#btnSave").removeClass("btn-danger").addClass("bg-custom-navbar");
                    $('#modalCrud').modal('show');
                    $('form.form-loading :input').removeAttr('readonly');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        } else if (action === 'delete') {
            $.ajax({
                url: `/users/${id}`,
                method: 'GET',
                success: function(data) {
                    $('#modalTitle').text('Delete');
                    $.each(data, result => {
                        $("#id").val(data[result].id);
                        $('#department_id').val(data[result].department_id).trigger("change");
                        $('#role_id').val(data[result].role_id).trigger("change");
                        $('#level_id').val(data[result].level_id).trigger("change");
                        $('#noreg').val(data[result].noreg);
                        $('#nama').val(data[result].nama);
                        $('#email').val(data[result].email);
                    })

                    $('#btnSave').html('<i class="fa fa-trash"></i> Update');
                    $("#btnSave").removeClass("bg-custom-navbar").addClass("btn-danger");
                    $('#modalCrud').modal('show');
                    $('form.form-loading :input').attr('readonly', 'readonly');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        } else if (action === 'import') {
            $('#modalImport').modal('show');
            $('#modalTitle').text('Import {{ $title }}');
            $('#formImport')[0].reset();
            $('#uploadProgress').hide();
            $('#importProgress').hide();
            $('#btnUpload').prop('disabled', false);
        }


    }




    document.addEventListener('livewire:initialized', function() {
        $("#product_id").select2({
            dropdownParent: $('#modalCrud'),
            width: '100%' // ⬅️ ini biar fix full width
        });
        Livewire.hook("morphed", () => {
            $("#product_id").select2({
                dropdownParent: $('#modalCrud'),
                width: '100%'
            });
        });

    });


    $(document).on('submit', '#formSubmit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('#error-name').text('');
        $('#error-code').text('');
        $('#btnSave').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Simpan');

        $.ajax({
            url: "{{ route('users.crud') }}",
            method: "POST",
            data: formData,
            processData: false, // WAJIB untuk FormData
            contentType: false, // WAJIB untuk FormData
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
                    // Bersihkan error lama
                    $('.error-text').text('');
                    // Loop semua field dan tampilkan pesan error
                    $.each(errors, function(key, messages) {
                        $('#error-' + key).text(messages[0]);
                    });
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