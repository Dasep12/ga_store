<div class="row" wire:key="product-table" wire:init="loadData">
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
                                    <form action="http://127.0.0.1:8000/product-categories/batteries" data-action="http://127.0.0.1:8000/products" method="GET" class="bb-product-form-filter">
                                        <div class="bb-ecommerce-filter-hidden-fields">
                                            <input name="layout" type="hidden" class="product-filter-item" value="">
                                            <input name="page" type="hidden" class="product-filter-item" value="">
                                            <input name="per-page" type="hidden" class="product-filter-item" value="">
                                            <input name="num" type="hidden" class="product-filter-item" value="">
                                            <input name="sort-by" type="hidden" class="product-filter-item" value="">
                                            <input name="collection" type="hidden" class="product-filter-item" value="">
                                            <input name="discounted_only" type="hidden" class="product-filter-item" value="">
                                        </div>



                                        <div class="bb-product-filter">
                                            <h4 class="bb-product-filter-title">Brands</h4>

                                            <div class="bb-product-filter-content">
                                                <ul class="bb-product-filter-items filter-checkbox">
                                                    <li class="bb-product-filter-item">
                                                        <input id="attribute-brand-2" type="checkbox" name="brands[]" value="2">
                                                        <label for="attribute-brand-2">Hand crafted</label>
                                                    </li>
                                                    <li class="bb-product-filter-item">
                                                        <input id="attribute-brand-3" type="checkbox" name="brands[]" value="3">
                                                        <label for="attribute-brand-3">Mestonix</label>
                                                    </li>
                                                    <li class="bb-product-filter-item">
                                                        <input id="attribute-brand-6" type="checkbox" name="brands[]" value="6">
                                                        <label for="attribute-brand-6">Anfold</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="bb-product-filter">
                                            <h4 class="bb-product-filter-title border-0 mb-3">Price</h4>

                                            <div class="bb-product-filter-content">
                                                <div class="bb-product-price-filter">
                                                    <div class="price-slider mb-20 ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="0" data-max="1662">
                                                        <div class="ui-slider-range ui-corner-all ui-widget-header" style="width: 100%; left: 0%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span>
                                                    </div>
                                                    <div class="bb-product-price-filter-info d-flex align-items-center justify-content-between">
                                                        <span class="input-range">
                                                            <input name="min_price" type="hidden" value="">
                                                            <input name="max_price" type="hidden" value="">
                                                            <span class="input-range-label">
                                                                <span class="from">$0.00</span> — <span class="to">$1,662.00</span>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bb-product-filter">
                                            <div class="bb-product-filter-attribute-item">
                                                <h4 class="bb-product-filter-title">On Sale</h4>
                                                <div class="bb-product-filter-content">
                                                    <ul class="bb-product-filter-items filter-checkbox">
                                                        <li class="bb-product-filter-item">
                                                            <input id="discounted_only" name="discounted_only" type="checkbox" value="1" data-bb-toggle="product-form-filter-item">
                                                            <label for="discounted_only" style="line-height: 20px;">Show only discounted products</label>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bb-product-filter bb-product-filter-attributes">
                                            <div class="bb-product-filter-attribute-item">
                                                <h4 class="bb-product-filter-title">Color</h4>
                                                <div class="bb-product-filter-content">
                                                    <ul class="bb-product-filter-items filter-checkbox">
                                                        <li class="bb-product-filter-item">
                                                            <input id="attribute-6" name="attributes[size][]" type="checkbox" value="6">
                                                            <label for="attribute-6">S</label>
                                                        </li>
                                                        <li class="bb-product-filter-item">
                                                            <input id="attribute-7" name="attributes[size][]" type="checkbox" value="7">
                                                            <label for="attribute-7">M</label>
                                                        </li>
                                                        <li class="bb-product-filter-item">
                                                            <input id="attribute-8" name="attributes[size][]" type="checkbox" value="8">
                                                            <label for="attribute-8">L</label>
                                                        </li>
                                                        <li class="bb-product-filter-item">
                                                            <input id="attribute-9" name="attributes[size][]" type="checkbox" value="9">
                                                            <label for="attribute-9">XL</label>
                                                        </li>
                                                        <li class="bb-product-filter-item">
                                                            <input id="attribute-10" name="attributes[size][]" type="checkbox" value="10">
                                                            <label for="attribute-10">XXL</label>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="bb-product-filter-attribute-item">
                                                <h4 class="bb-product-filter-title">Size</h4>

                                                <div class="bb-product-filter-content">
                                                    <ul class="bb-product-filter-items filter-checkbox">
                                                        <li class="bb-product-filter-item">
                                                            <input id="attribute-6" name="attributes[size][]" type="checkbox" value="6">
                                                            <label for="attribute-6">S</label>
                                                        </li>
                                                        <li class="bb-product-filter-item">
                                                            <input id="attribute-7" name="attributes[size][]" type="checkbox" value="7">
                                                            <label for="attribute-7">M</label>
                                                        </li>
                                                        <li class="bb-product-filter-item">
                                                            <input id="attribute-8" name="attributes[size][]" type="checkbox" value="8">
                                                            <label for="attribute-8">L</label>
                                                        </li>
                                                        <li class="bb-product-filter-item">
                                                            <input id="attribute-9" name="attributes[size][]" type="checkbox" value="9">
                                                            <label for="attribute-9">XL</label>
                                                        </li>
                                                        <li class="bb-product-filter-item">
                                                            <input id="attribute-10" name="attributes[size][]" type="checkbox" value="10">
                                                            <label for="attribute-10">XXL</label>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>


                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="ps-layout__right">
                        <div class="ps-block--shop-features">
                            <div class="ps-block__header">
                                <h1 class="h1">Batteries</h1>
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
                                                <strong>3</strong><span class="ms-1">Products found</span>
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
                                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail">
                                                    <a href="http://127.0.0.1:8000/products/macsafe-80w-digital" title="MacSafe 80W (Digital)">
                                                        <img src="http://127.0.0.1:8000/storage/products/32-1-300x300.jpg" data-bb-lazy="false" loading="lazy" alt="MacSafe 80W (Digital)">
                                                    </a>
                                                    <div class="ps-product__badges">
                                                        <div class="ps-product__badge">-18%</div>
                                                    </div>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-bb-toggle="quick-shop" data-url="http://127.0.0.1:8000/ajax/quick-shop/macsafe-80w-digital" data-product-id="32" data-product-name="MacSafe 80W (Digital)" data-product-price="1560.62" data-product-sku="DI-199-A1" data-product-category="Sport &amp; Outdoor" data-product-brand="Hand crafted" data-product-categories="Electronics,Accessories &amp; Parts,Batteries,Sport &amp; Outdoor" title="Select Options"><i class="icon-bag2"></i></a></li>
                                                        <li><a class="js-quick-view-button" href="#" data-url="http://127.0.0.1:8000/ajax/quick-view/32" title="Quick View"><i class="icon-eye"></i></a></li>
                                                        <li><a class="js-add-to-wishlist-button" href="#" data-url="http://127.0.0.1:8000/wishlist/32" title="Add to Wishlist"><i class="icon-heart"></i></a></li>
                                                        <li><a class="js-add-to-compare-button" href="#" data-url="http://127.0.0.1:8000/compare/32" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container">
                                                    <a class="ps-product__vendor" href="http://127.0.0.1:8000/stores/old-el-paso" title="Visit store: Old El Paso">Old El Paso </a>
                                                    <div class="ps-product__content">
                                                        <a class="ps-product__title" href="http://127.0.0.1:8000/products/macsafe-80w-digital" title="MacSafe 80W (Digital)">MacSafe 80W (Digital)</a>
                                                        <div class="rating_wrap">
                                                            <div class="rating">
                                                                <div class="product_rate" style="width: 44.4%"></div>
                                                            </div>
                                                            <span class="rating_num">(9)</span>
                                                        </div>

                                                        <p class="ps-product__price  sale ">$1,264.10 <del>$1,560.62 </del> </p>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail">
                                                    <a href="http://127.0.0.1:8000/products/leather-watch-in-black" title="Leather Watch In Black">
                                                        <img src="http://127.0.0.1:8000/storage/products/37-1-300x300.jpg" data-bb-lazy="false" loading="lazy" alt="Leather Watch In Black">
                                                    </a>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-bb-toggle="quick-shop" data-url="http://127.0.0.1:8000/ajax/quick-shop/leather-watch-in-black" data-product-id="37" data-product-name="Leather Watch In Black" data-product-price="1661.63" data-product-sku="BC-184-A1" data-product-category="Cars &amp; Motorcycles" data-product-brand="Mestonix" data-product-categories="Batteries,Monitors,Phones,Cars &amp; Motorcycles" title="Select Options"><i class="icon-bag2"></i></a></li>
                                                        <li><a class="js-quick-view-button" href="#" data-url="http://127.0.0.1:8000/ajax/quick-view/37" title="Quick View"><i class="icon-eye"></i></a></li>
                                                        <li><a class="js-add-to-wishlist-button" href="#" data-url="http://127.0.0.1:8000/wishlist/37" title="Add to Wishlist"><i class="icon-heart"></i></a></li>
                                                        <li><a class="js-add-to-compare-button" href="#" data-url="http://127.0.0.1:8000/compare/37" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container">
                                                    <a class="ps-product__vendor" href="http://127.0.0.1:8000/stores/global-office" title="Visit store: Global Office">Global Office <span class="store-verified-badge badge-sm" data-bs-toggle="tooltip" data-bs-placement="top" style="display: inline-flex; vertical-align: middle;" aria-label="Verified" data-bs-original-title="Verified">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#1d9bf0">
                                                                <path d="M22.25 12c0-1.43-.88-2.67-2.19-3.34.46-1.39.2-2.9-.81-3.91s-2.52-1.27-3.91-.81c-.66-1.31-1.91-2.19-3.34-2.19s-2.67.88-3.33 2.19c-1.4-.46-2.91-.2-3.92.81s-1.26 2.52-.8 3.91c-1.31.67-2.2 1.91-2.2 3.34s.89 2.67 2.2 3.34c-.46 1.39-.21 2.9.8 3.91s2.52 1.26 3.91.81c.67 1.31 1.91 2.19 3.34 2.19s2.68-.88 3.34-2.19c1.39.45 2.9.2 3.91-.81s1.27-2.52.81-3.91c1.31-.67 2.19-1.91 2.19-3.34zm-11.71 4.2L6.8 12.46l1.41-1.42 2.26 2.26 4.8-5.23 1.47 1.36-6.2 6.77z"></path>
                                                            </svg>
                                                        </span></a>
                                                    <div class="ps-product__content">
                                                        <a class="ps-product__title" href="http://127.0.0.1:8000/products/leather-watch-in-black" title="Leather Watch In Black">Leather Watch In Black</a>
                                                        <div class="rating_wrap">
                                                            <div class="rating">
                                                                <div class="product_rate" style="width: 77.2%"></div>
                                                            </div>
                                                            <span class="rating_num">(7)</span>
                                                        </div>

                                                        <p class="ps-product__price ">$1,661.63 </p>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail">
                                                    <a href="http://127.0.0.1:8000/products/cool-smart-watches-digital" title="Cool Smart Watches (Digital)">
                                                        <img src="http://127.0.0.1:8000/storage/products/12-1-300x300.jpg" data-bb-lazy="false" loading="lazy" alt="Cool Smart Watches (Digital)">
                                                    </a>
                                                    <div class="ps-product__badges">
                                                        <span class="ps-product__badge" style="background-color: #fe9931 !important;">Sale</span>
                                                    </div>
                                                    <ul class="ps-product__actions">
                                                        <li><a class="add-to-cart-button" data-id="12" href="#" data-url="http://127.0.0.1:8000/cart/add-to-cart" data-bb-toggle="none" data-product-id="12" data-product-name="Cool Smart Watches (Digital)" data-product-price="497.64" data-product-sku="FW-168" data-product-category="Cars &amp; Motorcycles" data-product-brand="Anfold" data-product-categories="Batteries,Clothing,Phones,Cars &amp; Motorcycles" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                                        <li><a class="js-quick-view-button" href="#" data-url="http://127.0.0.1:8000/ajax/quick-view/12" title="Quick View"><i class="icon-eye"></i></a></li>
                                                        <li><a class="js-add-to-wishlist-button" href="#" data-url="http://127.0.0.1:8000/wishlist/12" title="Add to Wishlist"><i class="icon-heart"></i></a></li>
                                                        <li><a class="js-add-to-compare-button" href="#" data-url="http://127.0.0.1:8000/compare/12" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container">
                                                    <a class="ps-product__vendor" href="http://127.0.0.1:8000/stores/global-office" title="Visit store: Global Office">Global Office <span class="store-verified-badge badge-sm" data-bs-toggle="tooltip" data-bs-placement="top" style="display: inline-flex; vertical-align: middle;" aria-label="Verified" data-bs-original-title="Verified">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#1d9bf0">
                                                                <path d="M22.25 12c0-1.43-.88-2.67-2.19-3.34.46-1.39.2-2.9-.81-3.91s-2.52-1.27-3.91-.81c-.66-1.31-1.91-2.19-3.34-2.19s-2.67.88-3.33 2.19c-1.4-.46-2.91-.2-3.92.81s-1.26 2.52-.8 3.91c-1.31.67-2.2 1.91-2.2 3.34s.89 2.67 2.2 3.34c-.46 1.39-.21 2.9.8 3.91s2.52 1.26 3.91.81c.67 1.31 1.91 2.19 3.34 2.19s2.68-.88 3.34-2.19c1.39.45 2.9.2 3.91-.81s1.27-2.52.81-3.91c1.31-.67 2.19-1.91 2.19-3.34zm-11.71 4.2L6.8 12.46l1.41-1.42 2.26 2.26 4.8-5.23 1.47 1.36-6.2 6.77z"></path>
                                                            </svg>
                                                        </span></a>
                                                    <div class="ps-product__content">
                                                        <a class="ps-product__title" href="http://127.0.0.1:8000/products/cool-smart-watches-digital" title="Cool Smart Watches (Digital)">Cool Smart Watches (Digital)</a>
                                                        <div class="rating_wrap">
                                                            <div class="rating">
                                                                <div class="product_rate" style="width: 65.8%"></div>
                                                            </div>
                                                            <span class="rating_num">(7)</span>
                                                        </div>

                                                        <p class="ps-product__price  sale ">$164.64 <del>$497.64 </del> </p>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ps-pagination">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>