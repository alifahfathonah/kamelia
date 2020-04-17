<?php
class User_model extends CI_Model{

    public function __construct()
    {
        // $this->load->database();
    }

    // define table
    private $_table = "user";
    function dump($var, $die=FALSE)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        if ($die) die;
    }
    
    // buat methd untuk login
    public function doLogin(){
        $post = $this->input->post();

        // cari user berdasarkan email dan username
        $this->db->where('username', $post["username"])
            ->or_where('email', $post["username"]);
        $user = $this->db->get($this->_table)->row();

        // jika user terdaftar
        if ($user) {
            // periksa password-nya
            $isPasswordTrue = password_verify($post["password"], $user->password);

            // jika password benar dan dia admin
            if ($isPasswordTrue) {
                // login sukses yay!
                $sesdata = array(
                   'username'  => $user->username,
                   'nama'      => $user->nama,
                   'role'      => $user->role,
                   'logged_in' => TRUE
                );
                $this->session->set_userdata($sesdata);
                return true;
            }
        }

        // login gagal
        return false;
    }

    public function isNotLogin()
    {
        return $this->session->userdata('user_logged') === null;
    }

}
