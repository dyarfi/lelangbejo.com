<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
         <style type="text/css">
            .row{
                margin-bottom: 0;
            }
            .row a{
               color: #dc4e4e;
            }
        </style>
    </head>
    <body>
        
        <?php $this->load->view('inc/menu');?>
        
        <div id="body">
            
            <?php $this->load->view('inc/menu_mobile');?>
            
		<div class="bendera1">&nbsp;</div>
		<div class="main">
			<!-- *** -->
			<div class="pencil">&nbsp;</div>
			<div class="jamu">&nbsp;</div>
			<div class="daun">&nbsp;</div>
			<div class="bendera2">&nbsp;</div>
			<div class="bendera3">&nbsp;</div>
			<!-- *** -->

			<div class="container">
				<div class="kotak-head">
					<a class="menu-mekanisme active" href="<?=site_url('mekanisme-lelang')?>">MEKANISME LELANG</a>
					<a class="menu-mekanisme" href="<?=site_url('mekanisme-koin')?>">MEKANISME KOIN</a>
				</div>
				<div class="mekanisme-body">
					<!-- Tiny Scroll -->
					<div class="scrollbar"><div class="track"><div class="thumb"></div></div></div>
					<div class="viewport">
						<div class="overview">
							<!-- Content -->
							<h4>Monggo dibaca dulu supaya ndak salah langkah pas ikutan LELANG BEJO:</h4>
							<div class="row">
                                                            <div class="thumb-lelang">
                                                                <img src="<?=base_url()?>assets/img/mekanisme/1.png" border="0">
                                                                <p>Like fan page Mas Bejo di Facebook dan follow akun Twitter resmi Bintang Toedjoe Masuk Angin <strong>@KoncoBejo</strong></p>
                                                            </div>
                                                            <div class="thumb-lelang">
                                                                <img src="<?=base_url()?>assets/img/mekanisme/2.png" border="0">
                                                                <p>Isi data diri sesuai dengan kartu identitas Konco Bejo yang berlaku</p>
                                                            </div>
                                                            <div class="thumb-lelang">
                                                                <img src="<?=base_url()?>assets/img/mekanisme/3.png" border="0">
                                                                <p>Konco Bejo bisa menuliskan harga yang ingin dibayar untuk membeli barang lelang sesuai dalam rentang harga yang ditentukan (Rp. 1 - Rp. 500.000)</p>
                                                            </div>
                                                            <div class="clear"></div>
							</div>
							<div class="row">
                                                            <div class="thumb-lelang">
                                                                <img src="<?=base_url()?>assets/img/mekanisme/4.png" border="0">
                                                                <p>Jika harga yang Konco Bejo tulis ndak ada yang menyamai serta menjadi harga yang paling rendah, maka Konco Bejo bisa mendapatkan barang yang sedang dilelang sesuai dengan harga yang ditulis sebelumnya.</p>
                                                            </div>
                                                            <div class="thumb-lelang">
                                                                <img src="<?=base_url()?>assets/img/mekanisme/5.png" border="0">
                                                                <p>Untuk bisa ikutan lelang, Konco Bejo harus menggunakan <strong>20 KOIN</strong>.</p>
                                                            </div>
                                                            <div class="thumb-lelang">
                                                                <img src="<?=base_url()?>assets/img/mekanisme/6.png" border="0">
                                                                <p>Konco Bejo bisa berpartisipasi lebih dari 1 kali, selama KOIN yang dimiliki masih mencukupi <br><a href="<?=site_url('mekanisme-koin')?>">(cara mendapatkan koin baca di sini)</a></p>
                                                            </div>
                                                            <div class="clear"></div>
							</div>
                                                        <div class="row">
                                                            <div class="thumb-lelang">
                                                                <img src="<?=base_url()?>assets/img/mekanisme/7.png" border="0">
                                                                <p>Pemenang utama dapat membeli barang yang dilelang sesuai dengan harga yang ia tuliskan</p>
                                                            </div>
                                                            <div class="thumb-lelang">
                                                                <img src="<?=base_url()?>assets/img/mekanisme/8.png" border="0">
                                                                <p>75 peserta yang bejo berkesempatan mendapatkan voucher pulsa senilai Rp. 25.000</p>
                                                            </div>
                                                            <div class="thumb-lelang">
                                                                <img src="<?=base_url()?>assets/img/mekanisme/9.png" border="0">
                                                                <p>Periode lelang Laptop HP 240 G3 9PA berlangsung mulai 23 Desember – 23 Januari 2014</p>
                                                            </div>
                                                            <div class="clear"></div>
							</div>
                                                        <div class="row">
                                                            <div class="thumb-lelang">
                                                                <img src="<?=base_url()?>assets/img/mekanisme/10.png" border="0">
                                                                <p>Pemenang akan diumumkan di website ini pada tanggal 28 Januari 2014</p>
                                                            </div>
                                                            <div class="thumb-lelang">
                                                                <img src="<?=base_url()?>assets/img/mekanisme/11.png" border="0">
                                                                <p>Pemenang akan langsung dihubungi oleh pihak Bintang Toedjoe Masuk Angin</p>
                                                            </div>
                                                            <div class="thumb-lelang">
                                                                <img src="<?=base_url()?>assets/img/mekanisme/12.png" border="0">
                                                                <p>Selain membeli produk Bintang Toedjo Masuk Angin dan membeli barang yang dilelang dengan harga yang telah dituliskan sebelumnya, peserta lelang tidak akan dipungut biaya lain lagi</p>
                                                            </div>
                                                            <div class="clear"></div>
							</div>
							<!-- end Content -->
						</div>
					</div>
					<!-- end Tiny Scroll -->
				</div>
			</div>
		</div>
	</div>
               
        <?php $this->load->view('inc/footer');?>
                
        <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.tinyscrollbar.js"></script>
	<script type="text/javascript">
	    $(window).load(function(){
                    var width = $(window).width();
                    if(width <= 800){
                    }else{
                            $(document).ready(function(){
                            $(".mekanisme-body").tinyscrollbar({thumbSize:15,trackSize:100});
                        });
                    }
            });
	</script>
    </body>
</html>