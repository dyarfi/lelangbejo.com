<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
    </head>

    <body>
        
        <?php $this->load->view('inc/menu');?>
        
        <div id="body-home">
            
            <?php $this->load->view('inc/menu_mobile');?>
            
            <div class="dus">&nbsp;</div>
            <div class="main-home">
                <!-- *** -->
                <!--<div class="daun2">&nbsp;</div>-->
                <div class="jamu2">&nbsp;</div>
                <div class="bejo">&nbsp;</div>
                <!-- *** -->
                <div class="container-home">
                    <div class="con-img"><img src="<?=base_url().xml('dir_item').$item->file_name?>" border="0"></div>
                    <div class="con-text">
                        <ul class="con-menu">
                            <li><a>STEP 1</a></li>
                            <li class="border"></li>
                            <li><a class="active">STEP 2</a></li>
                            <li class="border"></li>
                            <li><a>STEP 3</a></li>
                            <li class="border"></li>
                            <li><a>STEP 4</a></li>
                        </ul>
                        <p>Cara Ikutan</p>
                        <div class="step2-body">
                            <div class="scrollbar"><div class="track"><div class="thumb"></div></div></div>
                            <div class="viewport" style="right:30px;">
                                <div class="overview">
                                    <div class="row">
                                        <div class="thumb-lelang">
                                            <img src="<?=base_url()?>assets/img/step2/1.png" border="0">
                                            <p>Beli produk Bintang Toedjoe Masuk Angin di toko swalayan terdekat untuk mendapatkan kode transaksi</p>
                                        </div>
                                        <div class="thumb-lelang">
                                            <img src="<?=base_url()?>assets/img/step2/2.png" border="0">
                                            <p>Tandai struk pada bagian kode transaksi dan bagian pembelian Bintang Toedjoe Masuk Angin</p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="row">
                                        <div class="thumb-lelang">
                                            <img src="<?=base_url()?>assets/img/step2/3.png" border="0">
                                            <p>Foto struk pembelian lalu upload pada tempat yang telah disediakan</p>
                                        </div>
                                        <div class="thumb-lelang">
                                            <img src="<?=base_url()?>assets/img/step2/4.png" border="0">
                                            <p>Masukkan kode transaksi pada tempat yang telah disediakan</p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="row">
                                        <div class="thumb-lelang">
                                            <img src="<?=base_url()?>assets/img/step2/5.png" border="0">
                                            <p>Tunggu 1x24 jam hari kerja hingga admin memverifikasi kode transaksi</p>
                                        </div>
                                        <div class="thumb-lelang">
                                            <img src="<?=base_url()?>assets/img/step2/6.png" border="0">
                                            <p>Setelah diverifikasi, Konco Bejo akan mendapatkan KOIN yang dapat dilihat pada bagian Dompet</p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="row">
                                        <div class="thumb-lelang">
                                            <img src="<?=base_url()?>assets/img/step2/7.png" border="0">
                                            <p>Untuk mengikuti 1 kali lelang, Konco Bejo membutuhkan 20 KOIN</p>
                                        </div>
                                        <div class="thumb-lelang">
                                            <img src="<?=base_url()?>assets/img/step2/8.png" border="0">
                                            <p>MULAI LELANG : Tulis harga yang Konco Bejo inginkan mulai dari Rp1 – Rp500.000</p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="row">
                                        <div class="thumb-lelang">
                                            <img src="<?=base_url()?>assets/img/step2/9.png" border="0">
                                            <p>Kalau harga yang Konco Bejo tulis adalah harga termurah dan ndak ada yang menyamai, Konco Bejo berhak membeli barang sesuai dengan harga tersebut. Muantep...</p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="step2-button">
                            <a href="<?=site_url('step1')?>"><img src="<?=base_url()?>assets/img/kem.png" border="0"></a>
                            <a href="<?=site_url('step3')?>"><img src="<?=base_url()?>assets/img/lan.png" border="0"></a>
                        </div>
                    </div>
                </div>
            </div>
	</div>
        
        <?php $this->load->view('inc/footer');?>
        
        <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.tinyscrollbar.js"></script>
	<script type="text/javascript">
	    $(document).ready(function(){
	    	setScrollBar();
                setTimeout(function(){setScrollBar()}, 500);
                setTimeout(function(){setScrollBar()}, 1000);
                setTimeout(function(){setScrollBar()}, 2000);
                setTimeout(function(){setScrollBar()}, 3000);
                setTimeout(function(){setScrollBar()}, 4000);
                setTimeout(function(){setScrollBar()}, 5000);
	    });
            function setScrollBar(){
                $(".step2-body").tinyscrollbar({thumbSize:15,trackSize:230});
            }
	</script>
    </body>
</html>