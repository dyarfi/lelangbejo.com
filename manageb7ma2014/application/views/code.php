<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('inc/head');?>
    </head>
    <body>
        <?php $this->load->view('inc/menu');?>
        <div class="container-fluid min-content">
            <ul class="breadcrumb">
                <li><a href="#">Manage</a> <span class="divider">/</span></li>
                <li><a href="<?=site_url('code')?>">Transaction Code</a> <span class="divider">/</span></li>
                <li class="active">Data</li>
            </ul>

            <div class="input-prepend input-append">
                <form class="margin-none">
                    <div class="btn-group">
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="icon-filter"></span> Filter <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="<?=$a=($action=='') ?'active':''?>"><a href="<?=site_url('code')?>">All</a></li>
                            <li class="<?=$a=($action=='Unapproved') ?'active':''?>"><a href="<?=site_url('code?action=Unapproved')?>">Unapproved</a></li>
                            <li class="<?=$a=($action=='Approved') ?'active':''?>"><a href="<?=site_url('code?action=Approved')?>">Approved</a></li>
                            <li class="<?=$a=($action=='Rejected') ?'active':''?>"><a href="<?=site_url('code?action=Rejected')?>">Rejected</a></li>
                        </ul>
                    </div>
                    <a class="btn" href="<?=site_url('code')?>"><span class="icon-refresh"></span> Refresh</a>
                    <input class="input-medium" name="code"  placeholder="Search by code" type="text">
                    <button class="btn" type="submit"><span class="icon-search"></span></button>
                </form>
            </div>
           
            <?php if($rows){?>
                <table class="table top-10">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Status</th>
                            <th>Submit</th>
                            <th>Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r){?>
                            <tr>
                                <td>
                                    <a class="set_tooltip" title="Detail - <?=$r['code']?>" href="<?=site_url('code/edit/'.$r['id'])?>"><?=$r['code']?></a>
                                </td>
                                <td><?=$r['approved']?></td>
                                <td><?=format_date($r['created'],'F d, Y H:i')?> (<a href="<?=site_url('member')?>?name=<?=$r['user_name']?>"><?=$r['user_name']?></a>)</td>
                                <td><?=$m=(!empty ($r['approved_date'])) ? format_date($r['approved_date'],'F d, Y H:i').'('.$r['admin_name'].')' :'-'?></td>
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
