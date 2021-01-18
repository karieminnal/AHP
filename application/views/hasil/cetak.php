<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak Hasil Survey Kepuasan Pelanggan</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 14px;
        }

        th {
            height: 30px;
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 3px;
        }

        thead {
            background: lightgray;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2 class="center">LAPORAN HASIL SURVEY KEPUASAN PELANGGAN</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Divisi</th>
                <th>Tingkat Kepuasan</th>
                <th>Keterangan</th>
                <th>Jumlah Pelanggan yang Melakukan Survey</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0; ?>
            <?php foreach ($hasil as $row) : ?>
                <tr>
                    <td class="center"><?= ++$no ?></td>
                    <td><?= $row['nama_divisi'] ?></td>
                    <td class="center"><?= $row['tingkat_kepuasan'] ?>%</td>
                    <td class="center"><?= $row['keterangan'] ?></td>
                    <td class="center"><?= $row['jumlah_pelanggan'] ?> orang</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>