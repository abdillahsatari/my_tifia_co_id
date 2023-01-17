<?php 

function cekUserRole(){

	$CI =& get_instance();
	if ($CI->session->userdata('role_id') == 1 && $CI->session->userdata('email')  ) {
			    redirect('admin');
			  } else if ($CI->session->userdata('role_id') == 2 && $CI->session->userdata('email')) {
			    redirect('kabinet');
			  } else {
			    // jika ada role_id yg lain maka tambahkan disini
			  }
}
