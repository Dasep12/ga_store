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
                    <input type="text" id="id" hidden name="id">
                    <input type="text" id="crudAction" hidden name="crudAction">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control form-control-sm" id="nama_barang" name="nama_barang" placeholder="Nama Barang">
                            <span class="text-danger fs-9 error-text" id="error-nama_barang"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="kode_barang" class="form-label">Kode Barang</label>
                            <input type="text" class="form-control form-control-sm" id="kode_barang" name="kode_barang" placeholder="Kode Barang">
                            <span class="text-danger fs-9 error-text" id="error-kode_barang"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="type_barang" class="form-label">Type Barang</label>
                            <select name="type_barang" class="form-select form-select-sm" id="type_barang">
                                <option value="">Pilih Tipe Barang</option>
                                <option value="REGULER">REGULER</option>
                                <option value="NON-REGULER">NON-REGULER</option>
                            </select>
                            <span class="text-danger fs-9 error-text" id="error-type_barang"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="jenis_asset" class="form-label">Jenis Asset</label>
                            <select id="jenis_asset" name="jenis_asset" class="form-select form-select-sm" id="">
                                <option value="">Pilih Jenis Asset</option>
                                @foreach($jenis_assets as $asset)
                                <option value="{{ $asset->kode_asset }}">{{ $asset->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger fs-9 error-text" id="error-jenis_asset"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select class="form-select form-select-sm" id="kategori_id" name="kategori_id">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger fs-9 error-text" id="error-kategori_id"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="merek" class="form-label">Merek</label>
                            <input type="text" class="form-control form-control-sm" id="merek" name="merek" placeholder="Merek">
                            <span class="text-danger fs-9 error-text" id="error-merek"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="warna" class="form-label">Warna</label>
                            <input type="text" class="form-control form-control-sm" id="warna" name="warna" placeholder="Warna">
                            <span class="text-danger fs-9 error-text" id="error-warna"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="ukuran" class="form-label">Ukuran</label>
                            <input type="text" class="form-control form-control-sm" id="ukuran" name="ukuran" placeholder="Ukuran">
                            <span class="text-danger fs-9 error-text" id="error-ukuran"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="satuan_id" class="form-label">Satuan</label>
                            <select class="form-select form-select-sm" id="satuan_id" name="satuan_id">
                                <option value="">Pilih Unit</option>
                                @foreach($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->code . ' : ' .  $unit->name  }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger fs-9 error-text" id="error-satuan_id"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" class="form-control form-control-sm" id="model" name="model" placeholder="Model">
                            <span class="text-danger fs-9 error-text" id="error-model"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="stock_type" class="form-label">Stock Type</label>
                            <select class="form-select form-select-sm" id="stock_type" name="stock_type">
                                <option value="">Pilih Unit</option>
                                <option value="INDENT">INDENT</option>
                                <option value="READY">READY</option>
                            </select>
                            <span class="text-danger fs-9 error-text" id="error-stock_type"></span>
                        </div>


                        <div class="col-md-3 mb-3">
                            <label for="images" class="form-label">Images</label>
                            <input type="file" class="form-control form-control-sm" id="images" name="images" placeholder="images">
                            <span class="text-danger fs-9 error-text" id="error-images"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea type="text" class="form-control form-control-sm" id="deskripsi" name="deskripsi" placeholder="Deskripsi"></textarea>
                            <span class="text-danger fs-9 error-text" id="error-deskripsi"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="form-check form-switch mt-3">
                                <input class="form-check-input" type="checkbox" id="is_actived" name="is_actived" value="1">
                                <label class="form-check-label">Active</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="special_order" name="special_order" value="1">
                                <label class="form-check-label">Special Order</label>
                            </div>
                        </div>

                        <div class="row error-info"></div>
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