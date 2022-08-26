

<!-- Services -->

<section class="products-grids trending pb-4 mt-5 mb-5">
    <div class="container">
       <?php if($cart == false){ ?>
        <h4 class="text-center mb-2 text-primary" style="font-weight: bold;">Tidak ada item pada keranjang <br>( 404 ) </h4><br>
        <center>
            <a href="<?= base_url('shop/') ?>" class="btn btn-primary">Mulai Berbelanja <i class="fa fa-shopping-bag"></i> </a>
        </center>
        <!--  <img src="<?= base_url('assets/img/brand/logo.png') ?>" class="img-fluid" alt="Responsive image"> -->
        <br>
    <?php }else{ ?>

        <div class="alert alert-dark" role="alert">
          Silahkan isi form data diri dengan data yang sebenar-benarnya, karena alamat pengiriman akan di kirimkan berdasarkan data yang anda isikan.

          Batas akhir pembayaran pesanan adalah 1 x 24 jam dari waktu pesan. Jika tidak dilakukan pembayaran dengan batas waktu tersebut maka pesanan akan digagalkan secara otomatis.

          Pembayaran hanya dilakukan melalui rekening
          ini : <label style="color: orange; font-weight: bold;">BCA 647577111
          a/n PT SINAR ANEKA NIAGA.</label>
      </div>
      <form method="post" action="<?= base_url('shop/checkout') ?>">
          <div class="row">


            <div class="col-sm-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" value="<?= $this->session->email ?>" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Example@mail.com" required>
                    
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">No Whatsapp</label>
                    <input type="number" name="wa" class="form-control"  placeholder="0811" required="">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Sistem Pengambilan Barang</label>
                    <select class="form-control" name="sistem_pengambilan" id="selectpengantaran" required>
                        <option value="">-- Pilih Sistem Pengambilan Barang -- </option>
                        <option>Sistem Jemput</option>
                        <option>Sistem Antar</option>
                    </select>

                    <a href="#" id="readjemput"  data-toggle="modal" data-target="#exampleModaljemput" style="display: none;">
                      Baca aturan untuk sistem penjemputan
                  </a>

                  <a href="#" id="readantar"  data-toggle="modal" data-target="#exampleModalantar" style="display: none;">
                      Baca aturan untuk sistem antar
                  </a>

                 <!--  <a href="#" id="readjemput" class="mt-5" style="display: none;">Baca aturan untuk sistem penjemputan</a>
                  <a href="#" id="readantar" class="mt-5" style="display: none;">Baca aturan untuk sistem pengataran</a> -->

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModaljemput" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Aturan sistem jemput</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button> -->
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModalantar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aturan sistem antar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            <div class="modal-footer">
           <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
    </div>
</div>
</div>




</div>



<div class="form-group" id="filtertgl" style="display: none;">
    <label for="exampleInputEmail1" id="jemput">Tgl Pengantaran / Penjemputan</label>
    <input type="date" name="tgl_pengantaran" class="form-control" required="">
</div>



<div class="form-group">
    <label for="exampleInputEmail1">Alamat Pengantaran</label>
    <textarea class="form-control" placeholder="Kota medan kecamatan medan" name="alamat" required=""></textarea>
    <small id="emailHelp" class="form-text text-muted">Masukan alamat lengkap pengataran.</small>
</div>

</div>
<div class="col-sm-6">
    <br>
    <div class="row">

        <?php foreach($cart as $data){ ?>
            <div class="col-sm-3 col-3">
                <img src="<?= base_url('') ?>/assets/img/products/<?= $data['gambar'] ?>" class="img-fluid" style="height: 100px;">
            </div>
            <div class="col-sm-9 col-9">
                <p  style="font-weight: bold;"><?= $data['name'] ?></p>
                <?php 
                $kategori = $this->db->get_where('tbl_kategori',['kode_kategori' => $data['kategori']])->row_array();
                ?>
                <p style="font-style: italic;"><?= $kategori['nama_kategori'] ?></p>
                <p>Harga / Item : <?= "Rp " . number_format($data['price'],0,',','.') ?></p>
                <p>Qty : 
                    <select id="qty<?= $data['id'] ?>" name="qty[]">
                        <option><?= $data['qty'] ?></option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </p>
                <p>Total Harga : <label style="font-weight: bold;" id="total<?= $data['id'] ?>"><?= "Rp " . number_format($data['price'] * $data['qty'],0,',','.'); ?></label></p>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
            <script>
                var total_harga = 0;
            </script>
            <script>
                $(document).ready(function(){


                    $("#qty<?= $data['id'] ?>").change(function(){
                        var qty = $(this).val();
                        var harga = "<?= $data['price'] ?>";
                        var total = harga * qty;
                        const numb = total;
                        const format = numb.toString().split('').reverse().join('');
                        const convert = format.match(/\d{1,3}/g);
                        const rupiah = 'Rp ' + convert.join('.').split('').reverse().join('');

                        $("#total<?= $data['id'] ?>").html(rupiah);
                        var rowid = "<?= $data['rowid'] ?>";
                        var url = "<?= base_url('shop/totalpembayaran?id=') ?>"+rowid+"&totalharga="+total;
                        $("#totalpembayaran").load(url);
                    })

                })
            </script>
            <input type="hidden" name="produk[]" value="<?= $data['name'] ?>">
            <input type="hidden" name="kode_produk[]" value="<?= $data['id'] ?>">
            <input type="hidden" name="kategori[]" value="<?= $data['kategori'] ?>">
            <input type="hidden" name="harga[]" value="<?= $data['price'] ?>">
            <!--  <input type="hidden" name="qty[]" value="<?= $data['qty'] ?>"> -->
        <?php } ?>
    </div>

    <?php 
    $totalharga = 0;
    foreach ($cart as $total) {
        $harga = $total['price'] * $total['qty'];
        $totalharga += $harga;
    }
    ?>



    <p  style="font-weight: bold;">Total pembayaran : <label id="totalpembayaran"><?= "Rp " . number_format($totalharga,0,',','.'); ?></label> </p>



    <?php if ($this->session->email == null) { ?>

      <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModallogin">
        Checkout <i class="fa fa-credit-card"></i>
    </button>
    <a href="<?= base_url('shop/') ?>" class="btn btn-success btn-block mb-4">Belanja Lagi <i class="fa fa-shopping-cart"></i> </a>
<?php } else{ ?>
    <button type="submit" class="btn btn-primary btn-block">Checkout <i class="fa fa-credit-card"></i></button>
    <a href="<?= base_url('shop/') ?>" class="btn btn-success btn-block mb-4">Belanja Lagi <i class="fa fa-shopping-cart"></i> </a>
<?php } ?>

</div>

<?php } ?>
</div>

</form>


</div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModallogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <form method="post" action="<?= base_url('shop/act_login') ?>">
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass" required>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary ">Login <i class="fa fa-user"></i></button>
</div>
</form>
</div>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

        $("#selectpengantaran").change(function(){
            var val = $(this).val();
            if (val == 'Sistem Jemput') {

                $("#readjemput").show();
                $("#readantar").hide();

                $("#filtertgl").show();


            }else if(val == 'Sistem Antar'){



                $("#readjemput").hide();
                $("#readantar").show();

                $("#filtertgl").show();
            }else{


              $("#readjemput").hide();
              $("#readantar").hide();

              $("#filtertgl").hide();


          }
      })

    })
</script>



