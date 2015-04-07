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
                            SHARE OR INVITE VIA FACEBOOK
                        </div>
                        <p style="padding: 0 20px; margin: 0;">
                            Kamu bisa mendapatkan KOIN dengan SHARE LELANG BEJO di Facebook-mu atau INVITE teman-teman Facebookmu untuk ikutan
                        </p>
                        
                        <div class="dompet-body">
                            <!-- content -->
                            <div class="dompet_left">
                                <div class="dompet_social">
                                    <p>SHARE LELANG BEJO ke wall Facebook kamu dan dapatkan tambahan 1 POIN*</p>
                                    <p align="center"><a href="<?=site_url('facebook/share')?>"><img src="<?=base_url()?>assets/img/fb.png" border="0"></a></p>
                                    <p style="font-size: 12px;color:red;">*Kamu hanya bisa melakukan SHARE Facebook <br>maksimal 1 kali setiap harinya</p>
                                </div>
                            </div>	
                            <div class="dompet_right">
                                <div class="scrollbar"><div class="track"><div class="thumb"></div></div></div>
                                <div class="viewport">
                                    <div class="overview">
                                        <form id="invite-form" action="<?=site_url('facebook/invite')?>">
                                            <p>INVITE teman kamu untuk ikut bermain di LELANG BEJO dan dapatkan tambahan 1 POIN untuk setiap teman yang kamu ajak*</p>
                                            <p><input type="button" class="invite" value="INVITE"/></p>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <td>FACEBOOK FRIENDS</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if($rows){?>
                                                        <?php foreach ($rows as $r){?>
                                                            <tr>
                                                                <td>
                                                                    <label class="facebook-friend">
                                                                        <input type="checkbox" value="<?=$r['facebook_id']?>" name="facebook_id[]" <?=$d=($r['invited'])?'disabled':''?> />
                                                                        <?=$r['facebook_name']?> [<a href="https://www.facebook.com/profile.php?id=<?=$r['facebook_id']?>" title="Facebook Profile" target="_blank">facebook profile</a>]
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                        <?php }?>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>					
                            <!-- End content -->
                        </div>
                    </div>
            </div>
        </div>
        
        <!-- Pop Up Error -->
        <?php $this->load->view('inc/error_s');?>
            <?php if(!empty($err)){?>
                <p class="error"><?=$err?></p>
            <?php }?>
        <?php $this->load->view('inc/error_e');?>
                
        <!-- Pop Up Success -->
        <?php $this->load->view('inc/success_s');?>
            <?php if(!empty($success)){?>
                <p class="success">POIN kamu bertambah <?=$success?>. Cek total POIN kamu di DOMPET.</p>
                <br>
                <center><a href="<?=site_url('dompet')?>"><img src="<?=base_url()?>assets/img/go-dompet.png" /></a></center>
            <?php } ?>
        <?php $this->load->view('inc/success_e');?>
        
        <?php $this->load->view('inc/footer');?>
        <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.tinyscrollbar.js"></script>
	<script type="text/javascript">
	    $(document).ready(function(){
                $('input.invite').click(function(){
                    $('#LightBoxError .title').html('PENTING!');
                    $('#LightBoxError .text').html('<p class="success">Kamu akan mengundang temanmu untuk ikut serta dalam LELANG BEJO</p><br><center><a class="invite" style="display: block;height: 20px;padding: 10px 0;text-decoration: none;" href="javascript:;" onClick="submitForm();">OK</a></center>');
                    
                    $("#LightBoxError").show();
                    $("#grayBGError").show(); 
                });
                
                setScrollBar();
                setTimeout(function(){setScrollBar()}, 500);
                setTimeout(function(){setScrollBar()}, 1000);
                setTimeout(function(){setScrollBar()}, 2000);
                setTimeout(function(){setScrollBar()}, 3000);
                setTimeout(function(){setScrollBar()}, 4000);
                setTimeout(function(){setScrollBar()}, 5000);
	    });
            function submitForm()
            {
                $('#invite-form').submit();
            }
            function setScrollBar(){
                $(".dompet_right").tinyscrollbar({ thumbSize:15,trackSize:100});
            }
	</script>
    </body>
</html>