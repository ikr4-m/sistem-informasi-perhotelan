<div class="row page-body-header">
    <div class="col-lg-12">
        <span class="page-header">Transaksi Jasa</span>
        <span class="page-subheader">Apabila tamu ingin meminta jasa, tempatnya di sini.</span>
    </div>
</div>

<div class="row">

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5>Form Transaksi</h5>
            </div>
            <div class="card-body">
                <script type="text/javascript">
                    $(function () {
                      $('table').DataTable({language: dtLangID})
                      $('#id_tamu').change(function () {
                        $('table').DataTable().destroy()
                        $('table').DataTable({
                          language: dtLangID,
                          processing: false,
                          serverSide: false,
                          ordering: true,
                          order: [
                            [0, 'desc']
                          ],
                          ajax: {
                            url: './module/admin_transaksijasa_execute.php',
                            method: 'GET',
                            data: {
                              'id_tamu': $(this).val()
                            },
                            dataSrc: function (json) {
                              $('#id_jasa').removeAttr('disabled')
                              $('.simpan-button').removeAttr('disabled')
                              return json
                            }
                          },
                          columns: [
                            { data: 'no_transaksi' },
                            { data: 'unit_jasa' },
                            { data: 'issued_date' },
                            {
                              render: (data, type, row) => {
                                return EHFamily.Rupiah.format(row.harga_jasa.toString())
                              }
                            }
                          ]
                        })
                      })
                      $('#id_jasa').change(function () {
                        const harga = $(this).find(':selected').data('jasa-harga')
                        $('#harga_jasa').val(harga)
                      })
                      $('#no_transaksi').val(`TJS${moment().format('YYYYMMDDHHmmss')}`)
                    })
                </script>
                <form class="form" action="./module/admin_transaksijasa_transaksi.php" method="post">

                    <div class="form-group">
                        <label for="no_transaksi">Nomor Transaksi</label>
                        <input type="text" name="no_transaksi" id="no_transaksi" class="form-control" readonly>
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
                    <div class="form-group">
                        <label for="id_jasa">Jasa yang diminta</label>
                        <select class="form-control" name="id_jasa" id="id_jasa" disabled>
                            <option value="" disabled hidden selected>..:: Pilih Jasa ::..</option>
                            <?php
                            $query = $_DB->query('SELECT * FROM tbl_jasa');
                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_assoc()) {
                                    $harga = 'Rp. ' . number_format($row['harga_jasa'], 0, ',', '.');
                                    echo "<option value='$row[id_jasa]' data-jasa-harga='$harga'>$row[unit_jasa]</option>";
                                }
                            } else {
                                echo "<option value='null'>Jasa masih kosong.</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga_jasa">Harga Jasa</label>
                        <input type="text" class="form-control" name="harga_jasa" id="harga_jasa" disabled>
                    </div>
                    <input type="submit" class="btn btn-success btn-block simpan-button" value="Simpan" disabled>

                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5>Riwayat Transaksi</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>Nomor Transaksi</th>
                        <th>Unit Jasa</th>
                        <th>Tanggal Diminta</th>
                        <th>Harga Jasa</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>
