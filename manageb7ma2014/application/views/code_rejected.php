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
                <li class="active">Rejected - <?=$row->code?></li>
            </ul>
            <form method="post" class="form-horizontal">
                
                <div class="controls">
                    <div class="alert alert-info">
                        <strong>Penting!</strong> <br>
                        <ul type="number">
                            <li>Jika bottom rejected di click maka member akan mendapat notifikasi dan data sudah tidak bisa diedit kembali.</li>
                            <li>Jika pesan/message diisi maka user/member akan mendapatkan notifikasi sesuai dengan yang diinputkan dan jika sebaliknya maka user/member akan mendapat pesan dari system (default).</li>
                        </ul>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Message</label>
                    <div class="controls">
                        <input class="input-xxlarge" name="message" type="text" placeholder="Pesan untuk member jika diperlukan" value="<?=  set_value('message')?>">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="hidden" name="rejected" value="1">
                        <button class="btn btn-primary" type="submit">Rejected</button>
                        <a class="btn" href="<?=site_url('code?action=Unapproved')?>">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
        <?php $this->load->view('inc/footer');?>
    </body>
</html>