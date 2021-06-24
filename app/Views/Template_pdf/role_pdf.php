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
    <div style="font-size:24px; color:'#dddddd'">Daftar Role User</div>

    <hr>

    <table cellpadding="6">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Email</th>
            <th>Jabatan</th>
            <th>Role</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Foto</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($role as $r) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $r['Nama']; ?></td>
                <td><?= $r['NIK']; ?></td>
                <td><?= $r['Email']; ?></td>
                <td><?= $r['Jabatan']; ?></td>
                <td><?= $r['role']; ?></td>
                <td><?= $r['Status']; ?></td>
                <td><?= $r['Keterangan']; ?></td>
                <td><?= $r['Foto']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>