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
                                Pohon Jaringan
                            </h3>
                            <button id="download-tree" class="btn btn-primary btn-sm ml-3">Download <i class="fa fa-download"></i></button>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-section">
                        <!-- <span class="m-section__sub">

                        </span> -->

                        <div class="m-section__content html-content">

                            <div class="table-responsive">

                                <div>
                                    <?php
                                    $mitra0 = mitra($marketing_id);
                                    ?>

                                    <!-- <i class="fa fa-users text-danger"></i> -->
                                    <!-- <code class="badgee badge-secondary" data-toggle="tooltip" data-placement="right" title="<?= $mitra0['role'] ?>"><span class="text-danger font-weight-bold"><?= $mitra0['kode'] ?></span> <?= ucwords($mitra0['nama']) ?></code> -->

                                    <code><span class="text-danger font-weight-bold"><?= $mitra0['kode'] ?></span> <?= ucwords($mitra0['nama']) ?></code> <span class="badge badge-dark"><?= $mitra0['role'] ?></span>

                                </div>

                                <?= $pohon; ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(document).on('click', '#download-tree', function(e) {
            e.preventDefault();
            CreatePDFfromHTML();
        });

        //Create PDf from HTML...
        function CreatePDFfromHTML() {
            var HTML_Width = $(".html-content").width();
            var HTML_Height = $(".html-content").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            html2canvas($(".html-content")[0]).then(function(canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) {
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4), canvas_image_width, canvas_image_height);
                }
                pdf.save("Pohon Jaringan [<?= $mitra0['kode'] ?>] <?= ucwords($mitra0['nama']) ?>.pdf");
                // $(".html-content").hide();
            });
        }
    });
</script>