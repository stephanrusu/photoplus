<?php include('_header.php');  require_once("paginate.php"); ?>
        <div class="container">
            <div class="row row-top">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 pull-right" > 
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
                                    <a href="edit.php" class="btn btn-start btn-block"><?php echo WORDING_EDIT_PROFILE; ?></a>
                                </div>
                                <div class="col-md-6">
                                    <a href="index.php?logout" class="btn btn-default btn-block">Logout</a>
                                </div>
                            </div>                                                        
                        </div>
                        <div class="panel-footer text-center">                                                                                                
                            <ul class="social-links">
                                <li><a href="mailto:<?php echo $_SESSION['user_email']; ?>"><i class="fa fa-envelope fa-fw"></i></a></li>
                                <?php if(!empty($twitter)) { ?><li><a class="twitter-link" href="http://twitter.com/<?php echo $twitter; ?>"><i class="fa fa-twitter fa-fw"></i></a></li> <?php } ?>
                                <?php if(!empty($facebook)) { ?><li><a class="facebook-link" href="https://facebook.com/<?php echo $facebook ?>"><i class="fa fa-facebook fa-fw"></i></a></li> <?php } ?>
                                <?php if(!empty($googleplus)) { ?><li><a class="googleplus-link" href="http://plus.google.com/<?php echo $googleplus; ?>"><i class="fa fa-google-plus fa-fw"></i></a></li><?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 pull-left">                    
                    <div class="text-center">
                        <?php  echo $paginate;?>
                    </div>
                    <div id="project-frames">
                        <?php
                            while($row = $query_limit->fetch(PDO::FETCH_ASSOC)) {  
                                $panel = '<div class="panel panel-default iframe-wrap panel-caption">                                    
                                        <a href="javascript:void(0);" class="caption-info"><i class="fa fa-info fa-fw"></i></a>                                    
                                        <div class="head hide">'.$row["title"].'</div>
                                        <div class="content hide"> 
                                            <p>'.$row["description"].'</p>
                                            <div class="info-buttons">
                                                <a href="http://localhost/photoplus/editor/'.$row["unique_id"].'" target="_blank" class="btn btn-default viewProject">View project</a>
                                                <button data-toggle="tooltip" data-placement="top" title="Delete"  type="button" class="btn btn-default pull-right deleteBtn" id=""><i class="fa fa-trash-o fa-fw fa-lg"></i></button>
                                                <input type="hidden" name="uniqueId" value="'.$row["unique_id"].'" class="uniqueId"/>
                                            </div>
                                            <hr/>
                                            <div class="text-center">
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Share on Facebook" class="btn btn-social-icon btn-facebook"><i class="fa fa-lw fa-facebook"></i></a>&ensp;
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Share on Google+" class="btn btn-social-icon btn-google-plus"><i class="fa fa-lw fa-google-plus"></i></a>&ensp;
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Share on Twitter" class="btn btn-social-icon btn-twitter"><i class="fa fa-lw fa-twitter"></i></a>
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Share on Flickr" class="btn btn-social-icon btn-flickr"><i class="fa fa-flickr"></i></a>&ensp;
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Share on Pinterest" class="btn btn-social-icon btn-pinterest"><i class="fa fa-lw fa-pinterest"></i></a>&ensp;
                                            </div>
                                        </div>
                                        <div class="cover-link"></div>
                                        <iframe style="width:100%; height:470px;" frameborder="0" sandbox="allow-scripts allow-pointer-lock allow-same-origin" 
                                                data-src="http://localhost/photoplus/editor/view-project-static.php?uid='.$row["unique_id"].'" scrolling="no"
                                                allowtransparency="true" data-title="" data-slug-hash="'.$row["unique_id"].'" 
                                                src="http://localhost/photoplus/editor/view-project-static.php?uid='.$row["unique_id"].'" ></iframe>
                                        
                                      </div>'."\n";                                      
                                echo $panel;
                            }
                        ?>
                    </div>
                    <div class="text-center">
                        <?php  echo $paginate;?>
                    </div>
                </div>                
            </div>    
        </div>
        <a href="#" class="btn back-to-top btn-to-top-light btn-to-top-bottom" data-toggle="tooltip" data-placement="top" title="Back to top"> <span class="fa fa-chevron-up"></span> </a>
<?php include('_footer.php'); ?>
