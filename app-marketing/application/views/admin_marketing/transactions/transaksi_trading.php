<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>

            <div class="box-body">

                <form id="myform" method="post" onsubmit="return false">

                    <div class="row" style="margin-bottom: 10px">
                        <div class="col-xs-12 col-md-4">
                            <!-- <?php echo anchor(site_url('adminarea/marketing/nasabah/'), '<i class="fa fa-plus"></i> Create', 'class="btn bg-purple"'); ?> -->
                            <a href="#" id="TambahTransaksi" data-href="<?= base_url('adminarea/marketing/nasabah/modal_tambah_transaksi') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                        </div>
                        <div class="col-xs-12 col-md-4 text-center">
                            <div style="margin-top: 4px" id="message">

                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4 text-right">
                            <?php echo anchor(site_url('adminarea/marketing/transactions/excel'), '<i class="fa fa-file-excel"></i> Excel', 'class="btn btn-success"'); ?>
                            <!-- <?php echo anchor(site_url('adminarea/marketing/word'), '<i class="fa fa-file-word"></i> Word', 'class="btn btn-primary"'); ?> -->

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tableku" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="10px">#</th>
                                    <th class="text-center">Kode</th>
                                    <th class="text-center">No Akun Trading</th>
                                    <th class="text-center">Lot</th>
                                    <th class="text-center">Tipe</th>
                                    <th class="text-center">Tanggal</th>

                                    <th class="text-center" width="80px">Action</th>
                                </tr>
                            </thead>


                        </table>
                    </div>
                    <!-- <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button> -->
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahTransaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form" action="<?= base_url('adminarea/marketing/transactions/tambahTransaksi_action') ?>">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Akun Trading</label>
                        <div class="col-sm-10">
                            <select name="no_akun" id="no_akun" class="form-control form-control-sm">

                                <?php
                                $qry = '
                                    SELECT acc_trading.no_akun, nasabah.nama_lengkap
                                    FROM acc_trading, nasabah
                                    WHERE acc_trading.nasabah_id=nasabah.nasabah_id
                                ';
                                $nasabah = $this->db->query($qry)->result();
                                foreach ($nasabah as $r) {
                                    echo '<option value="' . $r->no_akun . '">' . $r->no_akun . ' - ' . $r->nama_lengkap . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">LOT</label>
                        <div class="col-sm-10">
                            <input type="number" name="lot" id="lot" min="0" step="0.01" class="form-control form-control-sm" placeholder="Berapa LOT">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">USD per LOT</label>
                        <div class="col-sm-10">
                            <input type="number" name="usd" id="usd" min="0" class="form-control form-control-sm" value="50" placeholder="Berapa USD per LOT">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tipe</label>
                        <div class="col-sm-10">
                            <select name="tipe" id="tipe" class="form-control form-control-sm">
                                <option value="buy">BUY</option>
                                <option value="sell">SELL</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" id="submit" class="btn btn-primary btn-sm">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        $(document).ready(function() {
            var dataTable = $('#tableku').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?= base_url() . 'adminarea/marketing/transactions/fetch_transaksi_trading'; ?>",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5, 6],
                    "orderable": false,
                }, ],
                'autoWidth': false
            });
        });


        $(document).on("click", "#TambahTransaksi", function(e) {
            e.preventDefault();
            $("#modalTambahTransaksi").modal("show");
        });

        $(document).on('submit', '#form', function(e) {
            e.preventDefault();
            var me = $(this);
            $("#submit").prop('disabled', true).html('<div class="spinner-border spinner-border-sm text-white"></div> Processing...');
            $.ajax({
                url: me.attr('action'),
                type: 'post',
                data: new FormData(this),
                contentType: false,
                cache: false,
                dataType: 'JSON',
                processData: false,
                success: function(json) {
                    if (json.form_validation == true) {
                        $('.form-group').removeClass('.has-error')
                            .removeClass('.has');

                        if (json.success == true) {

                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success('<a style="color:white"><p>' + json.alert + '</p></a>');

                            $("#modalTambahTransaksi").modal('hide');
                            // $("#tableku").DataTable().ajax.reload();
                            location.reload();
                            // window.location.href = json.href;

                        } else {
                            $("#submit").prop('disabled', false).html('Submit');
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.error('<a style="color:white"><p>' + json.alert + '</p></a>');
                        }

                    } else {
                        $("#submit").prop('disabled', false)
                            .html('Submit');
                        $.each(json.alert, function(key, value) {
                            var element = $('#' + key);
                            $(element)
                                .closest('.form-group')
                                .find('.invalid-feedback-show').remove();
                            $(element).after(value);
                        });
                    }
                }
            });
        });

    });
</script>