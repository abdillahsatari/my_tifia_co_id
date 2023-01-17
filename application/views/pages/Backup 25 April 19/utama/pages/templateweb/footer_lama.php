<footer id="footer" id="contact">
				<!-- <div class="container">
					<div class="row py-5">
						<div class="col-md-4 d-flex justify-content-center justify-content-md-start mb-4 mb-lg-0">
							< <a href="index.html" class="logo pr-0 pr-lg-3 pl-3 pl-md-0">
								<img alt="Porto Website Template" src="img/logo-default-slim-dark.png" height="33">
							</a> 
						</div>
						<div class="col-md-8 d-flex justify-content-center justify-content-md-end mb-4 mb-lg-0">
							<div class="row">
								<div class="col-md-12 mb-3 mb-md-0">
									<div class="ml-3 text-center text-md-right">
										<h5 class="text-4 mb-0 text-color-light">OFFICE</h5>
										<h5 class="text-3 mb-0 text-color-light">RUKO PESONA A8</h5>
										<h5 class="text-3 mb-0 text-color-light">Sukmajaya, DEPOK</h5>
										<p class="text-4 mb-0"><i class="fab fa-whatsapp text-color-primary top-1 p-relative"></i><span class="pl-1">+62 821-1111-2051</span></p>            
									</div>
								</div>
								 <div class="col-md-6">
									<div class="ml-3 text-center text-md-right">
										<h5 class="text-3 mb-0 text-color-light">LOS ANGELES</h5>
										<p class="text-4 mb-0"><i class="fab fa-whatsapp text-color-primary top-1 p-relative"></i><span class="pl-1">(123) 465-7890</span></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> -->
				<div class="footer-copyright footer-copyright-style-2">
					<div class="container py-2">
						<div class="row py-4">
							<div class="col-md-4 d-flex align-items-center justify-content-center justify-content-md-start mb-2 mb-lg-0">
								<p>PT SDP Syariah Indonesia © Copyright 2019. All Rights Reserved.</p>
							</div>
							<div class="col-md-8 d-flex align-items-center justify-content-center justify-content-md-end mb-4 mb-lg-0">
								<p><i class="far fa-envelope text-color-primary top-1 p-relative"></i><a href="mailto:cs@syamsagroup.co.id" class="opacity-7 pl-1">cs@syamsagroup.co.id</a></p>
								<ul class="footer-social-icons social-icons social-icons-clean social-icons-icon-light ml-3">
									<li class="social-icons-facebook"><a href="https://www.facebook.com/sdpsyariahindonesia/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
									<li class="social-icons-instagra,"><a href="http://www.instagram.com/syamsadhuhaproperty" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
									<li class="social-icons-telegram"><a href="https://t.me/joinchat/AAAAAFL83-K15T0C-_sgRQ" target="_blank" title="Telegram"><i class="fab fa-telegram"></i></a></li>
								</ul>
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
		<!-- <script src="assets/web/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script> -->
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

		<script src="assets/web/js/demos/demo-education.js"></script>
		
		<!-- Current Page Vendor and Views -->
		<script src="assets/web/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
		<script src="assets/web/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/web/js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/web/js/theme.init.js"></script>

		 <script>
	    $("#menu-toggle").click(function(e) {
	        e.preventDefault();
	        $("#wrapper").toggleClass("toggled");
	    });
	    </script>

	    <?php if ($this->session->flashdata('gagal')): ?>
            <small>
                <script>
                    swal({
                        title: "Gagal",
                        text: "<?php echo $this->session->flashdata('gagal'); ?>",
                        timer: 3000,
                        showConfirmButton: false,
                        type: 'error'
                    });
                </script>
            </small>
        <?php endif; ?>

        <?php if ($this->session->flashdata('berhasil')): ?>
            <small>
                <script>
                    swal({
                        title: "Berhasil",
                        text: "<?php echo $this->session->flashdata('berhasil'); ?>",
                        timer: 3000,
                        showConfirmButton: false,
                        type: 'success'
                    });
                </script>
            </small>
        <?php endif; ?>

	    <script type="text/javascript">
	    	$(document).ready(function(){
			    // Format mata uang.
			    $( '.uang' ).mask('0.000.000.000', {reverse: true});
			});

			$(function () {
		        $("#checkbox1").click(function () 
		        {
		            if ($(this).is(":checked")) {
		                $("#checkbox2").removeAttr("disabled");
		                $("#checkbox2").focus();
		            } else {
		                $("#checkbox2").attr("disabled", "disabled");
		                $("#checkbox3").attr("disabled", "disabled");
		                $("#next").attr("disabled", "disabled");
		                
		            }
		        });
		        $("#checkbox2").click(function () 
		        {
		            if ($(this).is(":checked")) {
		                $("#checkbox3").removeAttr("disabled");
		                $("#checkbox3").focus();
		            } else {
		                $("#checkbox3").attr("disabled", "disabled");
		                $("#next").attr("disabled", "disabled");
		                
		            }
		        });
		        $("#checkbox3").click(function () 
		        {
		            if ($(this).is(":checked")) {
		                $("#next").removeAttr("disabled");
		                $("#next").focus();
		            } else {
		                $("#next").attr("disabled", "disabled");
		                
		            }
		        });
		    });


			function validHuruf(a) {
		        if(!/^[a-zA-Z _]+$/.test(a.value)) {
		        a.value = a.value.substring(0,a.value.length-1000);
		        }
		    }
		    function validAngka(a) {
		        if(!/^[0-9]+$/.test(a.value)) {
		        a.value = a.value.substring(0,a.value.length-1000);
		        }
		    }

		    function validAngkaHuruf(a) {
		        if(!/^[a-zA-Z0-9.]+$/.test(a.value)) {
		        a.value = a.value.substring(0,a.value.length-1000);
		        }
		    }

		    //signup
		    var goodColor = "#66cc66";
			var badColor = "#A94442";	
			function validasiEmail(user) {
			  	pola_email=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
			  	if (!pola_email.test(user.value)){
				    user.style.borderColor = badColor;
	                document.getElementById("emailValidasi").style.display = "block";
	                $('#daftarb').attr('disabled','disabled');
	                return false;
			  	}
			  	user.style.borderColor = goodColor;
                document.getElementById("emailValidasi").style.display = "none";
                $('#daftarb').removeAttr('disabled');
			  	return (true);
			}

			function checkEmail(user) {
				var email = user.value;
				$.ajax({
	                type : "POST",
	                url  : "otentikasi/periksa_email",
	                dataType : "JSON",
	                data : {email: email},
	                success: function(data){
	                	if (data.success !== true) {
	                		user.style.borderColor = badColor;
			                document.getElementById("emailError").style.display = "block";
			                $('#daftarb').attr('disabled','disabled');
			                return false;
	                	} else {
	                		user.style.borderColor = goodColor;
			                document.getElementById("emailError").style.display = "none";
			                $('#daftarb').removeAttr('disabled');
			                return true;
	                	}
	                    
	                }
	            });
			}

			function checkPassw() {
		        //Store the password field objects into variables ...
		        var pass1 = document.getElementById('pass_inv');
		        var pass2 = document.getElementById('repass_inv');
		        //Store the Confimation Message Object ...
		        var message = document.getElementById('confirmMessage');

		        //Compare the values in the password field 
		        //and the confirmation field

		        if(pass1.value == pass2.value){
		            //The passwords match. 
		            //Set the color to the good color and inform
		            //the user that they have entered the correct password 
		            pass2.style.borderColor = goodColor;
		            message.style.color = goodColor;
		            message.innerHTML = "";
		            $('#daftarb').removeAttr('disabled');
		            // alert('a');
		        }else{
		            //The passwords do not match.
		            //Set the color to the bad color and
		            //notify the user.
		            pass2.style.borderColor = badColor;
		            message.style.color = badColor;
		            message.innerHTML = "Password Tidak Sama!";
		            $('#daftarb').attr('disabled','disabled');
		            // alert('bn');
		        }
		    } 

		    $('#daftarb').on('click',function() {
		    	
		    	var tipe = $("#tipe").val();
		    	var ndepan = $("#nmdpn_inv").val();
		    	var nblkg = $("#nmblkg_inv").val();
	            var email = $("#email_inv").val();
	            var tlp = $("#tlp_inv").val();
	            var referral = $("#referral").val();
	            var pass = $("#pass_inv").val();
	            var cpass = $("#repass_inv").val();
	            $.ajax({
	                type : "POST",
	                url  : "otentikasi/daftar",
	                dataType : "JSON",
	                data : {tipe : tipe, nm_depan: ndepan, nm_belakang: nblkg, email: email, telepon: tlp, referral: referral, pass: pass, cpass: cpass},
	                beforeSend: function () {
	                	document.getElementById("loadingdaf").style.display = "block";
	                	// document.getElementById("formnya").style.display = "none";
	                	$('#daftarb').attr('disabled','disabled');
	                },

	                success: function(data){
	                	if (data.success === true) {
	                		swal({
							  title: 'Berhasil!',
							  text: data.message,
							  type: 'success'
							  // confirmButtonText: 'OK'
							}).then(function() {
								// Redirect the user
								window.location.href = "signin";
								console.log('The Ok Button was clicked.');
							});
							document.getElementById("email_inv").value = "";
							document.getElementById("referral").value = "";
							document.getElementById("pass_inv").value = "";
							document.getElementById("repass_inv").value = "";
	                	} else {
	                		swal({
							  title: 'Gagal!',
							  text: data.message,
							  type: 'error',
							  confirmButtonText: 'OK'
							});
	                	}
	                },

	                complete:function(data){
					    document.getElementById("loadingdaf").style.display = "none";
	                	// document.getElementById("formnya").style.display = "none";
	                	$('#daftarb').removeAttr('disabled');
				   	}
	            });
	            return false;
	        });
		    //signup

		    // profile user
		    function checkReferral(user) {
				var uname = user.value;
				$.ajax({
	                type : "POST",
	                url  : "otentikasi/periksa_referral",
	                dataType : "JSON",
	                data : {uname: uname},
	                success: function(data){
	                	if (data.success !== true) {
	                		user.style.borderColor = badColor;
	                		$("#usernameError").html(data.message);
			                document.getElementById("usernameError").style.display = "block";
			                $('#saveProfile').attr('disabled','disabled');
			                return false;
	                	} else {
	                		user.style.borderColor = goodColor;
			                document.getElementById("usernameError").style.display = "none";
			                $('#saveProfile').removeAttr('disabled');
			                return true;
	                	}
	                    
	                }
	            });
			}

			function checkPhone(user) {
				var phone = user.value;
				$.ajax({
	                type : "POST",
	                url  : "otentikasi/periksa_telepon",
	                dataType : "JSON",
	                data : {phone: phone},
	                success: function(data){
	                	if (data.success !== true) {
	                		user.style.borderColor = badColor;
			                document.getElementById("phoneError").style.display = "block";
			                $('#saveProfile').attr('disabled','disabled');
			                return false;
	                	} else {
	                		user.style.borderColor = goodColor;
			                document.getElementById("phoneError").style.display = "none";
			                $('#saveProfile').removeAttr('disabled');
			                return true;
	                	}
	                    
	                }
	            });
			}
			//profile user

			//change pass
			var goodColor = "#66cc66";
			var badColor = "#A94442";	
			function checkPass() {
		        //Store the password field objects into variables ...
		        var pass1 = document.getElementById('newpass');
		        var pass2 = document.getElementById('renewpass');
		        //Store the Confimation Message Object ...
		        var message = document.getElementById('confirmAlert');

		        //Compare the values in the password field 
		        //and the confirmation field

		        if(pass1.value == pass2.value){
		            //The passwords match. 
		            //Set the color to the good color and inform
		            //the user that they have entered the correct password 
		            pass2.style.borderColor = goodColor;
		            message.style.color = goodColor;
		            message.innerHTML = "";
		            $('#cpass').removeAttr('disabled');
		        }else{
		            //The passwords do not match.
		            //Set the color to the bad color and
		            //notify the user.
		            pass2.style.borderColor = badColor;
		            message.style.color = badColor;
		            message.innerHTML = "Password Tidak Sama!";
		            $('#cpass').attr('disabled','disabled');
		        }
		    }
			//change pass

			//forgot pass
			var goodColor = "#66cc66";
			var badColor = "#A94442";	
			function checkingEmail(user) {
				var email = user.value;
				$.ajax({
	                type : "POST",
	                url  : "otentikasi/periksa_email",
	                dataType : "JSON",
	                data : {email: email},
	                success: function(data){
	                	if (data.success !== false) {
	                		user.style.borderColor = badColor;
			                document.getElementById("emailAlert").style.display = "block";
			                $('#fpass').attr('disabled','disabled');
			                return true;
	                	} else {
	                		user.style.borderColor = goodColor;
			                document.getElementById("emailAlert").style.display = "none";
			                $('#fpass').removeAttr('disabled');
			                return false;
	                	}
	                    
	                }
	            });
			}

		    $('#forgetpass').on('click',function(){
	            var user = $("#femail").val();
	            $.ajax({
	                type : "POST",
	                url  : "<?php echo base_url() ?>otentikasi/lupa_password",
	                dataType : "JSON",
	                data : {user: user},

	                beforeSend: function () {
	                	document.getElementById("loadingfpass").style.display = "block";
	                	// document.getElementById("formnya").style.display = "none";
	                	$('#forgetpass').attr('disabled','disabled');
	                },

	                success: function(data){
	                	if (data.success === true) {
							swal({
							  title: 'Berhasil!',
							  text: data.message,
							  type: 'success'
							  // confirmButtonText: 'OK'
							}).then(function() {
								// Redirect the user
								window.location.href = "signin";
								console.log('The Ok Button was clicked.');
							});
	                	} else {
	                		swal({
							  title: 'Gagal!',
							  text: data.message,
							  type: 'error',
							  confirmButtonText: 'OK'
							});
	                	}
	                },

	                complete:function(data){
					    // Hide image container
					    document.getElementById("loadingfpass").style.display = "none";
	        			// document.getElementById("formnya").style.display = "block";
	        			$('#forgetpass').removeAttr('disabled');
				   	}
	            });
	            return false;
	        });

	        //forgot pass

	        //login
	        $('#login').on('click',function(){
	            var user = $("#inputan").val();
	            var pass = $("#password").val();
	            $.ajax({
	                type : "POST",
	                url  : "<?php echo base_url() ?>/otentikasi/masuk",
	                dataType : "JSON",
	                data : {user: user, pass: pass},

	                beforeSend: function () {
	                	document.getElementById("loadinglogin").style.display = "block";
	                	// document.getElementById("formnya").style.display = "none";
	                	$('#login').attr('disabled','disabled');
	                },

	                success: function(data){
	                	if (data.success === true) {
							window.location.replace('dashboard');
	                	} else {
	                		swal({
							  title: 'Gagal!',
							  text: data.message,
							  type: 'error',
							  confirmButtonText: 'OK'
							});
	                	}
	                },

	                complete:function(data){
					    // Hide image container
					    document.getElementById("loadinglogin").style.display = "none";
	        			// document.getElementById("formnya").style.display = "block";
	        			$('#login').removeAttr('disabled');
				   	}
	            });
	            return false;
	        }); 
	        //login

	        //dashboard
	        var auto_refresh = setInterval(
			    function () {
			       $('#jWallet').load('wallet_value').fadeIn("fast");
			       $('#jFollowers').load('followers_value').fadeIn("fast");
			       $('#jInvest').load('invest_value').fadeIn("fast");
			       $('#jWd').load('wd_value').fadeIn("fast");
			    },  5000); // refresh setiap 5000 milliseconds
	        //dashboard

	        //request
	        $(function(){ 
				$('#jenisporto').on('change', function () {
		      		var val = $(this).val(); // get selected value
		      		if (val == "upload") { // require a URL
		          		$("#uploada").show();
		          		$("#ketik").hide();
		      		} else {
		       			$("#uploada").hide();
		       			$("#ketik").show();
		      		}
		      		return false;
		  		});
			});
	        //request
		   	
		   	//investasi
		    $('#submitinvest').on('click',function() {
	            $.ajax({
	                type : "POST",
	                url  : "investasi/simpan",
	                dataType : "JSON",

	                success: function(data){
	                	if (data.success === true) {
	                		swal({
							  title: 'Berhasil!',
							  text: data.message,
							  type: 'success'
							  // confirmButtonText: 'OK'
							}).then(function() {
								// Redirect the user
								window.location.href = "investasi/list";
								console.log('The Ok Button was clicked.');
							});
	                	} else {
	                		swal({
							  title: 'Gagal!',
							  text: data.message,
							  type: 'error',
							  confirmButtonText: 'OK'
							});
	                	}
	                }
	            });
	            return false;
	        });
	          
			$(function(){ 
				$('#cara_pembayaran').on('change', function () {
		      		var val = $(this).val(); // get selected value
		      		if (val == "Transfer") { // require a URL
		          		$("#divElse").show();
		          		$("#divButton").show();
		          		$("#divWallet").hide();
		      		} else if (val == "Wallet") {
		  				$("#divElse").hide();
		          		$("#divButton").show();
		          		$("#divWallet").show();
		      		} else {
		       			$("#divElse").hide();
		          		$("#divButton").hide();
		        		$("#divWallet").hide();
		      		}
		      		return false;
		  		});
			});
			//investasi
		</script>

		<!-- validasi Login Admin-->
		<script type="text/javascript"> 
		    $('#logina').on('click',function(){
	            var user = $("#uname").val();
	            var pass = $("#password").val();
	            $.ajax({
	                type : "POST",
	                url  : "<?php echo base_url() ?>/adminarea/otentikasi",
	                dataType : "JSON",
	                data : {user: user, pass: pass},

	                beforeSend: function () {
	                	document.getElementById("loadinglogina").style.display = "block";
	                	// document.getElementById("formnya").style.display = "none";
	                	$('#logina').attr('disabled','disabled');
	                },

	                success: function(data){
	                	if (data.success === true) {
							window.location.replace('adminarea/dashboard');
	                	} else {
	                		swal({
							  title: 'Gagal!',
							  text: data.message,
							  type: 'error',
							  confirmButtonText: 'OK'
							});
	                	}
	                },

	                complete:function(data){
					    // Hide image container
					    document.getElementById("loadinglogina").style.display = "none";
	        			// document.getElementById("formnya").style.display = "block";
	        			$('#logina').removeAttr('disabled');
				   	}
	            });
	            return false;
	        });
		</script>
		<!-- validasi Login -->

		<script type="text/javascript">
			$(function(){ 
				$('#status_depoadmin').on('change', function () {
		      		var val = $(this).val(); // get selected value
		      		if (val == "Rejected") { // require a URL
		          		$("#catatanadmindepo").show();
		      		} else {
		       			$("#catatanadmindepo").hide();
		      		}
		      		return false;
		  		});
			});

			$(function(){ 
				$('#status_penarikanadmin').on('change', function () {
		      		var val = $(this).val(); // get selected value
		      		if (val == "Rejected") { // require a URL
		          		$("#keteranganrepenarikan").show();
		      		} else {
		       			$("#keteranganrepenarikan").hide();
		      		}
		      		return false;
		  		});
			});

			//request
	        $(function(){ 
				$('#statusreqa').on('change', function () {
		      		var val = $(this).val(); // get selected value
		      		if (val == "Rejected") { // require a URL
		          		$("#ketreq").show();
		      		} else {
		       			$("#ketreq").hide();
		      		}
		      		return false;
		  		});
			});
	        //request

	        //trader
	         $(function(){ 
				$('#level_trader').on('change', function () {
		      		var val = $(this).val(); // get selected value
		      		if (val == "1") { // require a URL
		          		$("#lvl1").show();
		          		$("#lvl2").hide();
		          		$("#lvl3").hide();
		          		$("#lvl4").hide();
		          		$("#lvl5").hide();
		      		} else if(val == "2") {
		       			$("#lvl1").hide();
		          		$("#lvl2").show();
		          		$("#lvl3").hide();
		          		$("#lvl4").hide();
		          		$("#lvl5").hide();
		      		} else if(val == "3") {
		       			$("#lvl1").hide();
		          		$("#lvl2").hide();
		          		$("#lvl3").show();
		          		$("#lvl4").hide();
		          		$("#lvl5").hide();
		      		} else if(val == "4") {
		       			$("#lvl1").hide();
		          		$("#lvl2").hide();
		          		$("#lvl3").hide();
		          		$("#lvl4").show();
		          		$("#lvl5").hide();
		      		} else if(val == "5") {
		       			$("#lvl1").hide();
		          		$("#lvl2").hide();
		          		$("#lvl3").hide();
		          		$("#lvl4").hide();
		          		$("#lvl5").show();
		      		}
		      		return false;
		  		});
			});
	        //trader
		</script>

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
	</body>
</html>