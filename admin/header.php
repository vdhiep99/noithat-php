<?php 
    include '../connect.php';
    if (isset($_GET["logout"])) {
        setcookie("user", null, -1, '/');
        header('location:../login.php');
    }
    if (isset($_COOKIE["user"])) {
        $user = $_COOKIE["user"];
        foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
            $permission = $row['phanquyen'];
        }
        if ($permission==1) {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nội Thất Fpoly Admin</title>
    <link rel="icon" href="../img/golochuan.png">
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <style>
      .addfont{
        font-family: 'Arial';
      }
      
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="index.php"><img style="height: 95px;" src="../img/golochuan.png" alt="logo" /></a>
          <a  class="sidebar-brand brand-logo-mini" href="index.php"><img  src="../img/golochuan.png" alt="logo" /></a>
        </div>
        <ul class="nav ">
          <!-- <li class="nav-item profile">
            <div class="profile-desc">

            </div>
          </li> -->
          <li class="nav-item menu-items ">
            <a class="nav-link" href="index.php">
              <span class="menu-icon">
                <i class="mdi mdi-chart-bar"></i>
              </span>
              <span class="menu-title addfont">Thống Kê Doanh Thu</span>
            </a>
          </li>
          
          <li class="nav-item menu-items">
            <a class="nav-link" href="category.php">
              <span class="menu-icon">
                <i class="mdi mdi-format-list-bulleted-type"></i>
              </span>
              <span class="menu-title addfont">Danh Mục Sản Phẩm</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="product.php">
              <span class="menu-icon">
                <i class="mdi mdi-cellphone-iphone"></i>
              </span>
              <span class="menu-title addfont">Sản Phẩm</span>
            </a>
          </li>
          
          <li class="nav-item menu-items">
            <a class="nav-link" href="account.php">
              <span class="menu-icon">
                <i class="mdi mdi-account-card-details"></i>
              </span>
              <span class="menu-title addfont">Tài Khoản</span>
            </a>
          </li>
          
          <li class="nav-item menu-items">
            <a class="nav-link" href="comment.php">
              <span class="menu-icon">
                <i class="mdi mdi-comment-processing-outline"></i>
              </span>
              <span class="menu-title addfont">Bình Luận</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="cart.php?action">
              <span class="menu-icon">
                <i class="mdi mdi-cart"></i>
              </span>
              <span class="menu-title addfont">Đơn Hàng</span>
            </a>
          </li>
          
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-information"></i>
              </span>
              <span class="menu-title addfont">Thông tin website</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> 
                    <a class="nav-link addfont" href="slide.php">Slide</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo-mini.png" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control addfont text-light" name="filter" onkeyup="myFunction()" id="txtFind" style="width: 100%;" placeholder="Tìm Kiếm">
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link btn btn-success create-new-button addfont" href="../index.php">Về Trang Chủ</a>
              </li>
              <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="#">
                  <i class="mdi mdi-view-grid"></i>
                </a>
              </li>
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email"></i>
                  <!-- <span class="count bg-success"></span> -->
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  
                </div>
              </li>
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                  <!-- <span class="count bg-danger"></span> -->
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <!-- <img class="img-xs rounded-circle" src="assets/images/faces/face15.jpg" alt=""> -->
                    <p class="mb-0 d-none d-sm-block navbar-profile-name addfont">ADMIN</p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <!-- <h6 class="p-3 mb-0">Profile</h6> -->
                  <div class="dropdown-divider"></div>
                  <!-- <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                    </div>
                  </a> -->
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="?logout">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1 addfont">Đăng Xuất</p>
                    </div>
                  </a>
                  <!-- <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">Advanced settings</p>
                </div> -->
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
    <?php
        }else{
            include '404.php';
        }
    }else{
        include '404.php';
    }
?>
