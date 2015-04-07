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
				<div class="kotak-head">PROFILKU</div>
				<div class="mekanisme-body">
					<!-- Content -->
					<div class="profile-img">
                                            <div class="area">
                                                <img src="<?=avatar($user->avatar_file)?>"/>
                                            </div>
                                        </div>
					<div class="profile-bio">
						<ul>
							<li>Nama</li>
                                                        <li class="big"><?=$user->name?></li>
                                                        <li>Email</li>
                                                        <li class="big"><?=$user->email?></li>
                                                        <li>Nomor Telepon</li>
                                                        <li class="big"><?=$user->phone?></li>
                                                        <li>Alamat</li>
                                                        <li class="big"><?=$user->address?></li>
                                                        <li class="big">
                                                            <a class="logout" href="<?=site_url('logout')?>">LOGOUT</a>
                                                        </li>
						</ul>
					</div>
					<!-- end Content -->
				</div>
			</div>
			
		</div>

	</div>
        
        <?php $this->load->view('inc/footer');?>
    </body>
</html>