<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/jquery.jqplot.css" />
        <style type="text/css">
            .total-visits{font-size: 18px;text-align: right;}
        </style>
    </head>
    <body>
        <?php $this->load->view('inc/menu');?>
        <div class="container-fluid min-content">
            <div class="row-fluid">
                <div class="span6">
                    <h2>Welcome <?=full_name()?></h2>
                    <p>Your last loggedin date : <?=lastlogin()?></p>
                </div>

                <div class="span6">
                    <div class="total-visits">
                        Total last members
                        <h1><?=$total_member?></h1>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div id="chart-daily" style="height:275px; width:100%;"></div>
                </div>
            </div>
            <div class="row-fluid top-20">
                <div class="span5">
                    <div id="chart-category" style="height:275px;width:100%;"></div>
                </div>

                <div class="span7">
                    <div id="chart-category-2" style="height:275px;width:100%;"></div>
                </div>
            </div>
        </div>
        <?php $this->load->view('inc/footer');?>
        <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.jqplot.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/plugins/jqplot.highlighter.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/plugins/jqplot.cursor.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/plugins/jqplot.dateAxisRenderer.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/plugins/jqplot.pieRenderer.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/plugins/jqplot.categoryAxisRenderer.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/plugins/jqplot.barRenderer.min.js"></script>

        <script class="code" type="text/javascript">

            $(document).ready(function(){
                chartDaily();
                chartCategory();
                chartCategory2();
            });

            $(window).resize(function() {
                chartDaily();
                chartCategory();
                chartCategory2();
            });
            
            function chartCategory2()
            {
                $('#chart-category-2').html('');
                var line = [<?=$category?>];

                $('#chart-category-2').jqplot([line], {
                    title:'Category Activity',
                    seriesDefaults:{
                        renderer:$.jqplot.BarRenderer,
                        rendererOptions: {
                            // Set the varyBarColor option to true to use different colors for each bar.
                            // The default series colors are used.
                            varyBarColor: true
                        }
                    },

                    axes:{
                        xaxis:{
                            renderer: $.jqplot.CategoryAxisRenderer
                        }

                    }

                });

            }

            function chartCategory()
            {
                $('#chart-category').html('');
                var line = [<?=$category?>];

                var plot = $.jqplot('chart-category', [line], {
                    grid: {
                        drawBorder: false,
                        drawGridlines: false,
                        background: '#ffffff',
                        shadow:false
                    },

                    axesDefaults: {

                    },

                    seriesDefaults:{
                        renderer:$.jqplot.PieRenderer,
                        rendererOptions: {
                            showDataLabels: true
                        }

                    },

                    legend: {
                        show: true,
                        rendererOptions: {
                            numberRows: 1
                        },
                        location: 's'
                    }

                });

            }

            function chartDaily()
            {
                $('#chart-daily').html('');


                var line=[<?=$daily?>];
                var daily = $.jqplot('chart-daily', [line], {
                    title:'Daily Activity',
                    axes:{
                      xaxis:{
                        renderer:$.jqplot.DateAxisRenderer,
                          tickOptions:{
                            formatString:'%b&nbsp;%#d'
                          }
                      }
                    },

                    highlighter: {
                      show: false
                    },

                    cursor: {
                      show: true,
                      tooltipLocation:'sw'
                    }

                  });

            }

        </script>
    </body>
</html>