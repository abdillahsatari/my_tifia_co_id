		<section id="hubungikami"></section>
			<footer id="footer" style="margin-top: 0px;">
					<div class="container">
						<div class="footer-ribbon">
							<span>Get in Touch</span>
						</div>
						<div class="row py-5 my-4">
							<div class="col-md-6 col-lg-3 mb-4 mb-md-0">
								<h5 class="text-3 mb-3" style="text-align: justify;"><strong>PT SDP SYARIAH INDONESIA</strong></h5>
								<p class="pr-1" align="justify" style="color:#777;">Perusahaan developer property syariah tanpa Bank pertama kali di kota Depok yang berdiri pada tahun 2016 dengan nama brand <strong style="color: white;">"Syamsa Dhuha Property"</strong>, dimana para pendirinya sangat berpengalaman di bidang property baik sebagai agency, kontraktor maupun developer secara konvensional.</p>
								<!-- <div class="alert alert-success d-none" id="newsletterSuccess">
									<strong>Success!</strong> You've been added to our email list.
								</div>
								<div class="alert alert-danger d-none" id="newsletterError"></div>
								<form id="newsletterForm" action="php/newsletter-subscribe.php" method="POST" class="mr-4 mb-3 mb-md-0">
									<div class="input-group input-group-rounded">
										<input class="form-control form-control-sm bg-light" placeholder="Email Address" name="newsletterEmail" id="newsletterEmail" type="text">
										<span class="input-group-append">
											<button class="btn btn-light text-color-dark" type="submit"><strong>GO!</strong></button>
										</span>
									</div>
								</form> -->
							</div>
							<!-- <div class="col-6 col-lg-2 mb-5 mb-lg-0">
								<h5 class="text-3 mb-3">NAVIGASI</h5>
								<ul class="list list-icons list-icons-sm">
									<li><i class="fas fa-angle-right"></i><a data-hash data-hash-offset="68" href="#home" class="link-hover-style-1 ml-1"> Home</a></li>
									<li><i class="fas fa-angle-right"></i><a data-hash data-hash-offset="68" href="#project" class="link-hover-style-1 ml-1"> Proyek Kami</a></li>
									<li><i class="fas fa-angle-right"></i><a data-hash data-hash-offset="68" href="#testimoni" class="link-hover-style-1 ml-1"> Testimoni</a></li>
									<li><i class="fas fa-angle-right"></i><a data-hash data-hash-offset="68" href="#tanyajawab" class="link-hover-style-1 ml-1"> FAQ</a></li>
									<li><i class="fas fa-angle-right"></i><a data-hash data-hash-offset="68" href="#blog" class="link-hover-style-1 ml-1"> Blog</a></li>
								</ul>
							</div> -->
							<div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
								<div class="contact-details">
									<h5 class="text-3 mb-3">HUBUNGI KAMI</h5>
									<ul class="list list-icons list-icons-lg">
										<li class="mb-1"><i class="fas fa-map-marked-alt text-color-primary"></i><p class="m-0" style="color:#777;">Ruko Pesona Blok A.No.8 <br>Jl. K.H.M.Yusuf, Mekar Jaya, Sukmajaya, Depok<br> Jawa Barat 16411</p></li>
										<li class="mb-1"><i class="fas fa-phone text-color-primary"></i><p class="m-0"><a href="tel:8001234567">021-27612433</a></p></li>
										<li class="mb-1"><i class="far fa-envelope text-color-primary"></i><p class="m-0"><a href="mailto:cs@syamsagroup.co.id">cs@syamsagroup.co.id</a></p></li>
									</ul>
									<h5 class="text-3 mb-3">JAM OPERASIONAL</h5>
									<ul class="list list-icons list-dark mt-2">
										<li class="mb-1"><i class="far fa-clock text-color-primary"></i> Senin - Jum'at : 09:00 - 16:00 (Kantor)</li>
										<li class="mb-1"><i class="far fa-clock text-color-primary"></i> Sabtu - Ahad :  09:00 - 16:00 (Proyek)</li>
									</ul>
								</div>
							</div>
							<div class="col-6 col-lg-2 mb-5 mb-lg-0">
								<h5 class="text-3 mb-3">ARTIKEL FAVORIT</h5>
								<ul class="list list-icons list-icons-sm">
									<?php $popular = $this->Blog_model->popularArtikel();
										foreach ($popular as $key => $value) { ?>
											<li><i class="fas fa-angle-right"></i><a href="https://syamsagroup.co.id/development/blog/<?php echo $value->slug; ?>" class="link-hover-style-1 ml-1"> <?php echo $value->judul; ?></a></li>
										<?php }
									?>
										
									
								</ul>
							</div>
							
							<div class="col-md-6 col-lg-2">
								<h5 class="text-3 mb-3">IKUTI SOSIAL MEDIA</h5>
								<ul class="social-icons">
									<li class="social-icons-facebook"><a href="https://www.facebook.com/sdpsyariahindonesia/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
									<li class="social-icons-instagram"><a href="http://www.instagram.com/syamsadhuhaproperty" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
									<li class="social-icons-telegram"><a href="https://t.me/joinchat/AAAAAFL83-K15T0C-_sgRQ" target="_blank" title="Telegram"><i class="fab fa-telegram"></i></a></li>
									<li class="social-icons-youtube"><a href="https://www.youtube.com/channel/UCOHyw6xyUKw-DPaxaf0-8mw?view_as=subscriber" target="_blank" title="Youtube Chanel"><i class="fab fa-youtube"></i></a></li>
								</ul><br>
							</div>
							
						</div>
					</div>
					<div class="footer-copyright">
						<div class="container py-2">
							<div class="row py-4">
								<div class="col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-start mb-4 mb-lg-0">
									<p>PT SDP Syariah Indonesia © Copyright 2019. Hak Cipta Dilindungi Undang-Undang.</p>
								</div>
								<div class="col-lg-1 d-flex align-items-center justify-content-center justify-content-lg-start mb-2 mb-lg-0">
									<!-- <a href="#home" class="logo pr-0 pr-lg-3">
										<img alt="Syamsagroup" src="img/logo-footer.png" class="opacity-5" height="33">
									</a> -->
								</div>
								
								<div class="col-lg-4 d-flex align-items-center justify-content-center justify-content-lg-end">
									<!-- <nav id="sub-menu">
										<ul>
											<li><i class="fas fa-angle-right"></i><a href="page-faq.html" class="ml-1 text-decoration-none"> FAQ's</a></li>
											<li><i class="fas fa-angle-right"></i><a href="sitemap.html" class="ml-1 text-decoration-none"> Sitemap</a></li>
											<li><i class="fas fa-angle-right"></i><a href="contact-us.html" class="ml-1 text-decoration-none"> Contact Us</a></li>
										</ul>
									</nav> -->
									
								</div>
							</div>
						</div>
					</div>
			</footer>

		</div>

		<!-- Vendor -->
		<script src="assets/web/vendor/jquery/jquery.min.js"></script>
		<script type="text/javascript">
		
		var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
	</script>
		<script src="assets/web/vendor/jquery.appear/jquery.appear.min.js"></script>
		<script src="assets/web/vendor/jquery.easing/jquery.easing.min.js"></script>
		<script src="assets/web/vendor/jquery.cookie/jquery.cookie.min.js"></script>
		<script src="assets/web/vendor/popper/umd/popper.min.js"></script>
		<script src="assets/web/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/web/vendor/common/common.min.js"></script>
		<script src="assets/web/vendor/jquery.validation/jquery.validation.min.js"></script>
		<script src="assets/web/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script> 
		<script src="assets/web/vendor/jquery.gmap/jquery.gmap.min.js"></script>
		<script src="assets/web/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
		<script src="assets/web/vendor/isotope/jquery.isotope.min.js"></script>
		<script src="assets/web/vendor/owl.carousel/owl.carousel.min.js"></script>
		<script src="assets/web/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="assets/web/vendor/vide/vide.min.js"></script>

		<!-- Format Rupiah -->
		<script src="assets/web/js/jquery.mask.min.js"></script>
		<script src="assets/web/js/jquery.mask.js"></script>


		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/web/js/theme.js"></script>

		<script src="assets/web/js/views/view.home.js"></script>

		<!-- Current Page Vendor and Views -->
		<script src="assets/web/js/views/view.contact.js"></script>

	<!-- 	<script src="assets/web/js/demos/demo-education.js"></script> -->
		
		<!-- Current Page Vendor and Views -->
		<script src="assets/web/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
		<script src="assets/web/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/web/js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/web/js/theme.init.js"></script>

		<!--Start of Tawk.to Script-->
		<!-- <script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/5c7383c83341d22d9ce5e88a/default';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
		})();
		</script> -->
		<!--End of Tawk.to Script-->

		<!-- WhatsHelp.io widget -->
		<script type="text/javascript">
		(function () {
		var options = {
		whatsapp: "+6285882728713", // WhatsApp number
		call_to_action: "Assalamu'alaykum Admin", // Call to action
		position: "right", // Position may be 'right' or 'left'
		};
		var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
		var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
		s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
		var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
		})();
		</script>
		<!-- /WhatsHelp.io widget --> 

		<script type="text/javascript">
		  function kalkulator() {
		    var harga = parseInt(document.getElementById("harga").value);
		    var dp = parseInt(document.getElementById("dp").value);
		    var tenor = parseInt(document.getElementById("tenor").value);

		    var nama = document.getElementById("nama").value;
		    var nowa = document.getElementById("wa").value;
		    var email = document.getElementById("email").value;

		    var cicilan = document.getElementById("hasil");
		    var harga_total = document.getElementById("harga_total");

		    var lb = $("#harga option:selected").attr("lb");
 			var lt = $("#harga option:selected").attr("lt");
		    
		    var nama_simulasi = document.getElementById("nama_simulasi");
		    var tlp_simulasi = document.getElementById("tlp_simulasi");
		    var email_simulasi = document.getElementById("email_simulasi");
		    var lb_simulasi = document.getElementById("lb_simulasi");
		    var lt_simulasi = document.getElementById("lt_simulasi");

		    var harga_rmh = document.getElementById("harga_rmh");
		    var dp_rmh = document.getElementById("dp_rmh");
		    var cicilan_rmh = document.getElementById("cicilan_rmh");
		    var thn_rmh = document.getElementById("thn_rmh");

		    var bulan;
		    var harga_sisa;
		    var return_pertahun;
		    var harga_pertahun;
		    var harga_jml;

		    var h_cicilan;
		    var h_harga_total;
		    if(isNaN(dp)){
		      alert('isi DP dengan angka!')
		    } else {
		    	if (nama=="" || nowa=="" || email=="email") {
		    		alert('Mohon Lengkapi Data!')
		    	} else {
		    		$.ajax({
		                type : "POST",
		                url  : "content/kalkulator/simpan",
		                dataType : "JSON",
		                data : {nama : nama, no_hp: nowa, email: email},

		                success: function(data){
		                	if (data.success === true) {
		                		bulan = tenor*12;

		                		harga_sisa = harga-dp;
		                		return_pertahun = harga_sisa*0.08;
		                		harga_pertahun = return_pertahun*tenor;
		                		harga_jml = harga_sisa+harga_pertahun;
		                		h_cicilan = harga_jml/bulan;
		                		h_harga_total = h_cicilan*bulan+dp;

		                		cicilan.value = h_cicilan;
		                		harga_total.value = h_harga_total;

		                		nama_simulasi.innerHTML = nama;
		                		tlp_simulasi.innerHTML = nowa;
		                		email_simulasi.innerHTML = email;

		                		lb_simulasi.innerHTML = lb;
		                		lt_simulasi.innerHTML = lt;

		                		harga_rmh.innerHTML = h_harga_total;
		                		dp_rmh.innerHTML = dp;
		                		cicilan_rmh.innerHTML = h_cicilan;
		                		thn_rmh.innerHTML = tenor; 

		                	} else {
		                		alert('gagal menghitung');
		                	}
		                }
		            });
		            return false;
		    	}
		    }
		}

		$('#subs').on('click',function(){
	            var email = $("#newsletterEmail").val();
	            $.ajax({
	                type : "POST",
	                url  : "adminarea/subscriber/kirim_subscriber/",
	                dataType : "JSON",
	                data : {email: email},

	                success: function(data){
	                	if (data.success === true) {
	                		alert('Terimakasih telah mensubscribe kami');
	                	} else {
	                		alert('subscribe gagal, silahkan coba lagi');
	                	}
	                },
	            });
	            return false;
	        });
		</script>


	
	</body>
</html>