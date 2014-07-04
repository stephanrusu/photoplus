	</div>
	<!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script type="text/javascript" src="../js/vendor/jquery-1.10.2.min.js"><\/script>')</script>-->
    <script type="text/javascript" src="../js/vendor/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../js/vendor/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/prefixfree.min.js"></script>
    <script type="text/javascript" src="../js/plugins.js"></script>
    <script tyoe="text/javascript" src="../js/bootstrap-notify.js"></script>
    <script type="text/javascript" src="../js/nicescroll.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>   
	<script type="text/javascript">
	$(function(){	
		$("html").niceScroll({cursorcolor:"#333",cursoropacitymax:0.6,cursorwidth:10});	
		window.setTimeout(function() { $(".alert-info").alert('close'); }, 2000);
	/* loading button */
		// $('#loginBtn').click(function () {
		// 	var btn = $(this);
		// 	btn.button('loading');
		// 	// perform ajax processing here is reset button when complete
		// 	setTimeout(function() {
		// 	btn.button('reset');
		// 	}, 2000);		 
		// });
		// $('#registerBtn').click(function () {
		// 	var btn = $(this);
		// 	btn.button('loading');
		// 	// perform ajax processing here is reset button when complete
		// 	setTimeout(function() {
		// 	btn.button('reset');
		// 	}, 2000);		 
		// });	
		$(".caption-info").popover({
            html: true,
			trigger: 'focus',
            placement: 'left',
            title:  function() {
                return $(this).parent().find('.head').html();
            },
            content: function() {
                return $(this).parent().find('.content').html();
            }
		});		
        $(".panel-caption").tooltip({
            selector: '[data-toggle=tooltip]'
        });
		$(".panel-caption").on('click','.deleteBtn', function() {
            var clicked = $(this);
            var infoData = clicked.parent().find("input.uniqueId").serialize() + "&delete=1";
            //alert(infoData);
            $.ajax({
                type : "post",
                url : "../editor/delete.php",
                dataType : "json",
                data: infoData,
                success : function(data) {
                    if(data.success) {
                        $(".top-right").notify({
                            message : {
                                text : data.message
                            },
                            type: 'success',
                            fadeOut : {
                                delay: 5000
                            }
                        }).show();
                        window.location.reload();
                    }
                    else {
                        $(".top-right").notify({
                            message : {
                                text : data.message
                            },
                            type: 'danger',
                            fadeOut : {
                                delay: 5000
                            }
                        }).show();
                    }
                },
                error : function(data) {
                    $('.top-right').notify({
                        message : {
                            text : data.message
                        },
                        type : 'danger',
                        fadeOut : {
                            delay: 5000
                        }
                    }).show();
                }
            });
        });	
	});
	</script>
    </body>
</html>