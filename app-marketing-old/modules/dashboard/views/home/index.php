<!-- END: Subheader -->
<div class="m-subheader">


    <?= $this->session->flashdata('message') ?>

    <div class="row">

        <?php
        // cek apakah sudah mengisi agreement
        $status_perjanjian = $this->db->query('SELECT status_perjanjian FROM marketing WHERE marketing.id="' . sess('mkt') . '"')->row_array()['status_perjanjian'];
        if ($status_perjanjian != 'Approved') {
        ?>
            <div class="col-lg-12">
                <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30-" role="alert">
                    <div class="m-alert__icon">
                        <i class="fa fa-exclamation"></i>
                    </div>
                    <div class="m-alert__text">
                        <a href="<?= base_url('dashboard/account/agreement') ?>">Klik disini</a> untuk Pengisian Nota Kesepakatan Kerjasama Kegiatan Pemasaran.
                    </div>
                </div>
            </div>
        <?php
        }
        ?>


        <div class="col-sm-12 col-md-12">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">

                    <h5 class="mb-3">Referral Link</h5>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="toCopy" value="<?= 'https://my.tfx.co.id/register?r=' . sess('mkt_kode') ?>" readonly>
                        <div class="input-group-prepend">
                            <button class="btn btn-primary waves-effect waves-light btnCopy" type="button" onclick="copyToClipboard('toCopy')">Copy <i class="fa fa-clipboard"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12">
            <div class="m-portlet m-portlet--mobile">

                <img src="<?= base_url('assets/demo/demo11/media/img/banner/banner1.gif') ?>" alt="" width="100%">
            </div>
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="m-portlet m-portlet--mobile" style="background-color: #c33232;">
                <div class="m-portlet__body">

                    <h5 class="text-light">BALANCE</h5>

                    <div class="text-center text-light">

                        <h3 class="font-weight-bold">IDR <?= rupiah(mkt_total_balance(sess('mkt'))) ?></h3>

                        <br>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="m-portlet m-portlet--mobile" style="background-color: #c33232;">
                <div class="m-portlet__body">

                    <h5 class="text-light">COMMISSION</h5>


                    <p class="text-light font-weight-bold">
                        USD <?= rupiah(mkt_komisi(sess('mkt'), 'USD')); ?><br>
                        IDR <?= rupiah(mkt_komisi(sess('mkt'), 'IDR')); ?>
                    </p>

                    <!-- <div class="m--space-30 m--margin-top-20 text-center">
                    <a class="btn btn-success btn-sm m-btn m-btn m-btn--icon m-btn--pill" id="bukaAkunTrading" href="#">
                        <span>
                            <i class="fa flaticon-paper-plane"></i>
                            <span>Membuka Akun Perdagangan</span>
                        </span>
                    </a>
                </div> -->

                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="m-portlet m-portlet--mobile" style="background-color: #c33232;">
                <div class="m-portlet__body">

                    <h5 class="text-light">TOTAL LOT</h5>

                    <div class="text-center text-light">

                        <h3 class="font-weight-bold"><?= mkt_total_lot(sess('mkt')); ?> LOT</h3>

                        <br>

                    </div>

                </div>
            </div>
        </div>

    </div>



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
                                LIST 5 TOP OMSET
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Section-->
                    <div class="m-section">
                        <span class="m-section__sub">
                            <!--  -->
                        </span>
                        <div class="m-section__content">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Mitra</th>
                                            <th class="text-center">Total Omset</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no1 = 1;
                                        foreach ($top_omset as $r) {
                                        ?>
                                            <!-- <tr>
                                                <td class="text-center"><?= $no1; ?>.</td>
                                                <td>
                                                    <span class="text-danger font-weight-bold"><?= $r['kode'] ?></span>
                                                    <br>
                                                    <?= ucwords($r['nama']) ?>
                                                </td>
                                                <td class="text-center">IDR <?= rupiah($r['total_omset']) ?></td>
                                            </tr> -->
                                        <?php
                                            $no1++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="m--space-30 text-center">
                            <a class="btn btn-success btn-sm m-btn m-btn m-btn--icon m-btn--pill" href="akuntrading/saveRequestDemo">
                                <span>
                                    <i class="fa flaticon-paper-plane"></i>
                                    <span>Buka Akun Demo</span>
                                </span>
                            </a>
                        </div> -->
                    </div>
                    <!--end::Section-->
                </div>
            </div>

            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                LIST 5 TOP COMMISSION
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Section-->
                    <div class="m-section">
                        <span class="m-section__sub">
                            <!--  -->
                        </span>
                        <div class="m-section__content">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Mitra</th>
                                            <th class="text-center">Total Commission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no2 = 1;
                                        foreach ($top_commission as $r) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no2; ?>.</td>
                                                <td>
                                                    <span class="text-danger font-weight-bold"><?= $r['kode'] ?></span>
                                                    <!-- <br> -->
                                                    <?php
                                                    // echo ucwords($r['nama']) 
                                                    ?>
                                                </td>
                                                <td class="text-center">IDR <?= rupiah($r['total_komisi']) ?></td>
                                            </tr>
                                        <?php
                                            $no2++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="m--space-30 text-center">
                            <a class="btn btn-success btn-sm m-btn m-btn m-btn--icon m-btn--pill" href="akuntrading/saveRequestDemo">
                                <span>
                                    <i class="fa flaticon-paper-plane"></i>
                                    <span>Buka Akun Demo</span>
                                </span>
                            </a>
                        </div> -->
                    </div>
                    <!--end::Section-->
                </div>
            </div>



        </div>

    </div>


    <div class="m-portlet messaging">
        <div class="inbox_msg">
            <div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4>USERS</h4>
                    </div>
                    <div class="srch_bar">
                        <div class="stylish-input-group">
                            <input type="text" class="search-bar" placeholder="Search">
                            <span class="input-group-addon">
                                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="inbox_chat">
                    <div class="chat_list active_chat">
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt=""> </div>
                            <div class="chat_ib">
                                <h5>User <span class="chat_date">Dec 25</span></h5>
                                <p>Test, which is a new approach to have all solutions
                                    astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt=""> </div>
                            <div class="chat_ib">
                                <h5>User <span class="chat_date">Dec 25</span></h5>
                                <p>Test, which is a new approach to have all solutions
                                    astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt=""> </div>
                            <div class="chat_ib">
                                <h5>User <span class="chat_date">Dec 25</span></h5>
                                <p>Test, which is a new approach to have all solutions
                                    astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt=""> </div>
                            <div class="chat_ib">
                                <h5>User <span class="chat_date">Dec 25</span></h5>
                                <p>Test, which is a new approach to have all solutions
                                    astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt=""> </div>
                            <div class="chat_ib">
                                <h5>User <span class="chat_date">Dec 25</span></h5>
                                <p>Test, which is a new approach to have all solutions
                                    astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt=""> </div>
                            <div class="chat_ib">
                                <h5>User <span class="chat_date">Dec 25</span></h5>
                                <p>Test, which is a new approach to have all solutions
                                    astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt=""> </div>
                            <div class="chat_ib">
                                <h5>User <span class="chat_date">Dec 25</span></h5>
                                <p>Test, which is a new approach to have all solutions
                                    astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mesgs">
                <div class="msg_history">
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt=""> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>Test which is a new approach to have all
                                    solutions</p>
                                <span class="time_date"> 11:01 AM | June 9</span>
                            </div>
                        </div>
                    </div>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>Test which is a new approach to have all
                                solutions</p>
                            <span class="time_date"> 11:01 AM | June 9</span>
                        </div>
                    </div>
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt=""> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>Test, which is a new approach to have</p>
                                <span class="time_date"> 11:01 AM | Yesterday</span>
                            </div>
                        </div>
                    </div>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>Apollo University, Delhi, India Test</p>
                            <span class="time_date"> 11:01 AM | Today</span>
                        </div>
                    </div>
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt=""> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>We work directly with our designers and suppliers,
                                    and sell direct to you, which means quality, exclusive
                                    products, at a price anyone can afford.</p>
                                <span class="time_date"> 11:01 AM | Today</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="type_msg">
                    <div class="input_msg_write">
                        <input type="text" class="write_msg" placeholder="Type a message" />
                        <button class="msg_send_btn" type="button">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

    });

    function copyToClipboard(element) {

        console.log('copy link');

        /* Get the text field */
        var copyText = document.getElementById(element);

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");

        $.toast({
            text: 'Referral link copied to clipboard!',
            position: 'top-right',
            textAlign: 'left',
            hideAfter: 2500,
            icon: 'success'
        });

    }
</script>