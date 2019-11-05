<div class="row page-body-header">
    <div class="col-lg-10">
        <span class="page-header">Data Kamar</span>
        <span class="page-subheader">Input kamar yang tersedia di hotel di sini.</span>
    </div>
    <div class="col-lg-2 d-flex">
        <button class="btn btn-primary my-auto ml-auto btn-block" onclick="EHModalForm.add('./module/admin_datakamar_create.php')">&plus; Tambah Data</button>
    </div>
</div>

<table class="table table-bordered table-hover">
    <thead class="thead-light">
        <th>Kode Kamar</th>
        <th>Status Kamar</th>
        <th>Terakhir Check-In</th>
        <th>Terakhir Check-Out</th>
        <th>Harga Kamar</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <?php
        $query = $_DB->query('SELECT * FROM tbl_kamar');
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                echo "<tr><td>$row[kode_kamar]</td>";
                echo $row['status_kamar'] == 1 ? '<td>Aktif</td>' : '<td>Belum Aktif</td>';
                echo $row['tgl_check_in'] == '0000-00-00' ? '<td>Belum Check In</td>' : "<td>$row[tgl_check_in]</td>";
                echo $row['tgl_check_out'] == '0000-00-00' ? '<td>Belum Check Out</td>' : "<td>$row[tgl_check_out]</td>";
                echo '<td>' . 'Rp. ' . number_format($row['harga_kamar'], 0, ',', '.') . '</td>';
                echo <<<"QUERY"
                        <td class="d-flex">
                        <div class="mx-auto">
                        <button class="btn btn-success mr-2" onclick="EHModalForm.edit(
                        './module/admin_datakamar_readID.php?id_kamar=$row[id_kamar]',
                        './module/admin_datakamar_edit.php');EHModalForm.lockElement()">Ubah</button>
                        <button class="btn btn-danger" onclick="EHModalForm.delete(
                        './module/admin_datakamar_delete.php','id_kamar',$row[id_kamar])">Hapus</button>
                        </div>
                        </td>
                        </tr>
                        QUERY;
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
      EHModalForm.lockElementConfig = 'kode_kamar'
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
                    <input type="hidden" name="_method" value="">
                    <input type="hidden" name="id_kamar" id="id_kamar" value="">
                    <div class="row form-group">
                        <div class="col-lg-4 d-flex">
                            <label for="kode_kamar" class="my-auto">Kode Kamar</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" name="kode_kamar" id="kode_kamar" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-4 d-flex">
                            <label for="harga_kamar" class="my-auto">Harga Kamar</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" name="harga_kamar" id="harga_kamar" class="form-control">
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
