<!-- END: Subheader -->
<div class="m-subheader">


    <?= $this->session->flashdata('message') ?>


    <div class="row">

        <div class="col-lg-12">

            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                <?= $title; ?>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-section">
                        <span class="m-section__sub">
                            <!--  -->
                        </span>
                        <div class="m-section__content">

                            <?php

                            foreach ($link as $r) {
                                echo '<a href="' . base_url('uploads/marketing-kit/' . $r->file) . '" target="_blank"><i class="fa fa-download"></i> ' . $r->nama . '</a><br>';
                            }

                            ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>