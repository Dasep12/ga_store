 <div class="bb-product-filter">
     <h4 class="bb-product-filter-title">Jenis</h4>

     <div class="bb-product-filter-content">
         <ul class="bb-product-filter-items filter-checkbox">
             @foreach($jenis_assets as $jenis)
             <li class="bb-product-filter-item">
                 <input type="checkbox"
                     wire:model.live="selectedJenis"
                     id="{{ $jenis->kode_asset }}"
                     type="checkbox"
                     value="{{ $jenis->kode_asset }}"
                     name="color">
                 <label for="{{ $jenis->kode_asset }}">{{ $jenis->name }}</label>
             </li>
             @endforeach
         </ul>
     </div>
 </div>

 <!-- <div class="bb-product-filter">
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
 </div> -->


 <div class="bb-product-filter bb-product-filter-attributes">
     <div class="bb-product-filter-attribute-item">
         <h4 class="bb-product-filter-title">Kategori</h4>
         <div class="bb-product-filter-content">
             <ul class="bb-product-filter-items filter-checkbox">
                 @foreach($categories as $category)
                 <li class="bb-product-filter-item">
                     <input type="checkbox" id="category-{{ $category->id }}"
                         type="checkbox" name="color"
                         wire:model.live="selectedCategories"
                         value="{{ $category->id }}">
                     <label for="category-{{ $category->id }}">{{ $category->name }}</label>
                 </li>
                 @endforeach
             </ul>
         </div>
     </div>

     <div class="bb-product-filter-attribute-item">
         <h4 class="bb-product-filter-title">Type</h4>

         <div class="bb-product-filter-content">
             <ul class="bb-product-filter-items filter-checkbox">
                 <li class="bb-product-filter-item">
                     <input id="flexCheckReguler" type="checkbox" wire:model.live="selectedType" name="brands" value="REGULER">
                     <label for="flexCheckReguler">
                         REGULER
                     </label>
                 </li>
                 <li class="bb-product-filter-item">
                     <input id="flexCheckNonReguler" type="checkbox" wire:model.live="selectedType" name="brands" value="NON-REGULER">
                     <label for="flexCheckNonReguler">
                         NON-REGULER
                     </label>
                 </li>
             </ul>
         </div>
     </div>

 </div>

 @pushOnce('scripts')
 <script>
     function initAllCollapses() {
         document.querySelectorAll('.collapse').forEach(el => {
             if (!bootstrap.Collapse.getInstance(el)) {
                 new bootstrap.Collapse(el, {
                     toggle: false
                 });
             }
         });
     }

     document.addEventListener('livewire:load', () => {
         initAllCollapses();

         Livewire.hook('message.processed', () => {
             initAllCollapses();
         });
     });

     document.addEventListener('livewire:navigated', () => {
         initAllCollapses();
     });
 </script>
 @endPushOnce