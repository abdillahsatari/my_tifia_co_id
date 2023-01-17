<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

    <!-- BEGIN: Left Aside -->
    <button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
    <div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-light ">
        <?php
        // get role id
        $role_id = my_role_id(sess('mkt'));
        $queryMenu = "SELECT marketing_menu.menu, marketing_menu.id FROM marketing_access_menu, marketing_menu WHERE marketing_access_menu.menu_id=marketing_menu.id AND marketing_access_menu.role_id='$role_id' AND marketing_menu.is_active='1' ORDER BY marketing_access_menu.id ASC";
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
                                    <img src="<?= base_url() ?>uploads/photo/default.jpg" class="m--img-rounded m--marginless m--img-centered" alt="" width="60" />
                                </span>
                            </td>
                            <td class="pl-4">
                                <p class="font-weight-bold mb-0 text-white"><?= sess('mkt_nama') ?></p>
                                <p class="text-muted">
                                    <?= sess('mkt_kode') ?>
                                    <br>
                                    <?= $this->db->query("SELECT role FROM marketing_role WHERE id='$role_id'")->row_array()['role']; ?>
                                </p>

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
                                                      FROM `marketing_sub_menu` JOIN `marketing_menu` 
                                                      ON `marketing_sub_menu`. `id` = `marketing_menu`. `id`
                                                      WHERE `marketing_sub_menu`. `id` = $menuID
                                                      AND `marketing_sub_menu`. `is_active` = 1";

                    $querySubMenu = "SELECT * FROM `marketing_sub_menu` WHERE `menu_id` = $menuID AND `is_active` =1";
                    $submenu = $this->db->query($querySubMenu)->result_array();
                    foreach ($submenu as $sm) {
                        $urlLink = $sm['url'];
                        if ($sm['title'] == "Download MT4") {
                            if (deviceIphone()) {
                                $urlLink = 'https://download.mql5.com/cdn/mobile/mt4/ios?server=TeknologiBerjangka-Demo,TeknologiBerjangka-MT4';
                            }
                            if (deviceAndroidPhone()) {
                                $urlLink = 'https://download.mql5.com/cdn/mobile/mt4/android?server=TeknologiBerjangka-Demo,TeknologiBerjangka-MT4';
                            }
                            if (deviceWindows()) {
                                $urlLink = 'https://download.mql5.com/cdn/web/17560/mt4/teknologiberjangka4setup.exe';
                            }
                        }
                    ?>
                        <li class="m-menu__item <?php if ($this->uri->segment('1') . '/' . $this->uri->segment('2') == $sm['url']) {
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