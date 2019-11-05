<?php $id_user = $_SESSION['user']['id_tamu']; ?>

<div class="row page-body-header">
    <div class="col-lg-10">
        <span class="page-header">Deskripsi Tagihan</span>
        <span class="page-subheader">Total tagihan anda akan tersusun dengan rapih di sini.</span>
    </div>
</div>

<script type="text/javascript">
  $(function () {
    $('.table-transaksi').DataTable()
    $.get('./module/global_tamu_legend.php?id_tamu=' + <?= $id_user ?>)
      .done(function (json) {
        // console.log(json)
        // Lama menetap
        const menetap = moment().diff(moment(json.tamu.tgl_check_in), 'days') + 1
        $('#history-lama-hari').text(menetap)

        // Harga kamar
        const hargaKamar = json.tamu.harga_kamar
        $('#history-kamar').text(
          EHFamily.Rupiah.format(hargaKamar.toString())
        )

        // Total harga kamar
        const totalHargaKamar = hargaKamar * menetap
        $('#history-akumulasi-kamar').text(
          EHFamily.Rupiah.format((totalHargaKamar).toString())
        )

        // Total jasa
        let totalJasa = 0, countJasa = 0
        json.jasa.forEach(function (j) {
          countJasa++
          totalJasa = parseInt(totalJasa) + parseInt(j.harga_jasa)
        })
        $('#history-akumulasi-jasa').text(
          EHFamily.Rupiah.format(totalJasa.toString())
        )

        // Total semua tagihan
        const totalTagihan = parseInt(totalHargaKamar) + parseInt(totalJasa)
        $('#history-total-tagihan').text(
          EHFamily.Rupiah.format(totalTagihan.toString())
        )
        $('#total_tagihan').val(totalTagihan)

        // Nyalakan tombol Transaksi
        $('.proses-transaksi').removeAttr('disabled')
      })
      .fail(function (error) {
        console.log(error)
      })
  })
</script>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5>Rincian Transaksi Jasa</h5>
            </div>
            <div class="card-body">
                <table class="table table-transaksi table-bordered table-hover">
                    <thead class="">
                        <th>Nomor Transaksi</th>
                        <th>Unit Jasa</th>
                        <th>Tanggal Diminta</th>
                        <th>Harga Jasa</th>
                    </thead>
                    <tbody>
                        <?php
                        $query = $_DB->query("SELECT * FROM view_transaksi_jasa WHERE id_tamu='$id_user'");
                        if ($query->num_rows > 0) {
                            while ($row = $query->fetch_assoc()) {
                                echo '<tr>';
                                echo "<td>$row[no_transaksi]</td>";
                                echo "<td>$row[unit_jasa]</td>";
                                echo "<td>$row[issued_date]</td>";
                                echo "<td>Rp. ". number_format($row['harga_jasa'], 0, ',', '.') ."</td>";
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5>Rincian Total Tagihan</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <th>Keterangan</th>
                        <th width="35%">Harga</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lama Menetap</td>
                            <td>
                                <span id="history-lama-hari">0</span> Hari
                            </td>
                        </tr>
                        <tr>
                            <td>Harga Kamar (per hari)</td>
                            <td id="history-kamar">Rp. 0</td>
                        </tr>
                        <tr>
                            <td>Total Harga Kamar (Akumulasi)</td>
                            <td id="history-akumulasi-kamar">Rp. 0</td>
                        </tr>
                        <tr>
                            <td>Total Jasa</td>
                            <td id="history-akumulasi-jasa">Rp. 0</td>
                        </tr>
                        <tr>
                            <td class="bg-dark text-white">Total Tagihan</td>
                            <td class="bg-dark text-white" id="history-total-tagihan">Rp. 0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
