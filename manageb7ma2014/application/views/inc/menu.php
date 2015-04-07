<?php
$page = isset ($page) ? $page : 'home';

$dashboard = ($page == 'home') ? 'active' : '';
$admin = ($page == 'admin') ? 'active' : '';
$manage = ($page == 'manage') ? 'active' : '';
$profile = ($page == 'profile') ? 'active' : '';
?>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

        <a class="brand logo" target="_blank" href="http://berlima.co"><img src="<?=base_url()?>assets/img/logo.png" border="0" /></a>
        <div class="nav-collapse collapse">
        <ul class="nav">
            <li class="<?=$dashboard?>"><a href="<?=site_url()?>"><span class="icon-home"></span> Dashboard</a></li>
            <?php if(user_role() == _xml('role_dev')){?>
                <li class="dropdown <?=$admin?>">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="icon-cog"></span> Administrator <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">Users</li>
                        <li><a href="<?=site_url('account/lists')?>"><span class="icon-list"></span> List Admin</a></li>
                        <li><a href="<?=site_url('account/add')?>"><span class="icon-plus"></span> Add new admin</a></li>
                        <li class="divider"></li>
                        <li class="nav-header">Blocked</li>
                        <li><a href="<?=site_url('home/lists')?>"><span class="icon-list"></span> List IP blocked</a></li>
                        <li><a href="<?=site_url('home/add')?>"><span class="icon-plus"></span> Add new IP blocked</a></li>
                    </ul>
                </li>
            <?php }?>
            <li class="dropdown <?=$manage?>">
                <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;"><span class="icon-book"></span> Manage <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <?php $page_empty = TRUE;?>
                    <?php if(check_page_access($this->_page_access , 'item')){?>
                        <li><a href="<?=site_url('item')?>"><span class="icon-picture"></span> Item</a></li>
                        <?php $page_empty = FALSE;?>
                    <?php }?>
                    <?php if(check_page_access($this->_page_access , 'code')){?>
                        <li><a href="<?=site_url('code')?>"><span class="icon-barcode"></span> Transaction Code</a></li>
                        <?php $page_empty = FALSE;?>
                    <?php }?>
                    <?php if(check_page_access($this->_page_access , 'notification')){?>
                        <li><a href="<?=site_url('notification')?>"><span class="icon-envelope"></span> Notification</a></li>
                        <?php $page_empty = FALSE;?>
                    <?php }?>
                    <?php if(check_page_access($this->_page_access , 'report')){?>
                        <li><a href="<?=site_url('report')?>"><span class="icon-list-alt"></span> Log Activity</a></li>
                        <?php $page_empty = FALSE;?>
                    <?php }?>
                    <?php if(check_page_access($this->_page_access , 'member')){?>
                        <li><a href="<?=site_url('member')?>"><span class="icon-user"></span> Member</a></li>
                        <?php $page_empty = FALSE;?>
                    <?php }?>

                    <?php if($page_empty){?>
                        <li><a href="#"><span class="icon-lock"></span> No Page Access</a></li>
                    <?php }?>
                </ul>
            </li>
            <li class="dropdown <?=$profile?>">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="icon-user"></span> Profile <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=site_url('account/profile')?>"><?=full_name()?></a></li>
                    <li><a href="<?=site_url('account/change_password')?>">Change password</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=site_url('logout')?>"><span class="icon-off"></span> Logout</a></li>
                </ul>
            </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>