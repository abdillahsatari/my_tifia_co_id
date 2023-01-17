<?php

$urlDesktop = 'https://download.mql5.com/cdn/web/17560/mt4/teknologiberjangka4setup.exe';
$urlIos = 'https://download.mql5.com/cdn/mobile/mt4/ios?server=TeknologiBerjangka-Demo,TeknologiBerjangka-MT4';
$urlAndroid = 'https://download.mql5.com/cdn/mobile/mt4/android?server=TeknologiBerjangka-Demo,TeknologiBerjangka-MT4';
?>

<!-- END: Subheader -->
                    <div class="m-subheader ">
                        <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
                            <div class="m-alert__icon">
                                <i class="flaticon-exclamation m--font-brand"></i>
                            </div>
                            <div class="m-alert__text">
								PT. Tifia Finansial Berjangka menyediakan fasilitas untuk Anda melakukan simulasi transaksi perdagangan dengan mendownload aplikasi meta trader tersedia untuk <a href="<?php echo $urlDesktop; ?>" target="_blank">desktop atau laptop</a>, <a href="<?php echo $urlAndroid; ?>" target="_blank">Android</a> & <a href="<?php echo $urlIos; ?>" target="_blank">IOS</a>
                            </div>
                        </div>
                        <div class="row ui-sortable" id="m_sortable_portlets">
                            <div class="col-lg">

                                <!--begin::Portlet-->
                              <div class="m-portlet m-portlet--tab">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <span class="m-portlet__head-icon m--hide">
                                                    <i class="la la-gear"></i>
                                                </span>
                                                <h3 class="m-portlet__head-text">
                                                    Buat Akun Demo Sekarang!
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">

                                        <!--begin::Section-->
                                        <div class="m-section">
                                            <span class="m-section__sub">
                                               Sebelum pembuatan akun ril, anda diwajibkan untuk membuat akun demo & telah melakukan simulasi, silihkan klik tombol hijau untuk membuat akun demo
                                            </span>
                                            <div class="m-section__content">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Tipe Akun</th>
                                                                <th>Status</th>
                                                                <th>Aksi</th>
                                                                <th>No Akun</th>
                                                                <th>Saldo</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (empty($demo)) { ?>
                                                                <tr>
                                                                    <td>Demo</td>
                                                                    <td><code>-</code></td>
                                                                    <td>
                                                                        <a href="demo/save" class="btn btn-success btn-sm m-btn     m-btn m-btn--icon m-btn--pill">
                                                                            <span>
                                                                                <i class="fa flaticon-paper-plane"></i>
                                                                                <span>Buat Akun</span>
                                                                            </span>
                                                                        </a>
                                                                    </td>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                </tr>
                                                            <?php } else { ?>
                                                                <tr>
                                                                    <td>Demo</td>
                                                                    <td><code>-</code></td>
                                                                    <td>
                                                                        <a href="demo/save" class="btn btn-success btn-sm m-btn     m-btn m-btn--icon m-btn--pill">
                                                                            <span>
                                                                                <i class="fa flaticon-paper-plane"></i>
                                                                                <span>Buat Akun</span>
                                                                            </span>
                                                                        </a>
                                                                    </td>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                </tr>
                                                                <?php foreach ($demo as $key => $value) { ?>
                                                                    <tr>
                                                                        <td><?= $value->type ?></td>
                                                                        <td><code><?= $value->status_aktif ?></code></td>
                                                                        <td>
                                                                            <a class="btn btn-success btn-sm m-btn m-btn m-btn--icon m-btn--pill">
                                                                                <span>
                                                                                    <i class="fa flaticon-paper-plane"></i>
                                                                                    <span>Buat Akun</span>
                                                                                </span>
                                                                            </a>
                                                                        </td>
                                                                        <td><?= $value->no_akun ?></td>
                                                                        <td><?= $value->balance ?></td>
                                                                    </tr>
                                                                <?php }
                                                            } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="m--space-30"></div>
                                            
                                        </div>

                                        <!--end::Section-->
                                    </div>
                                </div>

                                <!--end::Portlet-->
 
                            </div>
                            
                        </div>
                     
                    </div>

        
<!-- end:: Body -->

