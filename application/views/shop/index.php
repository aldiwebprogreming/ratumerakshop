SLIDER
------------------------------------------->
<section class="slider-section pt-4 pb-4">
    <div class="container">
        <div class="slider-inner">
            <div class="row">
                <div class="col-md-3">
                    <nav class="nav-category">
                        <h2>Categories</h2>
                        <ul class="menu-category">
                            <li><a href="<?= base_url('shop/produk/premium-rice') ?>">Premium Rice</a></li>
                            <li><a href="<?= base_url('shop/produk/medium-rice') ?>">Medium Rice</a></li>
                            <li><a href="<?= base_url('shop/produk/healthy-rice') ?>">Healthy Rice</a></li>
                            <li><a href="<?= base_url('shop/produk/glutinous-rice') ?>">Glutinous Rice</a></li>
                            <li><a href="<?= base_url('shop/produk/spesial-promo-product') ?>">Spesial Promo Product</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-9">
                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner shadow-sm rounded">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="<?= base_url('') ?>/assets/img/slides/slidebaru1.png" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                   <!--  <h5>Mountains, Nature Collection</h5> -->
                               </div>
                           </div>
                           <div class="carousel-item">
                            <img class="d-block w-100" src="<?= base_url('') ?>/assets/img/slides/slidebaru2.png" alt="Second slide">
                            <div class="carousel-caption d-none d-md-block">
                               <!--  <h5>Freedom, Sea Collection</h5> -->
                           </div>
                       </div>
                       <div class="carousel-item">
                        <img class="d-block w-100" src="<?= base_url('') ?>/assets/img/slides/slidebaru3.png" alt="Third slide">
                        <div class="carousel-caption d-none d-md-block">
                            <!-- <h5>Living the Dream, Lost Island</h5> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Slider -->
        </div>
    </div>
</div>
</div>
</section>

<!-- Services -->
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="media">
                    <div class="iconbox iconmedium rounded-circle text-info mr-4">
                        <i class="fa fa-truck"></i>
                    </div>
                    <div class="media-body">
                        <h5>Fast Shipping</h5>
                        <p class="text-muted">
                            All you have to do is to bring your passion. We take care of the rest.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="iconbox iconmedium rounded-circle text-purple mr-4">
                        <i class="fa fa-credit-card-alt"></i>
                    </div>
                    <div class="media-body">
                        <h5>Online Payment</h5>
                        <p class="text-muted">
                            All you have to do is to bring your passion. We take care of the rest.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="iconbox iconmedium rounded-circle text-warning mr-4">
                        <i class="fa fa-refresh"></i>
                    </div>
                    <div class="media-body">
                        <h5>Free Return</h5>
                        <p class="text-muted">
                            All you have to do is to bring your passion. We take care of the rest.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Services -->
<section class="products-grids trending pb-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title float-left">
                    <h2>Product</h2>
                </div>

                <div class="section-title float-right">
                    <a href="" class="btn btn-primary btn-sm">See all products <i class="fa fa-list"></i></a>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <?php foreach ($produk as $data) { ?>
                <div class="col-xl-3 col-lg-4 col-md-4 col-6 mb-2">
                    <div class="single-product">
                        <div class="product-img">
                            <center>
                                <a href="<?= base_url('shop/detail/') ?><?= $data['kode_produk'] ?>">
                                    <img src="<?= base_url('') ?>/assets/img/products/<?= $data['gambar'] ?>" class="img-fluid" />
                                </a>
                            </center>
                        </div>
                        <div class="product-content">
                           <p class="text-center"><?= $data['nama_produk'] ?></p>
                           <center>
                            <small><i><?= $data['nama_kategori'] ?></i></small>
                        </center>
                        <div class="product-price">
                            <center>
                                <form method="post" class="form-user">  
                                    <span><?= "Rp " . number_format($data['harga'],0,',','.'); ?></span><br>
                                    <p>Qty : <select id="qty<?= $data['kode_produk'] ?>">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select></p>
                                    <input type="hidden" name="nama_produk" id="nama_produk<?= $data['kode_produk'] ?>" value="<?= $data['nama_produk'] ?>">
                                    <input type="hidden" name="nama_kategori" id="nama_kategori<?= $data['kode_produk'] ?>" value="<?= $data['nama_kategori'] ?>">
                                    <input type="hidden" name="harga" id="harga<?= $data['kode_produk'] ?>" value="<?= $data['harga'] ?>">
                                </form>
                                <button type="button" id="addcart<?= $data['kode_produk'] ?>" class="btn btn-primary btn-sm btn-block addcart" data-toggle="modal" data-target="#exampleModal<?= $data['kode_produk'] ?>">
                                    Add to cart
                                </button>
                            </center>



                        </div>
                    </div>
                </div>
            </div>



            <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

            <script>
                $(document).ready(function(){

                    $("#addcart<?= $data['kode_produk'] ?>").click(function(){

                        var qty1 = $("#qty<?= $data['kode_produk'] ?>").val();
                        var kode_produk1 = "<?= $data['kode_produk'] ?>";
                        var nama_produk1 = $("#nama_produk<?= $data['kode_produk'] ?>").val();
                        var nama_kategori1 = $("#nama_kategori<?= $data['kode_produk'] ?>").val();
                        var harga1 = $("#harga<?= $data['kode_produk'] ?>").val();

                        var url = "<?= base_url('shop/cart?kode_produk=') ?>"+kode_produk1+"&harga="+harga1+"&qty="+qty1;
                        var url2 = "<?= base_url('shop/cart2') ?>";
                        $("#tampil_data").load(url);
                        $("#tampil_data_footer").load(url2);


                    })


                })
            </script>

        <?php } ?>



    </div>
</div>

<!-- <div class="tampil_data">

    ere

</div>
-->


</section>
<script src="https://cdn.jsdelivr.net/npm/vue@2.7.8/dist/vue.js"></script>

<script>
    $(function() {
        var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
      });

        $('.addcart').click(function() {
          Toast.fire({
            icon: 'success',
            title: 'Produk berhasil masuk kekeranjang'
        })
      });

    });
</script>
</script>





