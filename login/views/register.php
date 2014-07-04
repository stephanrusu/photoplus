<?php include('_header.php'); ?>
<!-- show registration form, but only if we didn't submit already -->

    <div class="container">
        <?php if (!$registration->registration_successful && !$registration->verification_successful) { ?>      
        <div class="row row-top">
            <div class="col-xs-8 col-sm-5 col-md-4 col-xs-offset-2 col-sm-offset-3 col-md-offset-4">
                <div class="panel panel-default">
                        <div class="panel-body">
                            <p class="text-center" style="margin-top:10px;"><img class="form-logo-picture" src="../img/form-logo.png" alt="PhotoPlus"/></p>
                        <form role="form" method="post" action="register.php" name="registerform">
                            <h3 class="text-center">Register on Photoplus</h3>
                            <hr/>
                            <div class="h6"></div>                                                    
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Display Name" pattern="[a-zA-Z0-9]{2,64}" required />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                                <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Email Address" required>
                            </div>                    
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                <input type="password" name="user_password_new" id="user_password_new" class="form-control" placeholder="Password" pattern=".{6,}" required autocomplete="off">
                            </div>                    
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                <input type="password" name="user_password_repeat" id="user_password_repeat" class="form-control" placeholder="Confirm Password" pattern=".{6,}" required autocomplete="off">
                            </div>
                            <div class="form-group text-center">
                                <img src="tools/showCaptcha.php" alt="captcha" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-puzzle-piece fa-fw"></i></span>
                                <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Please enter these characters" required autocomplete="off">
                            </div>
                            <hr/>
                            <div class="h6"></div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit" name="register" value="Register" data-loading-text="Loading..." id="registerBtn" class="btn btn-start btn-block">
                                </div>
                            </div>
                            <div class="row row-top">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <a href="index.php" class="btn btn-link btn-block">Already have an account</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
<?php include('_footer.php'); ?>