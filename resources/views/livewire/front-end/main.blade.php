<div wire:key="product-table" wire:init="loadData">

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
    <div class="ps-container">
        <div class="mt-40 mb-40">
            <div class="ps-page--shop">
                <div class="ps-layout--shop">
                    <div class="ps-layout__left">
                        <div class="screen-darken"></div>
                        <div class="ps-layout__left-container">
                            <div class="ps-filter__header d-block d-xl-none">
                                <h3>Filter Products</h3><a class="ps-btn--close ps-btn--no-border" href="#"></a>
                            </div>
                            <div class="ps-layout__left-content">
                                <div class="bb-shop-sidebar">
                                    <form action="#" data-action="#" method="GET" class="bb-product-form-filter">
                                        <div class="bb-ecommerce-filter-hidden-fields">
                                            <input name="layout" type="hidden" class="product-filter-item" value="">
                                            <input name="page" type="hidden" class="product-filter-item" value="">
                                            <input name="per-page" type="hidden" class="product-filter-item" value="">
                                            <input name="num" type="hidden" class="product-filter-item" value="">
                                            <input name="sort-by" type="hidden" class="product-filter-item" value="">
                                            <input name="collection" type="hidden" class="product-filter-item" value="">
                                            <input name="discounted_only" type="hidden" class="product-filter-item" value="">
                                        </div>
                                        @include('components.layouts.frontend.filter')
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="ps-layout__right">
                        <div class="ps-block--shop-features">
                            <div class="ps-block__header">
                                <h1 class="h1">ALL PRODUCT</h1>
                            </div>
                        </div>
                        <div class="ps-shopping ps-tab-root">
                            <div class="bg-light py-2 mb-3">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-md-3 d-xl-none px-2 px-sm-3">
                                            <div class="header__filter d-xl-none mx-auto mb-3 mb-sm-0">
                                                <button id="products-filter-sidebar" type="button">
                                                    <i class="icon-equalizer"></i><span class="ms-2">Filter</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-xl-6 d-none d-md-block">
                                            <div class="products-found pt-3">
                                                <strong>{{ $datas->total() }}</strong><span class="ms-1">Products found</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 px-2 px-sm-3">
                                            <div class="d-flex justify-content-center justify-content-sm-end">
                                                <select class="ps-select ps-select-shop-sort select2-hidden-accessible" data-placeholder="Sort Items" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                    <option value="default_sorting" data-select2-id="3">Default</option>
                                                    <option value="date_asc">Oldest</option>
                                                    <option value="date_desc">Newest</option>
                                                    <option value="price_asc">Price: low to high</option>
                                                    <option value="price_desc">Price: high to low</option>
                                                    <option value="name_asc">Name: A-Z</option>
                                                    <option value="name_desc">Name: Z-A</option>
                                                    <option value="rating_asc">Rating: low to high</option>
                                                    <option value="rating_desc">Rating: high to low</option>
                                                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: 158.067px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-pe0t-container"><span class="select2-selection__rendered" id="select2-pe0t-container" role="textbox" aria-readonly="true" title="Default">Default</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                <div class="ps-shopping__view ms-2">
                                                    <ul class="products-layout mb-0 p-0">
                                                        <li class="active"><a href="#grid" data-layout="grid"><i class="icon-grid"></i></a></li>
                                                        <li><a href="#list" data-layout="list"><i class="icon-list4"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ps-tabs ps-products-listing bb-product-items-wrapper">
                                <div class="loading">
                                    <div class="half-circle-spinner">
                                        <div class="circle circle-1"></div>
                                        <div class="circle circle-2"></div>
                                    </div>
                                </div>

                                <input type="hidden" name="page" data-value="1">
                                <input type="hidden" name="q" value="">

                                <div class="ps-shopping-product">
                                    <div class="row">
                                        @forelse($datas as $data)
                                        <?php
                                        $imagePath = $data->images ?: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTcFI6hTmgUtdxQTZktMt5KgEbySf4mtRgfQ&s';
                                        ?>
                                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail">
                                                    <a href="" title="Leather Watch In Black">
                                                        <img class="img-fluid fixed-size" src="{{ $imagePath }}" data-bb-lazy="false" loading="lazy" alt="Leather Watch In Black">
                                                    </a>
                                                    <ul class="ps-product__actions">
                                                        <li>
                                                            <a class="btn btn-sm" href="javascript:void(0)" wire:click="addToCart({{ $data->id }})"
                                                                title="Add to cart"><i class="icon-bag2"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="js-quick-view-button" href="#" data-url=" {{ route('main.detail', ['id' => $data->id]) }}" title=" Quick View"><i class="icon-eye"></i>
                                                            </a>
                                                        </li>
                                                        <!-- <li>
                                                            <a class="js-add-to-wishlist-button" href="#" data-url="http://127.0.0.1:8000/wishlist/37" title="Add to Wishlist"><i class="icon-heart"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="js-add-to-compare-button" href="#" data-url="http://127.0.0.1:8000/compare/37" title="Compare"><i class="icon-chart-bars"></i>
                                                            </a>
                                                        </li> -->
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container">
                                                    <a class="ps-product__vendor" href="http://127.0.0.1:8000/stores/global-office" title="Visit store: Global Office">GENERAL AFFAIRS <span class="store-verified-badge badge-sm" data-bs-toggle="tooltip" data-bs-placement="top" style="display: inline-flex; vertical-align: middle;" aria-label="Verified" data-bs-original-title="Verified">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#1d9bf0">
                                                                <path d="M22.25 12c0-1.43-.88-2.67-2.19-3.34.46-1.39.2-2.9-.81-3.91s-2.52-1.27-3.91-.81c-.66-1.31-1.91-2.19-3.34-2.19s-2.67.88-3.33 2.19c-1.4-.46-2.91-.2-3.92.81s-1.26 2.52-.8 3.91c-1.31.67-2.2 1.91-2.2 3.34s.89 2.67 2.2 3.34c-.46 1.39-.21 2.9.8 3.91s2.52 1.26 3.91.81c.67 1.31 1.91 2.19 3.34 2.19s2.68-.88 3.34-2.19c1.39.45 2.9.2 3.91-.81s1.27-2.52.81-3.91c1.31-.67 2.19-1.91 2.19-3.34zm-11.71 4.2L6.8 12.46l1.41-1.42 2.26 2.26 4.8-5.23 1.47 1.36-6.2 6.77z"></path>
                                                            </svg>
                                                        </span></a>
                                                    <div class="ps-product__content">
                                                        <a class="ps-product__title" href="" title="{{ $data->nama_barang }}">{{ $data->nama_barang }}</a>
                                                        <div class="rating_wrap">
                                                            <div class="rating">
                                                                <div class="product_rate" style="width: 77.2%"></div>
                                                            </div>
                                                            <span class="rating_num">({{ $data->stock_type == 'INDENT' ? $data->stock_type  : $data->stock }})</span>

                                                            <p style="font-size:8px;text-transform:unset;font-style:italic" class="small">{{ $data->special_order == 1 ? '( * hanya bisa di order HR Department )' : ''  }} </p>
                                                        </div>
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
                                                    </div>
                                                    <div class="col-12 col-lg-6 text-center text-lg-start">

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
                                </div>
                                <div class="ps-pagination d-flex justify-content-between align-items-center">
                                    @if($datas->total() > 0 )
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
                                                        <
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
                                                        >
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @pushOnce('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            if (!window.cartAddedListenerRegistered) {

                Livewire.on('cart-added', (data) => {
                    $("#product-quickview").modal("hide");
                    if (!data[0].status) {
                        Swal.fire('Gagal', data[0].message, 'error');
                        return;
                    }
                    Swal.fire('Berhasil', data[0].message, 'success');
                });
                window.cartAddedListenerRegistered = true; // tandai sudah didaftarkan
            }
        });

        $(document).on("click", ".js-quick-view-button", function(t) {
            t.preventDefault();

            var o = $(t.currentTarget);
            o.addClass("button-loading");

            $.ajax({
                url: o.data("url"),
                type: "GET",
                success: function(t) {
                    console.log(t[0]);
                    var html = detailQuickView(t[0])

                    $("#product-quickview .ps-product--quickview").html(html);

                    setTimeout(function() {
                        if (typeof EcommerceApp !== "undefined") {
                            EcommerceApp.initProductGallery(true);
                        }
                    }, 200);

                    $("#product-quickview").modal("show");

                    if (typeof Theme.lazyLoadInstance !== "undefined") {
                        Theme.lazyLoadInstance.update();
                    }

                    document.dispatchEvent(new CustomEvent("ecommerce.quick-view.initialized"));



                    o.removeClass("button-loading");
                },
                error: function() {
                    o.removeClass("button-loading");
                }
            });
        });

        function detailQuickView(data) {
            data.images = data.images == null ? 'http://127.0.0.1:8000/storage/products/32-1-300x300.jpg' : data.images;
            return `<div class="ps-product__header">
                        <div class="ps-product__thumbnail" data-vertical="false">
                            <div class="bb-quick-view-gallery-images" data-arrow="true">
                                <div class="slick-list draggable">
                                    <div class="slick-track">
                                        <div class="slick-slide slick-cloned" data-slick-index="-1" id="" aria-hidden="true" style="width: 404px;" tabindex="-1">
                                            <div>
                                                <div class="item" style="width: 100%; display: inline-block;"><img src="/${data.images}" alt="Black Smart Watches"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product__info">
                            <h1><a href="https://martfury.botble.com/products/black-smart-watches">${data.nama_barang}</a></h1>
                            <div class="ps-product__meta">
                                <p>Kode Barang: <a href="javascript:void(0)">${data.kode_barang}</a></p>
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width: 71.2%"></div>
                                    </div>
                                    <span class="rating_num">(${data.order_count}x di order)</span>
                                </div>
                            </div>
                            <h4 class="ps-product__price "><span>${formatRupiah(data.harga)}</span> </h4>
                            <div class="ps-product__desc">
                                <div class="ps-list--dot">

                                    <ul>
                                        <li>Jenis : ${data.jenis_asset_name}</li>
                                        <li> Kategori : ${data.kategori_name}</li>
                                        <li> Model : ${data.model}</li>
                                        <li> Type : ${data.type_barang}</li>
                                    </ul>

                                </div>
                            </div>
                            <div class="pr_switch_wrap">
                                <div class="product-attributes product-attribute-swatches" id="product-attributes-13" data-target="https://martfury.botble.com/product-variation/13">

                                    <div class="bb-product-attribute-swatch text-swatches-wrapper attribute-swatches-wrapper" data-type="text" data-slug="size">
                                        <h4 class="bb-product-attribute-swatch-title">Stock:</h4>
                                        <ul class="bb-product-attribute-swatch-list text-swatch attribute-swatch">
                                            <li data-slug="s" data-id="6" class="bb-product-attribute-swatch-item attribute-swatch-item ">
                                                <label>
                                                    <input name="attribute_size_188793431" data-slug="s" checked type="radio" value="6" class="product-filter-item">
                                                    <span class="bb-product-attribute-text-display">${data.stock_type == 'INDENT' ? data.stock_type  : data.stock + ' ' + data.satuan_name}</span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>

                                    
                                </div>
                            </div>
                            <div class="number-items-available" style="display: none; margin-bottom: 10px;"></div>


                            <form class="add-to-cart-form" method="POST" action="#">
                                <input type="hidden" name="_token" value="H7eCG6hwF3Ec9f1oznWkiwMbwXaFIlaiAooScbuh" autocomplete="off">
                                <div class="ps-product__shopping">
                                    <button  onclick="addToCartFromQuickView('${data.id}')" class="ps-btn ps-btn--black" type="button">Add to cart</button>
                                </div>
                            </form>
                        </div>
                    </div>`;
        }

        function formatRupiah(angka) {
            return 'Rp. ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function addToCartFromQuickView(productId) {
            console.log(productId);
            // window.Livewire.dispatch('addToCart', productId);
            window.Livewire.dispatch('addToCart', [productId]);

        }
    </script>
    @endPushOnce

</div>