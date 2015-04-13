<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
    </head>
    <body>
        
        <?php $this->load->view('inc/menu');?>
        <?php $this->load->view('inc/menu_mobile');?>
	<div>
	    <a href="<?=site_url('dompet')?>"><img class="img-responsive img-ctr" src="<?=base_url()?>assets/img/koin-maaf.png"></a>
	</div>
	<div class="choco-bg"></div>
               
        <?php $this->load->view('inc/footer');?>
                
        <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.tinyscrollbar.js"></script>
	<script type="text/javascript">
            $(window).load(function(){
                var width = $(window).width();
                if(width <= 800){
                }else{
                        $(document).ready(function(){
                        $(".syarat-body").tinyscrollbar({thumbSize:15,trackSize:100});
                    });
                }
            });
	</script>
    </body>
</html>