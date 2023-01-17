<?php 


function cekLogin(){

		// cek jika sudah login
		$CI = & get_instance();
		if (!$CI->session->userdata('nsb_email') && !$CI->session->userdata('nsb_role_id')) {
			redirect('login','refresh');	
			// cek role nya 
		}else{ 

			$role_id= $CI->session->userdata('nsb_role_id');
			$menu 	= $CI->uri->segment(1);			

			// tabel user_menu
			// $queryMenu = $CI->db->get_where('user_menu', ['menu' => $menu])->row_array();
			// $menu_id = $queryMenu['id']; // ambil ID di tabel user_menu
			// echo $menu;
			// tabel user_access_menu
			// $userAccess = $CI->db->get_where('user_access_menu', [
			// 						'role_id' => $role_id,
			// 						'menu_id' => $menu_id
			// 					])->row_array();
			
			// cek role_id
			if ($role_id < 1 )  {
				redirect('login');
			}

		}
}

function check_access($role_id, $menu_id){

	$ci =& get_instance();

	$result = $ci->db->get_where('user_access_menu',[
					'role_id' => $role_id,
					'menu_id' => $menu_id 
				]);

	if ($result->num_rows() > 0) {
		return "checked='checked'";
	}

}



