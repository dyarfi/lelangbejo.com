<div id="head">
    <div class="menu">
        <div class="logo"><a href="<?=site_url('/')?>"><img src="<?=base_url()?>assets/img/logo.png" border="0"></a></div>
        <div class="nav">
            <ul>
                <?php if(is_membership()){
                    $name = explode(' ',user_name());
                    $first_name = $name[0];
                    ?>
					<li><a class="nav_profile" href="<?=site_url('profile')?>">PROFILKU</a></li>
                    <!--li><a class="nav_profile" href="<?=site_url('profile')?>">Hai, <?=$first_name?></a></li-->
                <?php }?>
                <li><a href="<?=site_url('lokasi-penjualan')?>">LOKASI PENJUALAN</a></li>   
                <li><a href="<?=site_url('kotak-surat')?>">KOTAK SURAT</a></li>
                <li><a href="<?=site_url('catatan-belanja')?>">CATATAN BELANJA</a></li>
                <li><a href="<?=site_url('dompet')?>">DOMPET</a></li>
                <li><a href="<?=site_url('dagangan-laku')?>">DAGANGAN LAKU</a></li>
                <li><a href="<?=site_url('cara-lelang')?>">CARA LELANG</a></li>
                <li><a href="<?=site_url('/')?>">BERANDA</a></li>
            </ul>
        </div>
    </div>
</div>