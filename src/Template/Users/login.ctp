<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
<!-- no additional media querie or css is required -->
<div class="container">
        <div class="row justify-content-center align-items-center" style="height:20vh">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <form action="" autocomplete="off">
                            <center><?php 
                                echo $this->Form->control('username', array('class' => 'fadeIn second mb-1','type' => 'text','label'=>false,'placeholder'=>'Username'));
                            ?></center>
                            <center><?php
                                echo $this->Form->control('password', array('class' => 'fadeIn third','type' => 'password','label'=>false,'placeholder'=>'Password'));
                            ?></center>
                            <center><?= $this->Form->button(__('Login'),['class'=>'btn btn-primary']); ?></center>
                            <?= $this->Form->end() ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>