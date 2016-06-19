<?php 
    $this->load->view('admin/login-header');?>
<!--
		===========================================================
		BEGIN PAGE
		===========================================================
		-->
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title text-center">سائن ان کریں</h2>
                        </div>

                        <?php if ($this->session->flashdata('redirectError') != ""){?>
                            <div class="alert alert-danger">
                                <?php echo $this->session->flashdata('redirectError');?>
                            </div>
                        <?php }?>
                        
                        <?php if ($this->session->flashdata('failure') != ""){?>
                            <div class="alert alert-danger">
                                <?php echo $this->session->flashdata('failure');?>
                            </div>
                        <?php }?>

                        <?php //echo validation_errors();?>
                        <div class="panel-body">
                            <?php $attributes = array('name'=> 'login_form','role'=>'form','class' => 'web-form', 'id' => 'login_form');
                                echo form_open('admin/login',$attributes);?>
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" placeholder="ای میل پتہ" name="email" id="email" class="form-control" type="email" value="" autofocus>
                                        <?php //if(form_error('email') != ""){?>
                                                <!-- <div class="alert alert-danger"> -->
                                                    <?php echo form_error('email'); ?>
                                                <!-- </div> -->
                                        <?php //}?>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="پاس ورڈ" name="password" type="password" value="">
                                        <?php //if(form_error('email') != ""){?>
                                                <!-- <div class="alert alert-danger"> -->
                                                    <?php echo form_error('password'); ?>
                                                <!-- </div> -->
                                        <?php //}?>
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button type="submit" class="btn btn-lg btn-success btn-block">لاگ ان</button>
                                    <!-- <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end .container -->
<?php $this->load->view('admin/login-footer');?>