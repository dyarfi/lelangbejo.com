<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
        <style type="text/css">
            .b-left{
                border-left: 1px solid #DDDDDD;
            }
            .b-right{
                border-right: 1px solid #DDDDDD;
            }
            .b-bottom{
                border-bottom: 1px solid #DDDDDD;
            }
            .b-top{
                border-top: 1px solid #DDDDDD;
            }
        </style>
    </head>
    <body>
        <?php $this->load->view('inc/menu');?>
        <div class="container-fluid min-content">
            <ul class="breadcrumb">
                <li><a href="#">Manage</a> <span class="divider">/</span></li>
                <li><a href="<?=site_url('item')?>">Item</a> <span class="divider">/</span></li>
                <li class="active">View Winner</li>
            </ul>

            <p>
                <strong>Item</strong> : <?=$row->name?><br>
                <strong>Winner</strong> : <a href="<?=site_url('member')?>?name=<?=$row->user_name?>"><?=$row->user_name?></a> (Rp <?=  number_format($row->bidding_price, 0, '', '.')?>)
            </p>
           
            <?php if($rows){?>
                <table class="table top-10">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Price</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $i=>$r){?>
                            <?php if($r['user_id']==$row->user_id AND $r['price']==$row->bidding_price){?>
                                <tr style="background:#f5f5f5;">
                            <?php }else{?>
                                <tr>
                            <?php }?>
                                <td><?=$i+1?></td>
                                <td><?=$r['user_name']?></td>
                                <td>Rp <?= number_format($r['price'], 0, '', '.')?></td>
                                <td><?=$r['created']?></td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            <?php }else{?>
                <div class="alert alert-info top-10">No data</div>
            <?php }?>
        </div>

        <?php $this->load->view('inc/footer');?>
    </body>
</html>
