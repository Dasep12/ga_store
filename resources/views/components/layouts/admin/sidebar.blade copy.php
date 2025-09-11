 <nav class="navbar navbar-vertical navbar-expand-lg ">
     <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
         <!-- scrollbar removed-->
         <div class="navbar-vertical-content">
             <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                 <li class="nav-item">
                     <!-- parent pages-->
                     <div class="nav-item-wrapper ">
                         <a class="nav-link label-1" href="{{ route('homepage') }}" role="button" data-bs-toggle="" aria-expanded="false">
                             <div class="d-flex align-items-center"><span class="nav-link-icon"> <span class="fa-solid fa-chart-gantt "></span> </span><span class="nav-link-text-wrapper"><span class="nav-link-text">Dashboard</span></span></div>
                         </a>
                     </div>
                 </li>
                 <li class="nav-item">
                     <!-- label-->
                     <p class="navbar-vertical-label">Apps
                     </p>
                     <hr class="navbar-vertical-line" />
                     <!-- parent pages-->
                     <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-e-masterdata" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-e-masterdata">
                             <div class="d-flex align-items-center">
                                 <div class="dropdown-indicator-icon-wrapper"><span class="fas fa-caret-right dropdown-indicator-icon"></span></div><span class="nav-link-icon"><span data-feather="database"></span></span><span class="nav-link-text">Database</span>
                             </div>
                         </a>
                         <div class="parent-wrapper label-1">
                             <ul class="nav collapse parent " data-bs-parent="#navbarVerticalCollapse" id="nv-e-masterdata">
                                 <li class="collapsed-nav-item-title d-none">Database
                                 </li>
                                 <li class="nav-item"><a class="nav-link dropdown-indicator" href="#nv-admin" data-bs-toggle="collapse" aria-expanded="true" aria-controls="nv-admin">
                                         <div class="d-flex align-items-center">
                                             <div class="dropdown-indicator-icon-wrapper"><span class="fas fa-caret-right dropdown-indicator-icon"></span></div><span class="nav-link-text">Master</span>
                                         </div>
                                     </a>
                                     <!-- more inner pages-->
                                     <div class="parent-wrapper">
                                         <ul class="nav collapse parent show" data-bs-parent="#e-masterdata" id="nv-admin">
                                             <li class="nav-item">
                                                 <a class="nav-link" href="{{ url('departments') }}">
                                                     <div class="d-flex align-items-center"><span class="nav-link-text">Master Department</span>
                                                     </div>
                                                 </a>
                                                 <!-- more inner pages-->
                                             </li>
                                             <li class="nav-item">
                                                 <a class="nav-link" href="{{ url('kategori') }}">
                                                     <div class="d-flex align-items-center"><span class="nav-link-text">Master Kategori</span>
                                                     </div>
                                                 </a>
                                                 <!-- more inner pages-->
                                             </li>
                                             <li class="nav-item">
                                                 <a class="nav-link" href="{{ url('units') }}">
                                                     <div class="d-flex align-items-center"><span class="nav-link-text">Master Unit / Satuan</span>
                                                     </div>
                                                 </a>
                                                 <!-- more inner pages-->
                                             </li>
                                         </ul>
                                     </div>
                                 </li>
                                 <li class="nav-item"><a class="nav-link dropdown-indicator" href="#nv-customer" data-bs-toggle="collapse" aria-expanded="true" aria-controls="nv-customer">
                                         <div class="d-flex align-items-center">
                                             <div class="dropdown-indicator-icon-wrapper"><span class="fas fa-caret-right dropdown-indicator-icon"></span></div><span class="nav-link-text">Barang</span>
                                         </div>
                                     </a>
                                     <!-- more inner pages-->
                                     <div class="parent-wrapper">
                                         <ul class="nav collapse parent show" data-bs-parent="#e-commerce" id="nv-customer">
                                             <li class="nav-item"><a class="nav-link" href="{{ url('product') }}">
                                                     <div class="d-flex align-items-center"><span class="nav-link-text">Master Barang</span>
                                                     </div>
                                                 </a>
                                                 <!-- more inner pages-->
                                             </li>
                                         </ul>
                                     </div>
                                 </li>

                             </ul>
                         </div>
                     </div>

                     <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-e-transaction" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-e-transaction">
                             <div class="d-flex align-items-center">
                                 <div class="dropdown-indicator-icon-wrapper"><span class="fas fa-caret-right dropdown-indicator-icon"></span></div><span class="nav-link-icon"><span data-feather="shopping-cart"></span></span><span class="nav-link-text">Transaction</span>
                             </div>
                         </a>
                         <div class="parent-wrapper label-1">
                             <ul class="nav collapse parent " data-bs-parent="#navbarVerticalCollapse" id="nv-e-transaction">
                                 <li class="collapsed-nav-item-title  d-none">Transaction
                                 </li>
                                 <li class="nav-item"><a class="nav-link dropdown-indicator" href="#nv-admin" data-bs-toggle="collapse" aria-expanded="true" aria-controls="nv-admin">
                                         <div class="d-flex align-items-center">
                                             <div class="dropdown-indicator-icon-wrapper"><span class="fas fa-caret-right dropdown-indicator-icon"></span></div><span class="nav-link-text">Permintaan Barang</span>
                                         </div>
                                     </a>
                                     <!-- more inner pages-->
                                     <div class="parent-wrapper">
                                         <ul class="nav collapse parent show" data-bs-parent="#e-transaction" id="nv-admin">
                                             <li class="nav-item">
                                                 <a class="nav-link" href="{{ url('pengadaan') }}">
                                                     <div class="d-flex align-items-center"><span class="nav-link-text">List Request</span>
                                                     </div>
                                                 </a>
                                                 <!-- more inner pages-->
                                             </li>

                                         </ul>
                                     </div>
                                 </li>
                                 <li class="nav-item"><a class="nav-link dropdown-indicator" href="#nv-customer" data-bs-toggle="collapse" aria-expanded="true" aria-controls="nv-customer">
                                         <div class="d-flex align-items-center">
                                             <div class="dropdown-indicator-icon-wrapper"><span class="fas fa-caret-right dropdown-indicator-icon"></span></div><span class="nav-link-text">Stock</span>
                                         </div>
                                     </a>
                                     <!-- more inner pages-->
                                     <div class="parent-wrapper">
                                         <ul class="nav collapse parent show" data-bs-parent="#e-commerce" id="nv-customer">
                                             <li class="nav-item"><a class="nav-link" href="{{ url('inputstock') }}">
                                                     <div class="d-flex align-items-center"><span class="nav-link-text">Input Stock</span>
                                                     </div>
                                                 </a>
                                                 <!-- more inner pages-->
                                             </li>
                                             <li class="nav-item"><a class="nav-link" href="{{ url('stock') }}">
                                                     <div class="d-flex align-items-center"><span class="nav-link-text">Stock Barang</span>
                                                     </div>
                                                 </a>
                                                 <!-- more inner pages-->
                                             </li>
                                         </ul>
                                     </div>
                                 </li>
                             </ul>
                         </div>
                     </div>
                     <!-- parent pages-->
                     <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-settings" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-settings">
                             <div class="d-flex align-items-center">
                                 <div class="dropdown-indicator-icon-wrapper"><span class="fas fa-caret-right dropdown-indicator-icon"></span></div><span class="nav-link-icon"><span data-feather="phone"></span></span><span class="nav-link-text">Settings</span>
                             </div>
                         </a>
                         <div class="parent-wrapper label-1">
                             <ul class="nav collapse parent " data-bs-parent="#navbarVerticalCollapse" id="nv-settings">
                                 <li class="collapsed-nav-item-title d-none">Settings
                                 </li>
                                 <!-- <li class="nav-item"><a class="nav-link" href="{{ url('product') }}">
                                         <div class="d-flex align-items-center"><span class="nav-link-text">Menu Apps</span>
                                         </div>
                                     </a>
                                 </li> -->
                                 <li class="nav-item"><a class="nav-link" href="{{ url('role') }}">
                                         <div class="d-flex align-items-center"><span class="nav-link-text">Role Apps</span>
                                         </div>
                                     </a>
                                     <!-- more inner pages-->
                                 </li>
                                 <li class="nav-item"><a class="nav-link" href="{{ url('users') }}">
                                         <div class="d-flex align-items-center"><span class="nav-link-text">Users Account</span>
                                         </div>
                                     </a>
                                     <!-- more inner pages-->
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </li>
             </ul>
         </div>
     </div>
     <div class="navbar-vertical-footer ">
         <button class="btn navbar-vertical-toggle border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center"><span class="uil uil-left-arrow-to-left fs-8"></span><span class="uil uil-arrow-from-right fs-8"></span><span class="navbar-vertical-footer-text ms-2">Collapsed View</span></button>
     </div>
 </nav>