<?php include 'index_php.php'; ?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Users View - Frest - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-users.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <!-- INCLUDING THE HEADER NAVBAR -->
    <?php include 'header_nav.php'; ?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <?php include 'main_nav.php'; ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users view start -->
                <section class="users-view">
                    <!-- users view media object start -->
                    <div class="row">
                        <div class="col-12 col-sm-7">
                            <div class="media mb-2">
                                <a class="mr-1" href="#">
                                    <img src="../../../app-assets/images/portrait/small/avatar-s-26.jpg" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="64" width="64">
                                </a>
                                <div class="media-body pt-25">
                                    <h4 class="media-heading"><span class="users-view-name">Dean Stanley </span><span class="text-muted font-medium-1"> @</span><span class="users-view-username text-muted font-medium-1 ">candy007</span></h4>
                                    <span>ID:</span>
                                    <span class="users-view-id">305</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                            <a href="#" class="btn btn-sm mr-25 border"><i class="bx bx-envelope font-small-3"></i></a>
                            <a href="#" class="btn btn-sm mr-25 border">Profile</a>
                            <a href="../../../html/ltr/vertical-menu-template/page-users-edit.html" class="btn btn-sm btn-primary">Edit</a>
                        </div>
                    </div>
                    <!-- users view media object ends -->
                    <!-- users view card data start -->
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>Registered:</td>
                                                    <td>01/01/2019</td>
                                                </tr>
                                                <tr>
                                                    <td>Latest Activity:</td>
                                                    <td class="users-view-latest-activity">30/04/2019</td>
                                                </tr>
                                                <tr>
                                                    <td>Verified:</td>
                                                    <td class="users-view-verified">Yes</td>
                                                </tr>
                                                <tr>
                                                    <td>Role:</td>
                                                    <td class="users-view-role">Staff</td>
                                                </tr>
                                                <tr>
                                                    <td>Status:</td>
                                                    <td><span class="badge badge-light-success users-view-status">Active</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Module Permission</th>
                                                        <th>Read</th>
                                                        <th>Write</th>
                                                        <th>Create</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Users</td>
                                                        <td>Yes</td>
                                                        <td>No</td>
                                                        <td>No</td>
                                                        <td>Yes</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Articles</td>
                                                        <td>No</td>
                                                        <td>Yes</td>
                                                        <td>No</td>
                                                        <td>Yes</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Staff</td>
                                                        <td>Yes</td>
                                                        <td>Yes</td>
                                                        <td>No</td>
                                                        <td>No</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- users view card data ends -->
                    <!-- users view card details start -->
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
                                    <div class="col-12 col-sm-4 p-2">
                                        <h6 class="text-primary mb-0">Posts: <span class="font-large-1 align-middle">125</span></h6>
                                    </div>
                                    <div class="col-12 col-sm-4 p-2">
                                        <h6 class="text-primary mb-0">Followers: <span class="font-large-1 align-middle">534</span></h6>
                                    </div>
                                    <div class="col-12 col-sm-4 p-2">
                                        <h6 class="text-primary mb-0">Following: <span class="font-large-1 align-middle">256</span></h6>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>Username:</td>
                                                <td class="users-view-username">dean3004</td>
                                            </tr>
                                            <tr>
                                                <td>Name:</td>
                                                <td class="users-view-name">Dean Stanley</td>
                                            </tr>
                                            <tr>
                                                <td>E-mail:</td>
                                                <td class="users-view-email">deanstanley@gmail.com</td>
                                            </tr>
                                            <tr>
                                                <td>Comapny:</td>
                                                <td>XYZ Corp. Ltd.</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <h5 class="mb-1"><i class="bx bx-link"></i> Social Links</h5>
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>Twitter:</td>
                                                <td><a href="#">https://www.twitter.com/</a></td>
                                            </tr>
                                            <tr>
                                                <td>Facebook:</td>
                                                <td><a href="#">https://www.facebook.com/</a></td>
                                            </tr>
                                            <tr>
                                                <td>Instagram:</td>
                                                <td><a href="#">https://www.instagram.com/</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h5 class="mb-1"><i class="bx bx-info-circle"></i> Personal Info</h5>
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Birthday:</td>
                                                <td>03/04/1990</td>
                                            </tr>
                                            <tr>
                                                <td>Country:</td>
                                                <td>USA</td>
                                            </tr>
                                            <tr>
                                                <td>Languages:</td>
                                                <td>English</td>
                                            </tr>
                                            <tr>
                                                <td>Contact:</td>
                                                <td>+(305) 254 24668</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- users view card details ends -->

                </section>
                <!-- users view ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- demo chat-->
    <div class="widget-chat-demo">
        <!-- widget chat demo footer button start -->
        <button class="btn btn-primary chat-demo-button glow px-1"><i class="livicon-evo" data-options="name: comments.svg; style: lines; size: 24px; strokeColor: #fff; autoPlay: true; repeat: loop;"></i></button>
        <!-- widget chat demo footer button ends -->
        <!-- widget chat demo start -->
        <div class="widget-chat widget-chat-demo d-none">
            <div class="card mb-0">
                <div class="card-header border-bottom p-0">
                    <div class="media m-75">
                        <a href="JavaScript:void(0);">
                            <div class="avatar mr-75">
                                <img src="../../../app-assets/images/portrait/small/avatar-s-2.jpg" alt="avtar images" width="32" height="32">
                                <span class="avatar-status-online"></span>
                            </div>
                        </a>
                        <div class="media-body">
                            <h6 class="media-heading mb-0 pt-25"><a href="javaScript:void(0);">Kiara Cruiser</a></h6>
                            <span class="text-muted font-small-3">Active</span>
                        </div>
                        <i class="bx bx-x widget-chat-close float-right my-auto cursor-pointer"></i>
                    </div>
                </div>
                <div class="card-body widget-chat-container widget-chat-demo-scroll">
                    <div class="chat-content">
                        <div class="badge badge-pill badge-light-secondary my-1">today</div>
                        <div class="chat">
                            <div class="chat-body">
                                <div class="chat-message">
                                    <p>How can we help? 😄</p>
                                    <span class="chat-time">7:45 AM</span>
                                </div>
                            </div>
                        </div>
                        <div class="chat chat-left">
                            <div class="chat-body">
                                <div class="chat-message">
                                    <p>Hey John, I am looking for the best admin template.</p>
                                    <p>Could you please help me to find it out? 🤔</p>
                                    <span class="chat-time">7:50 AM</span>
                                </div>
                            </div>
                        </div>
                        <div class="chat">
                            <div class="chat-body">
                                <div class="chat-message">
                                    <p>Stack admin is the responsive bootstrap 4 admin template.</p>
                                    <span class="chat-time">8:01 AM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top p-1">
                    <form class="d-flex" onsubmit="widgetChatMessageDemo();" action="javascript:void(0);">
                        <input type="text" class="form-control chat-message-demo mr-75" placeholder="Type here...">
                        <button type="submit" class="btn btn-primary glow px-1"><i class="bx bx-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- widget chat demo ends -->

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
   <?php include 'footer.php'; ?>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/page-users.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>