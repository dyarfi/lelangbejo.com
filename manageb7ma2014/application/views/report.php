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
                <li><a href="<?=site_url('report')?>">Log Activity</a> <span class="divider">/</span></li>
                <li class="active">Data</li>
            </ul>

            <div class="input-prepend input-append">
                <form class="margin-none">
                    <div class="btn-group">
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="icon-filter"></span> Filter by Activity <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li <?=$c=($category=='')?'class="active"':''?>><a href="<?=site_url('report')?>">All</a></li>
                            <?php foreach ($categories as $r){?>
                                <li <?=$c=($category==$r['id'])?'class="active"':''?>><a href="<?=site_url('report?category='.$r['id'])?>"><?=$r['name']?></a></li>
                            <?php }?>
                        </ul>
                    </div>
                    <a class="btn" href="<?=site_url('report')?>"><span class="icon-refresh"></span> Refresh</a>
                    <?php if(check_page_access($this->_page_access,'report_print')){?>
                        <a class="btn" href="#modal-print" role="button" data-toggle="modal"><span class="icon-eye-open"></span> Report</a>
                    <?php }?>
                </form>
            </div>
           
            <?php if($rows){?>
                <table class="table top-10">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Activity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r){?>
                            <tr>
                                <td>
                                    <a class="set_tooltip" title="Detail" href="#modal<?=$r['id']?>" role="button" data-toggle="modal"><?=$r['user_name']?></a>
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
                                                        <th width="130">#</th>
                                                        <th>&nbsp;</th>
                                                        <th>Data</th>
                                                    </tr>
                                                </thead>
                                                <tr>
                                                    <td>User</td>
                                                    <td>:</td>
                                                    <td><?=$r['user_name']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Activity </td>
                                                    <td>:</td>
                                                    <td><?=$this->log_mod->data_category(FALSE,$r['category'])?></td>
                                                </tr>
                                                <tr>
                                                    <td>Date </td>
                                                    <td>:</td>
                                                    <td><?=format_date($r['created'],'F d, Y H:i')?></td>
                                                </tr>
                                                <tr>
                                                    <td>Message </td>
                                                    <td>:</td>
                                                    <td><?=$r['message']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Agent</td>
                                                    <td>:</td>
                                                    <td><?=$r['agent']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Platform</td>
                                                    <td>:</td>
                                                    <td><?=$r['platform']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Ip address</td>
                                                    <td>:</td>
                                                    <td><?=$r['ip_address']?></td>
                                                </tr>
                                                <tr>
                                                    <td>User agent</td>
                                                    <td>:</td>
                                                    <td><?=$r['user_agent']?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                                <td><?=$this->log_mod->data_category(FALSE,$r['category'])?></td>
                                <td><?=format_date($r['created'],'F d, Y H:i')?></td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            <?php }else{?>
                <div class="alert alert-info top-10">No data</div>
            <?php }?>
            <div class="pagination"><?=$pagination?></div>
        </div>

        <?php if(check_page_access($this->_page_access,'report_print')){?>
        <div id="modal-print" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Report Data</h3>
            </div>
            <form class="form-horizontal" action="<?=site_url('report/print_data')?>" method="POST">
                <div class="modal-body">
                    <p>Silahkan lihat data (data dikelompokkan berdasarkan tanggal) dan pilih kondisi yang diinginkan :</p>
                    <hr>
                    <div class="control-group">
                        <label class="control-label">Date (start)</label>
                        <div class="controls">
                            <div class="input-append datetimepicker">
                                <input type="text" class="input-medium" name="start_date" placeholder="Start date"/>
                                <span class="add-on">
                                  <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                  </i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Date (end)</label>
                        <div class="controls">
                            <div class="input-append datetimepicker">
                                <input type="text" class="input-medium" name="end_date" placeholder="End date"/>
                                <span class="add-on">
                                  <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                  </i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Activity</label>
                        <div class="controls">
                            <select name="category">
                                <option value="">All Activity</option>
                                <?php foreach ($categories as $r){?>
                                    <option value="<?=$r['id']?>"><?=$r['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <label class="checkbox">
                                <input name="is_detail" type="checkbox"> Tampilkan detail activity
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="margin-bottom:-20px;">
                    <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
        </div>
        <?php }?>
        <?php $this->load->view('inc/footer');?>
    </body>
</html>
