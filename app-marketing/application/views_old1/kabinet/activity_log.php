  <!-- BEGIN: Subheader -->
  <!-- <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title "> <h4 class="m-widget24__title">
                   Selamat datang! <?= $this->session->userdata('nsb_nama') ?>
                </h4></h3>
            </div>
           
        </div>
    </div>     -->

  <div class="m-content">
      <div class="row">
          <div class="col-xl-8">
              <div class="m-portlet m-portlet--full-height ">
                  <div class="m-portlet__head">
                      <div class="m-portlet__head-caption">
                          <div class="m-portlet__head-title">
                              <h3 class="m-portlet__head-text">
                                  Recent Activities
                              </h3>
                          </div>
                      </div>
                  </div>
                  <div class="m-portlet__body">
                      <div class="tab-content">
                          <div class="tab-pane active" id="m_widget4_tab1_content">
                              <div class="m-scrollable m-scroller ps ps--active-y" data-scrollable="true" data-height="400" style="height: 400px; overflow: hidden;">
                                  <div class="m-list-timeline m-list-timeline--skin-light">
                                      <div class="m-list-timeline__items">
                                          <?php foreach ($logtoday as $key => $value) { ?>
                                              <div class="m-list-timeline__item">
                                                  <span class="m-list-timeline__badge m-list-timeline__badge--<?php if ($value->type == 'logout') { ?>danger<?php } elseif ($value->type == 'login') { ?>success<?php } else { ?>info<?php } ?>"></span>
                                                  <span class="m-list-timeline__text"><?= $value->aktifitas ?></span>

                                                  <span class="m-list-timeline__time"><?= date("d F Y, H:i", strtotime($value->tanggal)) ?></span>
                                              </div>
                                          <?php } ?>
                                      </div>
                                  </div>
                                  <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                      <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                  </div>
                                  <div class="ps__rail-y" style="top: 0px; height: 400px; right: 4px;">
                                      <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 203px;"></div>
                                  </div>
                              </div>
                          </div>
                          <div class="tab-pane" id="m_widget4_tab2_content">
                          </div>
                          <div class="tab-pane" id="m_widget4_tab3_content">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </div>
  </div>

  <!-- end:: Body -->