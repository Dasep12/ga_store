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
                    <input type="text" hidden id="id" name="id">
                    <input type="text" hidden id="crudAction" name="crudAction">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="product_id" class="form-label">Nama Barang *</label>
                            <select class="form-control form-control-sm"
                                id="product_id" name="product_id">
                                <option value="">Pilih</option>
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
                            <label for="qty-actual" class="form-label">Stock Actual *</label>
                            <input type="number" class="form-control form-control-sm" id="qty-actual" name="qty-actual" placeholder="Qty Actual">
                            <span class="text-danger fs-9 error-text" id="error-qty-actual"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="tanggal" class="form-label">Tanggal Adjust</label>
                            <input type="date" class="form-control form-control-sm" id="tanggal" name="tanggal" placeholder="Tanggal Pembelian">
                            <span class="text-danger fs-9 error-text" id="error-tanggal"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="qty" class="form-label">QTY *</label>
                            <input type="number" class="form-control form-control-sm" id="qty" name="qty" placeholder="Qty">
                            <span class="text-danger fs-9 error-text" id="error-qty"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="type" class="form-label">Type Adjust *</label>
                            <select class="form-control form-control-sm"
                                id="type" name="type">
                                <option value="+">Plus (+)</option>
                                <option value="-">Minus (-)</option>
                            </select>
                            <span class="text-danger fs-9 error-text" id="error-type"></span>
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