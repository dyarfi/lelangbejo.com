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
                <li><a href="<?=site_url('account/lists')?>">Admin</a> <span class="divider">/</span></li>
                <li class="active">Data</li>
            </ul>
            <a class="btn" href="<?=site_url('account/add')?>"><span class="icon-plus"></span> Add new admin</a>
            <?php if($rows){?>
                <table class="table top-10">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Last loggedin date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r){?>
                            <tr>
                                <td>
                                    <a class="set_tooltip" title="Edit - <?=$r['full_name']?>" href="<?=site_url('account/edit/'.$r['id'])?>"><?=$r['full_name']?></a>
                                    <?php if($r['is_lock']){?>
                                        <span class="icon-lock"></span>
                                    <?php }?>
                                </td>
                                <td><?=$r['username']?></td>
                                <td><?=format_date($r['last_loggedin_date'],'F d, Y H:i:s')?></td>
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
