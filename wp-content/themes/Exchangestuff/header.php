<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <!--  <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css"> -->
        <title>Exchange Stuff</title>

        <?php wp_head(); /*this is the spot where wordpress can enque the style sheets*/ ?>
    </head>

    <body id="Home">
       <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
            <div class="container">
                <a href="index.html" class="navbar-brand">Exchange Stuff</a>
                    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon">
                                
                            </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                   
                        <?php 
                        
                       wp_nav_menu( 
                            array(
                                'menu_id' => 'mega_menu',
                                'theme_location' => 'primary',
                                'container' => false,
                                'menu_class'=>'navbar-nav ml-auto',
                                'walker' => new Walker_Nav_Primary()
                                
                        ) ) 
                        
                        ?>
 
                    <!-- <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a href="#home" class="nav-link">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#explore-head-section" class="nav-link">Explore</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#create-head-section" class="nav-link">Create</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#share-head-section" class="nav-link">Share</a>
                                </li>


                        </ul> -->
                    </div>

            </div>

       </nav>