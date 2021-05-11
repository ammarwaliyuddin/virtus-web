<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #000000;
            text-align: center;
            height: 20px;
            margin: 8px;
        }
    </style>
</head>

<body>
    <div style="font-size:24px; color:'#dddddd'">Daftar Customer</div>

    <hr>
    <table cellpadding="6">
        <tr>
            <th>No</th>
            <th>Nama Area</th>
            <th>Nama Customer</th>
            <th>Nomer Customer</th>
            <th>Nama PIC</th>
            <th>Nomor PIC</th>
            <th>Email PIC</th>
            <th>Alamat PIC</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($Customer as $C) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $C['Area']; ?></td>
                <td><?= $C['Nama_customer']; ?></td>
                <td><?= $C['Telepon_customer']; ?></td>
                <td><?= $C['Nama_PIC']; ?></td>
                <td><?= $C['Telepon_PIC']; ?></td>
                <td><?= $C['Email_PIC']; ?></td>
                <td><?= $C['Alamat_PIC']; ?></td>

            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>