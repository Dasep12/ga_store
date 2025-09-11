<div wire:key="product-table" wire:init="loadData">
    @section('title', 'Barang')
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
                    <button onclick="crudJson('import','*')" type="button" class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-import fs-9 me-2"></span> Import</button>
                    <button wire:click="exportExcel" class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span> Export</button>
                    <button onclick="crudJson('create','*')" class="btn btn-sm bg-custom-navbar text-white"><i class="fa fa-plus-square"></i> Tambah Data</button>

                </div>
                <div>
                    <label class="fs-9">
                        <select wire:model.live="filterType" class="form-select-sm form-select d-inline-block w-auto">
                            <option value="ALL">ALL</option>
                            <option value="REGULER">REGULER</option>
                            <option value="NON-REGULER">NON-REGULER</option>
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
                            <th class="text-white" scope="col">Kategori</th>
                            <th class="text-white" scope="col">Jenis</th>
                            <th class="text-white" scope="col">Nama</th>
                            <th class="text-white" scope="col">Kode</th>
                            <th class="text-white" scope="col">Type</th>
                            <th class="text-white" scope="col">Ukuran</th>
                            <th class="text-white" scope="col">Special Order</th>
                            <th class="text-white" scope="col">Stock Type</th>
                            <th class="text-white text-center" scope="col">Status</th>
                            <th class="text-white" scope="col">Created</th>
                            <th class="text-white text-center" style="width: 80px;" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @forelse($datas as $data)
                        <?php
                        $img =  $data->images == '' ? 'assets/assets/img/icons/image-icon.png' : $data->images
                        ?>
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td class="text-center">
                                <a class="" href="javascript:void(0)"><img src="{{ asset(  $img ) }}" alt="" height="30" width="30"></a>
                            </td>
                            <td>{{ $data->kategori_name }}</td>
                            <td>{{ $data->jenis_asset_name }}</td>
                            <td>{{ $data->nama_barang }}</td>
                            <td>{{ $data->kode_barang }}</td>
                            <td>{{ $data->type_barang }}</td>
                            <td>{{ $data->ukuran }}</td>
                            <td align="center"><span class="badge badge-phoenix badge-phoenix-{{ $data->special_order == true ? 'success' : 'danger'}}">{{ $data->special_order == true ? 'Y' : 'N' }}</span></td>
                            <td>{{ $data->stock_type }}</td>
                            <td align="center"><span class="badge badge-phoenix badge-phoenix-{{ $data->is_actived == true ? 'success' : 'danger'}}">{{ $data->is_actived == true ? 'Active' : 'Inactive' }}</span></td>
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

        {{-- Modal untuk CRUD --}}
        @include('livewire.admin.barang.crud')
        @include('livewire.admin.barang.import')

    </div>
    @endif

</div>

@push('scripts')
<script>
    function crudJson(action, id = null) {
        $('#formSubmit')[0].reset();
        $('.error-text').html('');
        $('#crudAction').val(action);
        $('form.form-loading :input').removeAttr('readonly');
        if (action === 'create') {
            $('#modalCrud').modal('show');
            $('#modalTitle').text('Add {{ $title }}');
            $('#id').val('');
            $('#is_actived').prop('checked', true);
            $('#special_order').prop('checked', true);
            $('#btnSave').html('<i class="fa fa-save"></i> Simpan');
            $("#btnSave").removeClass("btn-danger").addClass("bg-custom-navbar");
        } else if (action === 'edit') {
            $.ajax({
                url: `/product/${id}`,
                method: 'GET',
                success: function(data) {
                    $('#modalTitle').text('Edit {{ $title }}');
                    $('#id').val(data.id);
                    $('#nama_barang').val(data.nama_barang);
                    $('#kode_barang').val(data.kode_barang);
                    $('#type_barang').val(data.type_barang);
                    $('#jenis_asset').val(data.jenis_asset);
                    $('#kategori_id').val(data.kategori_id);
                    $('#stock_type').val(data.stock_type);
                    $('#merek').val(data.merek);
                    $('#warna').val(data.warna);
                    $('#ukuran').val(data.ukuran);
                    $('#satuan_id').val(data.satuan_id);
                    $('#model').val(data.model);
                    $('#deskripsi').val(data.deskripsi);
                    $('#is_actived').prop('checked', data.is_actived);
                    $('#special_order').prop('checked', data.special_order);
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
                url: `/product/${id}`,
                method: 'GET',
                success: function(data) {

                    $('#modalTitle').text('Delete Department');
                    $('#id').val(data.id);
                    $('#nama_barang').val(data.nama_barang);
                    $('#kode_barang').val(data.kode_barang);
                    $('#type_barang').val(data.type_barang);
                    $('#jenis_asset').val(data.jenis_asset);
                    $('#kategori_id').val(data.kategori_id);
                    $('#stock_type').val(data.stock_type);
                    $('#merek').val(data.merek);
                    $('#warna').val(data.warna);
                    $('#ukuran').val(data.ukuran);
                    $('#satuan_id').val(data.satuan_id);
                    $('#model').val(data.model);
                    $('#deskripsi').val(data.deskripsi);
                    $('#is_actived').prop('checked', data.is_actived);
                    $('#special_order').prop('checked', data.special_order);
                    $('#btnSave').html('<i class="fa fa-trash"></i> Delete');
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



    $(document).on('submit', '#formSubmit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('#error-name').text('');
        $('#error-code').text('');
        $('#btnSave').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Simpan');

        $.ajax({
            url: "{{ route('barang.crud') }}",
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
                } else {
                    let message = "Terjadi kesalahan saat upload.";

                    // Coba parsing JSON jika server mengirim error response JSON
                    try {
                        let response = JSON.parse(xhr.responseText);
                        if (response.message) {
                            message = response.message;
                        } else if (response.error) {
                            message = response.error;
                        }
                    } catch (e) {
                        // Kalau bukan JSON, ambil sebagian dari responseText
                        if (xhr.responseText) {
                            message = $(xhr.responseText).text().trim().substring(0, 200);
                        }
                    }

                    $(".error-info").html(`<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> ${message}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
                }

            }
        });
    });

    // ...existing code...
    $(document).on("click", "#btnSave", function() {
        $('#formSubmit').submit();
    });


    $(document).on("click", "#btnUpload", function() {
        $('#formImport').submit();
    });

    $(document).on('submit', '#formImport', function(e) {
        e.preventDefault();
        var form = this;
        var fd = new FormData(form);

        $('#btnUpload').prop('disabled', true);
        $('#uploadProgress').show();
        $('#importProgress').hide();

        $.ajax({
            url: "{{ route('barang.import') }}",
            method: "POST",
            data: fd,
            processData: false,
            contentType: false,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        $('#uploadBar').css('width', percentComplete + '%');
                        $('#uploadPercent').text(percentComplete + '% (upload)');
                    }
                }, false);
                return xhr;
            },
            success: function(res) {
                $('#btnUpload').prop('disabled', false);
                $('#uploadPercent').text('Upload selesai, menyiapkan import...');
                // res.import_id
                var importId = res.import_id;
                $('#importProgress').show();
                pollProgress(importId);
                $('#modalImport').modal('hide');
                Livewire.dispatch('reload-table');
            },
            error: function(xhr) {
                $('#btnUpload').prop('disabled', false);
                $('#uploadProgress').hide();
                $('#importProgress').hide();

                let message = "Terjadi kesalahan saat upload.";

                // Coba parsing JSON jika server mengirim error response JSON
                try {
                    let response = JSON.parse(xhr.responseText);
                    if (response.message) {
                        message = response.message;
                    } else if (response.error) {
                        message = response.error;
                    }
                } catch (e) {
                    // Kalau bukan JSON, ambil sebagian dari responseText
                    if (xhr.responseText) {
                        message = $(xhr.responseText).text().trim().substring(0, 200);
                    }
                }

                $(".error-info").html(`<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> ${message}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
            }
        });
    });

    var pollTimer = null;

    function pollProgress(importId) {
        if (pollTimer) clearInterval(pollTimer);
        pollTimer = setInterval(function() {
            $.get("{{ url('/product/import/progress') }}/" + importId, function(res) {
                var percent = res.percent !== null ? res.percent : 0;
                $('#importBar').css('width', (percent || 0) + '%');
                $('#importPercent').text((percent || 0) + '%');
                $('#importStatus').text('Status: ' + res.status + '. Processed: ' + res.processed + ' / ' + (res.total ?? '??'));

                if (res.status === 'finished' || percent === 100) {
                    clearInterval(pollTimer);
                    $('#importStatus').text('Selesai. Processed: ' + res.processed + ' / ' + res.total);
                }
            }).fail(function() {
                console.log('gagal ambil progress');
            });
        }, 1000); // poll tiap 1 detik
    }
</script>
@endpush