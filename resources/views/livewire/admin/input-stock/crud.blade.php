<!-- Modal -->
<div class="modal fade" id="modalCrud" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formSubmit" enctype="multipart/form-data" class="form-loading" name="formSubmit" method="post">
                @csrf
                <div class="modal-body">
                    <input type="text" hidden id="transaction_id" name="transaction_id">
                    <input type="text" hidden id="crudAction" name="crudAction">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="product_id" class="form-label">Nama Barang *</label>
                            <select class="form-control form-control-sm"
                                id="product_id" name="product_id">
                                @foreach($produk as $pr)
                                <option data-kode_barang="{{ $pr->kode_barang }}" value="{{ $pr->id }}">{{ $pr->nama_barang }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger fs-9 error-text" id="error-product_id"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="kode_barang" class="form-label">Kode Barang *</label>
                            <input type="text" class="form-control form-control-sm" id="kode_barang" name="kode_barang" placeholder="Kode Barang">
                            <span class="text-danger fs-9 error-text" id="error-kode_barang"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="no_po" class="form-label">NO PO</label>
                            <input type="text" class="form-control form-control-sm" id="no_po" name="no_po" placeholder="NO PO">
                            <span class="text-danger fs-9 error-text" id="error-no_po"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="tanggal_beli" class="form-label">Tanggal Pembelian</label>
                            <input type="date" class="form-control form-control-sm" id="tanggal_beli" name="tanggal_beli" placeholder="Tanggal Pembelian">
                            <span class="text-danger fs-9 error-text" id="error-tanggal_beli"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="qty" class="form-label">QTY *</label>
                            <input type="number" class="form-control form-control-sm" id="qty" name="qty" placeholder="Qty">
                            <span class="text-danger fs-9 error-text" id="error-qty"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="harga_satuan" class="form-label">Harga Satuan</label>
                            <input type="number" class="form-control form-control-sm" id="harga_satuan" name="harga_satuan" placeholder="Harga Satuan">
                            <span class="text-danger fs-9 error-text" id="error-harga_satuan"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="harga_total" class="form-label">Total Harga</label>
                            <input type="number" class="form-control form-control-sm" id="harga_total" name="harga_total" placeholder="Harga Satuan">
                            <span class="text-danger fs-9 error-text" id="error-harga_total"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="supplier" class="form-label">Supplier</label>
                            <input type="text" class="form-control form-control-sm" id="supplier" name="supplier" placeholder="Supplier">
                            <span class="text-danger fs-9 error-text" id="error-supplier"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="remark" class="form-label">Remark</label>
                            <textarea class="form-control form-control-sm" id="remark" name="remark" placeholder="Remark"></textarea>
                            <span class="text-danger fs-9 error-text" id="error-remark"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnSave" type="button" class="btn btn-sm btn-success bg-custom-navbar text-white">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>