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
				<div class="kotak-head">KEBIJAKAN PRIVASI</div>
				<div class="syarat-body">
					<!-- Tiny Scroll -->
					<div class="scrollbar"><div class="track"><div class="thumb"></div></div></div>
                                        <div class="viewport">
						<div class="overview">
							<!-- content -->
							<h4>Monggo dibaca untuk mengetahui ketentuan mengikuti LELANG BEJO:</h4>
                                                        <p>Privasi Anda sangat penting bagi kami. Oleh karena itu, kami mengembangkan kebijakan ini agar Anda dapat memahami bagaimana kami mengumpulkan, menggunakan, berkomunikasi dan mengungkapkan serta menggunakan informasi pribadi. Berikut garis besar kebijakan privasi kami.</p>
                                                        <p>Sebelum atau pada saat mengumpulkan informasi pribadi, kami akan mengidentifikasi tujuan dari pengumpulan informasi. </p>
                                                        <p>Kami akan mengumpulkan dan menggunakan informasi pribadi semata-mata hanya untuk memenuhi tujuan yang telah kami tentukan dan untuk tujuan lain yang kompatibel, kecuali kami mendapat persetujuan dari individu yang bersangkutan atau sebagaimana yang telah diatur oleh hukum. </p>
                                                        <p>Kami hanya akan menyimpan informasi pribadi selama diperlukan saat memenuhi tujuan tersebut. </p>
                                                        <p>Kami akan mengumpulkan informasi pribadi dengan cara yang sah dan adil serta, bila sesuai, dengan pengetahuan atau persetujuan dari individu yang bersangkutan.</p>
                                                        <p>Data pribadi harus relevan dengan tujuan awal penggunaan dan, sejauh yang diperlukan untuk tujuan tersebut, harus akurat, lengkap dan terkini.</p>
                                                        <p>Kami akan melindungi informasi pribadi dengan perlindungan keamanan yang wajar terhadap kehilangan atau pencurian, serta akses yang tidak sah, pengungkapan, penyalinan, penggunaan atau modifikasi.</p>
                                                        <p>Kami akan menyediakan informasi bagi pelanggan mengenai kebijakan dan praktek yang berkaitan dengan manajemen informasi pribadi. </p>
                                                        <p>Kami berkomitmen dalam menjalankan roda usaha sesuai dengan prinsip-prinsip ini dengan tujuan untuk memastikan bahwa kerahasiaan informasi pribadi dilindungi dan dijaga.</p>
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
                        $(".syarat-body").tinyscrollbar({thumbSize:15,trackSize:100});
                    });
                }
            });
	</script>
    </body>
</html>