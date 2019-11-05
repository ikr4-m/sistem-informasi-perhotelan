<div class="row page-body-header">
    <div class="col-lg-12">
        <span class="page-header">Pemasukan</span>
        <span class="page-subheader">Total pemasukan keseluruhan.</span>
    </div>
</div>

<script>
    $(function () {
        $('.table').DataTable({ language: dtLangID })
    })
</script>

<div class="card">
    <div class="card-header bg-info text-white">Riwayat Tagihan</div>
    <div class="card-body">

        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <th>No. Transaksi</th>
                <th>Tamu</th>
                <th>Total Tagihan</th>
                <th>Tertanggal</th>
            </thead>
            <tbody>
                <?php
                $query = $_DB->query('SELECT * FROM view_tagihan');
                $total_tagihan = 0;
                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_assoc()) {
                        echo '<tr>';
                        echo "<td>$row[no_transaksi]</td>";
                        echo "<td>$row[kode_kamar] - $row[nama]</td>";
                        echo "<td>Rp. ". number_format($row['total_tagihan'], 0, ',', '.') ."</td>";
                        echo "<td>$row[isseud_date]</td>";
                        echo '</tr>';
                        $total_tagihan += $row['total_tagihan'];
                    }
                }
                ?>
            </tbody>
        </table>

        <hr />

        <div class="row">
            <div class="col-lg-6">
                <p>Total Tagihan Keseluruhan: </p>
            </div>
            <div class="col-lg-6 text-right">
                <p><?= 'Rp. ' . number_format($total_tagihan, 0, ',', '.') ?></p>
            </div>
        </div>

    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-info text-white">Riwayat Transaksi Jasa</div>
    <div class="card-body">

        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <th>No. Transaksi</th>
                <th>Tamu</th>
                <th>Harga Jasa</th>
                <th>Tertanggal</th>
            </thead>
            <tbody>
                <?php
                $query = $_DB->query('SELECT * FROM view_transaksi_jasa');
                $total_tagihan = 0;
                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_assoc()) {
                        echo '<tr>';
                        echo "<td>$row[no_transaksi]</td>";
                        echo "<td>$row[kode_kamar] - $row[nama]</td>";
                        echo "<td>Rp. ". number_format($row['harga_jasa'], 0, ',', '.') ."</td>";
                        echo "<td>$row[issued_date]</td>";
                        echo '</tr>';
                        $total_tagihan += (int  ) $row['harga_jasa'];
                    }
                }
                ?>
            </tbody>
        </table>

        <hr />

        <div class="row">
            <div class="col-lg-6">
                <p>Total Jasa Keseluruhan: </p>
            </div>
            <div class="col-lg-6 text-right">
                <p><?= 'Rp. ' . number_format($total_tagihan, 0, ',', '.') ?></p>
            </div>
        </div>

    </div>
</div>
