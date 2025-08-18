<div class="row" wire:key="product-table" wire:init="loadData">
    @pushOnce('styles')
    <link rel="stylesheet" href="{{ asset('assets/assets/css/user.css') }}">
    @endPushOnce

    @include('components.layouts.frontend.filter')
    @if(!$isReady)
    <div class="text-center p-5 d-flex flex-column align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2">Loading...</p>
    </div>
    @else
    {{-- Spinner loading dengan target spesifik --}}
    <div wire:loading.delay.class="d-flex" wire:target="gotoPage, perPage,filterData, search, filterType,selectedCategories" class="position-fixed top-0 start-0 w-100 h-100 bg-white bg-opacity-75 justify-content-center align-items-center" style="z-index: 10; display: none;">
        <div class="spinner-border text-primary" role="status"> <span class="visually-hidden">Loading...</span> </div>
    </div>


    <div class="col-lg-10 col-xxl-10">
        <div class="row g-2"> <!-- g-4 = jarak antar kolom & baris -->
            @forelse($datas as $data)
            <div class="col-12 col-sm-6 col-lg-3"> <!-- 4 kolom di layar besar -->
                <div class="bg-white p-3 rounded-2 h-100">

                    <?php
                    $imagePath = $data->images ?: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTcFI6hTmgUtdxQTZktMt5KgEbySf4mtRgfQ&s';
                    ?>
                    <img class="img-fluid fixed-size" src="{{ asset($imagePath)}}" alt="" />
                    <h6 class="mt-3 lh-sm line-clamp-3 product-name">{{ $data->nama_barang }}</h6>
                    <p class="fs-9">
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="text-body-quaternary fw-semibold ms-1">({{ $data->order_count }} people order)</span>
                    </p>
                    <div>
                        <p class="fs-9 text-body-tertiary mb-2">{{ $data->kode_barang }}</p>
                        <div class="d-flex align-items-center mb-1">
                            <p class="me-2 text-body mb-0">stock</p>
                            <h3 class="text-body-emphasis mb-0">{{ $data->stock_type == 'INDENT' ? $data->stock_type  : $data->stock }}</h3>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">
                                kategori : {{ $data->kategori_name ?? '-' }}
                            </p>
                            <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                                wire:click="addToCart({{ $data->id }})"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Add to cart">
                                <span class="fas fa-shopping-cart d-block-hover" data-fa-transform="down-1"></span>
                                <span class="fas fa-shopping-cart d-none-hover" data-fa-transform="down-1"></span>
                            </button>
                        </div>

                    </div>
                </div>

            </div>
            @empty
            <div class="row flex-center">
                <div class="col-12 col-xl-10 col-xxl-8">
                    <div class="row justify-content-center align-items-center g-5">
                        <div class="col-12 col-lg-6 text-center order-lg-1">
                            <img class="img-fluid w-lg-100 d-dark-none" src="{{ asset('assets/assets/img/spot-illustrations/404-illustration.png')}}" alt="" width="400">
                            <img class="img-fluid w-md-50 w-lg-100 d-light-none" src="{{ asset('assets/assets/img/spot-illustrations/dark_404-illustration.png')}}" alt="" width="540">
                        </div>
                        <div class="col-12 col-lg-6 text-center text-lg-start">
                            <img class="img-fluid mb-6 w-50 w-lg-75 d-dark-none" src="{{ asset('assets/assets/img/spot-illustrations/404.png')}}" alt="">
                            <img class="img-fluid mb-6 w-50 w-lg-75 d-light-none" src="{{ asset('assets/assets/img/spot-illustrations/dark_404.png')}}" alt="">
                            <h2 class="text-body-secondary fw-bolder mb-3">Data Not Found!</h2>
                            <p class="text-body mb-5">Mohon Informasikan ke Team GA, barang yang di maksud <br class="d-none d-sm-block"> </p>
                            <!-- <a class="btn btn-lg btn-primary" href="#">Go Home</a> -->
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
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
    @endif

    @pushOnce('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            if (!window.cartAddedListenerRegistered) {
                Livewire.on('cart-added', (data) => {
                    alert(data[0].message)
                });
                window.cartAddedListenerRegistered = true; // tandai sudah didaftarkan
            }
        });
    </script>
    @endPushOnce