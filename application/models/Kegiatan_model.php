<?php
class Kegiatan_model extends CI_Model{

    public function __construct()
    {
        
    }

    // define table
    private $_table = "kegiatan";
    private $_table_jenis = "jenis";
    // definisi variabel yang sesuai dengan nama kolom di tabel user
    public $jenis_id;
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
            'label' => 'Jenis',
            'rules' => 'required'],

            ['field' => 'nama',
            'label' => 'Nama Kegiatan',
            'rules' => 'required'],
            
            ['field' => 'deskripsi',
            'label' => 'Deskripsi Kegiatan',
            'rules' => 'required'],

            ['field' => 'lokasi',
            'label' => 'Lokasi',
            'rules' => 'required'],

            ['field' => 'pembicara',
            'label' => 'Pembicara',
            'rules' => 'required'],

            ['field' => 'pj',
            'label' => 'Penanggungjawab',
            'rules' => 'required'],

            ['field' => 'catatan',
            'label' => 'Catatan',
            'rules' => 'required'],

            ['field' => 'waktu',
            'label' => 'Waktu',
            'rules' => 'required'],
        ];
    }
    public function rulesJenis()
    {
        return [
            ['field' => 'nama',
            'label' => 'Jenis',
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

    public function jenis(){
        return $this->db->get($this->_table_jenis)->result();
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
        $this->jenis_id = $post["jenis_id"];
        $this->nama = $post["nama"];
        $this->deskripsi = $post["deskripsi"];
        $this->lokasi = $post["lokasi"];
        $this->pembicara = $post["pembicara"];
        $this->pj = $post["pj"];        
        $this->catatan = $post["catatan"];
        $this->waktu = $post["waktu"];
        // Status 1 karena belum terlaksana. 1 = diajukan, 2 = selesai, 3 = gagal
        $this->status = 1;
        $this->review = null;
        // insert data ke table
        return $this->db->insert($this->_table, $this);
    }
}
