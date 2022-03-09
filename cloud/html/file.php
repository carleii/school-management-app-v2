<?php
require_once 'class_package.php';
require_once 'root.php';
$message = "";

?>



 <!doctype html>
 <html lang="en" dir="html">
 <head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="icon" href="favicon.ico" type="image/x-icon"/>
 <title><?php $system->page_name('Home') ?></title>

 <!-- Bootstrap Core and vandor -->
 <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css" />
 <link rel="stylesheet" href="../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
 <link rel="stylesheet" href="../assets/plugins/dropify/css/dropify.min.css">

 <!-- Core css -->
 <link rel="stylesheet" href="../assets/css/style.min.css"/>
 </head>

 <body class="font-muli dark-mode gradient">

 <!-- Page Loader -->
 <!-- <div class="page-loader-wrapper">
     <div class="loader">
     </div>
 </div> -->

 <div id="main_content">
    <?php
       // include 'main_nav.php';
    ?>


    <!-- Start project content area -->
    <div class="page">
         <!-- Start Page header -->
         <?php
             // include 'page_header.php';
         ?>
         <!-- Start Page title and tab -->
         <div class="section-body">
             <div class="container-fluid">
                 <div class="d-flex justify-content-between align-items-center ">
                     <div class="header-action">
                         <h1 class="page-title">Dashboard</h1>
                         <ol class="breadcrumb page-breadcrumb">
                             <li class="breadcrumb-item"><a href="#">THIB</a></li>
                             <li class="breadcrumb-item"><a href="./?cld_out" title="Exit the current Library and move to your private data">SERVER</a></li>
                             <?php
                             if (isset($cloud)==true) {
                                if (isset($folder)==true) {
                                  ?>
                                  <li class="breadcrumb-item"> <a href="./">
                                     <?php echo $retVal = ($cloud->get_type()==0) ? "PUBLIC :" : "PRIVATE :" ; ?>Library  <?php echo $cloud->get_name(); ?></a></li>
                                  <li class="breadcrumb-item"> <a href="./?f_ktsp=<?php echo base64_encode($folder->get_code_folder_in()); ?> ">Back</a></li>
                                  <li class="breadcrumb-item active" aria-current="page"> <a href="./?f_ktsp=<?php echo base64_encode($folder->get_code_folder()); ?> "><?php echo $folder->get_name(); ?></a></li>
                                  <?php
                                  // code...
                               }
                               else {
                                  ?>
                                  <li class="breadcrumb-item"> <a href="./">
                                     <?php echo $retVal = ($cloud->get_type()==0) ? "PUBLIC: " : "PRIVATE: " ; ?>Library  <?php echo $cloud->get_name(); ?></a></li>
                                  <?php
                                  // code...
                               }
                                // code...
                             }else {
                                if (isset($folder)==true) {
                                  ?>
                                  <li class="breadcrumb-item"> <a href="./" title="Move to your home personnal data">My Personnal Library</a></li>
                                  <li class="breadcrumb-item"> <a href="./?f_ktsp=<?php echo base64_encode($folder->get_code_folder_in()); ?> " title="Move to the previous folder">Back</a></li>
                                  <li class="breadcrumb-item active" aria-current="page"> <a href="./?f_ktsp=<?php echo base64_encode($folder->get_code_folder()); ?> "><?php echo $folder->get_name(); ?></a></li>
                                  <?php
                                  // code...
                               }else {
                                  ?>
                                  <li class="breadcrumb-item"> <a href="./">My Personnal Library</a></li>
                                  <?php
                                  // code...
                               }
                                // code...
                             }

                              ?>
                         </ol>
                     </div>
                     <ul class="nav nav-tabs page-header-tab">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Courses-all">List View</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Courses-add">Add</a></li>
                        <li class="nav-item"><a class="nav-link" id="Courses-tab-Boot" data-toggle="tab" href="#Courses-add-Boot">Add Bootstrap Style</a></li>
                     </ul>
                 </div>
             </div>
         </div>
         <div class="section-body mt-4">
             <div class="container-fluid">
                 <div class="tab-content">
                     <div class="tab-pane active" id="Courses-all">
                         <div class="row row-deck">
                             <div class="col-xl-4 col-lg-4 col-md-6">
                                 <div class="card">
                                     <a href="#"><img class="card-img-top" src="../assets/images/gallery/1.jpg" alt=""></a>
                                     <div class="card-body d-flex flex-column">
                                         <h5><a href="#">PHP Development Course</a></h5>
                                         <div class="text-muted">Look, my liege! The Knights Who Say Ni demand a sacrifice!</div>
                                     </div>
                                     <div class="table-responsive">
                                         <table class="table table-striped table-vcenter mb-0">
                                             <tbody>
                                                 <tr>
                                                     <td class="w20"><i class="fa fa-calendar text-blue"></i></td>
                                                     <td class="tx-medium">Duration</td>
                                                     <td class="text-right">6 Months</td>
                                                 </tr>
                                                 <tr>
                                                     <td><i class="fa fa-cc-visa text-danger"></i></td>
                                                     <td class="tx-medium">Fees</td>
                                                     <td class="text-right">$1,674</td>
                                                 </tr>
                                                 <tr>
                                                     <td><i class="fa fa-users text-warning"></i></td>
                                                     <td class="tx-medium">Students</td>
                                                     <td class="text-right">125+</td>
                                                 </tr>
                                             </tbody>
                                         </table>
                                     </div>
                                     <div class="card-footer">
                                         <div class="d-flex align-items-center mt-auto">
                                             <img class="avatar avatar-md mr-3" src="../assets/images/xs/avatar4.jpg" alt="avatar">
                                             <div>
                                                 <a href="#">Pro. Jane</a>
                                                 <small class="d-block text-muted">Head OF Dept.</small>
                                             </div>
                                             <div class="ml-auto text-muted">
                                                 <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i> 521</a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-xl-4 col-lg-4 col-md-6">
                                 <div class="card ribbon">
                                     <div class="ribbon-box orange"><i class="fa fa-star"></i></div>
                                     <a href="#"><img class="card-img-top" src="../assets/images/gallery/2.jpg" alt=""></a>
                                     <div class="card-body d-flex flex-column">
                                         <h5><a href="#">Account Management Course</a></h5>
                                         <div class="text-muted">Look, my liege! The Knights Who Say Ni demand a sacrifice!</div>
                                     </div>
                                     <div class="table-responsive">
                                         <table class="table table-striped table-vcenter mb-0">
                                             <tbody>
                                                 <tr>
                                                     <td class="w20"><i class="fa fa-calendar text-blue"></i></td>
                                                     <td class="tx-medium">Duration</td>
                                                     <td class="text-right">1 Year</td>
                                                 </tr>
                                                 <tr>
                                                     <td><i class="fa fa-cc-visa text-danger"></i></td>
                                                     <td class="tx-medium">Fees</td>
                                                     <td class="text-right">$1,674</td>
                                                 </tr>
                                                 <tr>
                                                     <td><i class="fa fa-users text-warning"></i></td>
                                                     <td class="tx-medium">Students</td>
                                                     <td class="text-right">50+</td>
                                                 </tr>
                                             </tbody>
                                         </table>
                                     </div>
                                     <div class="card-footer">
                                         <div class="d-flex align-items-center mt-auto">
                                             <img class="avatar avatar-md mr-3" src="../assets/images/xs/avatar2.jpg" alt="avatar">
                                             <div>
                                                 <a href="#">Pro. Alan</a>
                                                 <small class="d-block text-muted">Head OF Dept.</small>
                                             </div>
                                             <div class="ml-auto text-muted">
                                                 <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i> 521</a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-xl-4 col-lg-4 col-md-6">
                                 <div class="card">
                                     <a href="#"><img class="card-img-top" src="../assets/images/gallery/3.jpg" alt=""></a>
                                     <div class="card-body d-flex flex-column">
                                         <h5><a href="#">Angular Programmer Course</a></h5>
                                         <div class="text-muted">Look, my liege! The Knights Who Say Ni demand a sacrifice!</div>
                                     </div>
                                     <div class="table-responsive">
                                         <table class="table table-striped table-vcenter mb-0">
                                             <tbody>
                                                 <tr>
                                                     <td class="w20"><i class="fa fa-calendar text-blue"></i></td>
                                                     <td class="tx-medium">Duration</td>
                                                     <td class="text-right">6 Months</td>
                                                 </tr>
                                                 <tr>
                                                     <td><i class="fa fa-cc-visa text-danger"></i></td>
                                                     <td class="tx-medium">Fees</td>
                                                     <td class="text-right">$1,674</td>
                                                 </tr>
                                                 <tr>
                                                     <td><i class="fa fa-users text-warning"></i></td>
                                                     <td class="tx-medium">Students</td>
                                                     <td class="text-right">125+</td>
                                                 </tr>
                                             </tbody>
                                         </table>
                                     </div>
                                     <div class="card-footer">
                                         <div class="d-flex align-items-center mt-auto">
                                             <img class="avatar avatar-md mr-3" src="../assets/images/xs/avatar3.jpg" alt="avatar">
                                             <div>
                                                 <a href="#">Pro. Jane</a>
                                                 <small class="d-block text-muted">Head OF Dept.</small>
                                             </div>
                                             <div class="ml-auto text-muted">
                                                 <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i> 521</a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-xl-4 col-lg-4 col-md-6">
                                 <div class="card">
                                     <a href="#"><img class="card-img-top" src="../assets/images/gallery/4.jpg" alt=""></a>
                                     <div class="card-body d-flex flex-column">
                                         <h5><a href="#">PHP Development Course</a></h5>
                                         <div class="text-muted">Look, my liege! The Knights Who Say Ni demand a sacrifice!</div>
                                     </div>
                                     <div class="table-responsive">
                                         <table class="table table-striped table-vcenter mb-0">
                                             <tbody>
                                                 <tr>
                                                     <td class="w20"><i class="fa fa-calendar text-blue"></i></td>
                                                     <td class="tx-medium">Duration</td>
                                                     <td class="text-right">6 Months</td>
                                                 </tr>
                                                 <tr>
                                                     <td><i class="fa fa-cc-visa text-danger"></i></td>
                                                     <td class="tx-medium">Fees</td>
                                                     <td class="text-right">$1,674</td>
                                                 </tr>
                                                 <tr>
                                                     <td><i class="fa fa-users text-warning"></i></td>
                                                     <td class="tx-medium">Students</td>
                                                     <td class="text-right">125+</td>
                                                 </tr>
                                             </tbody>
                                         </table>
                                     </div>
                                     <div class="card-footer">
                                         <div class="d-flex align-items-center mt-auto">
                                             <img class="avatar avatar-md mr-3" src="../assets/images/xs/avatar4.jpg" alt="avatar">
                                             <div>
                                                 <a href="#">Pro. Jane</a>
                                                 <small class="d-block text-muted">Head OF Dept.</small>
                                             </div>
                                             <div class="ml-auto text-muted">
                                                 <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i> 521</a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-xl-4 col-lg-4 col-md-6">
                                 <div class="card">
                                     <a href="#"><img class="card-img-top" src="../assets/images/gallery/5.jpg" alt=""></a>
                                     <div class="card-body d-flex flex-column">
                                         <h5><a href="#">Magento Programmer Course</a></h5>
                                         <div class="text-muted">Look, my liege! The Knights Who Say Ni demand a sacrifice!</div>
                                     </div>
                                     <div class="table-responsive">
                                         <table class="table table-striped table-vcenter mb-0">
                                             <tbody>
                                                 <tr>
                                                     <td class="w20"><i class="fa fa-calendar text-blue"></i></td>
                                                     <td class="tx-medium">Duration</td>
                                                     <td class="text-right">1 Year</td>
                                                 </tr>
                                                 <tr>
                                                     <td><i class="fa fa-cc-visa text-danger"></i></td>
                                                     <td class="tx-medium">Fees</td>
                                                     <td class="text-right">$1,674</td>
                                                 </tr>
                                                 <tr>
                                                     <td><i class="fa fa-users text-warning"></i></td>
                                                     <td class="tx-medium">Students</td>
                                                     <td class="text-right">50+</td>
                                                 </tr>
                                             </tbody>
                                         </table>
                                     </div>
                                     <div class="card-footer">
                                         <div class="d-flex align-items-center mt-auto">
                                             <img class="avatar avatar-md mr-3" src="../assets/images/xs/avatar5.jpg" alt="avatar">
                                             <div>
                                                 <a href="#">Pro. Corrine</a>
                                                 <small class="d-block text-muted">Head OF Dept.</small>
                                             </div>
                                             <div class="ml-auto text-muted">
                                                 <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i> 521</a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-xl-4 col-lg-4 col-md-6">
                                 <div class="card">
                                     <a href="#"><img class="card-img-top" src="../assets/images/gallery/6.jpg" alt=""></a>
                                     <div class="card-body d-flex flex-column">
                                         <h5><a href="#">UI UX Design Course</a></h5>
                                         <div class="text-muted">Look, my liege! The Knights Who Say Ni demand a sacrifice!</div>
                                     </div>
                                     <div class="table-responsive">
                                         <table class="table table-striped table-vcenter mb-0">
                                             <tbody>
                                                 <tr>
                                                     <td class="w20"><i class="fa fa-calendar text-blue"></i></td>
                                                     <td class="tx-medium">Duration</td>
                                                     <td class="text-right">6 Months</td>
                                                 </tr>
                                                 <tr>
                                                     <td><i class="fa fa-cc-visa text-danger"></i></td>
                                                     <td class="tx-medium">Fees</td>
                                                     <td class="text-right">$1,674</td>
                                                 </tr>
                                                 <tr>
                                                     <td><i class="fa fa-users text-warning"></i></td>
                                                     <td class="tx-medium">Students</td>
                                                     <td class="text-right">125+</td>
                                                 </tr>
                                             </tbody>
                                         </table>
                                     </div>
                                     <div class="card-footer">
                                         <div class="d-flex align-items-center mt-auto">
                                             <img class="avatar avatar-md mr-3" src="../assets/images/xs/avatar6.jpg" alt="avatar">
                                             <div>
                                                 <a href="#">Pro. Emmett</a>
                                                 <small class="d-block text-muted">Head OF Dept.</small>
                                             </div>
                                             <div class="ml-auto text-muted">
                                                 <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i> 521</a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="tab-pane" id="Courses-add">
                         <div class="card">
                             <div class="card-header">
                                 <h3 class="card-title">Department Basic Info</h3>
                                 <div class="card-options ">
                                     <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                     <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                 </div>
                             </div>
                             <div class="card-body">
                                 <div class="row clearfix">
                                     <div class="col-sm-6">
                                         <div class="form-group">
                                             <input type="text" class="form-control" placeholder="Department Name ">
                                         </div>
                                     </div>
                                     <div class="col-sm-6">
                                         <div class="form-group">
                                             <input type="text" class="form-control" placeholder="Head of Department">
                                         </div>
                                     </div>
                                     <div class="col-sm-6">
                                         <div class="form-group">
                                             <input type="number" class="form-control" placeholder="No. of Students ">
                                         </div>
                                     </div>
                                     <div class="col-sm-6">
                                         <div class="form-group">
                                             <input data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="Department Start Date">
                                         </div>
                                     </div>
                                     <div class="col-sm-12">
                                         <div class="form-group">
                                             <textarea rows="4" class="form-control no-resize" placeholder="Brief"></textarea>
                                         </div>
                                     </div>
                                     <div class="col-sm-12">
                                         <button type="submit" class="btn btn-primary">Submit</button>
                                         <button type="submit" class="btn btn-outline-secondary btn-default">Cancel</button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="card">
                             <div class="card-header">
                                 <h3 class="card-title">Staff Member Account Info</h3>
                                 <div class="card-options ">
                                     <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                     <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                 </div>
                             </div>
                             <div class="card-body">
                                 <div class="row clearfix">
                                     <div class="col-sm-12">
                                         <div class="form-group">
                                             <input type="text" class="form-control" placeholder="Email">
                                         </div>
                                     </div>
                                     <div class="col-sm-12">
                                         <div class="form-group">
                                             <input type="text" class="form-control" placeholder="Phone">
                                         </div>
                                     </div>
                                     <div class="col-sm-12">
                                         <button type="submit" class="btn btn-primary">Submit</button>
                                         <button type="submit" class="btn btn-outline-secondary btn-default">Cancel</button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="tab-pane" id="Courses-add-Boot">
                         <div class="card">
                             <div class="card-header">
                                 <h3 class="card-title">Add Department</h3>
                                 <div class="card-options ">
                                     <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                     <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                 </div>
                             </div>
                             <form class="card-body">
                                 <div class="form-group row">
                                     <label class="col-md-3 col-form-label">Department Name <span class="text-danger">*</span></label>
                                     <div class="col-md-7">
                                         <input type="text" class="form-control">
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label class="col-md-3 col-form-label">Head Of Department</label>
                                     <div class="col-md-7">
                                         <input type="text" class="form-control">
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label class="col-md-3 col-form-label">Department Start Date <span class="text-danger">*</span></label>
                                     <div class="col-md-7">
                                         <input data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="">
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label class="col-md-3 col-form-label">Student Capacity <span class="text-danger">*</span></label>
                                     <div class="col-md-7">
                                         <input type="text" class="form-control">
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label class="col-md-3 col-form-label">Department Details <span class="text-danger">*</span></label>
                                     <div class="col-md-7">
                                         <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label class="col-md-3 col-form-label"></label>
                                     <div class="col-md-7">
                                         <button type="submit" class="btn btn-primary">Submit</button>
                                         <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Start main footer -->
 <div class="section-body">
     <footer class="footer">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-6 col-sm-12">
                     Copyright © 2019 <a href="https://themeforest.net/user/puffintheme/portfolio">PuffinTheme</a>.
                 </div>
                 <div class="col-md-6 col-sm-12 text-md-right">
                     <ul class="list-inline mb-0">
                         <li class="list-inline-item"><a href="../doc/index.html">Documentation</a></li>
                         <li class="list-inline-item"><a href="javascript:void(0)">FAQ</a></li>
                         <li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-outline-primary btn-sm">Buy Now</a></li>
                     </ul>
                 </div>
             </div>
         </div>
     </footer>
 </div>

 <!-- Start Main project js, jQuery, Bootstrap -->
 <script src="../assets/bundles/lib.vendor.bundle.js"></script>

 <!-- Start Plugin Js -->
 <script src="../assets/bundles/sweetalert.bundle.js"></script>
 <script src="../assets/plugins/dropify/js/dropify.min.js"></script>

 <!-- Start project main js  and page js -->
 <script src="../assets/js/core.js"></script>
 <script src="assets/js/page/dialogs.js"></script>
 <script src="assets/js/page/summernote.js"></script>
 <script>
 $(function() {
     "use strict";

     $('.dropify').dropify();

     var drEvent = $('#dropify-event').dropify();
     drEvent.on('dropify.beforeClear', function(event, element) {
         return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
     });

     drEvent.on('dropify.afterClear', function(event, element) {
         alert('File deleted');
     });

     $('.dropify-fr').dropify({
         messages: {
             default: 'Glissez-déposez un fichier ici ou cliquez',
             replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
             remove: 'Supprimer',
             error: 'Désolé, le fichier trop volumineux'
         }
     });
 });
 </script>
 </body>
 </html>
