<?php include('_header.php'); ?>
    <div class="container">
        <!-- clean separation of HTML and PHP -->    
        <div class="row row-top">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 pull-right">
                <div class="panel panel-default">                        
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                <?php
                                     echo '<img src="' . $login->user_gravatar_image_url . '"/>';
                                     //echo WORDING_PROFILE_PICTURE . '<br/>' . $login->user_gravatar_image_tag;               
                                ?>
                            </div>
                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                <h4 class=""><?php  echo $_SESSION['user_name']; ?></h4>                                
                                <div class="divider"></div>
                            </div>
                        </div>       
                        <div class="h2"></div>
                        <div class="row">
                            <div class="col-md-6">                                    
                                <a href="index.php" class="btn btn-start btn-block"><?php echo WORDING_VIEW_PROFILE; ?></a>
                            </div>
                            <div class="col-md-6">
                                <a href="index.php?logout" class="btn btn-default btn-block">Logout</a>
                            </div>
                        </div>                                                        
                    </div>
                    <!-- <div class="panel-footer text-center">                                                                                                
                        
                    </div> -->
                </div>                  
            </div>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 pull-left edit-content">
                <!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
                <form method="post" class="form-horizontal" role="form" action="edit.php" name="user_edit_form_name">
                    <div class="form-group">
                        <label for="user_name" class="col-sm-2 control-label">
                            <?php echo WORDING_USERNAME; ?>
                        </label>
                        <div class="col-sm-10">                           
                            <input class="form-control" id="user_name" type="text" name="user_name" required  value="<?php echo $_SESSION['user_name']; ?>"/> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-start pull-right" name="user_edit_submit_name" value="<?php echo WORDING_CHANGE_USERNAME; ?>" />
                        </div>
                    </div>                        
                </form>           
                <!-- edit form for user email / this form uses HTML5 attributes, like "required" and type="email" -->
                <form method="post" class="form-horizontal" role="form" action="edit.php" name="user_edit_form_email">
                    <div class="form-group">
                        <label for="user_email" class="col-sm-2 control-label">
                            <?php echo WORDING_EMAIL; ?>
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" id="user_email" type="email" name="user_email" required value=" <?php echo $_SESSION['user_email']; ?>"/>                                                             
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-start pull-right" name="user_edit_submit_email" value="<?php echo WORDING_CHANGE_EMAIL; ?>" />                                       
                        </div>
                    </div> 
                </form><hr/>            
                <form method="post" class="form-horizontal" role="form" action="edit.php" name="user_edit_form_social">
                    <div class="form-group">
                        <label for="user_twitter" class="col-sm-2 control-label">
                            Twitter
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" id="user_twitter" type="text" name="user_twitter" autocomplete="off" value="<?php echo $twitter; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_facebook" class="col-sm-2 control-label">Facebook</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="user_facebook" type="text" name="user_facebook" autocomplete="off" value="<?php echo $facebook; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_google_plus" class="col-sm-2 control-label">Google+</label>
                        <div class="col-sm-10">
                            <input class="form-control"id="user_google_plus" type="text" name="user_google_plus" autocomplete="off" value="<?php echo $googleplus; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input class="btn btn-start pull-right" type="submit" name="user_edit_social" value="Save Changes" />
                        </div>
                    </div>
                </form><hr/>
                <!-- edit form for user's password / this form uses the HTML5 attribute "required" -->
                <form method="post" class="form-horizontal" role="form" action="edit.php" name="user_edit_form_password">
                    <div class="form-group">
                        <label for="user_password_old" class="col-sm-2 control-label">
                            <?php echo WORDING_OLD_PASSWORD; ?>
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" id="user_password_old" type="password" name="user_password_old" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_password_new" class="col-sm-2 control-label">
                            <?php echo WORDING_NEW_PASSWORD; ?>
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" id="user_password_new" type="password" name="user_password_new" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_password_repeat" class="col-sm-2 control-label">
                            <?php echo WORDING_NEW_PASSWORD_REPEAT; ?>
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control"id="user_password_repeat" type="password" name="user_password_repeat" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input class="btn btn-start pull-right" type="submit" name="user_edit_submit_password" value="<?php echo WORDING_CHANGE_PASSWORD; ?>" />
                        </div>
                </form>          
                <!-- edit form for user's password / this form uses the HTML5 attribute "required" -->
            </div>
        </div>                
<!-- backlink -->
<!-- <a href="index.php"></a> -->
    </div>
<?php include('_footer.php'); ?>