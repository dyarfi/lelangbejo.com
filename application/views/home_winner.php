<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
        <style type="text/css">
            .list-winner{
                text-align: left;
                margin: 0 auto;
            }
            .list-winner tr td{
                padding: 0 15px 3px 0;
            }
            .con-text-winner{
                height: auto;
                position: relative;
            }
            /* .con-img img{
                width: 97%;
            }
            .con-img{
                left: -109px;
            }						*/
            .jamu2{
                top: 410px;
                left: 733px;
            }
            @media only screen and ( max-width: 800px ){
                .con-img{
                    left: auto;
                }
            }
            @media only screen and ( max-width: 410px ){
                .con-img{
                    left:  30px;
                }
            }
        </style>
    </head>

    <body>
        
        <?php $this->load->view('inc/menu');?>
        
        <div id="body-home">
            
            <?php $this->load->view('inc/menu_mobile');?>
                
		<div class="main-home">

                    <div class="jamu2">&nbsp;</div>
                    <!-- <div class="bejo">&nbsp;</div> -->

                    <div class="container-home container-home-winner">
                        <div class="con-img"><img src="<?=base_url()?>assets/img/00007.png"></div>
                        <div class="con-text con-text-winner">
                            <h1>PEMENANG LELANG BEJO PERIODE 3</h1>
                            <p>Pemenang Lelang Bejo Periode 3 yang dapat membeli <br/>Laptop HP dengan harga terunik dan termurah adalah :</p>
                            <h1>SALMA AVISA</h1>
                            <p>
                                Selamat untuk kamu sing menang. Selain pemenang tersebut, Mas Bejo juga punya Konco Bejo yang akan mendapat hadiah hiburan dari Mas Bejo. Mereka adalah:
                            </p>
                            <table class="list-winner" style="width:110%;">
                                <tr>
                                    <td>1. Arief mardhatillah</td>
                                    <td>11. Ady Funk</td>
                                    <td>21. Nia Wati</td>
                                </tr>
                                <tr>
                                    <td>2. Chandra Sirait</td>
                                    <td>12. Reza Rahman</td>
                                    <td>22. Wanda Saputra</td>
                                </tr>
                                <tr>
                                    <td>3. Andriyono</td>
                                    <td>13. Kiky Susan</td>
                                    <td>23. Chandra Praditya</td>
                                </tr>
                                <tr>
                                    <td>4. Abe Priambada</td>
                                    <td>14. Silver D'Explorer</td>
                                    <td>24. Irwan Revell</td>
                                </tr>
                                <tr>
                                    <td>5. Heru Rosadi</td>
                                    <td>15. Andika Andika</td>
                                    <td>25. Anosurino Rino</td>
                                </tr>
                                <tr>
                                    <td>6. Ayu Indah</td>
                                    <td>16. Fadli Hermawan</td>
                                    <td>26. Alex Ander</td>
                                </tr>
                                <tr>
                                    <td>7. Andreas A. Junianto</td>
                                    <td>17. Wahyudin Sam Sprs</td>
                                    <td>27. Aryo</td>
                                </tr>
                                <tr>
                                    <td>8. Fransiskus Putra</td>
                                    <td>18. Bella Nirmala</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>9. Kino Zuke</td>
                                    <td>19. Sigijono</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>10. Arif Setyabudi</td>
                                    <td>20. Isef Saepuloh</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                            <!--<div class="logo-winner"></div>-->
                        </div>
                    </div>
                    
		</div>
	</div>
        <?php $this->load->view('inc/footer');?>
    </body>
</html>