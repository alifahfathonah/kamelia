<?php
class User_model extends CI_Model{

    public function __construct()
    {
        // $this->load->database();
    }

    // define table
    private $_table = "user";
    // definisi variabel yang sesuai dengan nama kolom di tabel user
    public $nama;
    public $username;
    public $password;
    public $role = "2";

    // aturan untuk validasi input
    public function rules()
    {
        return [
            ['field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required'],

            ['field' => 'username',
            'label' => 'Username',
            'rules' => 'required|is_unique[user.email]'],
            
            ['field' => 'password',
            'label' => 'Password',
            'rules' => 'required'],

            ['field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[user.email]'],

            ['field' => 'role',
            'label' => 'Role',
            'rules' => 'required'],
        ];
    }
    // fungsi untuk debugging
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

    // untuk cek kalo belum login
    public function isNotLogin()
    {
        return $this->session->userdata('logged_in') === null;
    }

    public function save()
    {
        $post = $this->input->post();
        $this->username = $post["username"];
        $this->password = password_hash($post["password"], PASSWORD_DEFAULT);
        $this->nama = $post["nama"];
        $this->email = $post["email"];
        $this->role = $post["role"];
        return $this->db->insert($this->_table, $this);
    }
}
