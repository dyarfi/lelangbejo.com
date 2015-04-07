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
                    <div class="kotak-head">DAGANGAN LAKU</div>
                    <div class="laku-bodydetail">
                        <!-- content -->
                        <div class="laku_left">
                            <div class="laku_left_tumb"><img src="<?=base_url().xml('dir_item').$item->file_name2?>" width="235" height="235" border="0"></div>
                            <div class="laku_left_bio">
                                    <div class="foto">
                                        <div class="img-area"><img src="<?=avatar($item->avatar_file)?>"></div>
                                    </div>
                                    <div class="title">
                                        <p>Pemenang</p>
                                        <h3><?=$item->user_name?></h3>
                                        <p>Harga</p>
                                        <h3>Rp. <?=number_format($item->bidding_price, 0, '', '.')?></h3>
                                    </div>
                            </div>
                            <div class="laku_left_next"><a href="<?=site_url('dagangan-laku')?>"><img src="<?=base_url()?>assets/img/kembali.png"></a></div>
                        </div>	
                        <div class="laku_right">
                            <div class="laku_right_head">
                                <h2>
                                    Periode lelang 
                                    <?php 
                                        $start_date = $item->start_date;
                                        $end_date = $item->end_date;
                                        $y1 = format_date($start_date, 'Y');
                                        $y2 = format_date($end_date, 'Y');
                                        $m1 = format_date($start_date, 'F');
                                        $m2 = format_date($end_date, 'F');
                                        $d1 = format_date($start_date, 'd');
                                        $d2 = format_date($end_date, 'd');
                                        
                                        if($y1 == $y2){
                                            if($m1 == $m1){
                                                echo $d1.' - '.$d2.' '.format_date($end_date, 'F Y');
                                            }
                                            else {
                                                echo format_date($start_date, 'd F').' - '.format_date($end_date, 'd F Y');
                                            }
                                        }
                                        else{
                                            echo format_date($start_date, 'd F Y').' - '.format_date($end_date, 'd F Y');
                                        }
                                    ?>
                                </h2>
                                <p>Rp. <?=number_format($item->price_start, 0, '', '.')?> - Rp. <?=number_format($item->price_end, 0, '', '.')?></p>
                            </div>
                            <div class="laku_right_body">
                                <div class="scrollbar"><div class="track"><div class="thumb"></div></div></div>
                                <div class="viewport">
                                    <div class="overview">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <td width="10%">&nbsp;</td>
                                                    <td width="30%">TANGGAL</td>
                                                    <td width="30%">NAMA</td>
                                                    <td width="30%">HARGA</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($rows as $i=>$r){?>
                                                    <tr>
                                                        <td class="right"><?=$i+1?>.</td>
                                                        <td><?=format_date($r['created'], 'd F Y')?></td>
                                                        <td><?=$n=(strlen($r['user_name']) > 2)?substr($r['user_name'], 0, 3):substr($r['user_name'], 0, 2)?>xxxxxx</td>
                                                        <td><?=number_format($r['price'], 0, '', '.')?></td>
                                                    </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>					
                        <!-- End content -->
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('inc/footer');?>
        <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.tinyscrollbar.js"></script>
	<script type="text/javascript">
	    $(document).ready(function(){
    	 	var width = $(window).width();
                if(width <= 800){
                }else{
                        $(document).ready(function(){
                        $(".laku_right_body").tinyscrollbar({ thumbSize:15,trackSize:100});
                    });
                }
	    });
	</script>
    </body>
</html>