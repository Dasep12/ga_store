<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Approval Pengajuan Barang</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            background: #ffffff;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333333;
            text-align: center;
            margin-bottom: 20px;
        }

        .request-info {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .request-info strong {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 10px;
            font-size: 14px;
            text-align: left;
        }

        th {
            background-color: #f8f8f8;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
        }

        .btn-approve {
            background-color: #28a745;
            color: #ffffff;
        }

        .btn-reject {
            background-color: #dc3545;
            color: #ffffff;
        }

        .footer {
            font-size: 12px;
            color: #888888;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>Approval Pengajuan Barang</h2>

        <div class="request-info">
            <p><strong>Nama Pengaju:</strong> {{ $pengaju['nama'] }}</p>
            <p><strong>Departemen:</strong> {{ $pengaju['departemen'] }}</p>
            <p><strong>Tanggal Pengajuan:</strong> {{ $pengaju['tanggal'] }}</p>
        </div>

        <p>Halo, ada pengajuan barang baru yang membutuhkan persetujuan Anda:</p>

        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['qty'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ $approveUrl }}" class="btn btn-approve">Approve</a>
            <a href="{{ $rejectUrl }}" class="btn btn-reject" style="margin-left: 10px;">Reject</a>
        </div>

        <div class="footer">
            Email ini dikirim otomatis oleh sistem. Mohon tidak membalas email ini.
        </div>
    </div>
</body>

</html>