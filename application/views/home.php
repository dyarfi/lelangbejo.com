<?php 
//$this->session->sess_destroy();
//print_r(is_membership());
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
    </head>

    <body>
        
        <?php $this->load->view('inc/menu');?>
        
        <div id="body-home">
            
            <?php $this->load->view('inc/menu_mobile');?>
            
		<?php 
                    //print_r($item);
                ?>
                
		<div class="main-home">
			<!-- *** -->
			<!--<div class="daun2">&nbsp;</div>-->
			<div class="jamu2">&nbsp;</div>
			<!--<div class="bejo">&nbsp;</div>
                        <div class="dus">&nbsp;</div>-->
			<!-- *** -->
			<div class="container-home">
				<div class="con-img"><img src="<?=base_url().xml('dir_item').$item->file_name?>"></div>
				<div class="con-text">
                                    
                                    <?php if($item->is_finish){?>
                                        <h1>SELAMAT<br><?=$item->user_name?></h1>
                                        <br>
                                        <h2>
                                            Sudah berhasil membeli <?=$item->name?> hanya harga Rp.<?=number_format($item->bidding_price, 0, '', '.')?> di Lelang Bejo.
                                        </h2>
                                        <br>
                                        <p>Konco Bejo yang lainnya, ayo uji kebejoanmu di Lelang Bejo selanjutnya!</p>
                                    <?php }else{?>
                                        <h1><?=nl2br($item->headline)?></h1>
                                        <p><?=nl2br($item->body)?></p>
										
                                        <div class="input-harga-form">
                                            <form id="form-bidding" role="form" action="<?php echo base_url();?>step4" method="GET" autocomplete="off">
                                                <div class="form-group form-group-harga">
                                                    <input type="text" name="price" id="price" value="" maxlength="14" class="form-control input-harga" placeholder="masukan nilai bejomu">
												</div>
                                                <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block masukin-harga" value="">
												<div class="msg"></div>
											</form>
                                        </div>
										
										<?php			
										/*										
                                        <h3>Sisa waktu untuk ikutan lelang</h3>
											<?php if($is_item_active){?>
											<h2>
												<?php
													$total_day = difference($item->end_date,'d');
													$month = difference($item->end_date,'m');
													if($month > 0){
														$total_day += 30 * $month;
													}
												?>
												<b><?=$total_day?></b> <i>HARI</i> / 
												<b><?=difference($item->end_date,'h')?></b> <i>JAM</i> / 
												<b><?=difference($item->end_date,'i')?></b> <i>MENIT</i>
											</h2>
											<?=difference($item->end_date,'m')?> - 
											<?=difference($item->end_date,'d')?> - 
											<?=difference($item->end_date,'h')?> - 
											<?=difference($item->end_date,'i')?> - 											
											<?php } else { ?>
												<h2>LELANG BELUM DIMULAI</h2>
											<?php } ?>
										*/
										?>
										
										
										<?php }?>
									
                                    <?php if(is_membership()){?>
                                        <?php if(!$item->is_finish && $is_item_active){?>
                                            <p><a href="<?=site_url('step1')?>"><img src="<?=base_url()?>assets/img/lan.png" border="0"></a></p>
                                        <?php }?>
                                    <?php } else { ?>
                                        <!--p><a href="<?=site_url('facebook/auth')?>?url=home"><img src="<?=base_url()?>assets/img/connect.png" border="0"></a></p-->
                                    <?php } ?>
				</div>
			</div>
		</div>
	</div>
        <?php $this->load->view('inc/footer');?>
    </body>
</html>