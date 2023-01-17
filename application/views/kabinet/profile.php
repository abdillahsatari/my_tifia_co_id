<!-- BEGIN: Subheader -->
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title "><?= $title; ?></h3>
			<?= $this->session->flashdata('message'); ?>
			<?php   $email = $this->session->userdata('nsb_email'); ?>
			<?php $data = $this->db->get_where('nasabah', array('email' => $email))->row_array(); ?>
		</div>
	</div>
</div>
<!-- END: Subheader -->
<div class="m-content">
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
				<div class="m-portlet__head">
					<div class="m-portlet__head-tools">
						<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
							<li class="nav-item m-tabs__item">
								<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
									<i class="flaticon-share m--hide"></i>
									Data Pribadi
								</a>
							</li>
							<li class="nav-item m-tabs__item">
								<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
									Kontak Darurat
								</a>
							</li>
<!--							<li class="nav-item m-tabs__item">-->
<!--								<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">-->
<!--									Pekerjaan-->
<!--								</a>-->
<!--							</li>-->
<!--							<li class="nav-item m-tabs__item">-->
<!--								<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_4" role="tab">-->
<!--									Daftar Kekayaan-->
<!--								</a>-->
<!--							</li>-->
							<li class="nav-item m-tabs__item">
								<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_5" role="tab">
									Lampiran Dokumen
								</a>
							</li>
							<li class="nav-item m-tabs__item">
								<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_6" role="tab">
									Ganti Photo Profile
								</a>
							</li>
						</ul>
					</div>

				</div>
				<div class="tab-content">
					<div class="tab-pane active" id="m_user_profile_tab_1">
						<form class="m-form m-form--fit m-form--label-align-right">
							<div class="m-portlet__body">
								<div class="form-group m-form__group m--margin-top-10 m--hide">
									<div class="alert m-alert m-alert--default" role="alert">
										The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Nama Lengkap </label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['nama_lengkap']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Tempat Lahir</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['tempat_lahir']; ?> </span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Tanggal Lahir</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['tgl_lahir']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">No Identitas</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['no_identitas']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Pengalaman Investasi</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['pengalaman_investasi']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Tujuan Pembukaan Rekening</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['tujuan_pembukaan_rek']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">No NPWP</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['no_npwp']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Jenis Kelamin</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['gender']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Status Perkawinan</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['status_kawin']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Nama Suami/Istri</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['nama_pasangan']; ?></span>
									</div>
								</div>

								<div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
								<!--      <div class="form-group m-form__group row">
										 <div class="col-10 ml-auto">
											 <h3 class="m-form__section">2. Address</h3>
										 </div>
									 </div> -->
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Nama Ibu Kandung</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['nama_ibu']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Alamat Rumah</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['alamat_rumah']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Kewarganegaraan</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['kewarganegaraan']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Kode Pos</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['kode_pos']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Status Kepemilikan Rumah</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['status_rumah']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">No. Telp Rumah</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['no_tlp']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">No. Telp Handphone</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['no_hp']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">No.Faksimili</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['no_faksimili']; ?></span>
									</div>
								</div>
							</div>
							<!--   <div class="m-portlet__foot m-portlet__foot--fit">
								  <div class="m-form__actions">
									  <div class="row">
										  <div class="col-2">
										  </div>
										  <div class="col-7">
											  <button type="reset" class="btn btn-accent m-btn m-btn--air m-btn--custom">Save changes</button>&nbsp;&nbsp;
											  <button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">Cancel</button>
										  </div>
									  </div>
								  </div>
							  </div> -->
						</form>
					</div>
					<div class="tab-pane " id="m_user_profile_tab_2">
						<form class="m-form m-form--fit m-form--label-align-right">
							<div class="m-portlet__body">
								<div class="form-group m-form__group m--margin-top-10 m--hide">
									<div class="alert m-alert m-alert--default" role="alert">
										The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Nama Lengkap</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['nama_rekan']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Nomor Telepon</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['telepon_rekan']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Hubungan</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['hubungan_rekan']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Alamat</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['alamat_rekan']; ?></span>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Kode Pos</label>
									<div class="col-8">
										<span class="m-form__control-static">: <?php echo $user['kode_pos_rekan']; ?></span>
									</div>
								</div>
							</div>
						</form>
					</div>
<!--					<div class="tab-pane " id="m_user_profile_tab_3">-->
<!--						<form class="m-form m-form--fit m-form--label-align-right">-->
<!--							<div class="m-portlet__body">-->
<!--								<div class="form-group m-form__group m--margin-top-10 m--hide">-->
<!--									<div class="alert m-alert m-alert--default" role="alert">-->
<!--										The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">Pekerjaan</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['pekerjaan']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">Nama Perusahaan</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['nama_perusahaan']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">Bidang Usaha</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['bidang_usaha']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">Jabatan</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['jabatan']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">Lama Bekerja</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">:  --><?php //echo $user['lama_kerja']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">Kantor Sebelumnya</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['tempat_lahir']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">Alamat Kantor</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['alamat_kantor']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">Kode Pos</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['kode_pos_kantor']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">No Telp Kantor</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['telepon_kantor']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">No Faksimili</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['faksimili_kantor']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!---->
<!--							</div>-->
<!--						</form>-->
<!--					</div>-->
<!--					<div class="tab-pane " id="m_user_profile_tab_4">-->
<!--						<form class="m-form m-form--fit m-form--label-align-right">-->
<!--							<div class="m-portlet__body">-->
<!--								<div class="form-group m-form__group m--margin-top-10 m--hide">-->
<!--									<div class="alert m-alert m-alert--default" role="alert">-->
<!--										The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">Penghasilan Per Tahun</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['pendapatan_pertahun']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">Lokasi Rumah</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['lokasi_rumah']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">Nilai NJOP</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['njob']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">Deposit Bank</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['deposit_bank']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">Jumlah</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['jumlah_kekayaan']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="form-group m-form__group m-form__group--sm row">-->
<!--									<label for="example-text-input" class="col-4 col-form-label">Lainnya</label>-->
<!--									<div class="col-8">-->
<!--										<span class="m-form__control-static">: --><?php //echo $user['kekayaan_lainnya']; ?><!--</span>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--						</form>-->
<!--					</div>-->
					<div class="tab-pane " id="m_user_profile_tab_5">
						<form class="m-form m-form--fit m-form--label-align-right">
							<div class="m-portlet__body">
								<div class="form-group m-form__group m--margin-top-10 m--hide">
									<div class="alert m-alert m-alert--default" role="alert">
										The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">KTP/SIM/Passport</label>
									<div class="col-8">
										<span class="m-form__control-static">: </span>
										<?php if($user['pict_identitas'] == "") { ?>
												- - -
										<?php } else { ?>
											<img src="uploads/photo/<?= $user['pict_identitas']; ?>"  class="img-thumbnail">
										<?php } ?>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">NPWP</label>
									<div class="col-8">
										<span class="m-form__control-static">: </span>
										<?php if($user['foto_npwp'] == "") { ?>
											- - -
										<?php } else { ?>
											<img src="uploads/photo/<?= $user['foto_npwp']; ?>"  class="img-thumbnail">
										<?php } ?>
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<label for="example-text-input" class="col-4 col-form-label">Cover Buku Tabungan</label>
									<div class="col-8">
										<span class="m-form__control-static">: </span>
										<?php if($user['foto_buku_tabungan'] == "") { ?>
											- - -
										<?php } else { ?>
											<img src="uploads/photo/<?= $user['foto_buku_tabungan']; ?>"  class="img-thumbnail">
										<?php } ?>
									</div>
								</div>

							</div>
						</form>
					</div>
					<div class="tab-pane " id="m_user_profile_tab_6">
						<?= $this->session->flashdata('message'); ?>
						<form action="profile/updateprofile" method="post" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right">
							<div class="m-portlet__body">
								<div class="form-group m-form__group m--margin-top-10 m--hide">
									<div class="alert m-alert m-alert--default" role="alert">
										The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
									</div>
								</div>
								<div class="form-group m-form__group m-form__group--sm row">
									<div class="col-lg">
										<span class="m-form__control-static">: </span>
										<img src="uploads/photo/<?= $user['foto_terkini']; ?>"  class="img-thumbnail">
									</div>
								</div>
								<br>
								<div class="form-group m-form__group m-form__group--sm row">
									<div class="col-lg-6">
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="image" name="image" required>
											<label class="custom-file-label" for="image">Pilih Photo</label>
										</div>
									</div>
								</div>
								<br>
								<div class="form-group m-form__group m-form__group--sm row justify-content-end">
									<div class="col-sm-12">
										<button type="submit" name="submit" class="btn btn-primary small"> Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
