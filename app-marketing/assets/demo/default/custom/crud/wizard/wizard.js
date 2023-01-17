var WizardDemo = function () {
	$("#m_wizard");
	var e, r, i = $("#m_form");
	return {
		init: function () {
			var n;
			$("#m_wizard"),
				$('#m_datepicker_3').datepicker({
					format: 'yyyy-mm-dd'
				}),
				i = $("#m_form"),
				(r = new mWizard("m_wizard", {
					startStep: 1
				})).on("beforeNext", function (r) {
					!0 !== e.form() && r.stop()
				}), r.on("change", function (e) {
					mUtil.scrollTop()
				}), r.on("change", function (e) {
					1 === e.getStep()
				}), e = i.validate({
					ignore: ":hidden",
					rules: {

						// next button validation
						accept: { required: !0, min: 1 },
						accept1: { required: !0, min: 1 },
						accept2: { required: !0, min: 1 },
						accept3: { required: !0, min: 1 },
						accept4: { required: !0, min: 1 },
						accept5: { required: !0, min: 1 },
						accept6: { required: !0, min: 1 },
						accept7: { required: !0, min: 1 },
						accept8: { required: !0, min: 1 },

						// step 2.1 data diri
						nama_lengkap: { required: !0 },
						tempat_lahir: { required: !0 },
						tgl_lahir: { required: !0 },
						alamat_rumah: { required: !0 },
						kode_pos: { required: !0, minlength: 5 },
						no_identitas: { required: !0, minlength: 16 },
						noakundemo: { required: !0 },

						// step 3 pribadi
						no_npwp: { required: !0, minlength: 15 },
						nama_ibu: { required: !0 },
						kewarganegaraan: { required: !0 },
						no_tlp: { required: !0, minlength: 9 },
						// no_faksimili:{required:!0, minlength:9},

						// step 3 darurat
						nama_rekan: { required: !0 },
						telepon_rekan: { required: !0, minlength: 9 },
						hubungan_rekan: { required: !0 },
						alamat_rekan: { required: !0 },
						kode_pos_rekan: { required: !0, minlength: 5 },

						// step 3 pekerjaan
						// nama_perusahaan: {required:!0},
						// bidang_usaha: {required:!0},
						// jabatan: {required:!0},
						// lama_kerja: {required:!0},
						// kantor_sebelumnya: {required:!0},
						// alamat_kantor: {required:!0},
						// kode_pos_kantor: {required:!0,minlength:5},
						// telepon_kantor:{required:!0, minlength:9},
						// faksimili_kantor:{required:!0, minlength:9},

						// step 3 status
						keluarga_bapepti: { required: !0 },
						status_pailit: { required: !0 },

						// step 3 kekayaan
						lokasi_rumah: { required: !0 },
						njob: { required: !0 },
						deposit_bank: { required: !0 },
						jumlah_kekayaan: { required: !0 },
						// kekayaan_lainnya:{required:!0},

						// step 3 rekening idr
						nama_bank: { required: !0 },
						cabang: { required: !0 },
						// telepon_bank:{required:!0},
						no_rekening: { required: !0 },
						// kode_bank:{required:!0},
						atas_nama: { required: !0 },
						jenis_rekening: { required: !0 },

						// step 3 upload foto
						photo: { required: true },
						identitas: { required: true },
						// npwp: { required: true },
						tabungan: { required: true },

						// step 4 validasi checkboxes
						checkbox_1: { required: true },
						checkbox_2: { required: true },
						checkbox_3: { required: true },
						checkbox_4: { required: true },
						checkbox_5: { required: true },
						checkbox_6: { required: true },
						checkbox_7: { required: true },
						checkbox_8: { required: true },
						checkbox_9: { required: true },
						checkbox_10: { required: true },
						checkbox_11: { required: true },
						checkbox_12: { required: true },
						checkbox_13: { required: true },

						// step 5 validasi checkboxes
						cb_1: { required: true },
						cb_2: { required: true },
						// cb_3: { required: true },
						cb_4: { required: true },
						cb_5: { required: true },
						cb_6: { required: true },
						cb_7: { required: true },
						cb_8: { required: true },
						// cb_9: { required: true },
						cb_10: { required: true },
						cb_11: { required: true },
						cb_12: { required: true },
						cb_13: { required: true },
						cb_14: { required: true },
						cb_15: { required: true },
						cb_16: { required: true },
						cb_17: { required: true },
						cb_18: { required: true },
						cb_19: { required: true },
						cb_20: { required: true },
						cb_21: { required: true },
						cb_22: { required: true },
						cb_23: { required: true },
						cb_24: { required: true },
						cb_25: { required: true },
						cb_26: { required: true },
						cb_27: { required: true },
						cb_28: { required: true }
					},
					messages: {

						// next button validation
						accept: { required: "Anda harus menerima untuk melanjutkan", min: "Anda harus menerima untuk melanjutkan" },
						accept1: { required: "Anda harus menerima untuk melanjutkan", min: "Anda harus menerima untuk melanjutkan" },
						accept2: { required: "Anda harus menerima untuk melanjutkan", min: "Anda harus menerima untuk melanjutkan" },
						accept3: { required: "Anda harus menerima untuk melanjutkan", min: "Anda harus menerima untuk melanjutkan" },
						accept4: { required: "Anda harus menerima untuk melanjutkan", min: "Anda harus menerima untuk melanjutkan" },
						accept5: { required: "Anda harus menerima untuk melanjutkan", min: "Anda harus menerima untuk melanjutkan" },
						accept6: { required: "Anda harus menerima untuk melanjutkan", min: "Anda harus menerima untuk melanjutkan" },
						accept7: { required: "Anda harus menerima untuk melanjutkan", min: "Anda harus menerima untuk melanjutkan" },
						accept8: { required: "Anda harus menerima untuk melanjutkan", min: "Anda harus menerima untuk melanjutkan" },

						// step 2.1 data diri
						nama_lengkap: { required: "Nama lengkap wajib diisi" },
						tempat_lahir: { required: "Tempat lahir wajib diisi" },
						tgl_lahir: { required: "Tanggal lahir wajib diisi" },
						alamat_rumah: { required: "Alamat wajib diisi" },
						kode_pos: { required: "Kode pos wajib diisi", minlength: "Kode Pos minimal 5 digit" },
						no_identitas: { required: "Nomor identitas wajib diisi", minlength: "Panjang nomor harus 16 digit" },
						no_rekening: { required: "Nomor rekening wajib diisi" },

						// step 3 pribadi
						no_npwp: { required: "Nomor NPWP wajib diisi", minlength: "NPWP minimal 15 karakter" },
						nama_ibu: { required: "Nama Ibu wajib diisi" },
						kewarganegaraan: { required: "Kewarganegaraan wajib diisi" },
						no_tlp: { required: "Nomor telepon wajib diisi", minlength: "Nomor telepon minimal 9 karakter" },
						// no_faksimili: {required: "Nomor faksimili wajib diisi", minlength: "Nomor telepon minimal 9 karakter"},

						// step 3 darurat
						nama_rekan: { required: "Nama rekan wajib diisi" },
						telepon_rekan: { required: "Telepon rekan wajib diisi", minlength: "Nomor telepon minimal 9 karakter" },
						hubungan_rekan: { required: "Hubungan rekan wajib diisi" },
						alamat_rekan: { required: "Alamat rekan wajib diisi" },
						kode_pos_rekan: { required: "Kode pos rekan wajib diisi", minlength: "Kode Pos minimal 5 digit" },

						// step 3 pekerjaan
						// nama_perusahaan: {required:"Nama perusahaan wajib diisi"},
						// bidang_usaha: {required:"Bidang usaha wajib diisi"},
						// jabatan: {required:"Jabatan wajib diisi"},
						// lama_kerja: {required:"Lama kerja wajib diisi"},
						// kantor_sebelumnya: {required:"Kantor sebelumnya wajib diisi"},
						// alamat_kantor: {required:"Alamat kantor wajib diisi"},
						// kode_pos_kantor: {required:"Kode pos kantor wajib diisi", minlength: "Kode Pos minimal 5 digit"},
						// telepon_kantor:{required:"Telepon kantor wajib diisi", minlength:"Nomor telepon minimal 9 karakter"},
						// faksimili_kantor:{required:"Faksimili wajib diisi", minlength:"Nomor faksimili minimal 9 karakter"},

						// step 3 status
						keluarga_bapepti: { required: "Anda harus menyatakan statement" },
						status_pailit: { required: "Anda harus menyatakan statement" },

						// step 3 kekayaan
						lokasi_rumah: { required: "Lokasi rumah wajib diisi" },
						njob: { required: "NJOP wajib diisi" },
						deposit_bank: { required: "Deposit bank wajib diisi" },
						jumlah_kekayaan: { required: "Jumlah kekayaan wajib diisi" },
						// kekayaan_lainnya:{required:"Kekayaan lainnya wajib diisi"},

						// step 3 rekening idr
						nama_bank: { required: "Nama bank wajib diisi" },
						cabang: { required: "Cabang wajib diisi" },
						// telepon_bank:{required:"Telepon bank wajib diisi"},
						no_rekening: { required: "Nomor rekening wajib diisi" },
						// kode_bank:{required:"Kode bank wajib diisi"},
						atas_nama: { required: "Atas nama wajib diisi" },
						jenis_rekening: { required: "Jenis rekening wajib diisi" },

						// step 3 upload foto
						photo: { required: "Foto harus dilampirkan" },
						identitas: { required: "Identitas harus dilampirkan" },
						// npwp: { required: "Foto NPWP harus dilampirkan" },
						tabungan: { required: "Buku Tabungan harus dilampirkan" },

						// step 4 checkboxes validation
						checkbox_1: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						checkbox_2: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						checkbox_3: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						checkbox_4: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						checkbox_5: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						checkbox_6: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						checkbox_7: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						checkbox_8: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						checkbox_9: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						checkbox_10: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						checkbox_11: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						checkbox_12: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						checkbox_13: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},

						// step 5 checkboxes validation
						cb_1: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_2: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						// cb_3: {
						// 	required: "Anda harus membaca, memahami, dan menyetujui"
						// },
						cb_4: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_5: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_6: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_7: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_8: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						// cb_9: {
						// 	required: "Anda harus membaca, memahami, dan menyetujui"
						// },
						cb_10: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_11: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_12: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_13: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_14: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_15: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_16: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_17: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_18: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_19: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_20: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_21: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_22: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_23: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_24: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_25: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_26: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_27: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						},
						cb_28: {
							required: "Anda harus membaca, memahami, dan menyetujui"
						}
					},
					invalidHandler: function (form, validator) {
						mUtil.scrollTop()
						var errors = validator.numberOfInvalids();
						if (errors) {
							var message = errors == 1
								? 'Mohon perbaiki kesalahan berikut:\n'
								: 'Mohon perbaiki ' + errors + ' kesalahan berikut:\n';
							var errors = "";
							if (validator.errorList.length > 0) {
								for (x = 0; x < validator.errorList.length; x++) {
									errors += "\n\u25CF " + validator.errorList[x].message;
								}
							}
							alert(message + errors);
						}
						validator.focusInvalid();
					},
					submitHandler: function (form) {

					}
				})
		}
	}
}();

jQuery(document).ready(function () {
	WizardDemo.init()
});