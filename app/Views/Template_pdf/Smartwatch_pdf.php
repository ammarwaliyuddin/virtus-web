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
    <div style="font-size:24px; color:'#dddddd'">Daftar Smartwatch</div>

    <hr>
    <table cellpadding="6">
        <tr>
            <th>No</th>
            <th>Nama Smartwatch</th>
            <th>Latitude</th>
            <th>Longitude</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($Smartwatch as $S) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $S['merek']; ?></td>
                <td><?= $S['latitude']; ?></td>
                <td><?= $S['longitude']; ?></td>

            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>