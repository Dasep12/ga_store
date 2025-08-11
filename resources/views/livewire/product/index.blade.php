<div wire:key="product-table" wire:init="loadProducts">
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
                    <button class="btn btn-sm bg-custom-navbar text-white mb-2">Add Product</button>
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

                <table class="table table-sm table-hover table-bordered fs-8 ">
                    <thead class="bg-custom-navbar">
                        <tr>
                            <th class="text-white" scope="col">#</th>
                            <th class="text-white" scope="col">Product Code</th>
                            <th class="text-white" scope="col">Product Name</th>
                            <th class="text-white" scope="col">Satuan</th>
                            <th class="text-white" scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->kode_barang }}</td>
                            <td>{{ $product->nama_barang }}</td>
                            <td>{{ $product->satuan }}</td>
                            <td>{{ number_format($product->harga, 2) }}</td>
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
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries
                </div>
                <div>

                    <nav>

                        <ul class="pagination mb-0">
                            <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                                <a style="cursor:pointer" class="page-link"
                                    wire:click="gotoPage(1)"
                                    wire:target="gotoPage"
                                    aria-label="First">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>

                            @foreach ($products->getUrlRange(
                            max(1, $products->currentPage() - 1),
                            min($products->lastPage(), $products->currentPage() + 1)
                            ) as $page => $url)
                            <li class="page-item {{ $products->currentPage() == $page ? 'active ' : '' }}">
                                <a style="cursor:pointer" class="page-link {{ $products->currentPage() == $page ? 'active ' : '' }}"
                                    wire:click="gotoPage({{ $page }})"
                                    wire:target="gotoPage">
                                    {{ $page }}
                                </a>
                            </li>
                            @endforeach

                            <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                                <a style="cursor:pointer" class="page-link "
                                    wire:click="gotoPage({{ $products->lastPage() }})"
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
    </div>
    @endif
</div>