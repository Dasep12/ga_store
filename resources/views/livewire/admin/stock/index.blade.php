<div wire:key="product-table" wire:init="loadData">
    @section('title', 'Stock')
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
                    <button wire:click="exportExcel" class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span> Export</button>
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
                            <th class="text-white" scope="col">Nama Barang</th>
                            <th class="text-white" scope="col">Kode</th>
                            <th class="text-white" scope="col">Jumlah Stock</th>
                            <th class="text-white" scope="col">Satuan</th>
                            <th class="text-white" scope="col">Last Update</th>
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
                            <td>{{ $data->nama_barang }}</td>
                            <td>{{ $data->kode_barang }}</td>
                            <td>{{ $data->stock }}</td>
                            <td>{{ $data->satuan }}</td>
                            <td>{{ $data->updated_at }}</td>
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
        @include('livewire.admin.input-stock.crud')
        @include('livewire.admin.input-stock.import')

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
        $('#transaction_id').val('');
        console.log(id)
        if (action === 'create') {
            $("#kode_barang").attr("readonly", true);
            $('#modalCrud').modal('show');
            $('#modalTitle').text('Add {{ $title }}')
            $('#btnSave').html('<i class="fa fa-save"></i> Simpan');
            $("#btnSave").removeClass("btn-danger").addClass("bg-custom-navbar");
        } else if (action === 'delete') {
            $.ajax({
                url: `/inputstock/${id}`,
                method: 'GET',
                success: function(data) {
                    console.log(data)
                    $('#modalTitle').text('Delete');
                    $.each(data, result => {
                        $('#transaction_id').val(data[result].transaction_id);
                        $('#product_id').val(data[result].barang_id).trigger("change");
                        $('#kode_barang').val(data[result].kode_barang);
                        $('#no_po').val(data[result].no_po);
                        $('#tanggal_beli').val(data[result].tanggal_beli);
                        $('#qty').val(data[result].qty);
                        $('#harga_satuan').val(data[result].harga_satuan);
                        $('#harga_total').val(data[result].harga_total);
                        $('#supplier').val(data[result].supplier);
                        $('#remark').val(data[result].remark);
                    })

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

    $(document).on('change', '#product_id', function() {
        var barang_id = $(this).val()
        var kodeBarang = $(this).find('option:selected').data('kode_barang');
        $("#kode_barang").val(kodeBarang);
    });




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
            url: "{{ route('inputstock.crud') }}",
            method: "POST",
            data: formData,
            processData: false, // WAJIB untuk FormData
            contentType: false, // WAJIB untuk FormData
            success: function(res) {
                console.log(res);
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
            url: "{{ route('inputstock.import') }}",
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
                console.log(res);
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
            $.get("{{ url('/inputstock/import/progress') }}/" + importId, function(res) {
                var percent = res.percent !== null ? res.percent : 0;
                $('#importBar').css('width', (percent || 0) + '%');
                $('#importPercent').text((percent || 0) + '%');
                $('#importStatus').text('Status: ' + res.status + '. Processed: ' + res.processed + ' / ' + (res.total ?? '??'));
                console.log(res);
                if (res.status === 'finished' || percent === 100) {
                    clearInterval(pollTimer);
                    $("#btnUpload").prop('disabled', true);
                    $('#importStatus').text('Selesai. Processed: ' + res.processed + ' / ' + res.total);
                    // Tutup modal import
                    $('#modalImport').modal('hide');
                    Swal.fire('Berhasil', 'Upload Stock Success', 'success');
                    Livewire.dispatch('reload-table');
                }
            }).fail(function() {
                console.log('gagal ambil progress');
            });
        }, 1000); // poll tiap 1 detik
    }
</script>
@endpush