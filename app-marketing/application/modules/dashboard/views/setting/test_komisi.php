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
                                List
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

                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                <p><strong>Hitung Komisi (simulasi)</strong></p>


                                <p>Persen komisi akan <i>default</i> jika tidak di setting di <a href="<?= base_url('dashboard/setting/customrevenue') ?>">Perhitungan Komisi</a>.</p>

                                <form method="POST" action="<?= base_url('dashboard/setting/test_komisi') ?>">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Salest</label>
                                        <div class="col-sm-10">
                                            <select name="mkt_id" class="form-control form-control-sm">
                                                <?php
                                                foreach ($this->Allowance_request->select_marketing() as $r) {
                                                ?>
                                                    <option value="<?= $r->id ?>" <?= (set_value('mkt_id') == $r->id) ? 'selected' : '' ?>><?= $r->kode . ' - ' . $r->nama ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <?= form_error('mkt_id'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">LOT</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="lot" min="0" class="form-control form-control-sm" placeholder="Berapa LOT" value="<?= set_value('lot') ?>">
                                            <?= form_error('lot'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">USD per LOT</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="usd" min="0" class="form-control form-control-sm" value="<?= (set_value('usd') != null ? set_value('usd') : '50') ?>" placeholder="Berapa USD per LOT">
                                            <?= form_error('usd'); ?>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>

                                </form>
                            </div>


                            <div class="table-responsive">
                                <!--begin: Datatable -->
                                <table class="table table-striped table-bordered table-hover" id="tableku">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Mitra</th>
                                            <th>Jabatan</th>
                                            <th>Komisi (%)</th>
                                            <th>Komisi (USD)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($table as $r) {
                                        ?>
                                            <tr>
                                                <td><?= $no; ?>.</td>
                                                <td><?= $r['mitra'] ?></td>
                                                <td><?= $r['jabatan'] ?></td>
                                                <td><?= $r['komisi_persen'] ?></td>
                                                <td><?= $r['komisi_usd'] ?></td>
                                            </tr>

                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>