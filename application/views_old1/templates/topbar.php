<?php

$userTheme = $this->session->userdata('theme');

$theme = 'white';
if (isset($userTheme) && $userTheme == 1) {
	$theme = 'black';
}

$logoPng = 'black.svg';
if ($theme == 'black') {
	$logoPng = 'white.svg';
}
?>

<!-- begin::Body -->

<body id="<?php echo $theme; ?>" class="m-content--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside--offcanvas-default">

	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page">

		<!-- BEGIN: Header -->
		<header id="m_header" class="m-grid__item m-header" m-minimize-offset="200" m-minimize-mobile-offset="200">
			<div class="m-container m-container--fluid m-container--full-height" style="background-color: #F5F4F4;">
				<div class="m-stack m-stack--ver m-stack--desktop">

					<!-- BEGIN: Brand -->
					<div class="m-stack__item m-brand  m-brand--skin-light ">
						<div class="m-stack m-stack--ver m-stack--general m-stack--fluid">
							<div class="m-stack__item m-stack__item--middle m-brand__logo">
								<a href="#" class="m-brand__logo-wrapper">
									<img alt="" class="logo-default" src="<?= base_url() ?>assets/demo/demo11/media/img/logo/<?php echo $logoPng; ?>" />
								</a>
							</div>
							<div class="m-stack__item m-stack__item--middle m-brand__tools">

								<a href="<?= base_url() ?>deposit" style="display: none;" class="btn-mobile btn m-btn btn-primary m-btn--pill">
									Deposit
								</a>
								<a href="<?= base_url() ?>withdrawal" style="display: none;" class="btn-mobile btn btn-outline-primary m-btn m-btn--pill">
									Withdraw
								</a>

								<!-- BEGIN: Responsive Aside Left Menu Toggler -->
								<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
									<span></span>
								</a>

								<!-- END -->

								<!-- BEGIN: Topbar Toggler -->
								<!-- <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
									<i class="flaticon-more"></i>
								</a> -->

								<!-- BEGIN: Topbar Toggler -->
							</div>
						</div>
					</div>

					<!-- END: Brand -->
					<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

						<!-- BEGIN: Topbar -->
						<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
							<div class="m-stack__item m-topbar__nav-wrapper">
								<ul class="m-topbar__nav m-nav m-nav--inline">

									<a href="<?= base_url() ?>deposit" class="btn-desktop m-nav__link btn m-btn btn-primary m-btn--pill">
										Deposit
									</a>
									<a href="<?= base_url() ?>withdrawal" class="btn-desktop m-nav__link btn btn-outline-primary m-btn m-btn--pill mr-3">
										Withdraw
									</a>
									<a href="logout" class="btn-desktop m-nav__link btn text-dark">
										<i class="fa fa-power-off fa-2x"></i>
									</a>

									<li class="m-nav__item m-topbar__user-profile" m-dropdown-toggle="click">
										<!-- <a href="#" class="m-nav__link">
											<i class="fa fa-power-off"></i>
										</a> -->
									</li>

									<!-- <a class="m-nav__link m-dropdown__toggle" style="padding-top: 32px;">
										<span class="m--font-bolder">
											<?= $this->session->userdata('nsb_nama') ?>
										</span>
									</a> -->

									<!-- <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
										<a href="#" class="m-nav__link m-dropdown__toggle">
											<span class="m-topbar__userpic">
												<img src="uploads/photo/<?php if (!empty($this->session->userdata('nsb_photo'))) {
																			echo $this->session->userdata('nsb_photo');
																		} else {
																			echo "default.jpg";
																		}  ?>" class="m--img-rounded m--marginless m--img-centered" alt="" />
											</span>
											<span class="m-nav__link-icon m-topbar__usericon  m--hide">
												<span class="m-nav__link-icon-wrapper"><i class="flaticon-user-ok"></i></span>
											</span>
											<span class="m-topbar__username m--hide"><?= $this->session->userdata('nsb_email') ?></span>
										</a>
										<div class="m-dropdown__wrapper">
											<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
											<div class="m-dropdown__inner">
												<div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/user_profile_bg.png); background-size: cover;">
													<div class="m-card-user m-card-user--skin-dark">
														<div class="m-card-user__pic">
															<img src="uploads/photo/<?= $this->session->userdata('nsb_photo') ?>" class="m--img-rounded m--marginless" alt="" />
														</div>
														<div id="l-t-profile-d" class="m-card-user__details">
															<span class="m-card-user__name m--font-weight-500"><?= $this->session->userdata('nsb_nama') ?></span>
															<a href="" class="m-card-user__email m--font-weight-300 m-link"><?= $this->session->userdata('nsb_email') ?></a>
														</div>
													</div>
												</div>
												<div class="m-dropdown__body">
													<div class="m-dropdown__content">
														<ul class="m-nav m-nav--skin-light">
															<li class="m-nav__section m--hide">
																<span class="m-nav__section-text">Section</span>
															</li>
															<li class="m-nav__item">
																<a href="changetheme?theme=<?php if ($userTheme == 0) {
																								echo 1;
																							} else {
																								echo 0;
																							}; ?>" class="m-nav__link">
																	<i class="m-nav__link-icon flaticon-light"></i>
																	<span class="m-nav__link-title">
																		<span class="m-nav__link-wrap">
																			<span class="m-nav__link-text">Change theme</span>
																			<span class="m-nav__link-badge"></span>
																		</span>
																	</span>
																</a>
															</li>
															<li class="m-nav__item">
																<a href="profile" class="m-nav__link">
																	<i class="m-nav__link-icon flaticon-profile-1"></i>
																	<span class="m-nav__link-title">
																		<span class="m-nav__link-wrap">
																			<span class="m-nav__link-text">Profile</span>
																			<span class="m-nav__link-badge"></span>
																		</span>
																	</span>
																</a>
															</li>
															<li class="m-nav__item">
																<a href="changepassword" class="m-nav__link">
																	<i class="m-nav__link-icon fa fa-lock"></i>
																	<span class="m-nav__link-text">Password</span>
																</a>
															</li>
															<li class="m-nav__item">
																<a href="bank" class="m-nav__link">
																	<i class="m-nav__link-icon fa fa-credit-card"></i>
																	<span class="m-nav__link-text">Rekening</span>
																</a>
															</li>

															<li class="m-nav__separator m-nav__separator--fit">
															</li>
															<li class="m-nav__separator m-nav__separator--fit">
															</li>
															<li class="m-nav__item">
																<a href="logout" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</li> -->
								</ul>
							</div>
						</div>

						<!-- END: Topbar -->
					</div>
				</div>
			</div>
		</header>

		<!-- END: Header -->


		<script>
			document.addEventListener('DOMContentLoaded', function() {
				if (screen.width < 1025) {
					$('.btn-mobile').show();
					$('.btn-desktop').hide();
				} else {
					$('.btn-mobile').hide();
					$('.btn-desktop').show();
				}
			});
		</script>