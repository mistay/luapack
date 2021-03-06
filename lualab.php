<?php
/*
  Template Name: lualab
 */
?>
<!DOCTYPE html>

<html lang="en">
    
    <head>
        <meta charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo get_the_title(); ?></title>
        
        <!-- Load Arvo font -->
        <link href='http://fonts.googleapis.com/css?family=Arvo:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <!-- Load Brandon Grotesque font -->
        <link href="" rel='stylesheet' type="text/css">
        
        <!-- Load CSS styles -->
        <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url'); ?>/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url'); ?>/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url'); ?>/stylelualab.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url'); ?>/css/bootstrap-responsive.css" />
        
        <!-- Load JS -->
        <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jquery.easing.min.js"></script>	
	    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jquery.mixitup.min.js"></script>
	
	   
	    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/unslider/unslider.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $('.banner').unslider({
                    speed: 500,               //  The speed to animate each slide (in milliseconds)
                    delay: 3000,              //  The delay between slide animations (in milliseconds)
                    complete: function() {},  //  A function that gets called after every slide animation
                    keys: true,               //  Enable keyboard (left, right) arrow shortcuts
                    dots: false,              //  Display dot navigation
                    fluid: true               //  Support responsive design. May break non-responsive designs
                });
            });
        </script>
        <style>
            .banner ul { margin: 0px; }
            .banner li { min-height: 600px; }
            .banner { position: relative; overflow: auto; }
                .banner li { list-style: none; }
                    .banner ul li { float: left; }
        </style>


	<script>
		function Shufflearray(o) {
			for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
			return o;
		};

		function shuffleimages() {
			var images = [];
			$('.portfolio-wrapper img').each(function() {
				console.log(this);
				images.push(this);
				this.remove();
			});
			Shufflearray(images);
			$('.portfolio-wrapper').each(function() {
                                $(this).append(images.pop(this));
                        });
		}

		$( document ).ready(function() {
			//shuffleimages();
		});
	</script>
    
    
    
	    <script type="text/javascript">
            
        // Stick navbar to top
        
        
        
        $(window).scroll(function () {

            if ($(this).scrollTop() > 130) {
                $('.navbar').addClass('navbar-fixed-top');
            } else {
                $('.navbar').removeClass('navbar-fixed-top');
            }
        }); 
            
        // MixItUp plugin

        $(function () {
            var filterList = {
                init: function () {
			
				$('#portfoliolist').mixitup({
					targetSelector: '.portfolio',
					filterSelector: '.filter',
					effects: ['fade'],
					easing: 'snap',
					// call the hover effect
					onMixEnd: filterList.hoverEffect()
				});				
			},
			
			hoverEffect: function () {
			
        // Simple parallax
				$('#portfoliolist .portfolio').hover(
					function () {
						$(this).find('.label').stop().animate({bottom: 0}, 200, 'easeOutQuad');
						$(this).find('img').stop().animate({top: -30}, 500, 'easeOutQuad');				
					},
					function () {
						$(this).find('.label').stop().animate({bottom: -40}, 200, 'easeInQuad');
						$(this).find('img').stop().animate({top: 0}, 300, 'easeOutQuad');								
					}		
				);				
			
			}

		};
		
		// Run
		filterList.init();
		
	});	
            
	</script>

    </head>
    
    <body>

        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                   
                   <!-- Logo -->
                    <a href="#" class="brand">
                        <img src="<?php echo get_bloginfo('template_url'); ?>/images/logo_lualab.svg" width="80" height="80" alt="Logo" />
                    </a>
                    
                    <!-- Menu button, small screen -->
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <img class="icon-menu" src="<?php echo get_bloginfo('template_url'); ?>/images/menu.svg" width="30" height="30" alt="Menu" />
                    </button>
                    
                    <!-- Start main navigation -->
                    <div class="nav-collapse collapse pull-right">
                        <ul class="nav" id="top-navigation">


<?php
// query all pages that are derived from lualab template
$pages = get_pages(array(
	'meta_key' => '_wp_page_template',
	'meta_value' => 'lualab.php',
	'sort_column' => 'menu_order', 
  	'sort_order' => 'ASC', 

));
	$this_page_id=$wp_query->post->ID;
foreach ($pages as $page) {
	$active = $this_page_id == $page->ID? "active" :"";
	echo "<li class='$active'><a href='" . ($page->guid) . "'>" .($page->post_name) . "</a></li>";

}

?>

                        </ul>
                    </div>

                    <!-- End main navigation -->
                    
                </div>
            </div>
        </div>
<?php
	 while ( have_posts() ) {
                the_post(); 
//print_r($post);
		$page = $post;

		$filename = get_theme_root() . "/lua/sections/" . $post -> post_name.  ".html";
                if (file_exists($filename)) {
//echo "filename: $filename";
                        include($filename);
                }


	}
	$children = query_posts(array('showposts' => 20, 'post_parent' => $this_page_id, 'post_type' => 'page'));
	foreach ($children as $child) {
		$page = $child;

		$filename = get_theme_root() . "/lua/sections/" . $child -> post_name . ".html"; 
                if (file_exists($filename)) {
                        include($filename);
                }


        }

?>

        
        
        <!-- Footer section start -->
        <div class="footer">
            <p>&copy; 2015 by <a href="http://www.lualab.com">LUA LAB</a> – Choose the perfect dose.</p>
        </div>
        <!-- Footer section end -->
        <!-- ScrollUp button start -->
        <div class="scrollup">
            <a href="#">
                <i class="icon-up-open"></i>
            </a>
        </div>
        <!-- ScrollUp button end -->
        
    </body>
</html>
