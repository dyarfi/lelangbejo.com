<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
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
					<a class="menu-mekanisme" href="<?=site_url('mekanisme-lelang')?>">MEKANISME LELANG</a>
					<a class="menu-mekanisme active" href="<?=site_url('mekanisme-koin')?>">MEKANISME KOIN</a>
				</div>
				<div class="mekanisme-body">
					<!-- Tiny Scroll -->
					<div class="scrollbar"><div class="track"><div class="thumb"></div></div></div>
					<div class="viewport">
						<div class="overview">
							<!-- content -->
							<h4>Monggo dibaca untuk mengetahui ketentuan seputar KOIN:</h4>
                                                        <ul style="list-style-type: decimal;">                                                     
                                                            <li>Koin adalah alat yang Konco Bejo butuhkan untuk melakukan lelang dalam LELANG BEJO</li>
                                                            <li>Konco Bejo membutuhkan 20 KOIN setiap akan melakukan lelang (menuliskan harga yang ingin dibayar untuk mendapatkan barang)</li>
                                                            <li>Terdapat 2 cara untuk mengumpulkan KOIN
                                                                <ul style="list-style-type:lower-alpha;">
                                                                    <li><b>BELI PRODUK</b>
                                                                        <ul style="list-style-type:disc;">
                                                                            <li>Beli Bintang Toedjoe Masuk Angin di toko swalayan terdekat</li>
                                                                            <li>Masukkan Kode Transaksi yang ada di struk pembelian dan upload foto struk yang telah ditandai pada bagian pembelian BIntang Toedjoe Masuk Angin di website ini</li>
                                                                            <li>Konco Bejo akan mendapatkan 3 KOIN pada setiap pembelian 1 sachet BIntang Toedjoe Masuk Angin</li>
                                                                            <li>Makin buanyak Bintang Toedjoe Masuk Angin yang Konco Bejo beli, maka makin banyak KOIN yang terkumpul dan bisa digunakan untuk melakukan Lelang Bejo</li>
                                                                            <li>Peserta Lelang Bejo hanya bisa share ke social media 1x dalam 1 hari</li>
                                                                        </ul>
                                                                    <li><b>SHARE</b>
                                                                        <ul style="list-style-type:disc;">
                                                                            <li>Share tentang LELANG BEJO di Facebook dan Twitter untuk mendapatkan masing-masing 1 koin</li>
                                                                            <li>Invite 10 teman kamu untuk ikutan LELANG BEJO di Facebook untuk mendapatkan tambahan koin</li>
                                                                            <li>Konco Bejo hanya bisa Share dan Invite 1 kali dalam satu hari</li>
                                                                            <li>Tombol Share dan Invite dapat Konco Bejo temukan pada bagian Dompet</li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
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