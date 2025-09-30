<div wire:key="product-table" wire:init="loadData">
    @if(!$isReady)
    <div class="text-center p-5 d-flex flex-column align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2">Loading...</p>
    </div>
    @else
    <div class="card mb-3">
        <div class="card-header">
            <h3>Report Beli Barang</h3>
        </div>
        <div class="card-body">
            <form id="filterForm" class="row gy-2 gx-3 align-items-center" wire:submit.prevent="filterData">

                <div class="col-auto">
                    <select class="form-control select2" id="barang" wire:ignore name="barang"></select>
                </div>

                <div class="col-auto">
                    <input type="text" id="dates" class="form-control">
                </div>

                <div class="col-auto">
                    <button class="btn btn-primary btn-sm bg-custom-navbar" type="submit">
                        <i class="fa fa-search"></i> Search
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" id="resetFilter">
                        <i class="fa fa-undo"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive scrollbar bg-white p-2">
                <button wire:click="exportExcel" class="btn btn-link text-body me-4 px-0">
                    <span class="fa-solid fa-file-excel fs-9 me-2"></span> Excel
                </button>

                <table class="table table-sm table-hover table-bordered fs-8">
                    <thead class="bg-custom-navbar">
                        <tr>
                            <th class="text-white">#</th>
                            <th class="text-white">Date</th>
                            <th class="text-white">Kode Asset</th>
                            <th class="text-white">Nama Asset</th>
                            <th class="text-white">Tipe Barang</th>
                            <th class="text-white">Harga Beli</th>
                            <th class="text-white">Harga Total</th>
                            <th class="text-white">Unit</th>
                            <th class="text-white">Qty</th>
                            <th class="text-white">Remark</th>
                            <th class="text-white">Status</th>
                        </tr>
                    </thead>
                    @forelse($datas as $i => $data)
                    <tr>
                        <td>{{ $datas->firstItem() + $i }}</td>
                        <td>{{ $data->tanggal_beli }}</td>
                        <td>{{ ucwords($data->kode_barang) }}</td>
                        <td>{{ ucwords($data->nama_barang) }}</td>
                        <td>{{ ucwords($data->type_barang) }}</td>
                        <td>{{ number_format($data->harga_satuan,0) }}</td>
                        <td>{{ number_format($data->harga_total,0) }}</td>
                        <td>{{ ucwords($data->satuan_name) }}</td>
                        <td>{{ ucwords($data->qty) }}</td>
                        <td>{{ ucwords($data->remark) }}</td>
                        <td>{{ ucwords($data->status) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="text-center">DATA NOT FOUND</td>
                    </tr>
                    @endforelse
                </table>

                {{-- PAGINATION --}}
                @if($datas->total() > 0)
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
    @endif

    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', function() {

            // initFilters();

            Livewire.hook("morphed", () => {
                initFilters();
                // restoreFilters();
                // setelah render ulang, set ulang nilai dari Livewire
                setTimeout(() => {
                    $('#barang').val(@this.get('barang')).trigger('change');
                    $('#dates').val(@this.get('dates'));
                }, 50);
            });

            function initFilters() {
                loadFilter("{{ route('barang.json') }}", "Barang", "barang");

                $('#dates').daterangepicker({
                    autoUpdateInput: true
                });
            }

            function loadFilter(url, title, id) {
                $('#' + id).select2({
                    placeholder: `Filter ${title}...`,
                    allowClear: true,
                    width: '100%',
                    minimumInputLength: 2,
                    ajax: {
                        url: url,
                        dataType: 'json',
                        delay: 250,
                        data: params => ({
                            q: params.term
                        }),
                        processResults: data => ({
                            results: $.map(data, item => ({
                                id: item.id,
                                text: item.text
                            }))
                        }),
                        cache: true
                    }
                });
            }

            function restoreFilters() {
                // $('#dates').val(@this.dates);
            }

            // submit manual
            $(document).on('submit', '#filterForm', function(e) {
                e.preventDefault();
                let barangs = $('#barang').val();
                let departments = $('#department').val();
                @this.set('barang', barangs);
                @this.set('dates', $('#dates').val());
                @this.call('filterData');

                $("#barang").val(barangs).trigger("change");
            });

            // reset filter
            $(document).on('click', '#resetFilter', function() {
                $('#barang').val(null).trigger('change');
                $('#dates').val('');

                @this.set('barang', '');
                @this.set('dates', moment().format('MM/DD/YYYY') + ' - ' + moment().format('MM/DD/YYYY'));
                @this.call('filterData');
            });
        });
    </script>
    @endpush
</div>