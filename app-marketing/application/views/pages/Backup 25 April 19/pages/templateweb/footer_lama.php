		<section id="hubungikami"></section>
			<footer id="footer" style="margin-top: 0px;">
					<div class="container">
						<div class="footer-ribbon">
							<span>Get in Touch</span>
						</div>
						<div class="row py-5 my-4">
							<div class="col-md-6 col-lg-3 mb-4 mb-md-0">
								<h5 class="text-3 mb-3" style="text-align: justify;"><strong>PT SDP SYARIAH INDONESIA</strong></h5>
								<p class="pr-1" align="justify">Perusahaan developer property syariah tanpa Bank pertama kali di kota Depok yang berdiri pada tahun 2016 dengan nama brand <strong style="color: white;">"Syamsa Dhuha Property"</strong>, dimana para pendirinya sangat berpengalaman di bidang property baik sebagai agency, kontraktor maupun developer secara konvensional.</p>
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
										<li class="mb-1"><i class="fas fa-map-marked-alt text-color-primary"></i><p class="m-0">Ruko Pesona Blok A.No.8 <br>Jl. K.H.M.Yusuf, Mekar Jaya, Sukmajaya, Depok<br> Jawa Barat 16411</p></li>
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

		<script src="assets/jmask/src/jquery.mask.js"></script>

		<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5c7383c83341d22d9ce5e88a/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<script>
(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));
</script>

<script>
window.fbAsyncInit = function () {
  FB.init({
    appId  : '1083701864999348',
    status : true,
    xfbml  : true,
    version: 'v2.7'
  });

  window.facebookShare = function(href, callback ) {
    var options = ({
      method : 'share',
      href   : href
    }),
    status = '';
    FB.ui(options, function( response ){
      if (response && !response.error_code) {
        status = 'success';
        $.event.trigger('fb-share.success');
      } else {
          status = 'error';
          $.event.trigger('fb-share.error');
      }
      if(callback && typeof callback === "function") {
        callback.call(this, status);
      } else {
        return response;
      }
    });
  }

};

$('#facebook_share').on('click', function( e ) {
  e.preventDefault();
  facebookShare($(this).attr('data-href'),function( response ) {
    // simple function callback
    console.log(response);
  });
});

$('#facebook_share_foot').on('click', function( e ) {
  e.preventDefault();
  facebookShare($(this).attr('data-href'),function( response ) {
    // simple function callback
    console.log(response);
  });
});

$(function(){
$(document).on('click','#facebook_share_all',function(e){
  e.preventDefault();
  facebookShare($(this).attr('data-href'),function( response ) {
    // simple function callback
    console.log(response);
  });
});
});

// custom jQuery events
$(document)
.on('fb-share.success', function( e ) {
    // alert("succeed");
})
.on('fb-share.error', function( e ) {
    // alert("fail");
});
</script>

		<script type="text/javascript">
			$(document).ready(function(){
			    // Format mata uang.
			    $( '.uang' ).mask('0.000.000.000', {reverse: true});
			});

			// function changeValue(id) {
			// 	var value = $('#harga').val();
			// 	var dp_rumah;
			// 	dp_rumah = value*0.3;
			// 	$('#dp').val(dp_rumah);
			// 	// $('#dp_tampil').val(dp_rumah);
			// }

			function kalkulator() {
				var harga = parseInt(document.getElementById("harga").value);
				var dp = parseInt(document.getElementById("dp").value);
				var tenor = parseInt(document.getElementById("tenor").value);
				var hasil = document.getElementById("hasil");
				var harga_total_tahun = document.getElementById("harga_total");

				var nama = document.getElementById("nama").value;
				var wa = document.getElementById("wa").value;
				var email = document.getElementById("email").value;

				var lb = $("#harga option:selected").attr("lb");
 				var lt = $("#harga option:selected").attr("lt");

 				var nama_simulasi = document.getElementById("nama_simulasi");
 				var tlp_simulasi = document.getElementById("tlp_simulasi");
 				var email_simulasi = document.getElementById("email_simulasi");
 				var lb_simulasi = document.getElementById("lb_simulasi");
 				var lt_simulasi = document.getElementById("lt_simulasi");
 				var harga_rmh = document.getElementById("harga_rmh");
		    	var dp_rmh = document.getElementById("dp_rmh");
		    	var thn_rmh = document.getElementById("thn_rmh");
		    	var cicilan_rmh = document.getElementById("cicilan_rmh");

				var bulan;
				var harga_dp;
				var harga_return;
				var harga_tahun;
				var harga_total;
				var cicilan;
				var total_harga;

				if(isNaN(harga)) {
					alert('silahkan pilih harga rumah!');
				} else {
					if ((nama=="") || (wa=="") || (email=="")) {
						alert('nama, no.whatsapp dan email harus diisi!');
					} else {
						$.ajax({
			                type : "POST",
			                url  : "content/kalkulator/simpan",
			                dataType : "JSON",
			                data : {nama : nama, no_hp: wa, email: email},

			                success: function(data){
			                	if (data.success === true) {
			                		bulan = tenor*12;
									harga_dp = harga-dp;
									harga_return = harga_dp*0.08;
									harga_tahun = harga_return*tenor;
									harga_total = harga_dp+harga_tahun;
									cicilan = harga_total/bulan;
									total_harga = cicilan*bulan+dp;
									
									hasil.value = cicilan;
									harga_total_tahun.value = total_harga;

									harga_rmh.innerHTML = harga;
					    			dp_rmh.innerHTML = dp;
					    			thn_rmh.innerHTML = tenor;
					    			cicilan_rmh.innerHTML = cicilan;

					    			nama_simulasi.innerHTML = nama;
					    			tlp_simulasi.innerHTML = wa;
					    			email_simulasi.innerHTML = email;
					    			lb_simulasi.innerHTML = lb;
					    			lt_simulasi.innerHTML = lt;
			                	} else {
			                		alert('proses error');
			                	}
			                },
			            });
			            return false;
							
					}
				}
			}

		  	// function kalkulator() {
		    	
		   //  	var harga = parseInt(document.getElementById("harga").value);
		   //      var tenor = parseInt(document.getElementById("tenor").value);
		   //  	var nama = document.getElementById("nama").value;
		   //  	var nowa = document.getElementById("wa").value;
		   //  	var email = document.getElementById("email").value;
		   //  	var hasil = document.getElementById("hasil");

		   //  	var harga_rmh = document.getElementById("harga_rmh");
		   //  	var dp_rmh = document.getElementById("dp_rmh");
		   //  	var jual_rmh = document.getElementById("jual_rmh");
		   //  	var cicilan_rmh = document.getElementById("cicilan_rmh");

		   //      var total;
		   //  	var hasil1;
		   //  	var bulan;
		   //  	var dp;
		   //  	if(isNaN(harga)){
		   //    		alert('isi form dengan angka!')
		   //  	} else {
		   //  		if (nama=="" || nowa=="") {
		   //  			alert('isi nama dan nomor whatsapp anda!')
		   //  		} else {
		   //  			bulan = tenor*12;
		   //  			dp = harga*0.3;
			  //   		hasil1 = harga-dp;
			  //   		hasil2 = hasil1*0.08;
			  //   		hasil3 = hasil2*tenor; 
		   //  			hasil4 = hasil1+hasil3;		
		   //  			total = hasil4/bulan;

		    			// harga_rmh.innerHTML = harga;
		    			// dp_rmh.innerHTML = dp;
		    			// jual_rmh.innerHTML = hasil4;
		    			// cicilan_rmh.innerHTML = total;
		   //  		}	
		   //  	}
		   //  	alert(total);
		   //  	hasil.value = total;
		  	// }
		</script>

	
	</body>
</html>