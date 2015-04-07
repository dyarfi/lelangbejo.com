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
                <li><a href="<?=site_url('member')?>">Member</a> <span class="divider">/</span></li>
                <li class="active">Data</li>
            </ul>

            <div class="input-prepend input-append">
                <form class="margin-none">
                    <div class="btn-group">
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="icon-filter"></span> Sort by <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="<?=$a=($field=='-')?'active':''?>"><a href="<?=site_url('member')?>">New Register</a></li>
                            <li class="<?=$a=($field=='name-ASC')?'active':''?>"><a href="<?=site_url('member?field=name&sort=asc')?>">Name (Ascending)</a></li>
                            <li class="<?=$a=($field=='name-DESC')?'active':''?>"><a href="<?=site_url('member?field=name&sort=desc')?>">Name (Descending)</a></li>
                            <li class="<?=$a=($field=='last_loggedin_date-DESC')?'active':''?>"><a href="<?=site_url('member?field=last_loggedin_date&sort=desc')?>">Last login</a></li>
                        </ul>
                    </div>
                    <a class="btn" href="<?=site_url('member')?>"><span class="icon-refresh"></span> Refresh</a>
                    <?php if(check_page_access($this->_page_access,'member_print')){?>
                        <a class="btn" href="#modal-print" role="button" data-toggle="modal"><span class="icon-eye-open"></span> Report</a>
                    <?php }?>
                    <input class="input-medium" name="name"  placeholder="Search by name" type="text">
                    <button class="btn" type="submit"><span class="icon-search"></span></button>
                </form>
            </div>
           
            <?php if($rows){?>
                <table class="table top-10">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date (Register)</th>
                            <th>Date (Last Login)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r){?>
                            <tr>
                                <td>
                                    <a class="set_tooltip" title="Detail" href="#modal<?=$r['id']?>" role="button" data-toggle="modal"><?=$r['name']?></a>
                                    <?php if($r['is_lock']){?>
                                        <span class="icon-lock"></span>
                                    <?php }?>
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
                                                    <td><?=$r['name']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email </td>
                                                    <td>:</td>
                                                    <td><?=$r['email']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Phone </td>
                                                    <td>:</td>
                                                    <td><?=$r['phone']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Address </td>
                                                    <td>:</td>
                                                    <td><?=$r['address']?></td>
                                                </tr>
                                                <tr>
                                                    <td>Birthday</td>
                                                    <td>:</td>
                                                    <td><?=format_date($r['birthday'])?></td>
                                                </tr>
                                                <tr>
                                                    <td>Gender</td>
                                                    <td>:</td>
                                                    <td><?=$g=$r['gender']=='f'?'Female':'Male'?></td>
                                                </tr>
                                                <tr>
                                                    <td>Last Points</td>
                                                    <td>:</td>
                                                    <td><?=$r['last_points']?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                                <td><?=format_date($r['created'],'F d, Y H:i')?></td>
                                <td><?=format_date($r['last_loggedin_date'],'F d, Y H:i')?></td>
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
            <form class="form-horizontal" action="<?=site_url('member/print_data')?>" method="POST">
                <div class="modal-body">
                    <p>Silahkan lihat data (data dikelompokkan berdasarkan user) dan pilih kondisi yang diinginkan :</p>
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
                                <?php foreach ($categories as $r){?>
                                    <?php if($r['id']!='register'){?>
                                        <option value="<?=$r['id']?>"><?=$r['name']?></option>
                                    <?php }?>
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
