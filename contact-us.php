<!DOCTYPE html>
<html class="no-js" lang="en">
    
<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/contact-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:49:24 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Bege || Contact Us</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="images/icons/icon_logo.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/ionicons.min.css">
        <link rel="stylesheet" href="css/css-plugins-call.css">
        <link rel="stylesheet" href="css/bundle.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="css/colors.css">
    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!-- Add your site or application content here -->

        <!-- Body main wrapper start -->
        <div class="wrapper home-one home-two">
            <!-- HEADER AREA START -->
            <?php include "includes/header.php" ?>
            <!-- HRADER AREA END -->
            <!-- Breadcrumbs -->
            <div class="breadcrumbs-container">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <nav class="woocommerce-breadcrumb">
                                <a href="index.html">Home</a>
                                <span class="separator">/</span> About
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcrumbs End -->
            <!-- Contact page content -->
            <div class="contact-page-area">
                <!-- contact page map -->
                <div class="contact-page-map">
                    <!-- Google Map Start -->
                    <div class="container-fluid">
                        <div id="map"></div>
                    </div>
                    <!-- Google Map End -->
                </div>
                <!-- contact page map -->
                <!-- contact form area -->
                <div class="contact-form-area">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                                <div class="contact-form-inner">
                                    <h2>TELL US YOUR PROJECT</h2>
                                    <form action="http://preview.hasthemes.com/bege-v4/bege/mail.php" method="get">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="First name*" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Last name*" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Email*" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Subject*" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true"
                                                    aria-invalid="false" placeholder="Message *" required></textarea>
                                            </div>
                                        </div>
                                        <div class="contact-submit">
                                            <input type="submit" value="Send Email" class="wpcf7-form-control wpcf7-submit button">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                                <div class="contact-address-area">
                                    <h2>CONTACT US</h2>
                                    <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est
                                        notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum formas human.</p>
                                    <ul>
                                        <li>
                                            <i class="fa fa-fax">&nbsp;</i> Address : No 40 Baria Sreet 133/2 NewYork City</li>
                                        <li>
                                            <i class="fa fa-phone">&nbsp;</i> Info@roadthemes.com</li>
                                        <li>
                                            <i class="fa fa-envelope-o"></i>&nbsp;</i> 0(1234) 567 890</li>
                                    </ul>
                                    <h3>
                                        <strong>Working hours</strong>
                                    </h3>
                                    <p>
                                        <strong>Monday – Saturday</strong>: &nbsp;08AM – 22PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- contact form area end -->
            </div>
            <!-- Contact page content end -->
            <?php include "includes/footer.php" ?>

            <!-- QUICKVIEW PRODUCT START -->
            <?php include "includes/quickview.php" ?>
            <!-- QUICKVIEW PRODUCT END -->
        </div>
        <!-- Body main wrapper end -->


        <!-- jQuery CDN -->
        <script src="../../../code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <!-- jQuery Local -->
        <script>window.jQuery || document.write('<script src="js/jquery-3.2.1.min.js"><\/script>')</script>

        <!-- Popper min js -->
        <script src="js/popper.min.js"></script>
        <!-- Bootstrap min js  -->
        <script src="js/bootstrap.min.js"></script>
        <!-- All plugins here -->
        <script src="js/plugins.js"></script>
        <!-- google map js -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAq7MrCR1A2qIShmjbtLHSKjcEIEBEEwM"></script>
        <script>
            // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', init);

            function init() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 11,

                    scrollwheel: false,

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(23.761226, 90.420766), // New York

                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{
                            "featureType": "administrative",
                            "elementType": "labels.text.fill",
                            "stylers": [{
                                "color": "#444444"
                            }]
                        },
                        {
                            "featureType": "landscape",
                            "elementType": "all",
                            "stylers": [{
                                "color": "#f2f2f2"
                            }]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "all",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        },
                        {
                            "featureType": "road",
                            "elementType": "all",
                            "stylers": [{
                                    "saturation": -100
                                },
                                {
                                    "lightness": 45
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "all",
                            "stylers": [{
                                "visibility": "simplified"
                            }]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels.icon",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "all",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        },
                        {
                            "featureType": "water",
                            "elementType": "all",
                            "stylers": [{
                                    "color": "#314453"
                                },
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry.fill",
                            "stylers": [{
                                    "lightness": "-12"
                                },
                                {
                                    "saturation": "0"
                                },
                                {
                                    "color": "#4bc7e9"
                                }
                            ]
                        }
                    ]
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(23.761226, 90.420766),
                    map: map,
                    title: 'Snazzy!'
                });
            }
        </script>
        <!-- Main js  -->
        <script src="js/main.js"></script>



        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
        </script>
        <script src="../../../www.google-analytics.com/analytics.js" async defer></script>
    </body>

<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/contact-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:49:24 GMT -->
</html>
