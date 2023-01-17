<?php


function cekLogin()
{
	// cek jika sudah login
	$CI = &get_instance();
	if ($CI->session->userdata('mkt')) {

		$cek = $CI->db->query('SELECT id FROM marketing WHERE id="' . $CI->session->userdata('mkt') . '"')->num_rows();

		if ($cek == 0) {
			redirect('login', 'refresh');
		}
	} else {
		redirect('login');
	}
}

function cekRole($current_menu_id) // bisa array jika lebih dari 1
{
	// cek jika sudah login
	$CI = &get_instance();

	// get role_id user
	$role_id = my_role_id(sess('mkt'));

	// cek apakah array
	if (is_array($current_menu_id)) {
		$cek = 0;
		foreach ($current_menu_id as $key => $value) {
			// cek apakah user bisa akses menu
			$cekk = $CI->db->query("SELECT id FROM marketing_access_menu WHERE role_id='$role_id' AND menu_id='$value'")->num_rows();
			$cek += $cekk;
		}
		if ($cek == 0) {
			redirect('dashboard', 'refresh');
		}
	} else {
		// cek apakah user bisa akses menu
		$cek = $CI->db->query("SELECT id FROM marketing_access_menu WHERE role_id='$role_id' AND menu_id='$current_menu_id'")->num_rows();

		if ($cek == 0) {
			redirect('dashboard', 'refresh');
		}
	}
}


function my_role_id($marketing_id = '')
{
	$CI = &get_instance();

	if ($marketing_id == '') {
		$marketing_id = sess('mkt');
	}

	// get role_id user
	$qry1 = $CI->db->query('SELECT role_id FROM marketing WHERE id="' . $marketing_id . '"')->row_array();
	return $qry1['role_id'];
}
