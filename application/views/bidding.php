<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/expand.css"/>
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
				<div class="kotak-head">CATATAN BELAJA <font size="3">Ini adalah catatan belanja yang pernah Konco Bejo lakukan hingga saat ini:</font></div>
				<div class="belanja-body">
					<!-- Tiny Scroll -->
					<div class="con-head"></div>
					<div class="scrollbar"><div class="track"><div class="thumb"></div></div></div>
					<div class="viewport">
						<div class="overview">
							<!-- content -->
							<!--expad-->

							<div id="wrapper">  
								  <div class="demo">
                                                                    <?php if($rows){?>
                                                                        <?php foreach ($rows as $r){?>
                                                                            <div class="expand">
                                                                                <?=$r['name']?>
                                                                            </div>
                                                                            <div class="collapse">
                                                                                <div class="collapse_text">
                                                                                    <table>
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <td></td>
                                                                                                <td>TANGGAL</td>
                                                                                                <td>HARGA</td>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php foreach ($r['data'] as $i=>$rs){?>
                                                                                                <tr>
                                                                                                    <td><?=$i+1?>.</td>
                                                                                                    <td><?=format_date($rs['created'],'d M Y')?></td>
                                                                                                    <td><?= number_format($rs['price'],0,'','.')?></td>
                                                                                                </tr>
                                                                                            <?php }?>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        <?php }?>
                                                                    <?php }?>
								</div>
							</div>
							<!-- end expad-->
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
	<script type="text/javascript" src="<?=base_url()?>assets/js/expand.js"></script>
	<script type="text/javascript">
	    $(window).load(function(){
			var width = $(window).width();
			if(width <= 800){
				$(document).ready(function(){
		    	 	$(".expand").toggler();
					$("#wrapper").expandAll({trigger: ".expand", ref: "div.demo", localLinks: "p.top a"});
					
					$('#head-top-comment').click(function(){
						var data=$(this).attr('data');
						if ($('#'+data).length > 0){
							$('#'+data).show();
						};
					});
					$('.boxclose-comment').click(function(){
						var data=$(this).attr('data');
						if ($('#'+data).length > 0){
							$('#'+data).hide();
						};
					});
			    });
			}else{
				$(document).ready(function(){
			    	$(".belanja-body").tinyscrollbar({thumbSize:15,trackSize:100});
		    	 	
		    	 	$(".expand").toggler();
					$("#wrapper").expandAll({trigger: ".expand", ref: "div.demo", localLinks: "p.top a"});
					
					$('#head-top-comment').click(function(){
						var data=$(this).attr('data');
						if ($('#'+data).length > 0){
							$('#'+data).show();
						};
					});
					$('.boxclose-comment').click(function(){
						var data=$(this).attr('data');
						if ($('#'+data).length > 0){
							$('#'+data).hide();
						};
					});
			    });
			}
		});
	</script>
    </body>
</html>