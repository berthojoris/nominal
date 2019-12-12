<?php

class M_relokasi extends CI_Model {

    public $perPage;
    private $ci;
    private $table;
    private $distinct;
    private $group_by = array();
    private $select = array();
    private $joins = array();
    private $columns = array();
    private $where = array();
    private $or_where = array();
    private $where_in = array();
    private $like = array();
    private $filter = array();
    private $add_columns = array();
    private $edit_columns = array();
    private $unset_columns = array();

	public function __construct() 
    {
        parent::__construct();
        $this->ci = & get_instance();
        $this->load->library('session');
        $this->perPage = 3;
    }

    public function set_database($db_name) {
        $db_data = $this->ci->load->database($db_name, TRUE);
        $this->ci->db = $db_data;
    }

    function convertToDatatables($data)
    {
        return [
            'draw' => 0,
            'recordsTotal' => count($data),
            'recordsFiltered' => $this->perPage,
            'data' => $data
        ];
    }

    public function select($columns, $backtick_protect = TRUE) 
    {
        foreach ($this->explode(',', $columns) as $val) {
            $column = trim(preg_replace('/(.*)\s+as\s+(\w*)/i', '$2', $val));
            $column = preg_replace('/.*\.(.*)/i', '$1', $column); // get name after `.`
            $this->columns[] = $column;
            $this->select[$column] = trim(preg_replace('/(.*)\s+as\s+(\w*)/i', '$1', $val));
        }

        $this->ci->db->select($columns, $backtick_protect);
        return $this;
    }
    
    function getRelokasiData()
	{
        $this->select('*');
        $this->from('v_relokasi_edit');
        return $this->generate();
	}

	function getRelokasiDataFilter()
	{
		$filter_ip_wan = $this->session->userdata('filter_ip_wan');
        $filter_provider = $this->session->userdata('filter_provider');
        $filter_ip_lan = $this->session->userdata('filter_ip_lan');
        $filter_wo_no = $this->session->userdata('filter_wo_no');
        $filter_remote_name = $this->session->userdata('filter_remote_name');
        $filter_req_doc_no = $this->session->userdata('filter_req_doc_no');
        $filter_status = $this->session->userdata('filter_status');
        $filter_pic = $this->session->userdata('filter_pic');
        $filter_order_date = $this->session->userdata('filter_order_date');
        $filter_live_target = $this->session->userdata('filter_live_target');

        $this->select('*');

        if($filter_ip_wan != '-') {
            $this->like('ip_wan_new', $filter_ip_wan)->or_like('ip_wan_old', $filter_ip_wan);
        }
        
        if($filter_provider != '-') {
            $this->like('nickname_provider', $filter_provider);
        }

        if($filter_ip_lan != '-') {
            $this->like('ip_lan_new', $filter_ip_lan)->or_like('ip_lan_old', $filter_ip_lan);
        }

        if($filter_wo_no != '-') {
            $this->like('work_order_no', $filter_wo_no);
        }

        if($filter_remote_name != '-') {
            $this->where('id_remote_new', $filter_remote_name)->or_where('id_remote_old', $filter_remote_name);
        }

        if($filter_req_doc_no != '-') {
            $this->like('req_doc_no', $filter_req_doc_no);
        }

        if($filter_status != '-') {
            $this->like('status', $filter_status);
        }

        if($filter_pic != '-') {
            $this->like('pic', $filter_pic);
        }

        if($filter_order_date != '-') {
            $this->like('req_doc_date', $filter_order_date);
        }

        if($filter_live_target != '-') {
            $this->like('due_date', $filter_live_target);
        }
        
        $this->from('v_relokasi_edit');
        return $this->generate();
	}

	function getDetail($id)
	{
		$sql = "SELECT * FROM v_relokasi_list WHERE id_relokasi = ?";
        $query = $this->db->query($sql, [$id]);
        if(empty($query->row())) {
            return json_encode([
                'code' => 404,
                'data' => null
            ]);
        } else {
            return json_encode([
                'code' => 200,
                'data' => $query->row()
            ]);
        }
	}

	function getRemoteByNameFilter($strName)
	{
		$sql = "SELECT
            `tb_remote`.`id_remote`,
            `tb_remote`.`nama_remote`,
            `tb_remote`.`kode_tipe_uker`,
            `tb_tipe_uker`.`tipe_uker`,
            `tb_remote`.`alamat_uker`,
            `tb_remote`.`kode_kanca`,
            `tb_kanca`.`nama_kanca`,
            `tb_kanwil`.`kode_kanwil`,
            `tb_kanwil`.`nama_kanwil`
        FROM
            `tb_remote`
            INNER JOIN `tb_tipe_uker`
                ON (
                    `tb_remote`.`kode_tipe_uker` = `tb_tipe_uker`.`kode_tipe_uker`
                )
            INNER JOIN `tb_kanca`
                ON (
                    `tb_remote`.`kode_kanca` = `tb_kanca`.`kode_kanca`
                )
            INNER JOIN `tb_kanwil`
                ON (
                    `tb_kanca`.`kode_kanwil` = `tb_kanwil`.`kode_kanwil`
                )
        WHERE (
                `tb_remote`.`nama_remote` like '%$strName%'
            )";
        $query = $this->db->query($sql);
        $data = [];
        foreach ($query->result() as $key ) {
            $newdata = [
                "id" => $key->nama_remote,
				"text" => $key->nama_remote
            ];
            array_push($data, $newdata);
		}
		return $data;
	}

	function getRemoteByNameSelect2($strName)
	{
		$sql = "SELECT
            `tb_remote`.`id_remote`,
            `tb_remote`.`nama_remote`,
            `tb_remote`.`kode_tipe_uker`,
            `tb_remote`.`latitude`,
            `tb_remote`.`longitude`,
            `tb_tipe_uker`.`tipe_uker`,
            `tb_remote`.`alamat_uker`,
            `tb_remote`.`kode_kanca`,
            `tb_kanca`.`nama_kanca`,
            `tb_kanwil`.`kode_kanwil`,
            `tb_kanwil`.`nama_kanwil`
        FROM
            `tb_remote`
            INNER JOIN `tb_tipe_uker`
                ON (
                    `tb_remote`.`kode_tipe_uker` = `tb_tipe_uker`.`kode_tipe_uker`
                )
            INNER JOIN `tb_kanca`
                ON (
                    `tb_remote`.`kode_kanca` = `tb_kanca`.`kode_kanca`
                )
            INNER JOIN `tb_kanwil`
                ON (
                    `tb_kanca`.`kode_kanwil` = `tb_kanwil`.`kode_kanwil`
                )
        WHERE (
                `tb_remote`.`nama_remote` like '%$strName%'
            )";
        $query = $this->db->query($sql);
        $data = [];
        foreach ($query->result() as $key ) {
            $newdata = [
                "id" => $key->id_remote,
				"text" => $key->nama_remote
            ];
            array_push($data, $newdata);
		}
		return $data;
	}

	function searchUpdate($param)
	{
		$sql = "SELECT * FROM v_all_remote_jarkom WHERE `ip_lan` like '%$param%'";
        $query = $this->db->query($sql);
        $data = [];
        foreach ($query->result() as $key ) {
            $newdata = [
                "id" => $key->id_jarkom,
				"text" => $key->ip_lan." / ".$key->kode_jarkom." / ".$key->jenis_jarkom." / ".$key->tipe_uker
            ];
            array_push($data, $newdata);
		}
		return $data;
	}

	function findAllRemoteJarkom($jarkomID)
	{
		$sql = "SELECT * FROM v_all_remote_jarkom WHERE id_jarkom = ?";
        $query = $this->db->query($sql, [$jarkomID]);
        $output = [
            'code' => 200,
            'data' => $query->row()
		];
		return $output;
	}

	function searchByIpAddress($id_jarkom)
	{
		$sql = "SELECT
            `tb_jarkom`.`id` AS `id_jarkom`,
            `tb_jarkom`.`kode_jarkom`,
            `tb_jarkom`.`ip_wan`,
            `tb_jarkom`.`kode_jenis_jarkom`,
            `tb_jarkom`.`id_contract`,
            `tb_jenis_jarkom`.`jenis_jarkom` AS `network_type`,
            `tb_spk`.`no_spk`,
            `tb_remote`.`ip_lan`,
            `tb_tipe_uker`.`tipe_uker` AS `remote_type`,
            `tb_remote`.`id_remote`,
            `tb_remote`.`nama_remote` AS `remote_name`,
            `tb_kanwil`.`nama_kanwil` AS `region`,
            `tb_remote`.`alamat_uker` AS `remote_address`
        FROM
            `tb_jarkom`
            INNER JOIN `tb_jenis_jarkom`
                ON (
                    `tb_jarkom`.`kode_jenis_jarkom` = `tb_jenis_jarkom`.`kode_jenis_jarkom`
                )
            INNER JOIN `tb_remote`
                ON (
                    `tb_jarkom`.`id_remote` = `tb_remote`.`id_remote`
                )
            INNER JOIN `tb_provider`
                ON (
                    `tb_jarkom`.`kode_provider` = `tb_provider`.`kode_provider`
                )
            INNER JOIN `tb_spk`
                ON (
                    `tb_jarkom`.`id_spk` = `tb_spk`.`id_spk`
                )
            INNER JOIN `tb_tipe_uker`
                ON (
                    `tb_remote`.`kode_tipe_uker` = `tb_tipe_uker`.`kode_tipe_uker`
                )
            INNER JOIN `tb_kanca`
                ON (
                    `tb_remote`.`kode_kanca` = `tb_kanca`.`kode_kanca`
                )
            INNER JOIN `tb_kanwil`
                ON (
                    `tb_kanca`.`kode_kanwil` = `tb_kanwil`.`kode_kanwil`
                )
        WHERE (
                `tb_jarkom`.`ip_wan` = ? or `tb_jarkom`.`id` = ?
            )";
        $query = $this->db->query($sql, [$id_jarkom, $id_jarkom]);
        if ($query->num_rows() > 0) {
            $output = [
                'code' => 200,
                'data' => $query->row()
            ];
        } else {
            $output = [
                'code' => 404,
                'data' => ''
            ];
		}
		return $output;
	}

	function getProvider()
	{
		$sql = "SELECT kode_provider, nama_provider, nickname_provider FROM tb_provider";
        return $this->db->query($sql)->result();
	}
	
	function getRemoteByName($name)
	{
		$sql = "SELECT
            `tb_remote`.`id_remote`,
            `tb_remote`.`nama_remote`,
            `tb_remote`.`kode_tipe_uker`,
            `tb_remote`.`ip_lan`,
            `tb_remote`.`latitude`,
            `tb_remote`.`longitude`,
            `tb_tipe_uker`.`tipe_uker`,
            `tb_remote`.`alamat_uker`,
            `tb_remote`.`kode_kanca`,
            `tb_kanca`.`nama_kanca`,
            `tb_kanwil`.`kode_kanwil`,
            `tb_kanwil`.`nama_kanwil`
        FROM
            `tb_remote`
            INNER JOIN `tb_tipe_uker`
                ON (
                    `tb_remote`.`kode_tipe_uker` = `tb_tipe_uker`.`kode_tipe_uker`
                )
            INNER JOIN `tb_kanca`
                ON (
                    `tb_remote`.`kode_kanca` = `tb_kanca`.`kode_kanca`
                )
            INNER JOIN `tb_kanwil`
                ON (
                    `tb_kanca`.`kode_kanwil` = `tb_kanwil`.`kode_kanwil`
                )
        WHERE (
                `tb_remote`.`id_remote` = ?
            );
        
        ";
        $query = $this->db->query($sql, [$name]);
        if ($query->num_rows() > 0) {
            $output = [
                'code' => 200,
                'data' => $query->row()
            ];
        } else {
            $output = [
                'code' => 404,
                'data' => ''
            ];
		}
		return $output;
	}

	function searchById($id)
	{
		$sql = "SELECT * FROM v_relokasi_edit WHERE id_jarkom = ?";
        $query = $this->db->query($sql, [$id]);
        if ($query->num_rows() > 0) {
            $output = [
                'code' => 200,
                'data' => $query->row()
            ];
        } else {
            $output = [
                'code' => 404,
                'data' => ''
            ];
		}
		return $output;
	}

	function data($number, $offset) 
	{
		return $this->db->order_by("id", "desc")->get('tb_relokasi', $number, $offset)->result();		
	}

	function jumlah_data() 
	{
		return $this->db->get('tb_relokasi')->num_rows();
	}

	function insertData($relokasi, $jarkom, $jarkomHistory, $idJarkom)
	{
		$this->db->trans_begin();

        $this->db->insert('tb_relokasi', $relokasi);
        $this->db->insert('tb_jarkom_history', $jarkomHistory);

        $this->db->where('id', $idJarkom);
        $this->db->update('tb_jarkom', $jarkom);

        if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "FAILED";
        } else {
			$this->db->trans_commit();
			return "SUCCESS";
        }
	}

	function updateData($id_relokasi, $update, $id_jarkom, $updateJarkomData, $id_network, $jarkomHistoryData, $id_remote_new, $remoteUpdate)
	{
		$this->db->trans_begin();

        $this->db->where('id', $id_relokasi);
        $this->db->update('tb_relokasi', $update);

        $this->db->where('id', $id_jarkom);
        $this->db->update('tb_jarkom', $updateJarkomData);

        $this->db->where('kode_jarkom', $id_network);
        $this->db->update('tb_jarkom_history', $jarkomHistoryData);

        $this->db->where('id_remote', $id_remote_new);
        $this->db->update('tb_remote', $remoteUpdate);

        if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "FAILED";
        } else {
			$this->db->trans_commit();
			return "SUCCESS";
        }
	}

	function showDetail($id)
	{
		$sql = "SELECT * FROM v_relokasi_edit WHERE id_relokasi = ?";
		$query = $this->db->query($sql, [$id]);
		return $query;
	}

	function getJarkom($id)
	{
		$sqlJarkom = "SELECT * FROM tb_jarkom WHERE id = ?";
        return $this->db->query($sqlJarkom, [$id])->row();
    }
    
    /**
     * Sets additional column variables for adding custom columns
     *
     * @param string $column
     * @param string $content
     * @param string $match_replacement
     * @return mixed
     */
    public function add_column($column, $content, $match_replacement = NULL) {
        $this->add_columns[$column] = array('content' => $content, 'replacement' => $this->explode(',', $match_replacement));
        return $this;
    }

    /**
     * Sets additional column variables for editing columns
     *
     * @param string $column
     * @param string $content
     * @param string $match_replacement
     * @return mixed
     */
    public function edit_column($column, $content, $match_replacement) {
        $this->edit_columns[$column][] = array('content' => $content, 'replacement' => $this->explode(',', $match_replacement));
        return $this;
    }

    /**
     * Unset column
     *
     * @param string $column
     * @return mixed
     */
    public function unset_column($column) {
        $column = explode(',', $column);
        $this->unset_columns = array_merge($this->unset_columns, $column);
        return $this;
    }

    /**
     * Builds all the necessary query segments and performs the main query based on results set from chained statements
     *
     * @param string $output
     * @param string $charset
     * @return string
     */
    public function generate($output = 'json', $charset = 'UTF-8') {
        if (strtolower($output) == 'json') {
            $this->get_paging();
        }
        $this->get_ordering();
        $this->get_filtering();
        return $this->produce_output(strtolower($output), strtolower($charset));
    }

    /**
     * Generates the LIMIT portion of the query
     *
     * @return mixed
     */
    private function get_paging() {

        $iStart = $this->ci->input->post('iDisplayStart');
        $iLength = $this->ci->input->post('iDisplayLength');

        if ($iLength != '' && $iLength != '-1')
            $this->ci->db->limit($iLength, ($iStart) ? $iStart : 0);
    }

    /**
     * Generates the ORDER BY portion of the query
     *
     * @return mixed
     */
    private function get_ordering() {
        $sColumns = explode(",", $this->ci->input->post('sColumns'));

        if ($this->ci->input->post('iSortCol_0') || $this->ci->input->post('iSortCol_0') == 0) {
            for ($i = 0; $i < intval($this->ci->input->post('iSortingCols')); $i++) {
                if ($this->ci->input->post('bSortable_' . intval($this->ci->input->post('iSortCol_' . $i))) == "true") {
                    $this->ci->db->order_by($sColumns[$this->ci->input->post('iSortCol_' . $i)], $this->ci->input->post('sSortDir_' . $i));
                }
            }
        }
    }

    /**
     * Generates a %LIKE% portion of the query
     *
     * @return mixed
     */
    private function get_filtering() {
        $sColumns = explode(",", $this->ci->input->post('sColumns'));

        $like = array('local' => array(), 'global' => array());
        # loop through each column
        for ($i = 0; $i < $this->ci->input->post('iColumns'); $i++) {
            # check that field is searchable             
            if ($this->ci->input->post('bSearchable_' . $i) == "true") {
                # get local filter
                if (strlen($this->ci->input->post('sSearch_' . $i)) > 0) {
                    $like['local'] = array_merge($like['local'], $this->_applyColumnFilter($sColumns[$i], $this->ci->input->post('sSearch_' . $i)));
                } 
                
                # get global filter
                if ($this->ci->input->post('sSearch') && $this->ci->input->post('sSearch') != "") {
                    $like['global'] = array_merge($like['global'], $this->_applyColumnFilter($sColumns[$i], $this->ci->input->post('sSearch')));
                } 
            }
        }
        
        # set like statement
        $this->_createColumnsFilterStatement($like);
    }

    private function _createColumnsFilterStatement($like) {
        $str = "";
        # local filter
        if (!empty($like['local'])) {
            $str = "(" . implode(" OR ", $like['local']) . ")";
        }

        if (!empty($like['global'])) {

            $str = $str . ($str != "" ? ' AND ' : '') . "(" . implode(" OR ", $like['global']) . ")";
        }
 
        if ($str != "") {
            $this->ci->db->or_where("(" . $str . ")");
        }
        return TRUE;
    }

    /**
     * 
     * @param type $columnKey column name within DB
     * @param type $searchParams a strign with search params
     */
    private function _applyColumnFilter($columnKey, $searchParams) {
        $search_terms = explode("|", $searchParams);

        $arr = array();

        foreach ($search_terms as $key => $ele) {
            $arr[] = $columnKey . " LIKE '%" . $ele . "%'";
        }
        
        return $arr;
    }

    /**
     * Compiles the select statement based on the other functions called and runs the query
     *
     * @return mixed
     */
    private function get_display_result() {
        $result = $this->ci->db->get($this->table);
        
        return $result;
    }

    /**
     * Builds an encoded string data. Returns JSON by default, and an array of aaData if output is set to raw.
     *
     * @param string $output
     * @param string $charset
     * @return mixed
     */
    private function produce_output($output, $charset) {
        $aaData = array();
        $rResult = $this->get_display_result();

        if ($output == 'json') {
            $iTotal = $this->get_total_results();
            $iFilteredTotal = $this->get_total_results(TRUE);
        }

        foreach ($rResult->result_array() as $row_key => $row_val) {
            $aaData[$row_key] = ($this->check_cType()) ? $row_val : array_values($row_val);

            foreach ($this->add_columns as $field => $val)
                if ($this->check_cType())
                    $aaData[$row_key][$field] = $this->exec_replace($val, $aaData[$row_key]);
                else
                    $aaData[$row_key][] = $this->exec_replace($val, $aaData[$row_key]);


            foreach ($this->edit_columns as $modkey => $modval)
                foreach ($modval as $val)
                    $aaData[$row_key][($this->check_cType()) ? $modkey : array_search($modkey, $this->columns)] = $this->exec_replace($val, $aaData[$row_key]);

            $aaData[$row_key] = array_diff_key($aaData[$row_key], ($this->check_cType()) ? $this->unset_columns : array_intersect($this->columns, $this->unset_columns));

            if (!$this->check_cType())
                $aaData[$row_key] = array_values($aaData[$row_key]);
        }

        if ($output == 'json') {
            $sOutput = array
                (
                'draw' => intval($this->ci->input->post('draw')),
                'recordsTotal' => $iTotal,
                'recordsFiltered' => $iFilteredTotal,
                'data' => $aaData
            );

            if ($charset == 'utf-8')
                return json_encode($sOutput);
            else
                return $this->jsonify($sOutput);
        } else
            return array('aaData' => $aaData);
    }

    /**
     * Get result count
     *
     * @return integer
     */
    private function get_total_results($filtering = FALSE) {
        if ($filtering)
            $this->get_filtering();

        foreach ($this->joins as $val)
            $this->ci->db->join($val[0], $val[1], $val[2]);

        foreach ($this->where as $val)
            $this->ci->db->where($val[0], $val[1], $val[2]);

        foreach ($this->or_where as $val)
            $this->ci->db->or_where($val[0], $val[1], $val[2]);

        foreach ($this->where_in as $val)
            $this->ci->db->where_in($val[0], $val[1], $val[2]);

        foreach ($this->group_by as $val)
            $this->ci->db->group_by($val);

        foreach ($this->like as $val)
            $this->ci->db->like($val[0], $val[1], $val[2]);

        if (strlen($this->distinct) > 0) {
            $this->ci->db->distinct($this->distinct);
            $this->ci->db->select($this->columns);
        }

        $query = $this->ci->db->get($this->table, NULL, NULL, FALSE);
        return $query->num_rows();
    }

    /**
     * Runs callback functions and makes replacements
     *
     * @param mixed $custom_val
     * @param mixed $row_data
     * @return string $custom_val['content']
     */
    private function exec_replace($custom_val, $row_data) {
        $replace_string = '';

        if (isset($custom_val['replacement']) && is_array($custom_val['replacement'])) {
            //Added this line because when the replacement has over 10 elements replaced the variable "$1" first by the "$10"
            $custom_val['replacement'] = array_reverse($custom_val['replacement'], true);
            foreach ($custom_val['replacement'] as $key => $val) {
                $sval = preg_replace("/(?<!\w)([\'\"])(.*)\\1(?!\w)/i", '$2', trim($val));

                if (preg_match('/(\w+::\w+|\w+)\((.*)\)/i', $val, $matches) && is_callable($matches[1])) {
                    $func = $matches[1];
                    $args = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[,]+/", $matches[2], 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

                    foreach ($args as $args_key => $args_val) {
                        $args_val = preg_replace("/(?<!\w)([\'\"])(.*)\\1(?!\w)/i", '$2', trim($args_val));
                        $args[$args_key] = (in_array($args_val, $this->columns)) ? ($row_data[($this->check_cType()) ? $args_val : array_search($args_val, $this->columns)]) : $args_val;
                    }

                    $replace_string = call_user_func_array($func, $args);
                } elseif (in_array($sval, $this->columns))
                    $replace_string = $row_data[($this->check_cType()) ? $sval : array_search($sval, $this->columns)];
                else
                    $replace_string = $sval;

                $custom_val['content'] = str_ireplace('$' . ($key + 1), $replace_string, $custom_val['content']);
            }
        }

        return $custom_val['content'];
    }

    /**
     * Check column type -numeric or column name
     *
     * @return bool
     */
    private function check_cType() {
        $column = $this->ci->input->post('columns');
        if (is_numeric($column[0]['data']))
            return FALSE;
        else
            return TRUE;
    }

    /**
     * Return the difference of open and close characters
     *
     * @param string $str
     * @param string $open
     * @param string $close
     * @return string $retval
     */
    private function balanceChars($str, $open, $close) {
        $openCount = substr_count($str, $open);
        $closeCount = substr_count($str, $close);
        $retval = $openCount - $closeCount;
        return $retval;
    }

    /**
     * Explode, but ignore delimiter until closing characters are found
     *
     * @param string $delimiter
     * @param string $str
     * @param string $open
     * @param string $close
     * @return mixed $retval
     */
    private function explode($delimiter, $str, $open = '(', $close = ')') {
        $retval = array();
        $hold = array();
        $balance = 0;
        $parts = explode($delimiter, $str);

        foreach ($parts as $part) {
            $hold[] = $part;
            $balance += $this->balanceChars($part, $open, $close);

            if ($balance < 1) {
                $retval[] = implode($delimiter, $hold);
                $hold = array();
                $balance = 0;
            }
        }

        if (count($hold) > 0)
            $retval[] = implode($delimiter, $hold);

        return $retval;
    }

    /**
     * Workaround for json_encode's UTF-8 encoding if a different charset needs to be used
     *
     * @param mixed $result
     * @return string
     */
    private function jsonify($result = FALSE) {
        if (is_null($result))
            return 'null';

        if ($result === FALSE)
            return 'false';

        if ($result === TRUE)
            return 'true';

        if (is_scalar($result)) {
            if (is_float($result))
                return floatval(str_replace(',', '.', strval($result)));

            if (is_string($result)) {
                static $jsonReplaces = array(array('\\', '/', '\n', '\t', '\r', '\b', '\f', '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
                return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $result) . '"';
            } else
                return $result;
        }

        $isList = TRUE;

        for ($i = 0, reset($result); $i < count($result); $i++, next($result)) {
            if (key($result) !== $i) {
                $isList = FALSE;
                break;
            }
        }

        $json = array();

        if ($isList) {
            foreach ($result as $value)
                $json[] = $this->jsonify($value);

            return '[' . join(',', $json) . ']';
        } else {
            foreach ($result as $key => $value)
                $json[] = $this->jsonify($key) . ':' . $this->jsonify($value);

            return '{' . join(',', $json) . '}';
        }
    }

    /**
     * returns the sql statement of the last query run
     * @return type
     */
    public function last_query() {
        return $this->ci->db->last_query();
    }

    public function from($table) {
        $this->table = $table;
        return $this;
    }

    public function group_by($val) {
        $this->group_by[] = $val;
        $this->ci->db->group_by($val);
        return $this;
    }

    public function where($key_condition, $val = NULL, $backtick_protect = TRUE) {
        $this->where[] = array($key_condition, $val, $backtick_protect);
        $this->ci->db->where($key_condition, $val, $backtick_protect);
        return $this;
    }

    public function or_where($key_condition, $val = NULL, $backtick_protect = TRUE) {
        $this->or_where[] = array($key_condition, $val, $backtick_protect);
        $this->ci->db->or_where($key_condition, $val, $backtick_protect);
        return $this;
    }

    public function like($key_condition, $val = NULL, $backtick_protect = TRUE) {
        $this->like[] = array($key_condition, $val, $backtick_protect);
        $this->ci->db->like($key_condition, $val, $backtick_protect);
        return $this;
    }

    public function or_like($key_condition, $val = NULL, $backtick_protect = TRUE) {
        $this->or_like[] = array($key_condition, $val, $backtick_protect);
        $this->ci->db->or_like($key_condition, $val, $backtick_protect);
        return $this;
    }
}