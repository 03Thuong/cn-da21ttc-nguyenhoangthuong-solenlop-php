<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DoimatkhauModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Initialize database connection
    }

    public function get_account_id_by_username($username)
    {
        // Prepare the query
        $this->db->select('matk');
        $this->db->from('tai_khoan');
        $this->db->where('username', $username);

        // Execute the query
        $query = $this->db->get();

        // Check if a result was found
        if ($query->num_rows() > 0) {
            return $query->row()->matk; // Return the account ID
        }

        return null; // Return null if no user found
    }
    public function update_password($user_id, $new_password)
    {
        $this->db->where('matk', $user_id);
        return $this->db->update('tai_khoan', ['matkhau' => $new_password]); // Lưu mật khẩu dưới dạng văn bản thuần túy
    }


}