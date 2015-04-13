<div id="foot">
    <div class="menu-foot">
        <div class="ulimg">
            <a href="https://www.youtube.com/channel/UCaitRgHLYDwOqqHeLF8_J1g" title="Youtube"><img src="<?=base_url()?>assets/img/icon-y.png" border="0"></a>
            <a href="https://facebook.com/koncobejo" title="Facebook"><img src="<?=base_url()?>assets/img/icon-f.png" border="0"></a>
            <a href="https://twitter.com/koncobejo" title="Twitter"><img src="<?=base_url()?>assets/img/icon-t.png" border="0"></a>
        </div>
        <div class="ultext">
            <ul class="footer-dekstop">
                <li>&copy; Copyright 2015 by Bintang Toedjoe Masuk Angin 2015.</li>
                <li><a href="<?=site_url('mekanisme-lelang')?>">Mekanisme</a></li>
                <li>|</li>
                <li><a href="<?=site_url('mekanisme-koin')?>">Cara mendapatkan KOIN</a></li>
                <li>|</li>
                <li><a href="<?=site_url('syarat-ketentuan')?>">Syarat & Ketentuan</a></li>
                <li>|</li>
                <li><a href="<?=site_url('kebijakan-privasi')?>">Kebijakan Privasi</a></li>
            </ul>
            <p class="footer-mobile">
                Copyright 2015 by Bintang Toedjoe<br/>
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
		$('#form-bidding33').submit(function () {
			
			var form = $(this);
			var purl = form.attr('action');
			var mbox = form.find('.msg');
			
			mbox.empty();
			
			//$("#LightBoxError").show();
			
			//var userform = $('#user-form');
			//var user_id = userform.find('input[name="user_id"]').val();
			
			//userform.find('.msg').empty();
			//userform.find('.msg').html('<img src="'+base_URL + 'assets/admin/img/input-spinner.gif"/>&nbsp;Saving profile');
			
			
			$.ajax({
				url: purl,
				type: 'POST',
				data: form.serialize(),
				timeout: 5000,
				dataType: "JSON",
				cache: true,
				async: true,
				success: function(message) {
					//alert(message);
					// Empty loader
					//callback.empty().hide();
					// Empty loader image
					//loader.hide();
				},
				complete: function(message) {
				
					var msg = $.parseJSON(message.responseText);
					//console.log(msg.errors.bidding);
					
					if (msg.errors !== 'undefined') {
						$.each(msg.errors,function(error, m){
							if (error && m) {
								//console.log(m);   
								mbox.html('<div class="success">'+m+'</div>');
							}									  
						});
					}
					
					if (msg.code !== 'undefined' && msg.code === 1) {
						window.location.href = base_URL + 'step4';
					} else if (msg.code === 'must_login') {
						window.location.href = base_URL + 'facebook/auth?url=step1';
					} else {
						window.location.href = base_URL;
					}
					
				},
				error: function(x,message,t) { 
					if(message==="timeout") {
						alert("got timeout");
					} else {
						//alert(message);
					}	
				}
			});
			
			return false;	
		
		});
		
    });
	
    $( function() {
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
            if(heightHome > 550){
                $('.main-home').css({'min-height':heightHome+'px'});
            }else{
                $('.main-home').css({'min-height':'550px'});
            } 
        }
        
        if($('#body').length > 0)
        {
            if(heightNew > 500){
                $('#body').css({'min-height':heightNew+'px'});
            }else{
                $('#body').css({'min-height':'500px'});
            } 
        }
    }
</script>