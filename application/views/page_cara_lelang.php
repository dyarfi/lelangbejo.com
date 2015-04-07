<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
    </head>
    <body>
        
        <?php $this->load->view('inc/menu');?>
        
        <div id="body">
            
            <?php $this->load->view('inc/menu_mobile');?>
		<div class="main">
			<!-- *** -->
			<div class="container">
				<img class="img-responsive img-center" src="<?=base_url()?>assets/img/cara-lelang.png" alt="cara lelang">
				<div>
					<img class="img-responsive col-xs-12 col-md-6 caranya" src="<?=base_url()?>assets/img/cara1.png" alt="cara lelang">
					<img class="img-responsive col-xs-12 col-md-6 caranya" src="<?=base_url()?>assets/img/cara2.png" alt="cara lelang">
					<img class="img-responsive col-xs-12 col-md-6 caranya" src="<?=base_url()?>assets/img/cara3.png" alt="cara lelang">
					<img class="img-responsive col-xs-12 col-md-6 caranya" src="<?=base_url()?>assets/img/cara4.png" alt="cara lelang">
					<img class="img-responsive col-xs-12 col-md-6 caranya" src="<?=base_url()?>assets/img/cara5.png" alt="cara lelang">
					<img class="img-responsive col-xs-12 col-md-6 caranya" src="<?=base_url()?>assets/img/cara6.png" alt="cara lelang">
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
                        $(".syarat-body").tinyscrollbar({thumbSize:15,trackSize:100});
                    });
                }
            });
	</script>
    </body>
</html>