<?php
    $server=$_SERVER["SERVER_NAME"];
    $url=$_SERVER["PHP_SELF"];
    $arr=explode("/",$url);
    $root=$arr[1];
?>


<!DOCTYPE html>
<html lang="en-US">

<head>
    <!--required meta-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--title for this document-->
    <title>Soccer Spotlight</title>
    <!--favicon for this document-->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <!--keywords for this  document-->
    <meta name="keywords" content="Soccer Spotlight">
    <!--description for this document-->
    <meta name="description" content="Soccer Spotlight">
    <!--author of this document-->
    <meta name="author" content="Soccer Spotlight">

    <!--bootstrap 5 minified css source-->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <!--fontawesome 5 minified css source-->
    <link rel="stylesheet" href="assets/icons/font_awesome/css/all.min.css">
    <!--flaticon css source-->
    <link rel="stylesheet" href="assets/icons/flat_icon/flaticon.css">
    <!--owl carousel-2.3.4 minified css source-->
    <link rel="stylesheet" href="assets/css/vendor/owl.carousel.min.css">
    <!--owl carousel-2.3.4 theme default minified css source-->
    <link rel="stylesheet" href="assets/css/vendor/owl.theme.default.min.css">

    <!--animate css source-->
    <link rel="stylesheet" href="assets/css/vendor/animate.css">
    <!--custom css start-->
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body class="dark">


     <!--====header navbar start====-->
    <header> 
        <nav class="navbar fixed-top navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="assets/images/Logo-dark-n.png" alt="Soccer Spotlight Logo" id="logo">
                </a>
                <div class="d-flex flex-row order-2 order-lg-3 user_info">
                    <?php
                        if(!isset($_COOKIE["email"]))
                        {
                    ?>
                    <div class="group_btn d-none d-sm-block">
                        <a href="login.php" class="group_link log_in registration">LOG IN</a>
                        <a href="signup.php" class="group_link registration ">SIGN UP</a>
                    </div>
                    <?php
                        }
                    ?>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navDefault" aria-controls="navDefault" aria-expanded="false" aria-label="Toggle navigation" id="toggleIcon">
                        <span class="bar_one"></span>
                        <span class="bar_two"></span>
                        <span class="bar_three"></span>
                    </button>
                    <div class="profile">
                        <div class="avatar">
                            <div class="avatar-content">
                                <a href="#" style="text-decoration:none">
                                    <img src="assets/images/dp.png" alt="dp">
                                        <span>
                                            <?php
                                                session_start();
                                                if(isset($_COOKIE["email"]))
                                                {
                                                    include "includes/session.php";
                                            ?>
                                                <?=$data["first_name"]." ".$data["last_name"]?>
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                                    <?="Guest"?>
                                            <?php
                                                }
                                            ?>
                                        </span>
                                    </a>
                                    <?php
                                    if(isset($_COOKIE["email"]))
                                    {
                                    ?>
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    <?php
                                    }
                                    ?>
                            </div>
                            <?php
                                if(isset($_COOKIE["email"]))
                            {
                            ?>
                                <div class="dropdown">
                                    <ul>
                                        <li><a href="http://<?=$server?>/<?=$root?>/Admin/my-profile.php"><img src="assets/images/user.svg" alt="user">My Profile</a>
                                        </li>
                                        <li>
                                            <a href="my-matches.php"><img src="assets/images/stadium.svg" alt="stadium">My Matches</a>
                                        </li>
                                        <li>
                                            <a href="http://<?=$server?>/<?=$root?>/Admin/logout.php"><img src="assets/images/logout.svg" alt="logout">log Out</a>
                                        </li>
                                    </ul>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                   </div>
                </div>
                <div class="collapse navbar-collapse justify-content-end order-3 order-lg-2" id="navDefault">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php" >
                                HOME
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">ABOUT US</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="how-to-play.php">HOW TO PLAY</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link pd_right" href="contact.php">CONTACT US</a>
                        </li>
                        <li class="nav-item d-block d-sm-none"> 
                            <a class="nav-link registration" href="login.php">LOG IN</a>
                        </li>
                        <li class="nav-item d-block d-sm-none">
                            <a class="nav-link registration " href="signup.php">SIGN UP</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!--====header navbar end====-->
	<!--====banner section start====-->
    <section class="contact_banner_wrapper bg-dark">
        <div class="container">
            <h1 class="hero_title">About Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </section>
    <!--====banner section end====-->
	<!--====passion section start====-->
	<section class="passion_wrapper">
        <div class="container">
            <div class="row passion_row d-flex align-items-center">
                <div class="col-lg-6 order-last order-lg-first">
                    <div class="left_col text-center text-lg-start">
                        <img src="assets/images/about-banner.jpg" alt="img">
                    </div>
                </div>
                <div class="col-lg-6 order-first order-lg-last">
                    <div class="right_col">
                        <h4 class="secondary">A Few Words About Us</h4>
                        <h1 class="section_title">Love and Passion for the Game</h1>
                        <p class="para">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <p class="para">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<!--====passion section end====-->
	 <!--====experience section start====-->
    <section>
        <div class="container">
            <div class="experience">
                <div class="experience_content text-center">
                    <h1 class="section_title">Experience the future of fantasy sports</h1>
                    <p class="section_info">Buy & Sell Shares in Favourite Players</p>
                    <a href="#" class="btn btn-primary">Sign Up Today!</a>
                </div>
            </div>
        </div>
    </section>
    <!--====experience section end====-->
	
	<!--====testimonial section start====-->
    <section class="testimonial_section">
        <div class="container">
            <div class="testimonial_title_wrapper text-center">
                <h1 class="section_title">What do you like most about the stock market of sports?</h1>
            </div>
			
			<div class="game_slider_row owl-carousel owl-theme">          
                
                <div class="slider_items testimonial_row">
                    <div class="inner ">
                        <p class="para">
                      Brilliant site guys, we'll be moving our fantasy league
                      over to you next season, we tried it this year on a small
                      scale and we're very impressed.
                    </p>
                        <div class="members_info d-flex align-items-center">
                            <div class="avatar">
                                <a href="#">
                                    <img src="assets/images/testimonial/ava_1.png" alt="Mike Tucker">
                                </a>
                            </div>
                            <div class="name flex-grow-1">
                                <h6>
                                    <a href="#">- Kris Chambers</a>
                                </h6>
                                <span>New York</span>
                            </div>
                            <div class="twitter_account">
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider_items testimonial_row">
                   <div class="inner">
                        <p class="para">
                      It’s really fun. Really competitive...
                      I think it’s a lot better than normal fantasy football...
                      I invited my mates to do it. We enjoyed it so we made a
                      video out of it... I think it’s a cool football thing you
                      should check out. Enjoy.
                    </p>
                        <div class="members_info d-flex align-items-center">
                            <div class="avatar">
                                <a href="#">
                                    <img src="assets/images/testimonial/ava_2.png" alt="Mike Tucker">
                                </a>
                            </div>
                            <div class="name flex-grow-1">
                                <h6>
                                    <a href="#">- Spencer Owen</a>
                                </h6>
                                <span>Washington, DC</span>
                            </div>
                            <div class="twitter_account">
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider_items testimonial_row">
                  <div class="inner">
                        <p class="para">
                      Undoubtedly the best Fantasy football format. Every year
                      in regular Fantasy leagues folk lose interest after 6 weeks,
                      not with @DraftFantasy.
                    </p>
                        <div class="members_info d-flex align-items-center">
                            <div class="avatar">
                                <a href="#">
                                    <img src="assets/images/testimonial/ava_3.png" alt="Mike Tucker">
                                </a>
                            </div>
                            <div class="name flex-grow-1">
                                <h6>
                                    <a href="#">- TheFish @fraserforrest</a>
                                </h6>
                                <span>Chicago, IL</span>
                            </div>
                            <div class="twitter_account">
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
			
			
            <div class="row testimonial_row">
                <div class="col-md-6 col-lg-4">
                    
                </div>
                <div class="col-md-6 col-lg-4">
                   
                </div>
                <div class="col-md-6 col-lg-4">
                    
                </div>
            </div>
        </div>
    </section>
    <!--====testimonial section end====-->

    <!--====footer navbar start-->
   <footer>
        <div class="container">
            <div class="row footer_nav d-flex align-items-center">
                <div class="col-lg-12">
                    <ul class="nav justify-content-center ">
                        <li class="nav-item">
                            <a class="nav-link ml-0" href="contact.php">CONTACT US</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">TERMS OF USE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">PRIVACY POLICY</a>
                        </li>
                    </ul>
                </div>
               
            </div>
            <hr>
            <div class="row footer_copyright d-flex align-items-center">
                <div class="col-lg-7 text-center text-sm-start">
                    <p class="para">Copyright &#169; Soccer Spotlight 2024.</p>
                </div>
                <div class="col-lg-5 text-center text-sm-start text-lg-end">
                    <p class="para">All rights reserved</p>
                </div>
            </div>
        </div>
    </footer>
    <!--====footer navbar end====-->

    <!--===scroll bottom to top===-->
    <a href="#" class="scrollToTop"><i class="flaticon-up-chevron"></i></a>
    <!--===scroll bottom to top===-->


    <!--====js scripts start====-->
    <!--jquery-3.6.0 minified source-->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <!--bootstrap 5 minified bundle js source-->
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <!--waypoints-4.0.0 minified js source-->
    <script src="assets/js/vendor/jquery.waypoints.min.js"></script>
    <!--counter up-1.0.0 minified js source-->
    <script src="assets/js/vendor/jquery.counterup.min.js"></script>
    <!--owl carousel-2.3.4 minified js source-->
    <script src="assets/js/vendor/owl.carousel.min.js"></script>
    <!--magnific popup-1.1.0 js source-->
    <script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <!--jquery nice select minified source-->
    <script src="assets/js/vendor/jquery.nice-select.min.js"></script>
    <!--wow-1.1.3 minified js source-->
    <script src="assets/js/vendor/wow.min.js"></script>
    <!--custom js source-->
    <script src="assets/js/main.js"></script>
    <!--====js scripts end====-->
</body>

</html>