<!-- BEGIN: Subheader -->
<!--  <div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">Dashboard</h3>
        </div>
        
    </div>
</div> -->

<!-- END: Subheader -->
<div class="m-subheader ">

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
                            <h3 class="m-portlet__head-text mr-3">
                                Detail Deposit [<?= $data['deposit_id']; ?>]
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <?= $this->session->flashdata('message') ?>


                    <?php
                    if ($data['status_deposit'] == 'Pending') {
                    ?>
                        <div class="alert alert-warning text-justify" role="alert">
                            <i class="fa fa-exclamation-circle"></i> Mohon untuk melakukan transfer ke rekening <?= $gateway['bank'] . ' - ' . $gateway['no_rekening'] . ' atas nama ' . $gateway['nama_pemilik'] . ' sebesar <b>IDR ' . rupiah($data['total'] + $data['kode_unik']) . '</b>';  ?> dalam 1x24 jam dan mengunggah bukti transfer pada kolom dibawah. Abaikan pesan ini jika anda telah melakukan transfer dan mengunggah bukti transfer. Mohon untuk menunggu sampai setoran dikonfirmasi oleh admin.
                        </div>
                    <?php
                    } elseif ($data['status_deposit'] == 'Approve') {
                    ?>
                        <div class="alert alert-success text-justify" role="alert">
                            <i class="fa fa-check"></i> Setoran anda telah dikonfirmasi. Terima kasih telah melakukan transfer ke rekening <?= $gateway['bank'] . ' - ' . $gateway['no_rekening'] . ' atas nama ' . $gateway['nama_pemilik'] . ' sebesar IDR ' . rupiah($data['total'] + $data['kode_unik']);  ?>. Admin akan transfer setoran anda ke Akun Trading <b><?= $data['no_akun'] ?></b>.
                        </div>
                    <?php
                    } elseif ($data['status_deposit'] == 'Reject') {
                    ?>
                        <div class="alert alert-danger text-justify" role="alert">
                            <i class="fa fa-times-circle"></i> Mohon maaf, setoran anda ditolak. <?= ($data['komen'] != '' ? 'Alasan: <i>' . $data['komen'] . '</i>.' : '') ?>
                        </div>
                    <?php
                    } elseif ($data['status_deposit'] == 'Sukses') {
                    ?>
                        <div class="alert alert-success text-justify" role="alert">
                            <i class="fa fa-check"></i> Balance senilai <b><?= rupiah($data['total_balance']) ?></b> telah ditransfer ke Akun Trading <b><?= $data['no_akun'] ?></b>
                        </div>
                    <?php
                    }
                    ?>

                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">


                            <div class="table-responsive">
                                <table class="table table-striped m-table">

                                    <tbody>
                                        <tr>
                                            <th colspan="3"><b>DATA DEPOSIT</b></th>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <th>:</th>
                                            <td><code><?= $data['status_deposit'] ?></code></td>
                                        </tr>
                                        <tr>
                                            <th>Kode</th>
                                            <th>:</th>
                                            <td><b class="text-danger"><?= $data['deposit_id'] ?></b></td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah deposit</th>
                                            <th>:</th>
                                            <td>IDR <?= rupiah($data['total']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Angka Unik</th>
                                            <th>:</th>
                                            <td><?= rupiah($data['kode_unik']) ?></td>
                                        </tr>
                                        <tr>
                                            <th><b>Total Transfer</b></th>
                                            <th>:</th>
                                            <td><b>IDR <?= rupiah($data['total'] + $data['kode_unik']) ?></b></td>
                                        </tr>
                                        <tr>
                                            <th>No Akun Trading</th>
                                            <th>:</th>
                                            <td><?= $data['no_akun'] ?></td>
                                        </tr>
                                    </tbody>

                                    <tbody>
                                        <tr>
                                            <th colspan="3"><b>REKENING SAYA</b></th>
                                        </tr>
                                        <tr>
                                            <th>Bank</th>
                                            <th>:</th>
                                            <td><?= $rekening['nama_bank'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. Rekening</th>
                                            <th>:</th>
                                            <td><?= $rekening['no_rekening'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Atas Nama</th>
                                            <th>:</th>
                                            <td><?= $rekening['atas_nama'] ?></td>
                                        </tr>
                                    </tbody>

                                    <tbody>
                                        <tr>
                                            <th colspan="3"><b>REKENING TUJUAN</b></th>
                                        </tr>
                                        <tr>
                                            <th>Bank</th>
                                            <th>:</th>
                                            <td><?= $gateway['bank'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>No. Rekening</th>
                                            <th>:</th>
                                            <td><?= $gateway['no_rekening'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Atas Nama</th>
                                            <th>:</th>
                                            <td><?= $gateway['nama_pemilik'] ?></td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>


                            <div>


                                <form action="<?= base_url() ?>deposit/upload/<?= $data['id'] ?>" id="form" method="post" enctype="multipart/form-data">
                                    <div class="table-responsive">
                                        <table class="table m-table">

                                            <tbody>
                                                <tr>
                                                    <th><b>Unggah bukti transfer</b></th>

                                                    <?php
                                                    if ($data['bukti_transfer'] == '' && $data['bukti_transfer'] == null) {
                                                    ?>
                                                        <th>
                                                            <input type="file" class="form-control-file" id="image" name="image">
                                                        </th>
                                                        <td>
                                                            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">Unggah</button>
                                                        </td>
                                                    <?php
                                                    } else {
                                                        echo '<td colspan="2"><i class="text-success">Gambar sudah diunggah</i></td>';
                                                    }
                                                    ?>

                                                </tr>


                                            </tbody>

                                        </table>
                                    </div>
                                </form>

                            </div>

                            <div class="text-left mt-4">
                                <a href="<?= base_url('deposit') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>

                        </div>

                    </div>

                    <!--end::Section-->
                </div>
                <!--  -->

                <!--  -->
            </div>
            <!--end::Portlet-->

        </div>
    </div>
</div>

<!-- end:: Body -->