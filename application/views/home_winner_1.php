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
            .con-img img{
                width: 97%;
            }
        </style>
    </head>

    <body>
        
        <?php $this->load->view('inc/menu');?>
        
        <div id="body-home">
            
            <?php $this->load->view('inc/menu_mobile');?>
                
		<div class="main-home">

                    <div class="jamu2">&nbsp;</div>
                    <!-- <div class="bejo">&nbsp;</div>  -->
                    <div class="container-home container-home-winner">
                        <div class="con-img"><img src="<?=base_url()?>assets/img/winner-banner.png"></div>
                        <div class="con-text con-text-winner">
                            <h1>PEMENANG LELANG BEJO PERIODE 1</h1>
                            <p>Pemenang Lelang Bejo Periode 1 yang dapat membeli<br>Samsung GALAXY S5 dengan harga terunik dan termurah adalah :</p>
                            <h1>Michael Leonard</h1>
                            <p>
                                Selamat untuk kamu sing menang. Selain pemenang tersebut, Mas Bejo juga punya 18 orang Konco Bejo yang akan mendapat hadiah hiburan dari Mas Bejo. Mereka adalah:
                            </p>
                            <table class="list-winner">
                                <tr>
                                    <td>1. Chairul Anas</td>
                                    <td>10. Muchammad Nur</td>
                                </tr>
                                <tr>
                                    <td>2. Diah Wulandari</td>
                                    <td>11. Ratna Putri</td>
                                </tr>
                                <tr>
                                    <td>3. Ira Stella</td>
                                    <td>12. Rima Pramanik</td>
                                </tr>
                                <tr>
                                    <td>4. Jessy Christina</td>
                                    <td>13. Rudy Tan</td>
                                </tr>
                                <tr>
                                    <td>5. Jony Jr</td>
                                    <td>14. Sarah Kayla</td>
                                </tr>
                                <tr>
                                    <td>6. Joo Julizar</td>
                                    <td>15. Stephani Ella</td>
                                </tr>
                                <tr>
                                    <td>7. Kadek Widiarta</td>
                                    <td>16. Tania Adlinzila</td>
                                </tr>
                                <tr>
                                    <td>8. Lilis Jamilah</td>
                                    <td>17. Tata Ibba</td>
                                </tr>
                                <tr>
                                    <td>9. Malcallysta Azizah</td>
                                    <td>18. Vonda Aprilianto</td>
                                </tr>
                            </table>
                            <div class="logo-winner"></div>
                        </div>
                    </div>
                    
		</div>
	</div>
        <?php $this->load->view('inc/footer');?>
    </body>
</html>