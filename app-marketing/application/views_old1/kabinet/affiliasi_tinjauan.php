<div class="m-subheader">

    <div class="row">
        <div class="col-sm-12">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Tinjauan
                            </h3>
                        </div>
                    </div>

                </div>
                <div class="m-portlet__body">
                    <div class="table-responsive">
                        <!--begin: Datatable -->
                        <table class="table table-striped responsive no-wrap">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold">Status</td>
                                    <td>:</td>
                                    <td>MLD</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Client UID</td>
                                    <td>:</td>
                                    <td>XXX</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <?php
                    $base_url = substr(base_url(), 0, -1);
                    ?>

                    <div class="form-group mb-2">
                        <label>Rujukan pertautan</label>
                        <div class="input-group">
                            <input type="text" id="toCopy" class="form-control" value="<?= $base_url ?>?uid=XXX" class="form-control" readonly>
                            <div class="input-group-append">
                                <button onclick="copyToClipboard('toCopy')" class="btn btn-primary waves-effect waves-light" type="button">Copy <i class="fa fa-clipboard"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<div class="m-content">

    <div class="row">
        <div class="col-sm-12">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Mitra
                            </h3>
                        </div>
                    </div>

                </div>
                <div class="m-portlet__body">
                    <div class="table-responsive">
                        <!--begin: Datatable -->
                        <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Rekening</th>
                                    <th>Leverage</th>
                                    <th>Saldo</th>
                                    <th>Kredit</th>
                                    <th>Equity</th>
                                    <th>Margin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($afiliasi as $r) { ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php
                                    $no++;
                                } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>