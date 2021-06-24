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
    <div style="font-size:24px; color:'#dddddd'">Daftar personil</div>
    <hr>
    <table cellpadding="6">
        <tr>
            <th>No</th>
            <th>Nama Personil</th>
            <th>NIK</th>
            <th>Email</th>
            <th>Umur</th>
            <th>Nomor HP</th>
            <th>Foto</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($personilAll as $p) : ?>
            <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $p['Nama']; ?></td>
                <td><?= $p['NIK']; ?></td>
                <td><?= $p['Email']; ?></td>
                <td><?= $p['Umur']; ?></td>
                <td><?= $p['Nomor_HP']; ?></td>
                <td><?= $p['Foto']; ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>