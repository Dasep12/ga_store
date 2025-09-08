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
                    <input type="text" hidden id="crudAction" name="crudAction">
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
                            <input type="text" class="form-control form-control-sm" id="ukuran" name="ukuran" placeholder="ukuran">
                            <span class="text-danger fs-9 error-text" id="error-ukuran"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" class="form-control form-control-sm" id="model" name="model" placeholder="Model">
                            <span class="text-danger fs-9 error-text" id="error-model"></span>
                        </div>


                        <div class="col-md-3 mb-3">
                            <label for="images" class="form-label">Images</label>
                            <input type="file" class="form-control form-control-sm" id="images" name="images" placeholder="images">
                            <span class="text-danger fs-9 error-text" id="error-images"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="creator" class="form-label">Request By</label>
                            <input type="text" class="form-control form-control-sm" id="creator" name="creator" placeholder="creator">
                            <span class="text-danger fs-9 error-text" id="error-creator"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" class="form-control form-control-sm" id="department" name="department" placeholder="Department">
                            <span class="text-danger fs-9 error-text" id="error-department"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="qty" class="form-label">Qty</label>
                            <input type="text" class="form-control form-control-sm" id="qty" name="qty" placeholder="Qty">
                            <span class="text-danger fs-9 error-text" id="error-qty"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button id="btnProcess" type="submit" class="btnSave btnProcess btn btn-sm btn-success bg-custom-navbar text-white"
                        onclick="document.getElementById('crudAction').value='process'">
                        <i class="fa fa-refresh"></i> Progress
                    </button>

                    <button id="btnFinish" type="submit" class="btnSave btnReject btn btn-sm btn-success bg-custom-navbar text-white"
                        onclick="document.getElementById('crudAction').value='done'">
                        <i class="fa fa-check"></i> Finish
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>