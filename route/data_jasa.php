<div class="row page-body-header">
    <div class="col-lg-10">
        <span class="page-header">Data Jasa</span>
        <span class="page-subheader">Input jasa yang tersedia di hotel di sini.</span>
    </div>
    <div class="col-lg-2 d-flex">
        <button class="btn btn-primary my-auto ml-auto btn-block" onclick="EHModalForm.add('./module/admin_datajasa_create.php')">&plus; Tambah Data</button>
    </div>
</div>

<table class="table table-bordered table-hover">
    <thead class="thead-light">
        <th width="40%">Unit Jasa</th>
        <th width="40%">Harga Jasa</th>
        <th width="20%">Aksi</th>
    </thead>
    <tbody>
        <?php
        $query = $_DB->query("SELECT * FROM tbl_jasa");
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                echo '<tr>';
                echo "<td>$row[unit_jasa]</td>";
                echo '<td>Rp ' . number_format($row['harga_jasa'], 0, ',', '.') . '</td>';
                echo <<<"BUTTON"
                        <td class="d-flex">
                        <div class="mx-auto">
                        <button class="btn btn-success mr-2" onclick="EHModalForm.edit(
                        './module/admin_datajasa_readID.php?id_jasa=$row[id_jasa]',
                        './module/admin_datajasa_edit.php')">Ubah</button>
                        <button class="btn btn-danger" onclick="EHModalForm.delete(
                        './module/admin_datajasa_delete.php','id_jasa',$row[id_jasa])">Hapus</button>
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
          language: dtLangID
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
                    <input type="hidden" name="id_jasa" id="id_jasa" value="">

                    <div class="row form-group">
                        <div class="col-lg-4 d-flex">
                            <label for="unit_jasa" class="my-auto">Unit Jasa</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" name="unit_jasa" id="unit_jasa" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-4 d-flex">
                            <label for="harga_jasa" class="my-auto">Harga Jasa</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" name="harga_jasa" id="harga_jasa" class="form-control">
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
