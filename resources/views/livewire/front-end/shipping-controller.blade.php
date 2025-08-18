<div>
    <div class="border-y border-translucent bg-white p-3" id="productWishlistTable">
        <div class="table-responsive scrollbar mb-3">
            @if($cart)
            <table class="table fs-9 mb-0">
                <thead>
                    <tr>
                        <th class="sort white-space-nowrap align-middle fs-10" scope="col" style="width:7%;"></th>
                        <th class="sort white-space-nowrap align-middle">KODE</th>
                        <th class="sort white-space-nowrap align-middle" style="width: 20%;">BARANG</th>
                        <th class="sort white-space-nowrap align-middle">TYPE</th>
                        <th class="sort white-space-nowrap align-middle">KATEGORI</th>
                        <th class="sort white-space-nowrap align-middle" style="width: 10%;">QTY</th>
                        <th style=" width: 20%;" class=""> </th>
                    </tr>
                </thead>
                <tbody class="list" id="profile-wishlist-table-body">
                    @foreach($cart as $id => $item)
                    <?php
                    $imagePath = $item['images'] ?: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTcFI6hTmgUtdxQTZktMt5KgEbySf4mtRgfQ&s';
                    ?>
                    <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle white-space-nowrap ps-0 py-0">
                            <a class="border border-translucent rounded-2 d-inline-block" href="">
                                <img src="{{ asset($imagePath)}}" alt="" width="53">
                            </a>
                        </td>
                        <td class="color align-middle white-space-nowrap fs-9 text-body">{{ $item['kode_barang'] }}</td>

                        <td class="products align-middle">
                            <a class="fw-semibold mb-0" href="">{{ $item['nama_barang'] }}</a>
                        </td>
                        <td class="color align-middle white-space-nowrap fs-9 text-body">REGULER</td>
                        <td class="color align-middle white-space-nowrap fs-9 text-body">KATEGORI</td>

                        <td class="quantity align-middle">
                            <div class="input-group input-group-sm flex-nowrap" data-quantity="data-quantity"><button wire:click="decreamentQuantity({{ $id }})" class="btn btn-sm px-2" data-type="minus">-</button>
                                <input
                                    wire:model.lazy="cart.{{ $id }}.qty"
                                    class="form-control text-center input-spin-none bg-transparent border-0 px-0" type="number" min="1" value="{{ $item['qty'] }}" aria-label="Amount (to the nearest dollar)">
                                <button class="btn btn-sm px-2" wire:click="increamentQuantity({{ $id }})" data-type="plus">+</button>
                            </div>
                        </td>
                        <td class="align-middle white-space-nowrap text-end pe-0 ps-3">
                            <button wire:click="removeItem({{ $id }})" class="btn btn-sm text-body-tertiary text-opacity-85 text-body-tertiary-hover me-2"><span class="fas fa-trash text-danger"></span></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Keranjang kosong</p>
            @endif
        </div>
        <div class="d-flex justify-content-end mt-5 mb-5">
            <button wire:click="checkOut" class="btn btn-primary fs-10"><span class="fas fa-shopping-cart me-1 fs-10"></span> Request Barang</button>
        </div>
    </div>
</div>

@pushOnce('scripts')
<script>
    if (!window.CheckoutSuccessListenerRegistered) {
        Livewire.on('checkout-success', (data) => {
            alert(data.message ?? data[0]?.message ?? 'Checkout berhasil');
            console.log(data.message ?? data[0]?.message ?? 'Checkout berhasil');
        });
        window.CheckoutSuccessListenerRegistered = true;
    }
</script>
@endPushOnce