<?php include('_header.php'); ?>    
        <div class="container">
            <div class="row row-top">
                <div class="col-xs-8 col-sm-5 col-md-4 col-xs-offset-2 col-sm-offset-3 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p class="text-center" style="margin-top:10px;"><img class="form-logo-picture" src="../img/form-logo.png" alt="PhotoPlus"/></p>
                            <form role="form" method="post" action="index.php" name="loginform">                                    
                                <h3 class="text-center">Sign in to your account </h3> 
                                <hr/>
                                <div class="h6"></div>                       
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                                    <input type="email" name="user_email" id="user_email" class="form-control" placeholder="Email Address" required/>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                    <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Password"  autocomplete="off" required/>
                                </div>
                                <span class="button-checkbox">
                                    <button type="button" class="btn" style="outline:none;" data-color="info">Remember Me</button>
                                    <input type="checkbox" name="user_rememberme" id="user_rememberme" value="1" class="hidden">
                                    <a href="password_reset.php" style="outline:none;" class="btn btn-link pull-right">Forgot Password?</a>
                                </span>   
                                <hr/> 
                                <div class="h6"></div>                    
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="submit" class="btn btn-start btn-block" data-loading-text="Loading...." name="login" value="Sign In" id="loginBtn">
                                    </div>
                                </div>
                                <div class="row row-top">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <a href="register.php" class="btn btn-link btn-block">Create an account </a>
                                    </div>
                                </div>            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include('_footer.php'); ?>