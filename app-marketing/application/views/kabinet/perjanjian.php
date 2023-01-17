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
                            <h3 class="m-portlet__head-text">
                            
                                <span>Kontrak Perjanjian Nasabah Online</span>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">
                        <?php foreach ($acc as $key => $value) { ?>
                            <table>
                                <tr>
                                    <td>No Akun</td>
                                    <td><?= $value->no_akun ?></td>
                                </tr>
                                <tr>
                                    <td>Tipe Akun</td>
                                    <td><?= $value->type ?></td>
                                </tr>
                            </table>
                            <!-- isi perjanjian -->
                            <table class="table table-striped m-table">
                                <thead>
                                    <tr>
                                        <th>Step</th>
                                        <th>Judul</th>
                                        <th>No Formulir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Profil perusahaan pialang berjangka</td>
                                        <td>Formulir Nomor 107.PBK.01</td>
                                        <td><a href="perjanjian/formulirpbk01"  target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                                <span>
                                                    <i class="la la-file-pdf-o"></i>
                                                    <span>Lihat</span>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2.1</td>
                                        <td>Pernyataan telah melakukan simulasi perdagangan berjangka komoditi</td>
                                        <td>Formulir Nomor 107.PBK.02.1</td>
                                        <td><a href="perjanjian/formulirpbk02_1" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                                <span>
                                                    <i class="la la-file-pdf-o"></i>
                                                    <span>Lihat</span>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2.2</td>
                                        <td>Pernyataan telah berpengalaman melaksanakan perdagangan berjangka komoditi</td>
                                        <td>Formulir Nomor 107.PBK.02.2</td>
                                        <td><a href="perjanjian/formulirpbk02_2" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                                <span>
                                                    <i class="la la-file-pdf-o"></i>
                                                    <span>Lihat</span>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Aplikasi pembukaan rekening transaksi secara elektronik on-line</td>
                                        <td>Formulir Nomor 107.PBK.03</td>
                                       <td><a href="perjanjian/formulirpbk03" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                                <span>
                                                    <i class="la la-file-pdf-o"></i>
                                                    <span>Lihat</span>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Pemberitahuan adanya resiko untuk kontrak transaksi online berjangka</td>
                                        <td>Formulir Nomor 107.PBK.04.2</td>
                                       <td><a href="perjanjian/formulirpbk04" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                                <span>
                                                    <i class="la la-file-pdf-o"></i>
                                                    <span>Lihat</span>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Perjanjian pemberian amanat secara elektronik on-line dalam sistem perdagangan alternatif</td>
                                        <td>Formulir Nomor 107.PBK.05.2</td>
                                        <td><a href="perjanjian/formulirpbk05" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                                <span>
                                                    <i class="la la-file-pdf-o"></i>
                                                    <span>Lihat</span>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Trading rules (peraturan transaksi on-line trading)</td>
                                        <td>Formulir Nomor 107.PBK.06</td>
                                        <td><a href="perjanjian/formulirpbk06" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                                <span>
                                                    <i class="la la-file-pdf-o"></i>
                                                    <span>Lihat</span>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Pernyataan bertanggung jawab atas kode akses transaksi nasabah</td>
                                        <td>Formulir Nomor 107.PBK.07</td>
                                        <td><a href="perjanjian/formulirpbk07" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                                <span>
                                                    <i class="la la-file-pdf-o"></i>
                                                    <span>Lihat</span>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>                                    
                                </tbody>
                            </table>  
                            <!-- isi perjanjian -->
                        <?php } ?>
                            
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
<script type="text/javascript">
function closePrint () {
  document.body.removeChild(this.__container__);
}

function setPrint () {
  this.contentWindow.__container__ = this;
  this.contentWindow.onbeforeunload = closePrint;
  this.contentWindow.onafterprint = closePrint;
  this.contentWindow.focus(); // Required for IE
  console.log(this.contentWindow);  
  this.contentWindow.print();
}

function printPage (sURL) {
  var oHiddFrame = document.createElement("iframe");
  oHiddFrame.onload = setPrint;
  oHiddFrame.style.visibility = "hidden";
  oHiddFrame.style.position = "fixed";
  oHiddFrame.style.right = "0";
  oHiddFrame.style.bottom = "0";
  oHiddFrame.src = sURL;
  document.body.appendChild(oHiddFrame);
}
</script>
