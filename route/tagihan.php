<div class="row page-body-header">
    <div class="col-lg-10">
        <span class="page-header">Tagihan</span>
        <span class="page-subheader">Ketika tamu ingin keluar dari hotel, maka tamu harus membayar tagihannya.</span>
    </div>
</div>

<form class="form" action="./module/admin_tagihan_transaksi.php" method="post">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-white bg-info">
                    <h5>Form Tagihan</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="no_transaksi">No. Transaksi</label>
                        <input type="text" name="no_transaksi" class="form-control" id="no_transaksi" readonly>
                    </div>
                    <div class="form-group">
                        <label for="id_tamu">Tamu</label>
                        <select class="form-control" name="id_tamu" id="id_tamu">
                            <option value="" disabled hidden selected>..:: Pilih Tamu ::..</option>
                            <?php
                            $query = $_DB->query('SELECT * FROM view_tamu WHERE status="1"');
                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_assoc()) {
                                    echo "<option value='$row[id_tamu]'>$row[kode_kamar] - $row[nama]</option>";
                                }
                            } else {
                                echo "<option value='null'>Tamu masih kosong.</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-white bg-info">
                    <h5>Riwayat Tagihan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <th>Keterangan</th>
                            <th width="35%">Harga</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lama Inap</td>
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
                    <input type="hidden" name="total_tagihan" id="total_tagihan">
                    <input type="submit" value="Proses Transaksi" class="btn btn-success btn-block proses-transaksi" disabled>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(function () {
      $('#no_transaksi').val(`TGH${moment().format('YYYYMMDDHHmmss')}`)
      $('#id_tamu').change(function () {
        $.get('./module/global_tamu_legend.php?id_tamu=' + $(this).val())
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
    })
</script>
