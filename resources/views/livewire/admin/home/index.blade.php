<div>
    <!-- CONTENT -->
    <div class="container-fluid">
        <div class="col-12 col-xxl-2 mb-3">
            <div class="row align-items-center g-3 g-xxl-0 h-100 align-content-between">
                <div class="col-12 col-sm-6 col-md-3 col-lg-6 col-xl-3 col-xxl-12">
                    <div class="d-flex align-items-center"><span class="fs-4 lh-1 uil uil-refresh text-danger-dark"></span>
                        <div class="ms-2">
                            <div class="d-flex align-items-end">
                                <h2 class="mb-0 me-2 all">0</h2><span class="fs-7 fw-semibold text-body">Items</span>
                            </div>
                            <p class="text-body-secondary fs-9 mb-0">All </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 col-lg-6 col-xl-3 col-xxl-12">
                    <div class="d-flex align-items-center"><span class="fs-4 lh-1 uil uil-books text-primary-dark"></span>
                        <div class="ms-2">
                            <div class="d-flex align-items-end">
                                <h2 class="mb-0 me-2 reguler">0</h2><span class="fs-7 fw-semibold text-body">Items</span>
                            </div>
                            <p class="text-body-secondary fs-9 mb-0 ">Reguler</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 col-lg-6 col-xl-3 col-xxl-12">
                    <div class="d-flex align-items-center"><span class="fs-4 lh-1 uil uil-books text-success-dark"></span>
                        <div class="ms-2">
                            <div class="d-flex align-items-end">
                                <h2 class="mb-0 me-2  nonreguler">0</h2><span class="fs-7 fw-semibold text-body">Items</span>
                            </div>
                            <p class="text-body-secondary fs-9 mb-0">Non-Reguler</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 col-lg-6 col-xl-3 col-xxl-12">
                    <div class="d-flex align-items-center"><span class="fs-4 lh-1 uil uil-invoice text-warning-dark"></span>
                        <div class="ms-2">
                            <div class="d-flex align-items-end">
                                <h2 class="mb-0 me-2 request">0</h2><span class="fs-7 fw-semibold text-body">Items</span>
                            </div>
                            <p class="text-body-secondary fs-9 mb-0">Request</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-7 pb-3 border-y">
            <div class="row">
                <div class="col-12 col-xl-7 col-xxl-6">
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <p class="text-body-tertiary">Request Pengadaan Department</p>
                            <canvas id="myChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-5 col-xxl-6">
                    <p class="text-body-tertiary mb-0 mb-xl-3"></p>
                    <table class="table table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Department</th>
                                <th>Qty</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END -->
</div>

@push('scripts')
<script>
    function chartRequest() {
        $.ajax({
            url: "{{ route('listRequestDepartment') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                formattedData = data.map(item => item.code_department);
                formattedValues = data.map(item => item.total_requests);
                console.log(formattedData);
                console.log(formattedValues);
                // Chart.js initialization
                const ctx = document.getElementById('myChart');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: formattedData,
                        datasets: [{
                            label: 'Request',
                            data: formattedValues,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", status, error);
            }
        });
    }

    SumProduct()
    chartRequest()
    listOrder()

    function SumProduct() {
        $.ajax({
            url: "{{ route('SumProduct') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                $(".all").html(data.All);
                $(".reguler").html(data.Reguler);
                $(".nonreguler").html(data.NonReguler);
                $(".request").html(data.Request);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", status, error);
            }
        });
    }

    function listOrder() {
        $.ajax({
            url: "{{ route('listOrder') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                let rows = '';
                data.forEach((item, index) => {
                    rows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.kode_barang}</td>
                        <td>${item.nama_barang}</td>
                        <td>${item.department}</td>
                        <td>${item.qty}</td>
                        <td>${item.status}</td>
                    </tr>
                    `;
                });
                $('table tbody').html(rows);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", status, error);
            }
        });
    }
</script>
@endpush