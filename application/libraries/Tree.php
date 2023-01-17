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
	function get_all_parent_id($id, $type = 'new') // $type 'add' or 'new',  'new' will reset the parents variable
	{
		if ($type == 'new') {
			$this->parents = [];
		}

		if (!in_array($id, $this->parents)) {
			array_push($this->parents, $id);
		}

		$array = $this->ci->db->query("SELECT parent_id FROM marketing WHERE id='$id' AND role_id!='1' AND role_id IS NOT NULL")->row_array();

		if ($array['parent_id'] != 0 && $array['parent_id'] != NULL) {
			if ($array['parent_id'] != '1') {
				if (!in_array($array['parent_id'], $this->parents)) {
					array_push($this->parents, $array['parent_id']);
				}
			}
			$parents[] = $this->get_all_parent_id($array['parent_id'], 'add');
		}

		return array_filter($this->parents);
	}

	function pohon($id, $level = 1)
	{
		$output = '';

		$child = $this->get_direct_child($id);
		foreach ($child as $r) {
			$mitra = mitra($r->id);
			$output .= '
				<div>
					' . spasi($level) . ' | <br>
					' . spasi($level) . ' |__
					<code class="badgee badge-secondary" data-toggle="tooltip" data-placement="right" title="' . $mitra['role'] . '"><span class="text-danger font-weight-bold">' . $mitra['kode'] . '</span> ' . ucwords($mitra['nama']) . '</code>
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
		return  $this->ci->db->get()->result();
	}
} //end class
