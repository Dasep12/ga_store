<div wire:init="loadData">


    <!-- <ul class="nav nav-underline fs-5 navbar-expand p-2 bg-white" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bold active" id="home-tab" data-bs-toggle="tab" href="#tab-home" wire:click="setFilterType('request')" role="tab" aria-controls="tab-home" aria-selected="false" tabindex="-1"><span class="fa-solid fa-hotel"></span> Request</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bold" id="profile-tab" data-bs-toggle="tab" href="#tab-profile" wire:click="setFilterType('progress')" role="tab" aria-controls="tab-profile" aria-selected="false" tabindex="-1"><span class="fa-solid fa-clock"></span> Progress</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bold" id="contact-tab" data-bs-toggle="tab" href="#tab-contact" wire:click="setFilterType('done')" role="tab" aria-controls="tab-contact" aria-selected="true"><span class="fa-solid fa-check"></span> Finish</a>
        </li>
    </ul> -->

    <ul class="nav nav-underline fs-5 navbar-expand p-2 bg-white" style="border-top-left-radius: 10px !important;border-top-right-radius: 10px !important;" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold {{ $filterType == 'request' ? 'active' : '' }}"
                wire:click="setFilterType('request')" type="button">
                <span class="fa-solid fa-hotel"></span> Request
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold {{ $filterType == 'approved' ? 'active' : '' }}"
                wire:click="setFilterType('approved')" type="button">
                <span class="fa-solid fa-edit"></span> Approved
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold {{ $filterType == 'progress' ? 'active' : '' }}"
                wire:click="setFilterType('progress')" type="button">
                <span class="fa-solid fa-clock"></span> Progress
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold {{ $filterType == 'rejected' ? 'active' : '' }}"
                wire:click="setFilterType('rejected')" type="button">
                <span class="fa-solid fa-remove"></span> Reject
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold {{ $filterType == 'done' ? 'active' : '' }}"
                wire:click="setFilterType('done')" type="button">
                <span class="fa-solid fa-check"></span> Finish
            </button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade  active show" id="tab-home" role="tabpanel" aria-labelledby="home-tab">
            @if(!$isReady)
            <div class="text-center p-5 d-flex flex-column align-items-center justify-content-center">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2">Loading...</p>
            </div>
            @else
            <div wire:loading.flex wire:target="setFilterType,loadData" class="justify-content-center align-items-center py-5 position-absolute top-50 start-50 translate-middle">
                <div class="spinner-border text-primary" role="status"></div>
                <span class="ms-2">Loading...</span>
            </div>
            <div class="table-responsive scrollbar bg-white p-3" style="border-bottom-left-radius: 10px !important;border-bottom-right-radius: 10px !important;">
                <table class="table fs-9 mb-0 border-top border-translucent" wire:loading.remove wire:target="gotoPage, perPage,filterData, search, filterType">
                    <thead>
                        @switch($filterType)
                        @case('request')
                        <tr>
                            <th>#</th>
                            <th>KODE</th>
                            <th>BARANG</th>
                            <th>QTY</th>
                            <th>REQUEST DATE</th>
                            <th>REQUEST BY</th>
                            <th>STATUS</th>
                        </tr>
                        @break
                        @case('approved')
                        <tr>
                            <th>#</th>
                            <th>KODE</th>
                            <th>BARANG</th>
                            <th>QTY</th>
                            <th>APPROVE DATE</th>
                            <th>APPROVE BY</th>
                            <th>STATUS</th>
                        </tr>
                        @break
                        @case('progress')
                        <tr>
                            <th>#</th>
                            <th>KODE</th>
                            <th>BARANG</th>
                            <th>QTY</th>
                            <th>PROGRESS DATE</th>
                            <th>PROGRESS BY</th>
                            <th>STATUS</th>
                        </tr>
                        @break
                        @case('rejected')
                        <tr>
                            <th>#</th>
                            <th>KODE</th>
                            <th>BARANG</th>
                            <th>QTY</th>
                            <th>REJECT DATE</th>
                            <th>REJECT BY</th>
                            <th>REMARK</th>
                            <th>STATUS</th>
                        </tr>
                        @break
                        @case('done')
                        <tr>
                            <th>#</th>
                            <th>KODE</th>
                            <th>BARANG</th>
                            <th>QTY</th>
                            <th>QTY ACTUAL</th>
                            <th>UNIT</th>
                            <th>FINISH DATE</th>
                            <th>FINISH BY</th>
                            <th>STATUS</th>
                        </tr>
                        @break
                        @endswitch
                        </tr>
                    </thead>
                    <tbody class="list" id="order-table-body">
                        @switch($filterType)
                        @case('request')
                        @forelse($datas as $data)
                        <?php
                        $imagePath = $data->images ?: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTcFI6hTmgUtdxQTZktMt5KgEbySf4mtRgfQ&s';
                        ?>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle white-space-nowrap ps-0 py-0">
                                <a class="border border-translucent rounded-2 d-inline-block" href="">
                                    <img src="{{ asset($imagePath)}}" alt="" width="53">
                                </a>
                            </td>
                            <td>
                                <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->kode_barang }}</a>
                            </td>
                            <td>
                                <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->nama_barang }}</a>
                            </td>
                            <td>
                                {{ $data->qty }}
                            </td>
                            <td>
                                {{ $data->order_date }}
                            </td>
                            <td>
                                {{ $data->creator }}
                            </td>
                            <td>
                                <span class="badge badge-phoenix fs-9 badge-phoenix-warning"><span class="">{{ $data->status }} <i class="fa fa-clock"></i></span> </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" align="center">DATA NOT FOUND</td>
                        </tr>
                        @endforelse
                        @break
                        @case('approved')
                        @forelse($datas as $data)
                        <?php
                        $imagePath = $data->images ?: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTcFI6hTmgUtdxQTZktMt5KgEbySf4mtRgfQ&s';
                        ?>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle white-space-nowrap ps-0 py-0">
                                <a class="border border-translucent rounded-2 d-inline-block" href="">
                                    <img src="{{ asset($imagePath)}}" alt="" width="53">
                                </a>
                            </td>
                            <td>
                                <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->kode_barang }}</a>
                            </td>
                            <td>
                                <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->nama_barang }}</a>
                            </td>
                            <td>
                                {{ $data->qty }}
                            </td>
                            <td>
                                {{ $data->approved_date }}
                            </td>
                            <td>
                                {{ $data->approved_by }}
                            </td>
                            <td>
                                <span class="badge badge-phoenix fs-9 badge-phoenix-warning"><span class="">{{ $data->status }} <i class="fa fa-edit"></i></span> </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" align="center">DATA NOT FOUND</td>
                        </tr>
                        @endforelse
                        @break
                        @case('progress')
                        @forelse($datas as $data)
                        <?php
                        $imagePath = $data->images ?: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTcFI6hTmgUtdxQTZktMt5KgEbySf4mtRgfQ&s';
                        ?>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle white-space-nowrap ps-0 py-0">
                                <a class="border border-translucent rounded-2 d-inline-block" href="">
                                    <img src="{{ asset($imagePath)}}" alt="" width="53">
                                </a>
                            </td>
                            <td>
                                <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->kode_barang }}</a>
                            </td>
                            <td>
                                <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->nama_barang }}</a>
                            </td>
                            <td>
                                {{ $data->qty }}
                            </td>
                            <td>
                                {{ $data->order_date }}
                            </td>
                            <td>
                                {{ $data->creator }}
                            </td>
                            <td>
                                <span class="badge badge-phoenix fs-9 badge-phoenix-primary"><span class="">{{ $data->status }} <i class="fa fa-clock"></i></span> </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" align="center">DATA NOT FOUND</td>
                        </tr>
                        @endforelse
                        @break
                        @case('rejected')
                        @forelse($datas as $data)
                        <?php
                        $imagePath = $data->images ?: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTcFI6hTmgUtdxQTZktMt5KgEbySf4mtRgfQ&s';
                        ?>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle white-space-nowrap ps-0 py-0">
                                <a class="border border-translucent rounded-2 d-inline-block" href="">
                                    <img src="{{ asset($imagePath)}}" alt="" width="53">
                                </a>
                            </td>
                            <td>
                                <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->kode_barang }}</a>
                            </td>
                            <td>
                                <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->nama_barang }}</a>
                            </td>
                            <td>
                                {{ $data->qty }}
                            </td>
                            <td>
                                {{ $data->rejected_date }}
                            </td>
                            <td>
                                {{ $data->rejected_by }}
                            </td>
                            <td>
                                {{ $data->remark_reject }}
                            </td>
                            <td>
                                <span class="badge badge-phoenix fs-9 badge-phoenix-danger"><span class="">{{ $data->status }} <i class="fa fa-close"></i></span> </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" align="center">DATA NOT FOUND</td>
                        </tr>
                        @endforelse
                        @break
                        @case('done')
                        @forelse($datas as $data)
                        <?php
                        $imagePath = $data->images ?: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTcFI6hTmgUtdxQTZktMt5KgEbySf4mtRgfQ&s';
                        ?>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle white-space-nowrap ps-0 py-0">
                                <a class="border border-translucent rounded-2 d-inline-block" href="">
                                    <img src="{{ asset($imagePath)}}" alt="" width="53">
                                </a>
                            </td>
                            <td>
                                <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->kode_barang }}</a>
                            </td>
                            <td>
                                <a class="fw-semibold mb-0" href="javascript:void(0)">{{ $data->nama_barang }}</a>
                            </td>

                            <td>
                                {{ $data->qty }}
                            </td>
                            <td>
                                {{ $data->qty_actual }}
                            </td>
                            <td>
                                {{ $data->satuan_name }}
                            </td>
                            <td>
                                {{ $data->finish_date }}
                            </td>
                            <td>
                                {{ $data->finish_by }}
                            </td>
                            <td>
                                <span class="badge badge-phoenix fs-9 badge-phoenix-success"><span class="">{{ $data->status }} <i class="fa fa-check"></i></span> </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" align="center">DATA NOT FOUND</td>
                        </tr>
                        @endforelse
                        @break
                        @endswitch


                    </tbody>
                </table>
                {{-- Pagination dengan wire:target --}}

                @if($datas->total() > 0 )
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <div class="fs-9 text-muted">
                        <label class="fs-9">
                            Row
                            <select wire:model.live="perPage" class="form-select-sm form-select d-inline-block w-auto">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            per pages
                        </label><br>
                        Showing {{ $datas->firstItem() }} to {{ $datas->lastItem() }} of {{ $datas->total() }} entries
                    </div>
                    <div>
                        <nav>
                            <ul class="pagination mb-0">
                                <li class="page-item {{ $datas->onFirstPage() ? 'disabled' : '' }}">
                                    <a style="cursor:pointer" class="page-link"
                                        wire:click="gotoPage(1)"
                                        wire:target="gotoPage"
                                        aria-label="First">
                                        <i class="fas fa-angle-double-left"></i>
                                    </a>
                                </li>
                                @foreach ($datas->getUrlRange(
                                max(1, $datas->currentPage() - 1),
                                min($datas->lastPage(), $datas->currentPage() + 1)
                                ) as $page => $url)
                                <li class="page-item {{ $datas->currentPage() == $page ? 'active ' : '' }}">
                                    <a style="cursor:pointer" class="page-link {{ $datas->currentPage() == $page ? 'active ' : '' }}"
                                        wire:click="gotoPage({{ $page }})"
                                        wire:target="gotoPage">
                                        {{ $page }}
                                    </a>
                                </li>
                                @endforeach

                                <li class="page-item {{ !$datas->hasMorePages() ? 'disabled' : '' }}">
                                    <a style="cursor:pointer" class="page-link "
                                        wire:click="gotoPage({{ $datas->lastPage() }})"
                                        wire:target="gotoPage"
                                        aria-label="Last">
                                        <i class="fas fa-angle-double-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>

</div>