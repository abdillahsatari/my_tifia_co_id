<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo "
		<!DOCTYPE html>
		<html>

		<head>
			<title>403 Forbidden</title>
		</head>

		<body>

			<p>Directory access is forbidden.</p>

		</body>

		</html>
		";
	}

	function kabupaten()
	{
		$propinsiID = $_GET['id'];
		$kabupaten   = $this->db->get_where('wil_kabupaten', array('province_id' => $propinsiID));
		echo '<option value="">-- Pilih Kabupaten/kota --</option>';
		foreach ($kabupaten->result() as $k) {
			echo "<option value='$k->id'>$k->name</option>";
		}
	}


	function kecamatan()
	{
		$kabupatenID = $_GET['id'];
		$kecamatan   = $this->db->get_where('wil_kecamatan', array('regency_id' => $kabupatenID));
		echo '<option value="">-- Pilih Kecamatan --</option>';
		foreach ($kecamatan->result() as $k) {
			echo "<option value='$k->id'>$k->name</option>";
		}
	}

	function kelurahan()
	{
		$kecamatanID  = $_GET['id'];
		$desa         = $this->db->get_where('wil_kelurahan', array('district_id' => $kecamatanID));
		echo '<option value="">-- Pilih Kelurahan --</option>';
		foreach ($desa->result() as $d) {
			echo "<option value='$d->id'>$d->name</option>";
		}
	}
}
