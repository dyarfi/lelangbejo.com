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
                <li><a href="<?=site_url('item')?>">Item</a> <span class="divider">/</span></li>
                <li class="active">Data</li>
            </ul>

            <div class="input-prepend input-append">
                <form class="margin-none">
                    <a class="btn" href="<?=site_url('item')?>"><span class="icon-refresh"></span> Refresh</a>
                    <?php if(check_page_access($this->_page_access,'item_add')){?>
                        <a class="btn" href="<?=site_url('item/add')?>"><span class="icon-upload"></span> Add new item</a>
                    <?php }?>
                    <?php if(check_page_access($this->_page_access,'item_edit')){?>
                        <a class="btn" href="<?=site_url('item/setting')?>"><span class="icon-check"></span> Setting</a>
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
                            <th>Date</th>
                            <th>Price</th>
                            <th>Created</th>
                            <th>Modified</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r){?>
                            <tr>
                                <td>
                                    <?php if(check_page_access($this->_page_access,'item_edit')){?>
                                    <a class="set_tooltip" title="Edit - <?=$r['name']?>" href="<?=site_url('item/edit/'.$r['id'])?>"><?=$r['name']?></a>
                                    <?php }else{?>
                                        <?=$r['name']?> 
                                    <?php }?>
                                    <?php if($r['is_active']){?><span class="icon-check"></span><?php }?>
                                    <?php if($r['is_finish']){?><span class="icon-star"></span><?php }?>
                                </td>
                                <td><?=format_date($r['start_date'])?> - <?=format_date($r['end_date'])?></td>
                                <td><?=number_format($r['price_start'])?> - <?=number_format($r['price_end'])?></td>
                                <td><?=format_date($r['created'],'F d, Y H:i')?> (<?=$r['created_by_name']?>)</td>
                                <td><?=$m=(!empty ($r['modified'])) ? format_date($r['modified'],'F d, Y H:i').'('.$r['modified_by_name'].')' :'-'?></td>
                                <td>
                                    <?php if($r['is_finish']){?>
                                        <a href="<?=site_url('item/view/'.$r['id'])?>">view winner</a>
                                    <?php }else{ ?>
                                        <a href="<?=site_url('item/set/'.$r['id'])?>">set winner</a>
                                    <?php }?>
                                    <?php if(check_page_access($this->_page_access,'item_delete')){?>
                                        | 
                                        <a class="delete" href="javascript:;" data="<?=site_url('item/delete/'.$r['id'])?>">delete</a>
                                    <?php }?>
                                </td>
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
        <script type="text/javascript">
            $(function(){
               $('.delete').click(function(){
                  if(confirm('Anda yakin akan menghapus item ini?')){
                      location.href = $(this).attr('data');
                  } 
               });
            });
        </script>
    </body>
</html>
