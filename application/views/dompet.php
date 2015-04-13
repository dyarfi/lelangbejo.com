<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
    </head>

    <body>
        <?php $this->load->view('inc/menu');?>
        
        
            
            <?php $this->load->view('inc/menu_mobile');?>
        <div class="main-home">
                    <!-- *** 
                    <div class="pencil">&nbsp;</div>
                    <div class="jamu">&nbsp;</div>
                    <div class="daun">&nbsp;</div>
                    <div class="bendera2">&nbsp;</div>
                    <div class="bendera3">&nbsp;</div>
                    *** -->

                    <div class="container">
                        <div class="dompet-body">
                            <!-- content -->
                            <div class="dompet_left">
                                <form method="post" action="<?=site_url('dompet')?>" enctype="multipart/form-data">
                                    <div class="dompet_save">
                                        <p class="big3">Biar bisa ikutan lelang, monggo tambah koin Konco Bejo dengan submit struk bukti pembelian B7MA di sini. </p>
                                        <div class="dompet_save_input">
                                            <input class="input" type="text" name="code" value="<?=set_value('code')?>" placeholder="Masukan Kode Pembelian" />
                                        </div>
                                        <div class="dompet_save_input">
                                            <div class="fileUpload btn-upload">
                                                <span>Upload foto struk pembelian</span>
                                                <input type="file" class="upload" name="file_upload" />
                                            </div>
                                        </div>
                                        <p style="margin: 0;"><input class="submit" type="submit" value="SUBMIT"></p>
                                    </div>
                                </form>
                                <div class="dompet_social">
                                    <p>Konco Bejo bisa mendapatkan KOIN dengan <b>SHARE</b> LELANG BEJO ke teman-teman lewat sini</p>
                                    <ul>
                                        <li><a href="<?=site_url('facebook/friend')?>"><img src="<?=base_url()?>assets/img/fb.png" border="0"></a></li>
                                        <li><a href="<?=site_url('twitter/share')?>"><img src="<?=base_url()?>assets/img/twit.png" border="0"></a></li>
                                    </ul>
                                </div>
                            </div>	
                            <div class="dompet_right">
                                <h1 class="superbig">DOMPET</h1>
                                <div class="dompet_koin">
                                    <p class="big3">Jumlah KOIN Konco Bejo saat ini adalah</p>
                                    <h2 class="big2"><?=$user->last_points?></h2>
                                    <h3 class="big1">Koin</h3>
                                    <img class="img-ctr img-responsive" src="<?=base_url()?>assets/img/koin-gede.png" border="0">
                                </div>
                                <!--div class="scrollbar"><div class="track"><div class="thumb"></div></div></div>
                                <div class="viewport">
                                    <div class="overview">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <td>TANGGAL</td>
                                                    <td>DESKRIPSI</td>
                                                    <td>DEBIT</td>
                                                    <td>KREDIT</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if($rows){
                                                    krsort($rows);
                                                ?>
                                                    <?php foreach ($rows as $r){?>
                                                        <tr>
                                                            <td><?=format_date($r['created'],'d M Y')?></td>
                                                            <td><?=$r['description']?></td>
                                                            <td><?=$d=($r['is_credit'])?'-':$r['point']?></td>
                                                            <td><?=$d=($r['is_credit'])?$r['point']:'-'?></td>
                                                        </tr>
                                                    <?php }?>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div-->
                            </div>					
                            <!-- End content -->
                        </div>
                    </div>
            </div>
        <div class="choco-bg"></div>
        
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
                <p class="success">POIN kamu bertambah <?=$success?>. Cek total POIN kamu di DOMPET.</p>
                <br>
                <center><a href="<?=site_url('dompet')?>"><img src="<?=base_url()?>assets/img/go-dompet.png" /></a></center>
            <?php } ?>
            <?php if($upload == 1){?>
                <p class="success"><br/>Submit kode pembelian dan upload foto bon pembelian berhasil.<br/>Tunggu 1x24 jam hari kerja hingga admin memverifikasi Kode Transaksi.</p>
                <br>
                <center><a href="<?=site_url('dompet')?>"><img src="<?=base_url()?>assets/img/go-dompet.png" /></a></center>
            <?php } ?>
        <?php $this->load->view('inc/success_e');?>
                
        <?php $this->load->view('inc/footer');?>
        
        <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.tinyscrollbar.js"></script>
	<script type="text/javascript">
            $('.upload').change(function(){
                $('.fileUpload span').text($(this).val());
            });
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
                $(".dompet_right").tinyscrollbar({ thumbSize:15,trackSize:100});
            }
	</script>
    </body>
</html>