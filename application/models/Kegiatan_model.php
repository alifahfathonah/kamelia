<?php
class Kegiatan_model extends CI_Model
{

    public function __construct()
    {

    }

    // define table
    private $_table       = "kegiatan";
    private $_table_jenis = "jenis";
    private $_table_user  = "user";
    // definisi variabel yang sesuai dengan nama kolom di tabel user
    public $jenis_id;
    public $user_id;
    public $nama;
    public $deskripsi;
    public $lokasi;
    public $pembicara;
    public $pj;
    public $catatan;
    public $waktu;
    public $status = 1;
    public $review = null;

    // aturan untuk validasi input
    public function rules()
    {
        return [
            ['field' => 'jenis_id',
                'label'  => 'Jenis',
                'rules'  => 'required'],

            ['field' => 'nama',
                'label'  => 'Nama Kegiatan',
                'rules'  => 'required'],

            ['field' => 'deskripsi',
                'label'  => 'Deskripsi Kegiatan',
                'rules'  => 'required'],

            ['field' => 'lokasi',
                'label'  => 'Lokasi',
                'rules'  => 'required'],

            ['field' => 'pembicara',
                'label'  => 'Pembicara',
                'rules'  => 'required'],

            ['field' => 'pj',
                'label'  => 'Penanggungjawab',
                'rules'  => 'required'],

            ['field' => 'catatan',
                'label'  => 'Catatan',
                'rules'  => 'required'],

            ['field' => 'waktu',
                'label'  => 'Waktu',
                'rules'  => 'required'],
        ];
    }
    public function rulesJenis()
    {
        return [
            ['field' => 'nama',
                'label'  => 'Jenis',
                'rules'  => 'required'],
        ];
    }

    public function rulesReview()
    {
        return [
            ['field' => 'review',
                'label'  => 'Review',
                'rules'  => 'required'],
            ['field' => 'status',
                'label'  => 'Status',
                'rules'  => 'required'],
        ];
    }

    public function jenis()
    {
        return $this->db->get($this->_table_jenis)->result();
    }

    public function getJenis($jenis)
    {
        return $this->db->get_where($this->_table_jenis, ["id" => $jenis])->row()->nama;
    }

    public function saveJenis()
    {
        // ambil input yang metodenya post
        $post = $this->input->post();
        // diinisiasi di variabel yang sudah ditulis di atas
        $data = ['nama' => $post['nama']];
        // insert data ke table
        return $this->db->insert($this->_table_jenis, $data);
    }

    public function save()
    {
        // ambil input yang metodenya post
        $post = $this->input->post();
        // diinisiasi di variabel yang sudah ditulis di atas
        $this->jenis_id  = $post["jenis_id"];
        $this->user_id   = $this->session->userdata('userid');
        $this->nama      = $post["nama"];
        $this->deskripsi = $post["deskripsi"];
        $this->lokasi    = $post["lokasi"];
        $this->pembicara = $post["pembicara"];
        $this->pj        = $post["pj"];
        $this->catatan   = $post["catatan"];
        $this->waktu     = $post["waktu"];
        // Status 1 karena belum terlaksana. 1 = diajukan, 2 = selesai, 3 = gagal
        $this->status = 1;
        $this->review = null;
        // insert data ke table
        return $this->db->insert($this->_table, $this);
    }

    public function update($id)
    {
        // ambil input yang metodenya post
        $post = $this->input->post();
        // diinisiasi di variabel yang sudah ditulis di atas
        $this->jenis_id  = $post["jenis_id"];
        $this->user_id   = $this->db->get_where($this->_table, ["id" => $id])->row()->user_id;
        $this->nama      = $post["nama"];
        $this->deskripsi = $post["deskripsi"];
        $this->lokasi    = $post["lokasi"];
        $this->pembicara = $post["pembicara"];
        $this->pj        = $post["pj"];
        $this->catatan   = $post["catatan"];
        $this->waktu     = $post["waktu"];
        // Status 1 karena belum terlaksana. 1 = diajukan, 2 = selesai, 3 = gagal
        $this->status = $this->db->get_where($this->_table, ["id" => $id])->row()->status;
        $this->review = $this->db->get_where($this->_table, ["id" => $id])->row()->review;
        return $this->db->update($this->_table, $this, array('id' => $id));
    }

    public function review($id)
    {
        // ambil data kegiatan yang mau di update review
        $kegiatan = $this->db->get_where($this->_table, ["id" => $id])->row();
        // diinisiasi di variabel yang sudah ditulis di atas
        $this->jenis_id  = $kegiatan->jenis_id;
        $this->user_id   = $kegiatan->user_id;
        $this->nama      = $kegiatan->nama;
        $this->deskripsi = $kegiatan->deskripsi;
        $this->lokasi    = $kegiatan->lokasi;
        $this->pembicara = $kegiatan->pembicara;
        $this->pj        = $kegiatan->pj;
        $this->catatan   = $kegiatan->catatan;
        $this->waktu     = $kegiatan->waktu;
        // ambil data input
        $post = $this->input->post();
        // proses tambah review dan edit status
        $this->status = $post['status'];
        $this->review = $post['review'];
        $this->db->update($this->_table, $this, array('id' => $id));
    }

    // ambil data kegiatan dengan id
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    // ambil data kegiatan dengan id dan punya user
    public function getByIdOwner($id, $user)
    {
        return $this->db->get_where($this->_table, ["id" => $id, "user_id" => $user])->row();
    }

    // ambil semua data kegiatan
    public function kegiatanAll()
    {
        return $this->db->get($this->_table)->result();
    }

    // ambil berdasarkan subadmin yang login
    public function kegiatanByOwner($user)
    {
        return $this->db->get_where($this->_table, ["user_id" => $user])->result();
    }

    // ambil nama pemilik kegiatan
    public function getOwner($user)
    {
        return $this->db->get_where($this->_table_user, ["id" => $user])->row()->nama;
    }
}
