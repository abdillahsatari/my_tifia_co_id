<div class="row">
  	<div class="col-xs-12">
    	<div class="box">
      		<div class="box-header">
        		<h3 class="box-title">Perjanjian Nasabah</h3>
        		<div class="box-tools pull-right">
         	 		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            			<i class="fa fa-minus"></i>
          			</button>
          			<button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
            			<i class="fa fa-refresh"></i>
          			</button>
        		</div>
      		</div>
      		<div class="box-body">
        		<form id="myform" method="post" onsubmit="return false">
          			<div class="row" style="margin-bottom: 10px">
            			<div class="col-xs-12 col-md-4">
              			
				<tr><td><a  class="btn bg-purple" href="javascript:window.history.go(-1);" >Kembali</a></td></tr>

            			</div>
            			<div class="col-xs-12 col-md-4 text-center">
	              			<div style="margin-top: 4px"  id="message"></div>
	        			</div>
	            		<div class="col-xs-12 col-md-4 text-right"></div>
	          		</div>
						
	              		No Akun : <?= $acc[0]->no_akun ?>
	              		<p>
	              		Tipe Akun : <?= $acc[0]->jenis ?>
	              		<div class="table-responsive">
			                <table class="table table-bordered table-striped" style="width:100%">
			                  	<thead>
				                    <tr>
				                      	<!-- <th width=""></th> -->
				                      	<th width="10px">Step</th>
				                      	<th>Judul</th>
				                      	<th>No Formulir</th>
				                      	<th width="80px">Action</th>   
				                    </tr>
			                  	</thead>
			                  	<tbody>
				                    <tr>
				                      	<td>1</td>
				                      	<td>Profil perusahaan pialang berjangka</td>
				                      	<td>Formulir Nomor 107.PBK.01</td>
				                      	<td><a href="<?= base_url() ?>adminarea/perjanjian/formulirpbk01/<?= $acc[0]->no_akun ?>"  target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
				                        	<span>
					                            <i class="la la-file-pdf-o"></i>
					                            <span>Lihat</span>
					                        </span>
				                      	</a></td>
				                    </tr>
				                    <tr>
				                        <td>2.1</td>
				                        <td>Pernyataan telah melakukan simulasi perdagangan berjangka komoditi</td>
				                        <td>Formulir Nomor 107.PBK.02.1</td>
				                        <td><a href="<?= base_url() ?>adminarea/perjanjian/formulirpbk02_1/<?= $acc[0]->no_akun ?>" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
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
				                        <td><a href="<?= base_url() ?>adminarea/perjanjian/formulirpbk02_2/<?= $acc[0]->no_akun ?>" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
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
				                       <td><a href="<?= base_url() ?>adminarea/perjanjian/formulirpbk03/<?= $acc[0]->no_akun ?>" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
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
				                       	<td><a href="<?= base_url() ?>adminarea/perjanjian/formulirpbk04/<?= $acc[0]->no_akun ?>" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
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
				                        <td><a href="<?= base_url() ?>adminarea/perjanjian/formulirpbk05/<?= $acc[0]->no_akun ?>" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
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
				                        <td><a href="<?= base_url() ?>adminarea/perjanjian/formulirpbk06/<?= $acc[0]->nasabah_id ?>" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
				                                <span>
				                                    <i class="la la-file-pdf-o"></i>
				                                    <span>Lihat</span>
				                                </span>
				                            </a>
				                        </td>
				                    </tr>
				                    <tr>
				                        <td>7.1</td>
				                        <td>Pernyataan bertanggung jawab atas kode akses transaksi nasabah</td>
				                        <td>Formulir Nomor 107.PBK.07.1</td>
				                        <td><a href="<?= base_url() ?>adminarea/perjanjian/formulirpbk07_1/<?= $acc[0]->nasabah_id ?>" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
				                                <span>
				                                    <i class="la la-file-pdf-o"></i>
				                                    <span>Lihat</span>
				                                </span>
				                            </a>
				                        </td>
				                    </tr> 


									<tr>
				                        <td>7.2</td>
				                        <td>Pernyataan bahwa dana yang digunakan sebagai margin merupakan dana milik nasabah sendiri</td>
				                        <td>Formulir Nomor 107.PBK.07.2</td>
				                        <td><a href="<?= base_url() ?>adminarea/perjanjian/formulirpbk07_2/<?= $acc[0]->nasabah_id ?>" target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
				                                <span>
				                                    <i class="la la-file-pdf-o"></i>
				                                    <span>Lihat</span>
				                                </span>
				                            </a>
				                        </td>
				                    </tr> 
				                    <!-- <tr>
				                      	<td>8</td>
				                      	<td>Bukti Konfirmasi Wakil Pialang</td>
				                      	<td>Bukti Konfirmasi Wakil Pialang</td>
				                      	<td><a <?php if (empty($acc[0]->konfirmasi_bukti)) { ?>
				                      		href="<?= base_url() ?>adminarea/perjanjian/bukti_konfirmasi/<?= $acc[0]->no_akun ?>"
				                      	<?php } else { ?>
				                      		href="<?= base_url() ?>uploads/bukti_konfirmasi/<?= $acc[0]->bukti_konfirmasi ?>"
				                      	<?php } ?> target="_blank" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
				                              <span>
				                                  <i class="la la-file-pdf-o"></i>
				                                  <span>Lihat</span>
				                              </span>
				                          	</a>
				                      	</td>
				                    </tr>                                                    -->
				                </tbody>
			                </table>
		              	</div>
	            
        		</form>
      		</div>
    	</div>
  	</div>
</div>