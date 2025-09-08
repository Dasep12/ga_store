<div class="modal fade" id="modalImport" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formImport" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" id="file" />
                    <div id="uploadProgress" style="display:none;">
                        <div id="uploadPercent">0%</div>
                        <div style="width:100%; background:#eee;">
                            <div id="uploadBar" style="width:0%;height:18px;background:#4caf50"></div>
                        </div>
                    </div>

                    <div id="importProgress" style="display:none;">
                        <div id="importPercent">0%</div>
                        <div style="width:100%; background:#eee;">
                            <div id="importBar" style="width:0%;height:18px;background:#2196F3"></div>
                        </div>
                        <div id="importStatus"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="btnUpload" type="submit" class="btn btn-primary btn-sm bg-custom-navbar" id="btnUpload"><i class="fa fa-file-upload"></i> Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>