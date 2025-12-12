<div>
    <div class="ps-cart--mini">
        <a class="header__extra btn-shopping-cart" href="http://127.0.0.1:8000/cart" title="Shopping cart"><i class="icon-bag2"></i><span><i>{{ $total }}</i></span></a>
        <div class="ps-cart--mobile">
            <div class="ps-cart__content">
                @if($total > 0)
                <div class="ps-cart__items">
                    <div class="ps-cart__items__body">
                        <?php

                        $cart = session('cart', []);

                        ?>
                        @foreach($cart as $id => $item)
                        <?php
                        $imagePath = $item['images'] ?: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTcFI6hTmgUtdxQTZktMt5KgEbySf4mtRgfQ&s';

                        ?>
                        <div class="ps-product--cart-mobile">
                            <div class="ps-product__thumbnail">
                                <a href=""><img src="{{ $imagePath }}" data-bb-lazy="true" loading="lazy" data-src="{{ $imagePath }}" alt="{{ $item['nama_barang'] }}" data-ll-status="loaded" class="entered loaded"></a>
                            </div>
                            <div class="ps-product__content">
                                <a wire:click="removeItem({{ $id }})" class="ps-product__remove remove-cart-item" href="#" data-url="">
                                    <i class="icon-cross"></i>
                                </a>
                                <a href=""> {{ $item['nama_barang'] }}</a>
                                <p class="mb-0">
                                    <small>
                                        <span class="d-inline-block">{{ $item['qty'] }} x</span>
                                        <span class="cart-price">

                                        </span>
                                    </small>
                                </p>
                                <!-- <p class="mb-0">
                                    <small>
                                        <small>(Color: Black, Size: XXL)</small>
                                    </small>
                                </p> -->
                                <p class="d-block mb-0 sold-by">
                                    <small>Sold by:
                                        <a href="https://martfury.botble.com/stores/starkist">GENERAL AFFAIRS <span data-bs-toggle="tooltip" data-bs-placement="top" class="store-verified-badge badge-sm page_speed_80455555" aria-label="Verified" data-bs-original-title="Verified">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#1d9bf0">
                                                    <path d="M22.25 12c0-1.43-.88-2.67-2.19-3.34.46-1.39.2-2.9-.81-3.91s-2.52-1.27-3.91-.81c-.66-1.31-1.91-2.19-3.34-2.19s-2.67.88-3.33 2.19c-1.4-.46-2.91-.2-3.92.81s-1.26 2.52-.8 3.91c-1.31.67-2.2 1.91-2.2 3.34s.89 2.67 2.2 3.34c-.46 1.39-.21 2.9.8 3.91s2.52 1.26 3.91.81c.67 1.31 1.91 2.19 3.34 2.19s2.68-.88 3.34-2.19c1.39.45 2.9.2 3.91-.81s1.27-2.52.81-3.91c1.31-.67 2.19-1.91 2.19-3.34zm-11.71 4.2L6.8 12.46l1.41-1.42 2.26 2.26 4.8-5.23 1.47 1.36-6.2 6.77z"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    </small>
                                </p>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="ps-cart__footer">
                    <!-- <h5>Sub Total:<strong>$1,286.16</strong></h5>
                    <h5>Tax:<strong>$0.00</strong></h5>
                    <h3>Total:<strong>$1,286.16</strong></h3> -->
                    <figure>
                        <a class="ps-btn" href="{{ url('shipping') }}">View Cart</a>
                        <a href="{{ url('track') }}" class="ps-btn">Checkout</a>
                    </figure>
                </div>
                @else
                <div class="ps-cart__items ps-cart_no_items">
                    <span class="cart-empty-message">No products in the cart.</span>
                </div>
                @endif


            </div>
        </div>
    </div>
</div>