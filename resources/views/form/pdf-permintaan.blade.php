<!DOCTYPE html>
<html>

<head>
    <title>Form Permintaan Barang</title>
    <style>
        /* ========================================================= */
        /* BASE STYLES & POSITIONING FOR FIXED FOOTER */
        /* ========================================================= */
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 20px;
            /* Jaga margin di sini */
            padding-bottom: 120px;
            /* PENTING: Ruang untuk footer tetap */
        }

        .container {
            width: 100%;
            padding: 0;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #e6e6e6;
            text-align: center;
        }

        .no-border td,
        .no-border th {
            border: none;
            padding: 2px 5px;
        }

        .table-center th {
            text-align: center;
        }

        /* ========================================================= */
        /* HEADER STYLES (image_ffca46.png) */
        /* ========================================================= */
        .header-table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 10px;
        }

        .header-table td {
            border: 1px solid #000;
            padding: 0;
            vertical-align: middle;
        }

        .logo-cell {
            width: 20%;
            padding: 5px;
            text-align: center;
        }

        .title-cell {
            width: 50%;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        .revision-cell {
            width: 30%;
        }

        .revision-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        .revision-table td {
            border: none;
            padding: 3px 5px;
            vertical-align: top;
        }

        .revision-table tr:first-child td {
            border-bottom: 1px solid #000;
        }

        .revision-table tr:nth-child(2) td {
            border-bottom: 1px solid #000;
        }

        .revision-table td:first-child {
            width: 35%;
        }

        .revision-table td:last-child {
            width: 65%;
        }

        /* Detail Permintaan */
        .detail-permintaan td:first-child {
            width: 20%;
        }

        /* Checkbox Style */
        .checkbox {
            width: 10px;
            height: 10px;
            border: 1px solid #000;
            display: inline-block;
            text-align: center;
            line-height: 8px;
            font-size: 8px;
            margin-left: 5px;
        }

        /* ========================================================= */
        /* FOOTER FIXED STYLES (image_ffc3db.png) */
        /* ========================================================= */
        .footer-fixed {
            position: fixed;
            bottom: 20px;
            /* Sesuaikan dengan margin bawah body */
            left: 20px;
            right: 20px;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .signature-row {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-row td {
            border: none;
            padding: 0;
            vertical-align: top;
        }

        /* Kotak General Affair (Cheked) */
        .box-cheked {
            width: 150px;
            border-collapse: collapse;
        }

        .box-cheked th {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            font-weight: bold;
            background-color: transparent;
        }

        .box-cheked td {
            border: 1px solid #000;
            height: 40px;
            padding: 5px;
        }

        .box-cheked tr:last-child td {
            height: 15px;
            font-size: 9px;
            text-align: center;
            line-height: 10px;
        }

        /* Kotak Approved dan Prepared */
        .box-approved-prepared {
            width: 250px;
            border-collapse: collapse;
        }

        .box-approved-prepared th {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            font-weight: bold;
            background-color: transparent;
        }

        .box-approved-prepared td {
            border: 1px solid #000;
            height: 30px;
            padding: 5px;
            text-align: center;
        }

        .box-approved-prepared tr:nth-child(2) td {
            height: 15px;
            font-size: 9px;
            line-height: 10px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/fontawesome.min.css" integrity="sha512-lauN4D/0AgFUGvmMR+knQnbOADyD/XuQ8VF18I8Ll0+TLvsujshyxvU+uzogmQbSq6qJd5jnUdYtK8ShxXMlSg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="container">
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <div style="font-weight: bold; font-size: 18px; color: #8F0000;">
                        <img height="70" width="90" src="{{ public_path('assets/assets/img/logo-color-bonecom@2x.png') }}" alt="Logo">
                    </div>
                    <!-- <div style="font-size: 8px; line-height: 1;">BONECOM TRICOM</div> -->
                </td>

                <td class="title-cell">
                    FORM PERMINTAAN BARANG
                </td>

                <td class="revision-cell">
                    <table class="revision-table">
                        <tr>
                            <td>No.</td>
                            <td>: FM-GA-002</td>
                        </tr>
                        <tr>
                            <td>Revisi</td>
                            <td>: 01</td>
                        </tr>
                        <tr>
                            <td>Efektif</td>
                            <td>: 01 Mei 2025</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="no-border detail-permintaan" style="margin-top: 5px;">
            <tr>
                <td>Departemen</td>
                <td>: {{ ucwords(strtolower($order[0]->department)) }}</td>
            </tr>
            <tr>
                <td>Tanggal Permintaan</td>
                <td>: {{ ucwords($order[0]->order_date) }}</td>
            </tr>
            <tr>
                <td>Nama Pemohon</td>
                <td>: {{ ucwords(strtolower($order[0]->creator)) }}</td>
            </tr>
            <tr>
                <?php
                $user = DB::table('tbl_sys_users')->where('user_id', $order[0]->created_by)->first();
                ?>
                <td>Jabatan</td>
                <td>: {{ $user->jabatan_id }}</td>
            </tr>
        </table>

        <p style="font-weight: bold; margin: 5px 0 2px 0;">A. Jenis Permintaan Barang</p>
        <table>
            <thead>
                <tr>
                    <th style="width: 33.3%;">Regular</th>
                    <th style="width: 33.3%;">Non-Regular</th>
                    <th style="width: 33.3%;">Spesial Order</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 0;">
                        <p style="margin: 0; padding: 5px;">ATK <span class="checkbox"><i class="fa fa-users"></i></span></p>
                        <p style="margin: 0; padding: 5px;">Susu Steril <span class="checkbox"></span></p>
                        <p style="margin: 0; padding: 5px;">Susu UHT <span class="checkbox"></span></p>
                        <p style="margin: 0; padding: 5px;">Obat-obatan <span class="checkbox"></span></p>
                    </td>
                    <td style="padding: 0;">
                        <p style="margin: 0; padding: 5px;">Barang tidak habis pakai <span class="checkbox"></span></p>
                    </td>
                    <td style="padding: 0;">
                        <p style="margin: 0; padding: 5px;">APD ( Seragam, topi, ID-Card & Sepatu) <span class="checkbox"></span></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <p style="font-weight: bold; margin: 5px 0 2px 0;">B. Rincian Barang yang Diminta</p>
        <table class="table-center">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 10%;">Kode Barang</th>
                    <th style="width: 15%;">Nama Barang</th>
                    <th style="width: 30%;">Nama Barang Spesifikasi / Merk</th>
                    <th style="width: 5%;">Qty</th>
                    <th style="width: 8%;">Satuan</th>
                    <th style="width: 10%;">Jenis</th>
                    <th style="width: 17%;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($order as $index => $item)
                <tr>
                    <td>{{ $no++}}</td>
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->merek  }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->satuan_name }}</td>
                    <td>{{ $item->type_barang }}</td>
                    <td></td>
                </tr>
                @endforeach
                <tr>
                    <td>{{ $no }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </div>

    <div class="footer-fixed">
        <table class="signature-row">
            <tr>
                <td style="width: 30%;">
                    <table class="box-cheked">
                        <thead>
                            <tr>
                                <th colspan="1">Cheked</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div style="text-align: center; font-size: 8px;"><br></div>
                                </td>
                            </tr>
                            <tr>
                                <td>General Affair</td>
                            </tr>
                        </tbody>
                    </table>
                </td>

                <td style="width: 40%; padding: 0;">
                </td>

                <td style="width: 30%;">
                    <table class="box-approved-prepared" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Approved</th>
                                <th style="width: 50%;">Prepared</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php
                                    $approvedSign = $order[0]->approved_sign;
                                    $creatorSign = $order[0]->creator_sign;
                                    ?>
                                    <div style="text-align: center; font-size: 8px;">
                                        <img style="height: 40px;width:70px" src="{{ public_path($approvedSign) }}" alt="">
                                    </div>
                                </td>
                                <td>
                                    <div style="text-align: center; font-size: 8px;">
                                        <img style="height: 40px;width:70px" src="{{ public_path($creatorSign) }}" alt="">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ ucwords(strtolower($order[0]->approved_name)) }}</td>
                                <td>{{ ucwords(strtolower($order[0]->creator)) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>