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
                        <!--ul class="con-menu">
                            <li><a class="active">STEP 1</a></li>
                            <li class="border"></li>
                            <li><a>STEP 2</a></li>
                            <li class="border"></li>
                            <li><a>STEP 3</a></li>
                            <li class="border"></li>
                            <li><a>STEP 4</a></li>
                        </ul-->
                        <p>Sebelum memulai berpartisipasi dalam <br>LELANG BEJO, monggo isi data diri berikut</p>
                        <form method="post" enctype="multipart/form-data">
                            <table class="con-input">
                                <tr>
                                    <td>NAMA</td>
                                    <td>:</td>
                                    <td><input type="text" name="name" required value="<?=set_value('name',$user->name)?>" /></td>
                                </tr>
                                <tr>
                                    <td>EMAIL</td>
                                    <td>:</td>
                                    <td><input type="email" name="email" required value="<?=set_value('email',$user->email)?>" /></td>
                                </tr>
                                <tr>
                                    <td>NO. TELP</td>
                                    <td>:</td>
                                    <td><input type="text" name="phone" required value="<?=set_value('phone',$user->phone)?>" /></td>
                                </tr>
                                <tr>
                                    <td>ALAMAT</td>
                                    <td>:</td>
                                    <td><input type="text" name="address" required value="<?=set_value('address',$user->address)?>" /></td>
                                </tr>
                                <tr>
                                    <td>UNGGAH FOTO <img style="height: 16px; border: 1px solid #604f00;" src="<?=avatar($user->avatar_file)?>"/></td>
                                    <td>:</td>
                                    <td>
                                        <div class="form">
                                            <input type="text" id="path" />
                                            <label class="add-photo-btn">
                                                Browse
                                                <span><input type="file" id="myfile" name="file_upload" /></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align:center;padding-top:20px;">
                                        <input class="con-lanjut" type="submit" value="LANJUT">
                                    </td>
                                </tr>
                            </table>
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
        
        <?php $this->load->view('inc/footer');?>
        
        <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.tinyscrollbar.js"></script>
	<script type="text/javascript">
	    $('#myfile').change(function(){
                $('#path').val($(this).val());
            });
	</script>
    </body>
</html>