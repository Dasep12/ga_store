 <?php

    use Illuminate\Support\Facades\Auth;

    $user = DB::table('tbl_sys_users')->where('user_id', Auth::user()->user_id)->first();
    $photo = $user->photo ? asset('assets/' . $user->photo) : asset('assets/assets/img/team/avatar.webp');

    $notif = DB::table('vw_trn_order')->where('status', 'approved');
    $data = $notif->get();
    ?>
 <nav class="navbar navbar-top fixed-top navbar-expand " id="navbarDefault">
     <div class="collapse navbar-collapse justify-content-between">
         <div class="navbar-logo">

             <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
             <a class="navbar-brand me-1 me-sm-3" href="javascript:void(0);">
                 <div class="d-flex align-items-center">
                     <div class="d-flex align-items-center"><img src="/assets/assets/img/logo-color-bonecom@2x.png" alt="phoenix" width="120" />
                         <p class="logo-text ms-2 d-none d-sm-block">GA STORE</p>
                     </div>
                 </div>
             </a>
         </div>
         <div class="search-box navbar-top-search-box d-none d-lg-block" style="width:25rem;">
             <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                 <!-- <input class="form-control search-input fuzzy-search rounded-pill form-control-sm" type="search" wire:model.live="search" placeholder="Search..." aria-label="Search" />
                  <span class="fas fa-search search-box-icon"></span> -->
                 @livewire('global-search')

             </form>
             <div class="btn-close position-absolute end-0 top-50 translate-middle cursor-pointer shadow-none" data-bs-dismiss="search">
                 <button class="btn btn-link p-0" aria-label="Close"></button>
             </div>
         </div>
         <ul class="navbar-nav navbar-nav-icons flex-row">
             <li class="nav-item">
                 <!-- <div class="theme-control-toggle fa-icon-wait px-2">
                      <input class="form-check-input ms-0 theme-control-toggle-input" type="checkbox" data-theme-control="phoenixTheme" value="dark" id="themeControlToggle" />
                      <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Switch theme" style="height:32px;width:32px;"><span class="icon" data-feather="moon"></span></label>
                      <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Switch theme" style="height:32px;width:32px;"><span class="icon" data-feather="sun"></span></label>
                  </div> -->
             </li>
             <li class="nav-item dropdown">
                 <a class="nav-link" href="#" style="min-width: 2.25rem" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside"><span class="d-block" style="height:20px;width:20px;"><span class="position-absolute top-10 start-100 translate-middle badge count-info badge-notification  rounded-pill bg-danger">0</span><span data-feather="bell" style="height:20px;width:20px;"></span></span></a>

                 <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border navbar-dropdown-caret" id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
                     <div class="card position-relative border-0">
                         <div class="card-header p-2">
                             <div class="d-flex justify-content-between">
                                 <h5 class="text-body-emphasis mb-0">Notifications</h5>
                                 <!-- <button class="btn btn-link p-0 fs-9 fw-normal" type="button">Mark all as read</button> -->
                             </div>
                         </div>
                         <div class="card-body p-0">
                             <div class="scrollbar-overlay" id="notifContainer" style="height: 27rem;">
                                 <p class="text-center text-muted">Memuat notifikasi...</p>
                             </div>
                         </div>
                         <div class="card-footer p-0 border-top border-translucent border-0">
                             <div class="my-2 text-center fw-bold fs-10 text-body-tertiary text-opactity-85"><a class="fw-bolder" href="{{ route('pengadaan.index') }}">Notification history</a></div>
                         </div>
                     </div>
                 </div>
             </li>

             <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                     <div class="avatar avatar-l ">
                         <img class="rounded-circle " src="{{ $photo }}" alt="" />

                     </div>
                 </a>
                 <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border" aria-labelledby="navbarDropdownUser">
                     <div class="card position-relative border-0">
                         <div class="card-body p-0">
                             <div class="text-center pt-4 pb-3">
                                 <div class="avatar avatar-xl ">
                                     <img class="rounded-circle " src="{{ $photo }}" alt="" />
                                 </div>

                                 <h6 class="mt-2 text-body-emphasis"><?= ucwords(Auth::user()->nama) ?></h6>
                             </div>
                             <div class="mb-3 mx-3">
                                 <!-- <input class="form-control form-control-sm" id="statusUpdateInput" type="text" placeholder="Update your status" /> -->
                             </div>
                         </div>
                         <!-- <div class="overflow-auto scrollbar" style="">
                              <ul class="nav d-flex flex-column mb-2 pb-1"> -->
                         <!-- <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-body" data-feather="user"></span><span>Profile</span></a></li> -->
                         <!-- <li class="nav-item"><a class="nav-link px-3" href="#!"><span class="me-2 text-body" data-feather="pie-chart"></span>Dashboard</a></li>
                                  <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-body" data-feather="lock"></span>Posts &amp; Activity</a></li>
                                  <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-body" data-feather="settings"></span>Settings &amp; Privacy </a></li>
                                  <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-body" data-feather="help-circle"></span>Help Center</a></li>
                                  <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-body" data-feather="globe"></span>Language</a></li> -->
                         <!-- </ul>
                          </div> -->
                         <div class="card-footer p-0 border-top border-translucent">
                             <!-- <ul class="nav d-flex flex-column my-3">
                                  <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-body" data-feather="user-plus"></span>Add another account</a></li>
                              </ul> -->
                             <br />
                             <div class="px-3"> <a class="btn btn-phoenix-secondary d-flex flex-center w-100" href="{{ route('logout') }}"> <span class="me-2" data-feather="log-out"> </span>Sign out</a></div>
                             <div class="my-2 text-center fw-bold fs-10 text-body-quaternary">
                                 <!-- <a class="text-body-quaternary me-1" href="#!">Privacy policy</a>&bull;
                                  <a class="text-body-quaternary mx-1" href="#!">Terms</a>&bull;
                                  <a class="text-body-quaternary ms-1" href="#!">Cookies</a> -->
                             </div>
                         </div>
                     </div>
                 </div>
             </li>
         </ul>
     </div>
 </nav>