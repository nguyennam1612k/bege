<?php
    require_once './commons/db.php';
    require_once './commons/constants.php';
    require_once './commons/helpers.php';

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $user = isset($_SESSION[AUTH]) ? $_SESSION[AUTH] : null;
    if($user != null){
        $user_id = $user['id'];
    }
    if($id == null){
        //random id blog
        $sqlQuery = "SELECT u.name as user_name ,b.*
                    from blogs b
                    inner join users u
                        on u.id = b.user_id
                    order by rand() limit 1";
    }else{
        $sqlQuery = "SELECT u.name as user_name ,b.*
                    from blogs b
                    inner join users u
                        on u.id = b.user_id
                    where b.id=$id";
    }
    //select blog
    $blog = executeQuery($sqlQuery, false);
    // dd($blog);

    //Bài viết liên quan
    $tag_blog = $blog['tag'];
    $sqlQuery = "SELECT * from blogs where id!=$id order by rand() limit 3";
    $related = executeQuery($sqlQuery, true);

    //select comment
    $sqlQuery = "SELECT u.name, u.avatar ,b.*
                from blog_comments b
                inner join users u
                    on u.id=b.user_id
                where blog_id=$id and reply_for is null";
    $comments = executeQuery($sqlQuery, true);

    if(isset($_POST['btn_submit']) && $user != null){
        extract($_REQUEST);
        $content = str_replace("'","\'", $content);
        //Reply for
        if(isset($_POST['reply_for'])){
            $sqlInsert = "INSERT into blog_comments
                            (blog_id, content, user_id, reply_for)
                        values
                            ($id, '$content', $user_id, $reply_for)";
        }else{
            $sqlInsert = "INSERT into blog_comments
                            (blog_id, content, user_id)
                        values
                            ($id, '$content', $user_id)";
        }
        executeQuery($sqlInsert);
        dd($sqlInsert);
        //Chuyển trang
        // header('location: '.$_SERVER['HTTP_REFERER']);
        // die;
    }
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    
<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/single-blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:49:52 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Bege || Single Blog</title>
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
                                <span class="separator">/</span> Single Blog
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcrumbs End -->
            <!-- Page title -->
            <div class="entry-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="entry-title">Single Blog</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page title end -->
            <!-- cart page content -->
            <div class="blog-page-area">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="single-blog page-content blog-page blog-sidebar right-sidebar">
                                <!-- blog post -->
                                <article class="text-center">
                                    <div class="blog-entry-header">
                                        <div class="post-category">
                                            <a href="#"><?php echo $blog['tag'] ?></a>
                                        </div>
                                        <h1><a href="single-blog.html"><?php echo $blog['name'] ?></a></h1>
                                        <div class="post-meta">
                                            <a href="#"  class="post-author"><i class="fa fa-user"></i>Posted by <?php echo $blog['user_name'] ?></a>
                                            <a href="#" class="post-date"><i class="fa fa-calendar"></i> <?php echo $blog['created_at'] ?> </a>
                                        </div>
                                    </div>
                                    <div class="post-thumbnail">
                                        <?php if (isset($blog['link'])): ?>
                                            <?php echo $blog['link'] ?>
                                        <?php endif ?>
                                        <?php if (empty($blog['link'])): ?>
                                            <a href="#"><img src="<?php echo $blog['image'] ?>"></a>
                                        <?php endif ?>
                                    </div>
                                    <div class="postinfo-wrapper">
                                        <?php echo $blog['content'] ?>
                                        <div class="single-post-tag">
                                            <!-- Đếm số comment bài viết -->
                                            <?php 
                                            $blog_id = $blog['id'];
                                            $sqlQuery = "SELECT count(id) as count from blog_comments where blog_id=$blog_id";
                                            $count = executeQuery($sqlQuery, false);
                                             ?>
                                            <a class="comment-link" href="#"><?php echo $count['count'] ?> comments</a> / Tags: <a href="#" rel="tag"><?php echo $blog['tag'] ?></a>,
                                        </div>
                                        <div class="social-sharing">
                                            <h3>Share this post</h3>
                                            <div class="social-sharie">
                                                <ul class="social-icons">
                                                    <li><a class="facebook social-icon" href="#"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a class="twitter social-icon" href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a class="pinterest social-icon" href="#"><i class="fa fa-pinterest"></i></a></li>
                                                    <li><a class="gplus social-icon" href="#"><i class="fa fa-google-plus"></i></a></li>
                                                    <li><a class="linkedin social-icon" href="#"><i class="fa fa-linkedin"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <!-- blog post end -->
                                <div class="relatedposts">
                                    <h3>Related posts</h3>
                                    <div class="row">
                                        <!-- related post -->
                                        <?php if ($related != null): ?>
                                            <?php foreach ($related as $value): ?>
                                                <div class="relatedthumb col-md-4 col-sm-6">
                                                    <div class="image">
                                                        <a href="single-blog.php?id=<?php echo $value['id'] ?>"><img src="<?php echo $value['image'] ?>"></a>
                                                    </div>
                                                    <h4><a rel="external" href="single-blog.php?id=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h4>
                                                    <span class="post-date"> <?php echo $value['created_at'] ?> </span>
                                                </div>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                        <!-- related post end -->
                                    </div>
                                </div>
                            </div>
                            <div class="comments-area">
                                <h3><?php echo $count['count'] ?> comments</h3>
                                <!-- comment chính -->
                                <?php if ($comments != null): ?>
                                    
                                    <?php foreach ($comments as $value): ?>
                                        <ol class="commentlist">
                                            <li>
                                                <div class="single-comment">
                                                    <div class="comment-avatar">
                                                        <img style="width: 100px" src="<?php echo $value['avatar'] ?>" alt="comment image bege">
                                                    </div>
                                                    <div class="comment-info">
                                                        <a href="#"><?php echo $value['name'] ?></a>
                                                        <div class="reply">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                        <span class="date"><?php echo $value['created_at'] ?></span>
                                                        <p><?php echo $value['content'] ?></p>
                                                    </div>
                                                </div>
                                                <!-- recomment -->
                                                    <?php
                                                    //select recomment
                                                    $main_comment = $value['id'];
                                                    $sqlQuery = "SELECT u.name, u.avatar ,b.*
                                                    from blog_comments b
                                                    inner join users u
                                                    on u.id=b.user_id
                                                    where blog_id=$id and reply_for=$main_comment";
                                                    $reply_comment = executeQuery($sqlQuery, true);
                                                    // dd($reply_comment);
                                                    ?>
                                                    <?php if ($reply_comment != null): ?>
                                                        <?php foreach ($reply_comment as $oki): ?>
                                                            <ol>
                                                                <li>
                                                                    <div class="single-comment">
                                                                        <div class="comment-avatar">
                                                                            <img style="width: 100px" src="<?php echo $oki['avatar'] ?>" alt="comment image bege">
                                                                        </div>
                                                                        <div class="comment-info">
                                                                            <a href="#"><?php echo $oki['name'] ?></a>
                                                                            <span class="date"><?php echo $oki['created_at'] ?></span>
                                                                            <p><?php echo $oki['content'] ?></p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ol>
                                                        <?php endforeach ?>
                                                    <?php endif ?>

                                                <!-- recomment end -->
                                            </li>
                                        </ol>
                                    <?php endforeach ?>
                                <?php endif ?>
                                <!-- comment chính edn -->
                            </div>
                            <div class="comment-respond">
                                <h3>Leave a Reply </h3>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <form method="post">
                                    <div class="text-filds">
                                        <p class="comment-form-author">
                                            <label for="author">Reply for</label> 
                                            <select name="reply_for">
                                                <option style="font-style: italic;">Null</option>
                                                <?php if ($comments != null): ?>
                                                    <?php foreach ($comments as $value): ?>
                                                        <option value="<?php echo $value['id'] ?>">( *<?php echo $value['name'] ?> ) Nội dung comment: "<?php echo $value['content'] ?>"</option>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </select>
                                        </p>
                                        <label for="comment">Comment</label>
                                        <textarea id="comment" name="content" cols="45" rows="8" maxlength="65525" required="required"></textarea>
                                    </div>
                                    <div class="form-submit">
                                        <input name="btn_submit" type="submit" id="submit" class="submit" value="Post Comment">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- <div class="col-xs-12 col-md-3">
                            <div class="blog_sidebar">
                                <div class="row_products_side">
                                    <div class="product_left_sidbar">
                                        <div class="product-filter  mb-30">
                                          <h5>Search </h5>
                                          <div class="search__sidbar">
                                             <div class="input_form">
                                                <form method="get">
                                                    <input type="text" id="search_input" name="value_search_blog" placeholder="Search..." class="input_text">
                                                    <button id="blogsearchsubmit" type="submit" class="button">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </form>
                                             </div>
                                          </div>
                                        </div>
                                        <div class="product-filter  mb-30">
                                          <h5>Blog Archives </h5>
                                            <div class="blog_Archives__sidbar">
                                                <ul>
                                                    <li>
                                                        <a href="#">March 2015</a>&nbsp;(1)</li>
                                                    <li>
                                                        <a href="#">December 2014</a>&nbsp;(3)</li>
                                                    <li>
                                                        <a href="#">November 2014</a>&nbsp;(4)</li>
                                                    <li>
                                                        <a href="#">September 2014</a>&nbsp;(1)</li>
                                                    <li>
                                                        <a href="#">August 2014</a>&nbsp;(1)</li>
                                                </ul>
                                          </div>
                                        </div>
                                        <div class="product-filter  mb-30">
                                            <h5>Recent Posts</h5>
                                            <div class="blog_Archives__sidbar">
                                                <ul>
                                                    <li> <a href="#">Blog image post</a>&nbsp;(1)</li>
                                                    <li> <a href="#">Post with Gallery</a>&nbsp;(3)</li>
                                                    <li><a href="#">Post with Audio</a>&nbsp;(4)</li>
                                                    <li><a href="#">Post with Video</a>&nbsp;(1)</li>
                                                    <li><a href="#">Post with Text</a>&nbsp;(1)</li>
                                                    
                                                </ul>
                                          </div>
                                        </div>
                                        <div class="sidebar-single-banner">
                                            <a href="#">
                                                <img src="images/banner/shop-sidebar.jpg" alt="Banner">
                                            </a>
                                        </div>
                                        <div class="product-filter mb-30">
                                            <h5>product tags</h5>
                                                <div class="blog-tags">
                                                    <a href="#">brand</a>
                                                    <a href="#">black</a>
                                                    <a href="#">white</a>
                                                    <a href="#">chire</a>
                                                    <a href="#">table</a>
                                                    <a href="#">Lorem</a>
                                                    <a href="#">ipsum</a>
                                                    <a href="#">dolor</a>
                                                    <a href="#">sit</a>
                                                    <a href="#">amet</a>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- cart page content end -->
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
        <!-- Main js  -->
        <script src="js/main.js"></script>



        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
        </script>
        <script src="../../../www.google-analytics.com/analytics.js" async defer></script>
    </body>

<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/single-blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:49:58 GMT -->
</html>
