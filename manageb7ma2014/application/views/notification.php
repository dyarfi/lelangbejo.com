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
                <li><a href="<?=site_url('notification')?>">Notification</a> <span class="divider">/</span></li>
                <li class="active">Send email</li>
            </ul>
            <form method="post" class="form-horizontal">
                <?php if($success){?>
                    <div class="alert alert-success">
                        <strong>Send email success!</strong><br>
                        Pesan sudah dikirim ke <strong><?=$users?></strong> users
                    </div>
                <?php }?>
                <div class="alert alert-info">
                    <strong>PENTING!</strong><br>
                    Catatan dan apa yang akan terjadi jika send email :<br>
                    <strong>1.</strong> Isi pesan dibawah akan dimasukan ke table notifikasi (untuk ditampung sementara).<br>
                    <strong>2.</strong> Isi pesan dibawah akan dikirim (kotak surat) kesemua user (berdasarkan category user yang dipilih) melalui aplikasi/system cron jobs (per menit 30 pesan).<br>
                </div>
                <?php echo validation_errors();?>
                <div class="row-fluid">
                    <div class="span12">
                        <div>
                            <label>User :</label>
                            <label class="radio">
                                <input type="radio" name="user" value="all" checked /> <strong>All</strong> (kirim ke semua user)
                            </label>
                            <label class="radio">
                                <input type="radio" name="user" value="last_point_max" /> <strong>Last koin > 20</strong> (kirim ke user yang memiliki koin lebih dari 20 koin)
                            </label>
                            <label class="radio">
                                <input type="radio" name="user" value="last_point_min" /> <strong>Last koin < 20</strong> (kirim ke user yang memiliki koin kurang dari 20 koin)
                            </label>
                            <label class="radio">
                                <input type="radio" name="user" value="lock" /> <strong>Lock</strong> (kirim ke user yang dikunci akunya)
                            </label>
                        </div>
                        <div class="top-10">
                            <label>Subject :</label>
                            <input class="span5" type="text" name="subject" placeholder="Subject untuk email" value="<?=set_value('subject')?>">
                        </div>
                        <div class="top-10">
                            <label>Message :</label>
                            <textarea class="span12" name="message" placeholder="Tuliskan pesan yang akan dikirim kesemua user." rows="10"></textarea>
                        </div>
                        <div class="top-20">
                            <button class="btn btn-primary" type="submit">Send Email</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!--/.image-->
        <?php $this->load->view('inc/footer');?>
    </body>
</html>