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
                
                <!--<div class="daun2">&nbsp;</div>
                <div class="jamu2">&nbsp;</div>
                <div class="bejo">&nbsp;</div>-->
                
                <!-- *** -->
                <div class="container-home">
                    <div class="con-img"><img src="<?=base_url().xml('dir_item').$item->file_name?>" border="0"></div>
                    <div class="con-text">
                        <!--ul class="con-menu">
                            <li><a>STEP 1</a></li>
                            <li class="border"></li>
                            <li><a>STEP 2</a></li>
                            <li class="border"></li>
                            <li><a class="active">STEP 3</a></li>
                            <li class="border"></li>
                            <li><a>STEP 4</a></li>
                        </ul-->
                        <!--p>Dompet</p-->
                        <form method="post" enctype="multipart/form-data" action="<?=  site_url('step3')?>">
                            <div class="step2-body" style="height: 263px;">
                                <p style="margin-bottom: 2px; text-align: center;">KOIN yang Konco Bejo miliki saat ini adalah</p>
                                <h3><b><?=$user->last_points?></b> Koin</h3>
                                <p style="margin-top: 5px; text-align: center;">Untuk ikut Lelang, Konco Bejo harus punya minimal 20 KOIN. Monggo membeli Bintang Toedjoe Masuk Angin pack (kemasan isi 5) di toko swalayan. Lalu masukkan Kode Transaksi yang tertulis pada struk pembelian, di sini:</p>
                                
                                <div class="dompet_save_input">
                                    <input type="text" class="input" name="code" placeholder="Masukan Kode Pembelian" value="<?=set_value('code')?>" />
                                </div>
                                <div class="dompet_save_input">
                                    <div class="fileUpload btn-upload">
                                        <span>Upload foto struk pembelian</span>
                                        <input type="file" class="upload" name="file_upload" />
                                    </div>
                                </div>
                            </div>
                            <div class="step2-button" style="margin: 20px -60px 0 -10px; width: auto; text-align: center;">
				<center>
                                <!-- a style="margin: 0;" href="<?=site_url('step2')?>"><img src="<?=base_url()?>assets/img/step3-back.png" border="0"></a -->
                                <a style="margin: 0 4px;float: none;" href="javascript:;" onclick="$('form').submit();"><img class="img-ctr" src="<?=base_url()?>assets/img/step3-submit.png" border="0"></a>
                                <!-- a style="margin: 0;" href="<?=site_url('step4')?>"><img src="<?=base_url()?>assets/img/step3-skip.png" border="0"></a -->
				</center>
                            </div>
                        </form>
                    </div>
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
            <?php if($upload == 1){?>
                <p class="success">Submit kode pembelian dan upload foto bon pembelian berhasil. Tunggu 1x24 jam hari kerja hingga admin memverifikasi Kode Transaksi.</p>
                <br>
                <center><a href="<?=site_url('dompet')?>"><img src="<?=base_url()?>assets/img/go-dompet.png" /></a></center>
            <?php } ?>
        <?php $this->load->view('inc/success_e');?>
                
        <?php $this->load->view('inc/footer');?>
                
        <script type="text/javascript">
            $('.upload').change(function(){
                $('.fileUpload span').text($(this).val());
            });
	</script>
    </body>
</html>