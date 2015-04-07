<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
    </head>
    <body>
        <?php $this->load->view('inc/menu');?>
        <div class="container-fluid min-content">
            <ul class="breadcrumb">
                <li><a href="#">Administrator</a> <span class="divider">/</span></li>
                <li><a href="<?=site_url('home/lists')?>">IP Blocked</a> <span class="divider">/</span></li>
                <li class="active">Data</li>
            </ul>
            <a class="btn" href="<?=site_url('home/add')?>"><span class="icon-plus"></span> Add new ip blocked</a>
            <?php if($rows){?>
                <table class="table top-10">
                    <thead>
                        <tr>
                            <th>IP address</th>
                            <th>Unlock date</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r){?>
                            <tr>
                                <td>
                                    <!-- Button to trigger modal -->
                                    <a class="set_tooltip" title="View - <?=$r['ip_address']?>" href="#modal<?=$r['id']?>" role="button" data-toggle="modal"><?=$r['ip_address']?></a>

                                    <!-- Modal -->
                                    <div id="modal<?=$r['id']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h3 id="myModalLabel">Detail</h3>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th width="80">Name</th>
                                                        <th>&nbsp;</th>
                                                        <th>Data</th>
                                                    </tr>
                                                </thead>
                                                <tr>
                                                    <td>IP Address</td>
                                                    <td>:</td>
                                                    <td><?=$r['ip_address']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Unlock Date</td>
                                                    <td>:</td>
                                                    <td><?=format_date($r['unlock_date'],'F d, Y H:i:s')?></td>
                                                </tr>
                                                <tr>
                                                    <td>Lock Date</td>
                                                    <td>:</td>
                                                    <td><?=format_date($r['created'],'F d, Y H:i:s')?></td>
                                                </tr>
                                                <tr>
                                                    <td>Platform</td>
                                                    <td>:</td>
                                                    <td><?=$r['platform']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Agent</td>
                                                    <td>:</td>
                                                    <td><?=$r['agent']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Data Post</td>
                                                    <td>:</td>
                                                    <td><?=$r['post_data']?></td>
                                                </tr>
                                                <tr>
                                                    <td>User Agent</td>
                                                    <td>:</td>
                                                    <td><?=$r['user_agent']?></td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                </td>
                                <td><?=format_date($r['unlock_date'],'F d, Y H:i:s')?></td>
                                <td><a href="<?=base_url()?>home/delete/<?=$r['id']?>?url=<?=uri_string()?>"><span class="icon-remove"></span> remove</a></td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            <?php }else{?>
                <div class="alert alert-info top-10">No data</div>
            <?php }?>
            <div class="pagination"><?=$pagination?></div>
        </div>

        <?php $this->load->view('inc/footer');?>
    </body>
</html>
