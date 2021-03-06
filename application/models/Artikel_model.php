<?php
class Artikel_model extends CI_Model
{

    public function __construct()
    {

    }

    // define table
    private $_table          = "artikel";
    private $_table_kategori = "kategori";
    // definisi variabel yang sesuai dengan nama kolom di tabel user
    public $user_id;
    public $judul;
    public $isi;
    public $kategori_id;
    public $thumbnail;

    // aturan untuk validasi input
    public function rules()
    {
        return [
            ['field' => 'judul',
                'label'  => 'Judul',
                'rules'  => 'required'],

            ['field' => 'isi',
                'label'  => 'Konten',
                'rules'  => 'required'],
        ];
    }

    public function getSlider()
    {
        return $this->db->order_by('dibuat', 'desc')->get($this->_table, 5)->result();
    }

    public function getColumnBerita()
    {
        return $this->db->order_by('dibuat', 'desc')->where('kategori_id', 1)->get($this->_table, 3)->result();
    }

    public function getColumnEsai()
    {
        return $this->db->order_by('dibuat', 'desc')->where('kategori_id', 2)->get($this->_table, 3)->result();
    }

    public function save()
    {
        // ambil input yang metodenya post
        $post = $this->input->post();
        // membuat slug, ex: judul-berita dan menyaring judul dengan spasi, angka, dan huruf
        $filter = preg_replace('/[^\da-z ]/i', '', $post["judul"]);
        $slug   = str_replace(" ", "-", strtolower($filter));
        // cek kalau slug sudah ada ditambahkan waktu
        if ($this->db->get_where($this->_table, ["slug" => $slug])->row() != null) {
            $slug = $slug . '-' . time();
        }

        // menambahkan id user yang sedang login dan menambahkan slug
        $post["user_id"] = $this->session->userdata("userid");
        $post["slug"]    = $slug;
        // kalo gambar kosong bakal dibuat default
        if (!empty($_FILES["thumbnail"]["name"])) {
            $post["thumbnail"] = $this->_uploadImage();
        } else {
            $post["thumbnail"] = 'default.jpg';
        }
        // insert data ke table
        return $this->db->insert($this->_table, $post);
    }

    public function all()
    {
        return $this->db->order_by('dibuat', 'desc')->get($this->_table)->result();
    }

    public function kategori()
    {
        return $this->db->get($this->_table_kategori)->result();
    }

    public function allPaginationSearch($limit, $start, $search = "", $kategori)
    {
        $this->db->select('*');
        $this->db->from('artikel');

        if ($search != '') {
            $this->db->like('judul', $search);
        }

        $this->db->limit($limit, $start)->order_by('dibuat', 'desc');
        $this->db->where('kategori_id', $kategori);
        $query = $this->db->get();

        return $query->result();
    }

    public function getRecordCount($search = '', $kategori)
    {

        $this->db->select('count(*) as allcount');
        $this->db->from('artikel');

        if ($search != '') {
            $this->db->like('judul', $search);
        }
        $this->db->where('kategori_id', $kategori);

        $query  = $this->db->get();
        $result = $query->result_array();

        return $result[0]['allcount'];
    }

    // ambil data kegiatan dengan id
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    // ambil data kegiatan dengan slug
    public function getBySlug($slug)
    {
        return $this->db->get_where($this->_table, ["slug" => $slug])->row();
    }

    public function update($id)
    {
        // ambil input yang metodenya post
        $post = $this->input->post();
        // diinisiasi di variabel yang sudah ditulis di atas
        $this->user_id     = $this->session->userdata("userid");
        $this->judul       = $post["judul"];
        $this->isi         = $post["isi"];
        $this->kategori_id = $post["kategori_id"];
        if (!empty($_FILES["thumbnail"]["name"])) {
            $this->thumbnail = $this->_uploadImage();
        } else {
            $this->thumbnail = $post["old_thumbnail"];
        }
        return $this->db->update($this->_table, $this, array('id' => $id));
    }

    public function delete($id)
    {
        // import library
        $this->load->helper('file');
        // ambil data untuk dapat nama thumbnail yang mau dihapus
        $delete = $this->db->get_where($this->_table, ["id" => $id])->row();
        // hapus yang gambarnya tidak default
        if ($delete->thumbnail !== 'default.jpg') {
            delete_files('./uploads/images/thumbnails/' . $delete->thumbnail);
        }
        // hapus data
        return $this->db->delete($this->_table, array('id' => $id));
    }

    private function _uploadImage()
    {
        // upload gambar
        $ext                     = pathinfo($_FILES["thumbnail"]["name"], PATHINFO_EXTENSION);
        $config['upload_path']   = './uploads/images/thumbnails/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['file_name']     = time() . '.' . $ext;
        $config['max_size']      = 2048;
        // $config['max_width']     = 1024;
        // $config['max_height']    = 768;

        // import library untuk upload file
        $this->load->library('upload', $config);

        // kalo upload gagal redirect balik dan pesan error ditaruh di session
        if (!$this->upload->do_upload('thumbnail')) {
            $errorImage = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('errorImage', $errorImage['error']);
            redirect(site_url('admin/artikel/add'));
        }

        return $config['file_name'];
    }

}
