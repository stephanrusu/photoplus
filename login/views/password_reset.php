<?php include('_header.php'); ?>    
        <div class="container">            
        <?php if ($login->passwordResetLinkIsValid() == true) { ?>
        <!-- no data from a password-reset-mail has been provided, so we simply show the request-a-password-reset form -->
            <div class="row row-top">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p class="text-center" style="margin-top:10px;"><img class="form-logo-picture" src="../img/form-logo.png" alt="PhotoPlus"/></p>
                            <form class="" role="form" method="post" action="password_reset.php" name="new_password_form">
                                <h2 class="text-center"><?php echo WORDING_RESET_PASSWORD_TITLE; ?></h2> 
                                <hr/>                       
                                <input type='hidden' name='user_name' value='<?php echo $_GET['user_name']; ?>' />
                                <input type='hidden' name='user_password_reset_hash' value='<?php echo $_GET['verification_code']; ?>' />                

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                    <input type="password" name="user_password_new" id="user_password_new" class="form-control" placeholder="New Password" pattern=".{6,}" required autocomplete="off">
                                </div>                    
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                    <input type="password" name="user_password_repeat" id="user_password_repeat" class="form-control" placeholder="Repeat Password" pattern=".{6,}" required autocomplete="off">
                                </div>

                                <hr/>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <button class="btn btn-start btn-block" name="submit_new_password" type="submit"><?php echo WORDING_SUBMIT_NEW_PASSWORD; ?></button>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <a href="index.php"class="btn btn-link btn-block"><?php echo WORDING_BACK_TO_LOGIN; ?></a>                
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="row row-top">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p class="text-center" style="margin-top:10px;"><img class="form-logo-picture" src="../img/form-logo.png" alt="PhotoPlus"/></p>
                            <form class="" role="form" method="post" action="password_reset.php" name="password_reset_form">
                                <h2 class="text-center"><?php echo WORDING_RESET_PASSWORD_TITLE; ?></h2>
                                <p class="message text-center"><?php echo WORDING_REQUEST_PASSWORD_RESET; ?></p>
                                <hr/>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                                    <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Email Address" required>
                                </div>

                                <hr/>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <button class="btn btn-start btn-block" name="request_password_reset" type="submit"><?php echo WORDING_RESET_PASSWORD; ?></button>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <a href="index.php" class="btn btn-link btn-block"><?php echo WORDING_BACK_TO_LOGIN; ?></a>
                                    <div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
        </div>
<?php include('_footer.php'); ?>