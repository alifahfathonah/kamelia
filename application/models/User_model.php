<?php
class User_model extends CI_Model
{

    public function __construct()
    {

    }

    // define table
    private $_table = "user";
    // definisi variabel yang sesuai dengan nama kolom di tabel user
    public $nama;
    public $username;
    // public $password;
    public $email;
    public $role = "2";

    // aturan untuk validasi input
    public function rules()
    {
        return [
            ['field' => 'nama',
                'label'  => 'Nama',
                'rules'  => 'required'],

            ['field' => 'username',
                'label'  => 'Username',
                'rules'  => 'required|is_unique[user.username]'],

            ['field' => 'password',
                'label'  => 'Password',
                'rules'  => 'required'],

            ['field' => 'email',
                'label'  => 'Email',
                'rules'  => 'required|valid_email|is_unique[user.email]'],

            ['field' => 'role',
                'label'  => 'Role',
                'rules'  => 'required'],
        ];
    }

    public function rulesUpdate()
    {
        return [
            ['field' => 'nama',
                'label'  => 'Nama',
                'rules'  => 'required'],

            ['field' => 'username',
                'label'  => 'Username',
                'rules'  => 'required'],

            ['field' => 'password',
                'label'  => 'Password',
                'rules'  => ''],

            ['field' => 'email',
                'label'  => 'Email',
                'rules'  => 'required|valid_email'],

            ['field' => 'role',
                'label'  => 'Role',
                'rules'  => ''],
        ];
    }

    // buat methd untuk login
    public function doLogin()
    {
        $post = $this->input->post();

        // prevent bypass strcmp array
        foreach ($post as $value) {
            if (!is_string($value)) {
                $this->session->set_flashdata('msg', 'HAYOOOO');
                redirect(site_url('/login'));
            }
        }

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
                    'userid'    => $user->id,
                    'username'  => $user->username,
                    'nama'      => $user->nama,
                    'role'      => $user->role,
                    'logged_in' => true,
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

    public function generateAdmin()
    {
        $data = [
            "username" => "kamelia",
            "password" => password_hash("kamelia99429", PASSWORD_DEFAULT),
            "nama"     => "Ismi Kamelia Najib Putri",
            "email"    => "ismykamelia@gmail.com",
            "role"     => 1,
        ];

        $this->db->where("username", $data["username"]);
        $admin = $this->db->get($this->_table)->row();
        if (!$admin) {
            return $this->db->insert($this->_table, $data);
        }
        // return $this->db->insert($this->_table, $data);
        redirect(site_url('/login'));
    }

    public function save()
    {
        // ambil input yang metodenya post
        $post = $this->input->post();
        // diinisiasi di variabel yang sudah ditulis di atas
        $this->username = $post["username"];
        // password nya di hash menggunakan bcrypt agar tidak dikirim di database dalam keadaan teks utuh, biar aman
        $this->password = password_hash($post["password"], PASSWORD_DEFAULT);
        $this->nama     = $post["nama"];
        $this->email    = $post["email"];
        $this->role     = $post["role"];
        // insert data ke table
        return $this->db->insert($this->_table, $this);
    }

    public function update($id)
    {
        // ambil input yang metodenya post
        $post = $this->input->post();
        if (!empty($post['password'])) {
            // proses hashing password
            $password = password_hash($post["password"], PASSWORD_DEFAULT);
            // proses update password saja
            $data = array('password' => $password);
            $this->db->where('id', $id);
            $this->db->update($this->_table, $data);
        }
        // diinisiasi di variabel yang sudah ditulis di atas
        $this->nama     = $post["nama"];
        $this->username = $post["username"];
        $this->email    = $post["email"];
        $this->role     = $post["role"];
        return $this->db->update($this->_table, $this, array('id' => $id));
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    // ambil data kegiatan dengan id
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }
}
