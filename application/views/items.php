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
                    <div class="kotak-head">DAGANGAN LAKU <font size="3"> Berikut ini adalah barang-barang yang telah laku dilelang</font></div>
                    <div class="laku-body">
                        <!-- Tiny Scroll -->
                        <div class="scrollbar"><div class="track"><div class="thumb"></div></div></div>
                        <div class="viewport">
                                <div class="overview" style="width:<?=$w=($rows)? ((255 * count($rows))+50) : 255?>px;">
                                
                                <?php if($rows){?>
                                    <?php foreach ($rows as $r){?>
                                        <div class="laku_content">
                                            <a href="<?=site_url('detail-dagangan-laku/'.$r['id'].'/'. url_title(strtolower($r['name'])))?>">
                                                <div class="laku_thumb">
                                                    <img src="<?=base_url().xml('dir_item').$r['file_name2']?>" width="235" height="235" border="0">
                                                    <img class="terjual" src="<?=base_url()?>assets/img/terjual.png" border="0">
                                                </div>
                                            </a>
                                            <div class="laku_info">
                                                <p>Pemenang</p>
                                                <h2><?=$r['user_name']?></h2>
                                                <p>Harga</p>
                                                <h2>Rp. <?=number_format($r['bidding_price'], 0, '', '.')?></h2>
                                            </div>
                                        </div>
                                    <?php }?>
                                <?php }?>
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
	    $(document).ready(function(){
    	 	$(".laku-body").tinyscrollbar({ thumbSize:15,trackSize:100,axis:"x"});
	    });
	</script>
    </body>
</html>