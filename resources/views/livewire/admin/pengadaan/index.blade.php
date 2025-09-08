<div wire:key="product-table" wire:init="loadData">
    @section('title', 'Barang')
    <?php

    ?>
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
                    <!-- <button wire:click="exportExcel" class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span> Export</button> -->
                    <!-- <button onclick="crudJson('create','*')" class="btn btn-sm bg-custom-navbar text-white"><i class="fa fa-plus-square"></i> Tambah Data</button> -->


                    <ul class="nav nav-underline fs-5 navbar-expand p-2 bg-white" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold {{ $filterStatus == 'request' ? 'active' : '' }}"
                                wire:click="setFilterStatus('request')" type="button">
                                <span class="fa-solid fa-hotel"></span> Request
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold {{ $filterStatus == 'progress' ? 'active' : '' }}"
                                wire:click="setFilterStatus('progress')" type="button">
                                <span class="fa-solid fa-clock"></span> Progress
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold {{ $filterStatus == 'rejected' ? 'active' : '' }}"
                                wire:click="setFilterStatus('rejected')" type="button">
                                <span class="fa-solid fa-close"></span> Reject
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold {{ $filterStatus == 'done' ? 'active' : '' }}"
                                wire:click="setFilterStatus('done')" type="button">
                                <span class="fa-solid fa-check"></span> Finish
                            </button>
                        </li>
                    </ul>

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

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade  active show" id="tab-home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="table-responsive scrollbar bg-white p-2">
                        <table class="table table-sm table-hover table-bordered fs-8 table-responsive scrollbar" wire:loading.remove wire:target="gotoPage, perPage,filterData, search, filterType">
                            <thead class="bg-custom-navbar">
                                @switch($filterStatus)
                                @case('request')
                                <tr>
                                    <th class="text-white">#</th>
                                    <th class="text-white">KODE</th>
                                    <th class="text-white">BARANG</th>
                                    <th class="text-white">QTY</th>
                                    <th class="text-white">REQUEST DATE</th>
                                    <th class="text-white">REQUEST BY</th>
                                    <th class="text-white">STATUS</th>
                                    <th class="text-white">ACT</th>
                                </tr>
                                @break
                                @case('progress')
                                <tr>
                                    <th class="text-white">#</th>
                                    <th class="text-white">KODE</th>
                                    <th class="text-white">BARANG</th>
                                    <th class="text-white">QTY</th>
                                    <th class="text-white">PROGRESS DATE</th>
                                    <th class="text-white">PROGRESS BY</th>
                                    <th class="text-white">REQUEST BY</th>
                                    <th class="text-white">STATUS</th>
                                    <th class="text-white">ACT</th>
                                </tr>
                                @break
                                @case('rejected')
                                <tr>
                                    <th class="text-white">#</th>
                                    <th class="text-white">KODE</th>
                                    <th class="text-white">BARANG</th>
                                    <th class="text-white">QTY</th>
                                    <th class="text-white">FINISH DATE</th>
                                    <th class="text-white">FINISH BY</th>
                                    <th class="text-white">REQUEST BY</th>
                                    <th class="text-white">STATUS</th>
                                </tr>
                                @break
                                @case('done')
                                <tr>
                                    <th class="text-white">#</th>
                                    <th class="text-white">KODE</th>
                                    <th class="text-white">BARANG</th>
                                    <th class="text-white">QTY</th>
                                    <th class="text-white">FINISH DATE</th>
                                    <th class="text-white">FINISH BY</th>
                                    <th class="text-white">REQUEST BY</th>
                                    <th class="text-white">STATUS</th>
                                </tr>
                                @break
                                @endswitch
                                </tr>
                            </thead>
                            <tbody class="list" id="order-table-body">
                                @switch($filterStatus)
                                @case('request')
                                @forelse($datas as $data)
                                <?php
                                $imagePath = $data->images ?: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTcFI6hTmgUtdxQTZktMt5KgEbySf4mtRgfQ&s';
                                ?>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                    <td class="align-middle white-space-nowrap ps-0 py-0">
                                        <a class="border border-translucent rounded-2 d-inline-block" href="">
                                            <img src="{{ asset($imagePath)}}" alt="" width="53">
                                        </a>
                                    </td>
                                    <td>
                                        <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->kode_barang }}</a>
                                    </td>
                                    <td>
                                        <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->nama_barang }}</a>
                                    </td>
                                    <td>
                                        {{ $data->qty }}
                                    </td>
                                    <td>
                                        {{ $data->order_date }}
                                    </td>
                                    <td>
                                        {{ $data->creator . ' - ' . $data->department }}
                                    </td>
                                    <td>
                                        <span class="badge badge-phoenix fs-9 badge-phoenix-warning"><span class="">{{ $data->status }} <i class="fa fa-clock"></i></span> </span>
                                    </td>
                                    <td align="center">
                                        <div class="position-static"><a class=" dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-cog fs-10"></span></a>
                                            <div class="dropdown-menu dropdown-menu-end py-2">
                                                <a href="javascropt:void(0)" onclick="crudJson('process','{{ $data->order_id }}')" class="dropdown-item text-primary btnEdit"><i class="fa fa-eye"></i> Process</a>
                                                <div class="dropdown-divider"></div>
                                                <a onclick="crudJson('reject','{{ $data->order_id }}')" class="dropdown-item text-danger btnDelete" href="javascropt:void(0)"><i class="fa fa-trash"></i> Reject</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" align="center">DATA NOT FOUND</td>
                                </tr>
                                @endforelse
                                @break
                                @case('progress')
                                @forelse($datas as $data)
                                <?php
                                $imagePath = $data->images ?: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTcFI6hTmgUtdxQTZktMt5KgEbySf4mtRgfQ&s';
                                ?>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                    <td class="align-middle white-space-nowrap ps-0 py-0">
                                        <a class="border border-translucent rounded-2 d-inline-block" href="">
                                            <img src="{{ asset($imagePath)}}" alt="" width="53">
                                        </a>
                                    </td>
                                    <td>
                                        <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->kode_barang }}</a>
                                    </td>
                                    <td>
                                        <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->nama_barang }}</a>
                                    </td>
                                    <td>
                                        {{ $data->qty }}
                                    </td>
                                    <td>
                                        {{ $data->progress_date }}
                                    </td>
                                    <td>
                                        {{ $data->progress_by }}
                                    </td>
                                    <td>
                                        {{ $data->creator . ' - ' . $data->department }}
                                    </td>

                                    <td>
                                        <span class="badge badge-phoenix fs-9 badge-phoenix-primary"><span class="">{{ $data->status }} <i class="fa fa-clock"></i></span> </span>
                                    </td>
                                    <td align="center">
                                        <div class="position-static"><a class=" dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-cog fs-10"></span></a>
                                            <div class="dropdown-menu dropdown-menu-end py-2">
                                                <a href="javascropt:void(0)" onclick="crudJson('process','{{ $data->order_id }}')" class="dropdown-item text-primary btnEdit"><i class="fa fa-eye"></i> Process</a>
                                                <div class="dropdown-divider"></div>
                                                <a onclick="crudJson('reject','{{ $data->order_id }}')" class="dropdown-item text-danger btnDelete" href="javascropt:void(0)"><i class="fa fa-trash"></i> Reject</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" align="center">DATA NOT FOUND</td>
                                </tr>
                                @endforelse
                                @break
                                @case('rejected')
                                @forelse($datas as $data)
                                <?php
                                $imagePath = $data->images ?: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTcFI6hTmgUtdxQTZktMt5KgEbySf4mtRgfQ&s';
                                ?>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                    <td class="align-middle white-space-nowrap ps-0 py-0">
                                        <a class="border border-translucent rounded-2 d-inline-block" href="">
                                            <img src="{{ asset($imagePath)}}" alt="" width="53">
                                        </a>
                                    </td>
                                    <td>
                                        <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->kode_barang }}</a>
                                    </td>
                                    <td>
                                        <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->nama_barang }}</a>
                                    </td>
                                    <td>
                                        {{ $data->qty }}
                                    </td>
                                    <td>
                                        {{ $data->finish_date }}
                                    </td>
                                    <td>
                                        {{ $data->finish_by }}
                                    </td>
                                    <td>
                                        {{ $data->creator . ' - ' . $data->department }}
                                    </td>
                                    <td>
                                        <span class="badge badge-phoenix fs-9 badge-phoenix-danger"><span class="">{{ $data->status }} <i class="fa fa-close"></i></span> </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" align="center">DATA NOT FOUND</td>
                                </tr>
                                @endforelse
                                @break
                                @case('done')
                                @forelse($datas as $data)
                                <?php
                                $imagePath = $data->images ?: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTcFI6hTmgUtdxQTZktMt5KgEbySf4mtRgfQ&s';
                                ?>
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                    <td class="align-middle white-space-nowrap ps-0 py-0">
                                        <a class="border border-translucent rounded-2 d-inline-block" href="">
                                            <img src="{{ asset($imagePath)}}" alt="" width="53">
                                        </a>
                                    </td>
                                    <td>
                                        <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->kode_barang }}</a>
                                    </td>
                                    <td>
                                        <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->nama_barang }}</a>
                                    </td>
                                    <td>
                                        {{ $data->qty }}
                                    </td>
                                    <td>
                                        {{ $data->finish_date }}
                                    </td>
                                    <td>
                                        {{ $data->finish_by }}
                                    </td>
                                    <td>
                                        {{ $data->creator . ' - ' . $data->department }}
                                    </td>
                                    <td>
                                        <span class="badge badge-phoenix fs-9 badge-phoenix-success"><span class="">{{ $data->status }} <i class="fa fa-check"></i></span> </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" align="center">DATA NOT FOUND</td>
                                </tr>
                                @endforelse
                                @break
                                @endswitch


                            </tbody>
                        </table>
                        {{-- Pagination dengan wire:target --}}

                        @if($datas->total() > 0 )
                        <div class="d-flex justify-content-between align-items-center mt-5">
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
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal untuk CRUD --}}
        @include('livewire.admin.pengadaan.crud')
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
            $('#btnSave').html('<i class="fa fa-save"></i> Simpan');
            $("#btnSave").removeClass("btn-danger").addClass("bg-custom-navbar");
        } else if (action === 'process') {
            $.ajax({
                url: `/pengadaan/${id}`,
                method: 'GET',
                success: function(data) {
                    $('#modalTitle').text('Process {{ $title }}');
                    $.each(data, function(i, value) {
                        $('#id').val(value.order_id);
                        $('#nama_barang').val(value.nama_barang);
                        $('#kode_barang').val(value.kode_barang);
                        $('#type_barang').val(value.type_barang);
                        $('#jenis_asset').val(value.jenis_asset);
                        $('#creator').val(value.creator);
                        $('#department').val(value.department);
                        $('#merek').val(value.merek);
                        $('#warna').val(value.warna);
                        $('#ukuran').val(value.ukuran);
                        $('#satuan').val(value.satuan);
                        $('#model').val(value.model);
                        $('#qty').val(value.qty);
                        $('#deskripsi').val(value.deskripsi);
                        $('#is_actived').prop('checked', value.is_actived);
                    });
                    $(".btnProcess").attr("disabled", false);
                    $('.btnReject').attr('onclick', 'document.getElementById("crudAction").value="done"');
                    $('.btnReject').html('<i class="fa fa-check"></i> Finish');
                    $(".btnReject").removeClass("btn-danger").addClass("bg-custom-navbar");
                    $('#modalCrud').modal('show');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        } else if (action === 'reject') {
            $.ajax({
                url: `/pengadaan/${id}`,
                method: 'GET',
                success: function(data) {
                    $('#modalTitle').text('Reject Pengadaan');
                    $.each(data, function(i, value) {
                        $('#id').val(value.order_id);
                        $('#nama_barang').val(value.nama_barang);
                        $('#kode_barang').val(value.kode_barang);
                        $('#type_barang').val(value.type_barang);
                        $('#jenis_asset').val(value.jenis_asset);
                        $('#creator').val(value.creator);
                        $('#department').val(value.department);
                        $('#merek').val(value.merek);
                        $('#warna').val(value.warna);
                        $('#ukuran').val(value.ukuran);
                        $('#satuan').val(value.satuan);
                        $('#model').val(value.model);
                        $('#qty').val(value.qty);
                        $('#deskripsi').val(value.deskripsi);
                        $('#is_actived').prop('checked', value.is_actived);
                    });
                    $(".btnProcess").attr("disabled", true);
                    $('.btnReject').attr('onclick', 'document.getElementById("crudAction").value="reject"');
                    $('.btnReject').html('<i class="fa fa-trash"></i> Reject');
                    $(".btnReject").removeClass("bg-custom-navbar").addClass("btn-danger");
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
        $('.btnSave').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Simpan');
        $.ajax({
            url: "{{ route('pengadaan.crud') }}",
            method: "POST",
            data: formData,
            processData: false, // WAJIB untuk FormData
            contentType: false, // WAJIB untuk FormData
            success: function(res) {
                $('.btnSave').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                if (res.success) {
                    $('#modalCrud').modal('hide');
                    Swal.fire('Berhasil', res.message, 'success');
                    $('#formSubmit')[0].reset(); // <-- ini sudah benar

                    Livewire.dispatch('reload-table');
                }
            },
            error: function(xhr) {
                $('.btnSave').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
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
    $(document).on("click", ".btnSave", function() {
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
            },
            error: function(xhr) {
                $('#btnUpload').prop('disabled', false);
                alert('Upload error');
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