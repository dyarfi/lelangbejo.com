<!-- Menu Responsive -->
<div id="nav" role="navigation"> 
    <div class="menu-roll">MENU</div>
    <a class="scroll-menu" href="#nav" title="Show navigation">Show navigation </a> 
    <a class="scroll-menu" href="#" title="Hide navigation">Hide navigation</a>
    <ul class="clearfix">
        <li><a href="<?=site_url('/')?>">BERANDA</a></li>
        <li><a href="<?=site_url('dagangan-laku')?>">DAGANGAN LAKU</a></li>
        <li><a href="<?=site_url('catatan-belanja')?>">CATATAN BELANJA</a></li>
        <li><a href="<?=site_url('kotak-surat')?>">KOTAK SURAT</a></li>
        <li><a href="<?=site_url('lokasi-penjualan')?>">LOKASI PENJUALAN</a></li>
        <?php if(is_membership()){
            $name = explode(' ',user_name());
            $first_name = $name[0];
            ?>
            <!--li><a class="nav_profile" href="<?=site_url('profile')?>">Hai, <?=$first_name?></a></li-->
			<li><a class="nav_profile" href="<?=site_url('profile')?>">PROFILKU</a></li>
        <?php }?>
    </ul>
    <div class="cara"><a href="<?=site_url('cara-lelang')?>">CARA LELANG</a></div>
    <div class="dompet"><a href="<?=site_url('dompet')?>">DOMPET</a></div>
    <div class="clear"></div> 
</div>
<div class="logo-mobile"><a href="<?=site_url('/')?>"><img src="<?=base_url()?>assets/img/logo.png" border="0"></a></div>
<!-- Menu Responsive -->