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
    <div style="font-size:24px; color:'#dddddd'">Daftar User</div>

    <hr>
    <table cellpadding="6">
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Keterangan</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($User as $U) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $U['NIK']; ?></td>
                <td><?= $U['Nama']; ?></td>
                <td><?= $U['Email']; ?></td>
                <td><?= $U['Keterangan']; ?></td>

            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>