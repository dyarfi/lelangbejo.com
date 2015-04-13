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
                <li class="active">Add</li>
            </ul>
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="controls">
                    <?php if(isset($err)){?>
                        <div class="alert alert-error error input-xxlarge">
                            <strong>Warning!</strong> <?=$err?>
                        </div>
                    <?php } ?>
                    <?php echo validation_errors();?>
                </div>
                <div class="control-group">
                    <label class="control-label">Name</label>
                    <div class="controls">
                        <input class="input-xxlarge" type="text" name="name" placeholder="Name" value="<?=set_value('name')?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Date</label>
                    <div class="controls">
                        <div class="input-append datetimepicker">
                            <input type="text" class="input-medium" name="start_date" placeholder="Start date" value="<?=set_value('start_date')?>"/>
                            <span class="add-on">
                              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                              </i>
                            </span>
                        </div>
                        <span class="icon-minus"></span> 
                        <div class="input-append datetimepicker">
                            <input type="text" class="input-medium" name="end_date" placeholder="End date" value="<?=set_value('end_date')?>"/>
                            <span class="add-on">
                              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                              </i>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Price</label>
                    <div class="controls">
                        <input type="text" class="input-medium" name="price_start" placeholder="Min price" value="<?=set_value('price_start')?>"/>
                         <span class="icon-minus"></span> 
                        <input type="text" class="input-medium" name="price_end" placeholder="Max price" value="<?=set_value('price_end')?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Headline</label>
                    <div class="controls">
                        <textarea class="input-xxlarge" type="text" name="headline" placeholder="Headline"><?=set_value('headline')?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Body text</label>
                    <div class="controls">
                        <textarea class="input-xxlarge" type="text" name="body" placeholder="Body text"><?=set_value('body')?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Detail item</label>
                    <div class="controls">
                        <textarea class="input-xxlarge" type="text" name="detail" placeholder="Detail item"><?=set_value('detail')?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Delivery info</label>
                    <div class="controls">
                        <textarea class="input-xxlarge" type="text" name="delivery" placeholder="Delivery info"><?=set_value('delivery')?></textarea>
                    </div>
                </div>				<div class="control-group">                    <label class="control-label">Share text</label>                    <div class="controls">                        <textarea class="input-xxlarge" type="text" name="share_text" placeholder="Share Text"><?=set_value('share_text',$row->share_text)?></textarea>                    </div>                </div>				
                <div class="control-group">
                    <label class="control-label">File [cover home]</label>
                    <div class="controls">
                        <input type="file" name="file_upload" />
                        <span class="help-block">Recommendation 400x500 pixel's. Background transacted.</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">File [dagangan laku]</label>
                    <div class="controls">
                        <input type="file" name="file_upload2" />
                        <span class="help-block">Recommendation 235x235 pixel's.</span>
                    </div>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-primary" type="submit">Add new item</button>
                        <a class="btn" href="<?=site_url('item')?>">Cancel</a>
                    </div>
                </div>
            </form>
        </div><!--/.image-->
        <?php $this->load->view('inc/footer');?>
    </body>
</html>