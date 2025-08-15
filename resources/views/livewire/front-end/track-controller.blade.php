<div>
    <h4>traack order</h4>
    <nav class="navbar navbar-landing navbar-home navbar-expand py-4 px-0">
        <ul class="navbar-nav " id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link fw-bold rounded-3 active" aria-current="page" id="home-tab" data-bs-toggle="tab" href="#tab-home" role="tab" aria-controls="tab-home" aria-selected="true"><span class="me-2 fa-solid fa-hotel"></span> Request</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold rounded-3" id="profile-tab" data-bs-toggle="tab" href="#tab-profile" role="tab" aria-controls="tab-profile" aria-selected="false" aria-current="page"> <span class="me-2 fa-solid fa-plane"></span> Progress</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold rounded-3" aria-current="page" id="contact-tab" data-bs-toggle="tab" href="#tab-contact" role="tab" aria-controls="tab-contact" aria-selected="false"> <span class="me-2 fa-solid fa-suitcase-rolling"></span> Finish</a>
            </li>
        </ul>
    </nav>

    <div class="tab-content mt-3" id="myTabContent">
        <div class="tab-pane fade show active" id="tab-home" role="tabpanel" aria-labelledby="home-tab">
            <div class="col-12 col-xl-12 col-xxl-12">
                <div id="orderTable" data-list="{&quot;valueNames&quot;:[&quot;products&quot;,&quot;color&quot;,&quot;size&quot;,&quot;price&quot;,&quot;quantity&quot;,&quot;total&quot;],&quot;page&quot;:10}">
                    <div class="table-responsive scrollbar">
                        <table class="table fs-9 mb-0 border-top border-translucent">
                            <thead>
                                <tr>
                                    <th class="sort white-space-nowrap align-middle fs-10" scope="col"></th>
                                    <th class="sort white-space-nowrap align-middle" scope="col" style="min-width:400px;" data-sort="products">PRODUCTS</th>
                                    <th class="sort align-middle ps-4" scope="col" data-sort="color" style="width:150px;">COLOR</th>
                                    <th class="sort align-middle ps-4" scope="col" data-sort="size" style="width:300px;">SIZE</th>
                                    <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:150px;">PRICE</th>
                                    <th class="sort align-middle text-end ps-4" scope="col" data-sort="quantity" style="width:200px;">QUANTITY</th>
                                    <th class="sort align-middle text-end ps-4" scope="col" data-sort="total" style="width:250px;">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody class="list" id="order-table-body">
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                    <td class="align-middle white-space-nowrap py-2">
                                        <a class="d-block border border-translucent rounded-2" href="javascript:void(0)"><img src="{{ asset('assets/assets/img//products/1.png')}}" alt="" width="53"></a>
                                    </td>
                                    <td class="products align-middle py-0">
                                        <a class="fw-semibold line-clamp-2 mb-0" href="javascript:void(0)">Fitbit Sense Advanced Smartwatch with Tools for Heart Health, Stress Management &amp; Skin Temperature Trends, Carbon/Graphite, One Size (S &amp; L Bands)</a>
                                    </td>
                                    <td class="payment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                                        <span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Request</span><span class="ms-1" data-feather="target" style="height:12.8px;width:12.8px;"></span></span>
                                    </td>
                                    <td class="payment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                                        <span class="badge badge-phoenix fs-10 badge-phoenix-primary"><span class="badge-label">Progress</span><span class="ms-1" data-feather="clock" style="height:12.8px;width:12.8px;"></span></span>
                                    </td>
                                    <td class="payment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                                        <span class="badge badge-phoenix fs-10 badge-phoenix-danger"><span class="badge-label">Rejected</span><span class="ms-1" data-feather="delete" style="height:12.8px;width:12.8px;"></span></span>
                                    </td>
                                    <td class="fulfilment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                                        <span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Completed</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-profile" role="tabpanel" aria-labelledby="profile-tab">Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic.</div>
        <div class="tab-pane fade" id="tab-contact" role="tabpanel" aria-labelledby="contact-tab">Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</div>
    </div>
</div>