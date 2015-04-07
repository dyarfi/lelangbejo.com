<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>

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
                            <li><a>STEP 2</a></li>
                            <li class="border"></li>
                            <li><a>STEP 3</a></li>
                            <li class="border"></li>
                            <li><a class="active">STEP 4</a></li>
                        </ul>
                        <p>Lelang</p>
                        <form method="post">
                            <div class="step4-body">
                                <div class="kirim-barang">
                                    <a href="javascript:;" class="popup" data="1" data-id="1"><img src="<?=base_url()?>assets/img/detail-barang.png" border="0"></a>
                                    <a href="javascript:;" class="popup" data="1" data-id="2"><img src="<?=base_url()?>assets/img/pengiriman.png" border="0"></a>
                                </div>
                                <p>Monggo masukkan harga yang ingin Konco Bejo bayarkan untuk membeli <?=$item->name?></p>
                                <div class="dompet_save_input">
                                    Rp. <input class="input" type="text" name="price" required value="<?=set_value('price')?>" />
                                </div>
                            </div>
                            <div class="step2-button">
                                <input class="step3-submit" type="submit" value="&nbsp;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
	</div>
        
        <!-- Pop Up -->
        <div id="grayBG" class="grayBox"></div> 
        <div id="LightBox1" class="box_content"> 
            <div class="box_in"> 
                <div class="close popup" data="2" data-id="1">X</div>
                <div class="title">DETAI BARANG</div>
                <div class="text">
                    <?=nl2br($item->detail)?>
                </div>
            </div> 
        </div>

        <div id="LightBox2" class="box_content"> 
            <div class="box_in"> 
                <div class="close popup" data="2" data-id="2">X</div>
                <div class="title">PENGIRIMAN</div>
                <div class="text">
                    <?=nl2br($item->delivery)?>
                </div>
            </div> 
        </div>
        
        <!-- Pop Up Error -->
        <?php $this->load->view('inc/error_s');?>
            <?php if(isset($error)){?>
                <p class="error"><?=$error?></p>
            <?php } ?>
            <?php echo validation_errors();?>
        <?php $this->load->view('inc/error_e');?>
       
        <!-- Pop Up Success -->
        <?php $this->load->view('inc/success_s');?>
            <?php if(isset($success)){?>
                <p class="success">
		    <img class="img-responsive" src="<?=base_url()?>assets/img/harga-berhasil.png" alt="input harga berhasil">
		</p>
            <?php } ?>
        <?php $this->load->view('inc/success_e');?>

        <?php $this->load->view('inc/footer');?>
        
        <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.tinyscrollbar.js"></script>
	<script type="text/javascript">
	    $(document).ready(function(){
	    	$(".step2-body").tinyscrollbar({thumbSize:15,trackSize:230});
	    });
            
            $(function(){
                $('.popup').click(function(){
                    var id = $(this).attr('data-id');
                    if($(this).attr('data') == '1'){
                        $("#LightBox"+id).show();
                        $("#grayBG").show(); 
                    }else{
                        $("#LightBox"+id).hide();
                        $("#grayBG").hide(); 
                    }
                });
            })
	</script>
    </body>
</html>