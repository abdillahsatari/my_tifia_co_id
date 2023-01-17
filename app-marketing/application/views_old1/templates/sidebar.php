<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

    <!-- BEGIN: Left Aside -->
    <button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
    <div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-light ">
        <?php
        $role_id = $this->session->userdata('nsb_role_id');
        $queryMenu = "SELECT `nasabah_menu`.`id`, `menu`
                                      FROM `nasabah_menu` JOIN `nasabah_access_menu` 
                                      ON `nasabah_menu`.`id` = `nasabah_access_menu`.`menu_id`
                                      WHERE `nasabah_access_menu`.`role_id` = $role_id 
                                      ORDER BY `nasabah_access_menu`.`menu_id` ASC";
        $menu = $this->db->query($queryMenu)->result_array();
        ?>

        <!-- BEGIN: Aside Menu -->
        <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
            <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">

                <!-- Profil -->
                <li class="m-menu__section m-menu__section--first">

                    <table class="">
                        <tr>
                            <td>
                                <span class="m-topbar__userpic">
                                    <img src="<?= base_url() ?>uploads/photo/<?php if (!empty($this->session->userdata('nsb_photo'))) {
                                                                                    echo $this->session->userdata('nsb_photo');
                                                                                } else {
                                                                                    echo "default.jpg";
                                                                                }  ?>" class="m--img-rounded m--marginless m--img-centered" alt="" width="60" />
                                </span>
                            </td>
                            <td class="pl-4">
                                <p class="font-weight-bold mb-0 text-white"><?= $this->session->userdata('nsb_nama') ?></p>

                                <?php
                                $tbl_nasalah = $this->db->query('SELECT status FROM nasabah WHERE nasabah_id="' . $this->session->userdata('cd_id') . '"')->row_array();

                                switch ($tbl_nasalah['status']) {
                                    case 'Register':
                                        echo '<span class="badge badge-danger text-white">Not Verified</span>';
                                        break;

                                    case 'Complete':
                                        echo '<span class="badge badge-warning text-white">Reviewed</span>';
                                        break;

                                    case 'Approved':
                                        echo '<span class="badge badge-success text-white">Approved</span>';
                                        break;

                                    case 'Active':
                                        echo '<span class="badge badge-success text-white">Active</span>';
                                        break;

                                    default:
                                        echo '<span class="badge badge-warning text-white">Reviewed</span>';
                                        break;
                                }

                                ?>
                                <!-- <span class="badge badge-danger">Status</span> -->
                            </td>
                        </tr>
                    </table>
                </li>


                <!-- LOOPING MENU -->
                <?php foreach ($menu as $m) { ?>
                    <!-- Heading -->
                    <li class="m-menu__section">
                        <h4 class="m-menu__section-text"><?= $m['menu']; ?></h4>
                        <i class="m-menu__section-icon flaticon-more-v2"></i>
                    </li>

                    <?php

                    $this->load->helper('detect_device');

                    $menuID = $m['id'];
                    $querySubMenu2 = "SELECT * 
                                                      FROM `nasabah_sub_menu` JOIN `nasabah_menu` 
                                                      ON `nasabah_sub_menu`. `id` = `nasabah_menu`. `id`
                                                      WHERE `nasabah_sub_menu`. `id` = $menuID
                                                      AND `nasabah_sub_menu`. `is_active` = 1";

                    $querySubMenu = "SELECT * FROM `nasabah_sub_menu` WHERE `menu_id` = $menuID AND `is_active` =1";
                    $submenu = $this->db->query($querySubMenu)->result_array();
                    foreach ($submenu as $sm) {
                        $urlLink = $sm['url'];
                        // if ($sm['title'] == "Download MT4") {
                        // if (deviceIphone()) {
                        //     $urlLink = 'https://download.mql5.com/cdn/mobile/mt4/ios?server=TeknologiBerjangka-Demo,TeknologiBerjangka-MT4';
                        // }
                        // if (deviceAndroidPhone()) {
                        //     $urlLink = 'https://download.mql5.com/cdn/mobile/mt4/android?server=TeknologiBerjangka-Demo,TeknologiBerjangka-MT4';
                        // }
                        // if (deviceWindows()) {
                        //     $urlLink = 'https://download.mql5.com/cdn/web/17560/mt4/teknologiberjangka4setup.exe';
                        // }
                        // }
                    ?>
                        <li class="m-menu__item <?php if ($this->uri->segment('1') == $sm['url']) {
                                                    echo "m-menu__item--active";
                                                } ?>" aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="<?= base_url($urlLink); ?>" class="m-menu__link ">
                                <i class="m-menu__link-icon <?= $sm['icon']; ?>"></i>
                                <span class="m-menu__link-text" <?php if ($sm['title'] == "Download MT4") {
                                                                    echo 'style="color:#C33232!important"';
                                                                } ?>><?= $sm['title']; ?></span>
                            </a>

                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>

        <!-- END: Aside Menu -->
    </div>

    <!-- END: Left Aside -->
    <div class="m-grid__item m-grid__item--fluid m-wrapper">