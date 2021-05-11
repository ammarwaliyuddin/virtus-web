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
    <div style="font-size:24px; color:'#dddddd'">Daftar Area</div>

    <hr>
    <table cellpadding="6">
        <tr>
            <th>No</th>
            <th>Nama Area</th>
            <th>Lokasi</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($Area as $A) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $A['Nama_area']; ?></td>
                <td><?= $A['Lokasi']; ?></td>

            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>