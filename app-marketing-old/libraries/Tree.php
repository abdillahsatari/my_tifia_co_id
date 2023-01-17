<?php

/**
 *
 */
class Tree
{
	public function __construct()
	{
		$this->ci = &get_instance();
	}

	private $ci;

	// public $child = array();
	public $parents = [];

	// All child yang disponsori/didaftarkan
	function get_all_child_id($id)
	{
		$child = array();

		$query = $this->ci->db->query("SELECT id
		FROM 
		    (SELECT * FROM marketing ORDER BY parent_id, id ASC) as a,
		    (SELECT @pv := '$id') initialisation
		WHERE find_in_set(parent_id, @pv) > 0 AND @pv := CONCAT(@pv, ',', id)");

		foreach ($query->result() as $r) {
			array_push($child, $r->id);
		}

		return $child;
	}


	// cari semua parent di tree
	function get_all_parent_id($id)
	{
		$array = $this->ci->db->query("SELECT parent_id FROM marketing WHERE id='$id' AND role_id!='1'")->row_array();

		if ($array['parent_id'] != 0) {
			if ($array['parent_id'] != '1') {
				array_push($this->parents, $array['parent_id']);
			}
			$parents[] = $this->get_all_parent_id($array['parent_id']);
		}

		return array_filter($this->parents);
	}

	function pohon($id, $level = 1)
	{
		$output = '';

		$child = $this->get_direct_child($id);
		foreach ($child as $r) {
			$mitra = mitra($r->id);

			// $output .= '
			// 	<div>
			// 		' . spasi($level) . ' | <br>
			// 		' . spasi($level) . ' |__
			// 		<code class="badgee badge-secondary" data-toggle="tooltip" data-placement="right" title="' . $mitra['role'] . '"><span class="text-danger font-weight-bold">' . $mitra['kode'] . '</span> ' . ucwords($mitra['nama']) . '</code>
			// 	</div>
			// ';

			switch ($mitra['role_id']) {
				case '5':
					$badge = 'danger';
					break;
				case '4':
					$badge = 'warning';
					break;
				case '3':
					$badge = 'success';
					break;
				default:
					$badge = 'primary';
					break;
			}

			$output .= '
				<div>
					' . spasi($level) . ' | <br>
					' . spasi($level) . ' |__
					<code><span class="text-danger font-weight-bold">' . $mitra['kode'] . '</span> ' . ucwords($mitra['nama']) . '</code>&nbsp;<span class="badge badge-' . $badge . '">' . $mitra['role'] . '</span>
				</div>
			';

			$output .= $this->pohon($mitra['id'], $level + 1);
		}


		return $output;
	}

	function get_direct_child($id)
	{
		$this->ci->db->select("marketing.id, marketing.nama, marketing.kode, marketing_role.role");
		$this->ci->db->from("marketing, marketing_role");
		$this->ci->db->where("marketing.parent_id", $id);
		$this->ci->db->where("marketing.role_id=marketing_role.id");
		$this->ci->db->order_by('date_added', 'ASC');
		return $this->ci->db->get()->result();
	}

	function get_direct_child_id($id)
	{
		$get_direct_child = $this->get_direct_child($id);
		$direct_child = [];

		foreach ($get_direct_child as $r) {
			array_push($direct_child, $r->id);
		}

		return $direct_child;
	}
} //end class
