<?php
class Solenlop_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    // Lấy danh sách sổ lên lớp từ Cơ sở dữ liệu
    public function get_all_solenlop()
    {
        $this->db->select('phancong.maPC, phan_cong.maHK, phan_cong.manhom, phan_cong.maMH, phan_cong.tongsotietlt, phan_cong.tongsotietth, mon_hoc.tenMH');
        $this->db->from('phan_cong');
        $this->db->join('mon_hoc', 'phan_cong.maMH = mon_hoc.maMH');
        $query = $this->db->get();
        return $query->result();
    }

    public function getHocKy()
    {
        return $this->db->get('hoc_ky')->result();
    }

    public function getNhomLop()
    {
        return $this->db->get('nhom_lop')->result();
    }

    public function getMonHoc()
    {
        return $this->db->get('mon_hoc')->result();
    }
}
?>
