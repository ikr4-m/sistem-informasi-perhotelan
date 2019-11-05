<div class="row page-body-header">
    <div class="col-lg-10">
        <span class="page-header">Data Tamu</span>
        <span class="page-subheader">Input tamu yang ada di hotel di sini.</span><br>
        <span>Catatan: Username tamu adalah "Kamar Tamu" dan Password tamu adalah "Tanggal awal check-in tanpa garis datar".</span>
    </div>
    <div class="col-lg-2 d-flex">
        <button class="btn btn-primary my-auto ml-auto btn-block" onclick="EHModalForm.add('./module/admin_datatamu_create.php')">&plus; Tambah Data</button>
    </div>
</div>

<table class="table table-bordered table-hover">
    <thead class="thead-light">
        <th>ID Tamu</th>
        <th>Nama Tamu</th>
        <th>Kamar Tamu</th>
        <th>Alamat</th>
        <th>Status</th>
        <th>Pekerjaan</th>
        <th>Nomor Telepon</th>
        <th>Aksi</th>
    </thead>
    <script type="text/javascript">
        EHModalForm.lockElementConfig = 'id_kamar'
    </script>
    <tbody>
        <?php
        $query = $_DB->query("SELECT * FROM view_tamu");
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                echo '<tr>';
                echo "<td>$row[id_tamu]</td>";
                echo "<td>$row[nama]</td>";
                echo "<td>";

                $kodeKamar = "$row[kode_kamar] - Last";
                if ($row['status'] == '1') {
                    $kodeKamar = $kodeKamar . "CI:$row[tgl_check_in]";
                } else {
                    $kodeKamar = $kodeKamar . "CO:$row[tgl_check_out]";
                }
                echo $kodeKamar;

                echo "</td>";
                echo "<td>$row[alamat]</td>";
                echo $row['status'] === '1' ? '<td>Check In</td>' : '<td>Check Out</td>';
                echo "<td>$row[pekerjaan]</td>";
                echo "<td>$row[no_telp]</td>";
                echo <<<"BUTTON"
                        <td class="d-flex">
                        <div class="mx-auto">
                        <button class="btn btn-success mr-2" onclick="EHModalForm.edit(
                        './module/admin_datatamu_readID.php?id_tamu=$row[id_tamu]',
                        './module/admin_datatamu_edit.php');EHModalForm.lockElement();">Ubah</button>
                        <button class="btn btn-danger" onclick="$('#id_kamar').val($row[id_kamar]);EHModalForm.delete(
                        './module/admin_datatamu_delete.php','id_tamu',$row[id_tamu])">Hapus</button>
                        </div>
                        </td>
                        </tr>
                        BUTTON;
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>

<script>
    $(function () {
      $('.table').DataTable({
          language: dtLangID,
          order: [
            ['0', 'desc']
          ]
      })
    })
</script>

<div class="modal modal-center fade modal-form" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <form class="form" method="post">

                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body container">
                    <input type="hidden" name="_method" value="" id="method">
                    <input type="hidden" name="id_tamu" id="id_tamu" value="">

                    <div class="row form-group">
                        <div class="col-lg-4 d-flex">
                            <label for="id_kamar" class="my-auto">Kamar</label>
                        </div>
                        <div class="col-lg-8">
                            <select class="form-control" name="id_kamar" id="id_kamar">
                                <option value="" disabled hidden selected>..:: Pilih Kamar ::..</option>
                                <?php
                                $query = $_DB->query("SELECT * FROM tbl_kamar WHERE status_kamar='0'");
                                if ($query->num_rows > 0) {
                                    while ($row = $query->fetch_assoc()) {
                                        echo "<option value='$row[id_kamar]'>$row[kode_kamar]</option>";
                                    }
                                } else {
                                    echo "<option value='null'>Kamar masih kosong</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-4 d-flex">
                            <label for="nama" class="my-auto">Nama Tamu</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-4 d-flex">
                            <label for="alamat" class="my-auto">Alamat Tamu</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" name="alamat" id="alamat" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-4 d-flex">
                            <label for="pekerjaan" class="my-auto">Pekerjaan Tamu</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-4 d-flex">
                            <label for="no_telp" class="my-auto">Nomor Telepon</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" name="no_telp" id="no_telp" class="form-control">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <input type="submit" class="btn btn-success modal-submit">
                </div>

            </form>
        </div>
    </div>
</div>
