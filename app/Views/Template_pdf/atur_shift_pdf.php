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
    <div style="font-size:24px; color:'#dddddd'">Daftar Shift</div>
    <hr>
    <table cellpadding="6">
        <tr>
            <th>No</th>
            <th>Nama Personil</th>
            <th>Nama Area</th>
            <th>Hari</th>
            <th>Jam</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($atur_shift as $atur) : ?>
            <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $atur['Nama']; ?></td>
                <td><?= $atur['Nama_area']; ?></td>
                <td><?= $atur['Hari']; ?></td>
                <td><?= $atur['Jam']; ?></td>

            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>