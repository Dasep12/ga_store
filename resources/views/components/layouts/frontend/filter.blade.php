 <div class="col-lg-2 col-xxl-2 ps-2 ps-xxl-2">
     <div class="phoenix-offcanvas-filter bg-body scrollbar phoenix-offcanvas phoenix-offcanvas-fixed" id="productFilterColumn" style="top: 92px">
         <div class="d-flex justify-content-between align-items-center mb-3">
             <h3 class="mb-0">Filters</h3>
             <button class="btn d-lg-none p-0" data-phoenix-dismiss="offcanvas"><span class="uil uil-times fs-8"></span></button>
         </div>
         <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseAvailability" role="button" aria-expanded="true" aria-controls="collapseAvailability">
             <div class="d-flex align-items-center justify-content-between w-100">
                 <div class="fs-8 text-body-highlight">Jenis</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
             </div>
         </a>
         <div class="collapse show" id="collapseAvailability">
             <div class="mb-2">
                 @foreach($jenis_assets as $jenis)
                 <div class="form-check mb-0">
                     <input class="form-check-input mt-0" id="{{ $jenis->kode_asset }}" type="checkbox" name="color">
                     <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="{{ $jenis->kode_asset }}">{{ $jenis->name }}</label>
                 </div>
                 @endforeach
             </div>
         </div>
         <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseColorFamily" role="button" aria-expanded="true" aria-controls="collapseColorFamily">
             <div class="d-flex align-items-center justify-content-between w-100">
                 <div class="fs-8 text-body-highlight">Kategori</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
             </div>
         </a>
         <div class="collapse show" id="collapseColorFamily">
             <div class="mb-2">
                 @foreach($categories as $category)
                 <div class="form-check mb-0">
                     <input class="form-check-input mt-0"
                         id="category-{{ $category->id }}"
                         type="checkbox" name="color"
                         wire:model.live="selectedCategories"
                         value="{{ $category->id }}">
                     <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="category-{{ $category->id }}">{{ $category->name }}</label>
                 </div>
                 @endforeach
             </div>
         </div>
         <a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseBrands" role="button" aria-expanded="true" aria-controls="collapseBrands">
             <div class="d-flex align-items-center justify-content-between w-100">
                 <div class="fs-8 text-body-highlight">Type</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
             </div>
         </a>
         <div class="collapse show" id="collapseBrands">
             <div class="mb-2">
                 <div class="form-check mb-0">
                     <input class="form-check-input mt-0" id="flexCheckReguler" type="checkbox" wire:model.live="selectedType" name="brands" value="REGULER">
                     <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="flexCheckReguler">
                         REGULER
                     </label>
                 </div>
                 <div class="form-check mb-0">
                     <input class="form-check-input mt-0" id="flexCheckNonReguler" type="checkbox" wire:model.live="selectedType" name="brands" value="NON-REGULER">
                     <label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="flexCheckNonReguler">
                         NON-REGULER
                     </label>
                 </div>
             </div>
         </div>

     </div>
     <div class="phoenix-offcanvas-backdrop d-lg-none" data-phoenix-backdrop style="top: 92px"></div>
 </div>