  <!-- BEGIN: Subheader -->
        <div class="m-subheader">
                       
                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Feeds
                                        </h3>
                                    </div>
                                </div>
                            
                            </div>
                            <div class="m-portlet__body">

                                <!--begin: Datatable -->
                                <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="m_table_1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Subjek</th>
                                            <th>Tanggal Kirim</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($feeds as $key => $value) { ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value->subject ?></td>
                                                <td><?= date("d F Y, H:i", strtotime($value->date)) ?></td>
                                                <td><button type="button" class="btn m-btn m-btn--pill m-btn--air m-btn--gradient-from-brand m-btn--gradient-to-info" data-toggle="modal" data-target="#m_modal_<?= $value->users_pesan_id ?>">Buka Pesan</button></td>
                                            </tr>
                                        <?php include 'feedsdetail.php'; $no++; } ?>
                                </table>
                            </div>
                        </div>

                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
    </div>
</div>

<!-- end:: Body -->
<!-- Modal -->
                        <div class="modal fade" id="m_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Informasi Feed</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
