
<div class="content-wrapper mt-3">

  <div class="container">

    <div class="card">
      <div class="card-body">
        <h3 style="font-weight: bold;">Data Order <i class="fas fa-shopping-basket"></i></h3>
        <hr>





        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Order</th>
              <th>Nama User</th>
              <th>Nama Produk</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Total Harga</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            ?>
            <?php foreach($order as $data){ ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $data['kode_order'] ?></td>
                <?php 
                $user = $this->db->get_where('tbl_register',['kode_user' => $data['kode_user']])->row_array();
                ?>
                <td><?= $user['name'] ?></td>
                <td><?= $data['nama_produk'] ?></td>
                <?php 
                $kt = $this->db->get_where('tbl_kategori',['kode_kategori' => $data['kategori']])->row_array();
                ?>
                <td><?= $kt['nama_kategori'] ?></td>
                <td><?= $data['harga'] ?></td>
                <td><?= $data['qty'] ?></td>
                <td><?= $data['total_harga'] ?></td>
                <td>

                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?= $data['id'] ?>">
                    Hapus
                  </button>




                  <div class="modal fade" id="myModal<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Apakah anda ingin menghapus data ini?
                          <form method="post" action="<?= base_url('admin/hapus_user') ?>">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">


                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="hapus" class="btn btn-danger" value="Hapus">
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>




                </td>
              </tr>
            <?php } ?>


          </tbody>
          <tfoot>
            <tr>
              <th colspan="3">Total order</th>
              <th class="text-center"><?= $no-1 ?> Order</th>
              <th colspan="3">Total Pemasukan</th>
              <th colspan="2" class="text-center"><?= "Rp " . number_format($total['total_harga'],0,',','.') ?></th>
              

            </tr>
          </tfoot>
        </table>


      </div>
    </div>










  </div>
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->




<!-- Main Footer -->
<script src="http://momentjs.com/downloads/moment.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> 

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<!-- kalender -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script>
  $(document).ready(function(){

    $("#uang").keyup(function(){
      var uang_anda = $(this).val();
      var totalbayar = $(".totalbayar2").val();
      var hasil = uang_anda - totalbayar;
      $("#hasilkembalian").val(hasil);
    })    

  })
</script>
