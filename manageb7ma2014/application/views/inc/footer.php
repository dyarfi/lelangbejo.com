<div id="footer">
    <div class="container-fluid">
        <div class="span12">
            <p class="muted credit">Copyright &copy; 2014 <a href="http://berlima.co">Berlima Digital Lab</a>.</p>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap-lightbox.min.js"></script>
<script type="text/javascript">
    if($('.set_tooltip').length){
        $('.set_tooltip').tooltip();
    }
    $(function() {
        if($( ".datepicker" ).length){
            $( ".datepicker" ).datepicker({
                    format:'yyyy-mm-dd'
            });
        }
        if($( ".datetimepicker" ).length){
            $('.datetimepicker').datetimepicker({
                format: 'yyyy-MM-dd hh:mm:ss',
                language: 'en'
            });
        }
        $('#check-all:checkbox').change(function(){
            if($(this).attr("checked")){
                $('input:checkbox').attr('checked','checked');
            }else {
                $('input:checkbox').removeAttr('checked');
            }
         });
         $('#remove').click(function(){
            var i = 0;
            var data = new Array();
            $('.check-del').each(function(){
                if($(this).is(':checked')){
                    data[i] = $(this).val();
                    i++;
                }
            });
            if(data == '' || data == undefined){
                alert('Please select the data to be deleted!');return false;
            }
            if(confirm('Are you sure to delete this data?'))
            location.href = $(this).attr('url')+'?id='+data;
         });
    });
    $(window).load(function(){
        resizeHeight();
    });
    $(window).resize(function() {
        resizeHeight();
    });

    function resizeHeight()
    {
        if($('.min-content').length > 0){
            $('.min-content').css({
                'min-height':($(window).height() - 150)
            });

            $('#footer').css({
                'position' : 'relative'
            });
        }
        if($('.error').length > 0){
            $('.error').delay(3000).fadeOut('slow');
        }
    }
</script>