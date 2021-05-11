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
    <div style="font-size:24px; color:'#dddddd'">Daftar Jabatan</div>

    <hr>

    <table cellpadding="6">
        <tr>
            <th>No</th>
            <th>Nama Jabatan</th>
            <th>Area</th>
            <th>Deskripsi</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($Jabatan as $J) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $J['Jabatan']; ?></td>
                <td><?= $J['Nama_area']; ?></td>
                <td><?= $J['Deskripsi']; ?></td>

            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>