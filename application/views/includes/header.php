<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<title><?= APP_TITLE?></title>
	<!-- <link rel="apple-touch-icon" href="<?=base_url('app-assets/images/ico/apple-icon-120.png')?>"> -->
	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>app-assets/images/ico/favicon.png">

	<!-- BEGIN: Vendor CSS-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/vendors/css/vendors.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/vendors/css/ui/prism.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/vendors/css/extensions/toastr.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/vendors/css/forms/select/select2.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/vendors/css/pickers/pickadate/pickadate.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/vendors/css/pickers/daterange/daterangepicker.css">
	<!-- END: Vendor CSS-->

	<!-- BEGIN: Theme CSS-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/bootstrap-extended.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/colors.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/components.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/themes/dark-layout.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/themes/semi-dark-layout.css">

	<!-- BEGIN: Page CSS-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/plugins/forms/validation/form-validation.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/plugins/extensions/toastr.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>app-assets/css/pages/dashboard-ecommerce.css">
	<!-- END: Page CSS-->

	<!-- BEGIN: Custom CSS-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css">
	<!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns menu-collapsed navbar-sticky footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
	<!-- BEGIN: Header-->
	<div class="header-navbar-shadow"></div>
	<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
		<div class="navbar-wrapper">
			<div class="navbar-container content">
				<div class="navbar-collapse" id="navbar-mobile">
					<div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
						<ul class="nav navbar-nav">
							<li class="nav-item mobile-menu d-xl-none mr-auto">
                                <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                                    <i class="ficon bx bx-menu"></i>
                                </a>
                            </li>
						</ul>
					</div>
					<ul class="nav navbar-nav float-right">
						<li class="dropdown dropdown-notification nav-item">
                            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                                <i class="ficon bx bx-bell"></i>
								<?php if (get_new_notify_count() > 0):?>
                                	<span class="badge badge-pill badge-primary badge-up" id="notification-number"><?= get_new_notify_count()?></span>
								<?php endif;?>
                            </a>
							<ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
								<li class="dropdown-menu-header">
									<?php if (get_new_notify_count() > 0): ?>
										<div class="dropdown-header px-1 py-75 d-flex justify-content-between">
											<span class="notification-title" id="notification-title"><?= get_new_notify_count() ?> new Notification</span>
											<span class="text-bold-400 cursor-pointer" id="mark-as-all-btn" data-user-id="<?= current_customer_id()?>">Mark all as read</span>
										</div>
									<?php else: ?>
										<div class="dropdown-header px-1 py-75 d-flex justify-content-between">
											<span class="notification-title" id="notification-title">No new notification</span>
										</div>
									<?php endif;?>
								</li>
								<li class="scrollable-container media-list">
									<?php if (get_new_notify_count() > 0): ?>
										<?php foreach(get_notify() as $notification):?>
										<div class="d-flex justify-content-between read-notification cursor-pointer">
											<div class="media d-flex align-items-center">
												<div class="media-body">
													<h6 class="media-heading">
														<span class="notification-detail <?= !$notification['status'] ? 'text-bold-700' : ''?>"><?= $notification['detail']?></span>
													</h6>
													<small class="notification-text"><?= show_datetime($notification['created_at'])?></small>
												</div>
											</div>
										</div>
										<?php endforeach;?>
									<?php else: ?>
										<div class="d-flex justify-content-between read-notification cursor-pointer">
											<div class="media d-flex align-items-center">
												<div class="media-body">
													<h6 class="media-heading">
														<span class="text-bold-500">There are no new notifications.</span>
													</h6>
												</div>
											</div>
										</div>
									<?php endif;?>
								</li>
							</ul>
						</li>
						<li class="dropdown dropdown-user nav-item">
							<a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
								<div class="user-nav d-sm-flex d-none">
									<span class="user-name"><?= $this->session->user['first_name'] . ' ' . $this->session->user['surname'] ?></span>
									<?php if (is_admin()): ?>
										<span class="user-status">Administrator</span>
									<?php else:?>
										<span class="user-status">Customer</span>
									<?php endif;?>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<?php if (!is_admin()): ?>
									<a class="dropdown-item" href="<?= base_url('bills')?>">
										<i class="bx bx-envelope mr-50"></i> My Bills
									</a>
								<?php endif;?>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?= base_url('auth/logout')?>">
									<i class="bx bx-power-off mr-50"></i> Logout
								</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<!-- END: Header-->


	<!-- BEGIN: Main Menu-->
	<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
		<div class="navbar-header">
			<ul class="nav navbar-nav flex-row">
				<li class="nav-item mr-auto">
					<a class="navbar-brand" href="<?= is_admin() ? base_url() : base_url('dashboard/customer')?>">
						<div class="brand-logo"><img class="logo" src="<?= base_url()?>app-assets/images/logo/logo.png" /></div>
						<!-- <h2 class="brand-text mb-0"><?= APP_TITLE?></h2> -->
					</a>
				</li>
				<li class="nav-item nav-toggle">
					<a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
						<i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
						<i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i>
					</a>
				</li>
			</ul>
		</div>
		<div class="shadow-bottom"></div>
		<div class="main-menu-content">
			<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
				<li class="nav-item <?= isset($menu) && $menu == "dashboard" ? "active" : "" ?>">
					<a href="<?= is_admin() ? base_url() : base_url('dashboard/customer') ?>">
						<i class="menu-livicon" data-icon="desktop"></i>
						<span class="menu-title" data-i18n="Dashboard">Dashboard</span>
					</a>
				</li>
				<?php if(is_admin()): ?>
					<li class="nav-item <?= isset($menu) && $menu == "customers" ? "active" : "" ?>">
						<a href="<?=base_url('customers')?>">
							<i class="menu-livicon" data-icon="users"></i>
							<span class="menu-title" data-i18n="Customers">Customers</span>
							<span class="badge badge-danger badge-pill badge-round float-right"><?= get_pendinng_customers()?></span>
						</a>
					</li>
				<?php endif;?>
                <li class="nav-item <?= isset($menu) && $menu == "bills" ? "active" : "" ?>">
					<a href="<?= base_url('bills')?>">
						<i class="menu-livicon" data-icon="coins"></i>
						<span class="menu-title" data-i18n="Bills">Bills</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- END: Main Menu-->

	<!-- BEGIN: Content-->
	<div class="app-content content">
		<div class="content-overlay"></div>
		<div class="content-wrapper">
			<div class="content-header row">
				<div class="content-header-left col-12 mb-2 mt-1">
					<div class="row breadcrumbs-top">
						<div class="col-12">
							<h5 class="content-header-title float-left pr-1 mb-0"><?= APP_TITLE ?></h5>
							<div class="breadcrumb-wrapper col-12">
								<ol class="breadcrumb p-0 mb-0">
									<li class="breadcrumb-item active"><?= isset($title) ? $title : "" ?></li>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>