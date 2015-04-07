<div id="foot">
    <div class="menu-foot">
        <div class="ulimg">
            <a href="https://www.youtube.com/channel/UCaitRgHLYDwOqqHeLF8_J1g" title="Youtube"><img src="<?=base_url()?>assets/img/icon-y.png" border="0"></a>
            <a href="https://facebook.com/koncobejo" title="Facebook"><img src="<?=base_url()?>assets/img/icon-f.png" border="0"></a>
            <a href="https://twitter.com/koncobejo" title="Twitter"><img src="<?=base_url()?>assets/img/icon-t.png" border="0"></a>
        </div>
        <div class="ultext">
            <ul class="footer-dekstop">
                <li>&copy; Copyright 2014 by Bintang Toedjoe Masuk Angin 2014.</li>
                <li><a href="<?=site_url('mekanisme-lelang')?>">Mekanisme</a></li>
                <li>|</li>
                <li><a href="<?=site_url('mekanisme-koin')?>">Cara mendapatkan KOIN</a></li>
                <li>|</li>
                <li><a href="<?=site_url('syarat-ketentuan')?>">Syarat & Ketentuan</a></li>
                <li>|</li>
                <li><a href="<?=site_url('kebijakan-privasi')?>">Kebijakan Privasi</a></li>
            </ul>
            <p class="footer-mobile">
                Copyright 2014 by Bintang Toedjoe<br/>
                <a href="<?=site_url('mekanisme-lelang')?>">Mekanisme</a> | <a href="<?=site_url('mekanisme-koin')?>">Cara Mendapatkan Poin</a><br>
                <a href="<?=site_url('syarat-ketentuan')?>">Syarat & Ketentuan</a> | <a href="<?=site_url('kebijakan-privasi')?>">Kebijakan Privasi</a>
            </p>
            <div class="clear"></div>
        </div>
        <div class="ullogo">
            <img src="<?=base_url()?>assets/img/bintang.png">
        </div>
    </div>
</div>

<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/menu.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        resizeMinHeight();
        if($('.error').length > 0){
            $("#LightBoxError").show();
            $("#grayBGError").show(); 
        }
        
        if($('.success').length > 0){
            $("#LightBoxSuccess").show();
            $("#grayBGSuccess").show(); 
        }
    });
    $( function()
    {
        $('.popup-close').click(function(){
            $(".popup-bg").hide();
            $(".popup-ctn").hide(); 
        });
        $('.popup-close-success').click(function(){
            location.href = '<?=site_url('dompet')?>'; 
        });
        $( '#nav li:has(ul)' ).doubleTapToGo();
    });
    
    $( window ).resize(function() {
        resizeMinHeight();
    });
    
    function resizeMinHeight()
    {
        var height = $(window).height();
        var heightFooter = $('#foot').height();
        var heightHead = $('#head').height();
        var heightNew = height - (heightFooter + heightHead);
        
        if($('.main-home').length > 0)
        {
            var heightHome = height - ((heightFooter + heightHead) + 75);
            if(heightHome > 685){
                $('.main-home').css({'min-height':heightHome+'px'});
            }else{
                $('.main-home').css({'min-height':'685px'});
            } 
        }
        
        if($('#body').length > 0)
        {
            if(heightNew > 660){
                $('#body').css({'min-height':heightNew+'px'});
            }else{
                $('#body').css({'min-height':'660px'});
            } 
        }
    }
</script>