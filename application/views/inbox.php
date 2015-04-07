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
				<div class="kotak-head">KOTAK SURAT</div>
				<div class="kotak-body">
					<!-- Tiny Scroll -->
					<div class="scrollbar"><div class="track"><div class="thumb"></div></div></div>
					<div class="viewport">
						<div class="overview">
							<!-- content -->
							<table>
								<thead>
									<tr>
                                                                            <td>TANGGAL</td>
                                                                            <td>SUBJEK</td>
                                                                            <td>PESAN</td>
									</tr>
								</thead>
								<tbody>
                                                                    <?php if($rows){?>
                                                                        <?php foreach ($rows as $r){?>
                                                                            <tr>
                                                                                <td><?=format_date($r['created'],'d M Y')?></td>
                                                                                <td><?=$r['subject']?></td>
                                                                                <td class="tb_left">
                                                                                    <?=$r['message']?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php }?>
                                                                    <?php }?>
								</tbody>
							</table>
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
                        $(".kotak-body").tinyscrollbar({thumbSize:15,trackSize:100});
                    });
                }
            });
	</script>
    </body>
</html>