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
                <li><a href="<?=site_url('report')?>">Log Activity</a> <span class="divider">/</span></li>
                <li class="active">Report</li>
            </ul>

            <p>
                <strong>Date</strong> : <?=$date?><br>
                <strong>Activity</strong> : <?=$c=empty($category)?'All Activity':$category?>
            </p>
           
            <?php if($rows){?>
                <?php if($is_detail){?>
                    <table class="table b-bottom b-top top-10">
                        <thead>
                            <tr>
                                <th class="b-left">#</th>
                                <th class="b-left">Date</th>
                                <th class="b-left b-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;?>
                            <?php foreach ($rows as $date=>$row){?>
                                <tr>
                                    <td class="b-left"><?=$i?></td>
                                    <td class="b-left"><?=format_date($date)?></td>
                                    <td class="b-left b-right"><?=count($row)?></td>
                                </tr>
                                <tr>
                                    <td class="b-left">&nbsp;</td>
                                    <td colspan="2" class="b-right">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th width="13%">User</th>
                                                    <th width="13%">Activity</th>
                                                    <th width="15%">Date</th>
                                                    <th>Message</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($row as $no=>$r){?>
                                                <tr>
                                                    <td><?=$no+1?></td>
                                                    <td><?=$r['user_name']?></td>
                                                    <td><?=$this->log_mod->data_category(FALSE,$r['category'])?></td>
                                                    <td><?=format_date($r['created'],'F d, Y H:i')?></td>
                                                    <td><?=$r['message']?></td>
                                                </tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php $i++;?>
                            <?php }?>
                        </tbody>
                    </table>
                <?php }else{?>
                    <table class="table top-10">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $i=>$r){?>
                                <tr>
                                    <td><?=$i+1?></td>
                                    <td><?=format_date($r['date'])?></td>
                                    <td><?=$r['total']?></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                <?php }?>
            <?php }else{?>
                <div class="alert alert-info top-10">No data</div>
            <?php }?>
        </div>

        <?php $this->load->view('inc/footer');?>
    </body>
</html>
