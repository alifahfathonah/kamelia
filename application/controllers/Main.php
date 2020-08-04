<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->model("artikel_model");
    }

    public function index()
    {
        $artikel = $this->artikel_model;
        $data["artikel"] = $artikel->getSlider();
        $data["berita"] = $artikel->getColumnBerita();
        $data["esai"] = $artikel->getColumnEsai();
        
        $this->load->view("main/index.php", $data);
    }

    public function calendar()
    {
        // menampilkan halaman index di depan
        $data['defaultDate'] = mdate("%Y-%m-%d");
        $this->load->view("main/calendar.php", $data);
    }

    // public function artikel()
    // {
    //     $artikel = $this->artikel_model;

    //     // untuk mencari berdasarkan judul dan isi
    //     $search = '';
    //     if ($this->input->post('submit_search') != null) {
    //         $search = $this->input->post('search');
    //         $this->session->set_userdata(array("search" => $search));
    //     } else {
    //         if ($this->session->userdata('search') != null) {
    //             $search = $this->session->userdata('search');
    //         }
    //     }
    //     // Menghitung data yang diambil berdasarkan pencarian
    //     $allcount = $artikel->getRecordCount($search);
        
    //     // konfigurasi pagination
    //     $this->load->library('pagination');
    //     $per_page = 6;
    //     $page     = (isset($_GET['page'])) ? $_GET['page'] : 0;
    //     $this->pagination->initialize($this->configPagination($per_page, $allcount));
    //     // ambil data dari 0
    //     $start = (($page - 1 < 0 ? $page = 0 : $page - 1)) * $per_page;

    //     // variable pagination dan data artikel
    //     $data['pagination'] = $this->pagination->create_links();
    //     $data['artikel'] = $artikel->allPaginationSearch($per_page, $start, $search);

    //     $this->load->view("main/artikel.php", $data);
    // }

    public function berita()
    {
        $artikel = $this->artikel_model;
        $kategori_id = 1;

        // untuk mencari berdasarkan judul dan isi
        $search = '';
        // if ($this->input->post('submit_search') != null) {
        //     $search = $this->input->post('search');
        //     $this->session->set_userdata(array("search" => $search));
        // } else {
        //     if ($this->session->userdata('search') != null) {
        //         $search = $this->session->userdata('search');
        //     }
        // }

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } 

        // Menghitung data yang diambil berdasarkan pencarian
        $allcount = $artikel->getRecordCount($search, $kategori_id);
        
        // konfigurasi pagination
        $this->load->library('pagination');
        $per_page = 6;
        $base_url = site_url('berita');
        $page     = (isset($_GET['page'])) ? $_GET['page'] : 0;
        $this->pagination->initialize($this->configPagination($per_page, $allcount, $base_url));
        // ambil data dari 0
        $start = (($page - 1 < 0 ? $page = 0 : $page - 1)) * $per_page;

        // variable pagination dan data artikel
        $data['pagination'] = $this->pagination->create_links();
        $data['artikel'] = $artikel->allPaginationSearch($per_page, $start, $search, $kategori_id);
        $data['base_url'] = $base_url;

        $this->load->view("main/artikel.php", $data);
    }

    public function esai()
    {
        $artikel = $this->artikel_model;
        $kategori_id = 2;

        // untuk mencari berdasarkan judul dan isi
        $search = '';
        // if ($this->input->post('submit_search') != null) {
        //     $search = $this->input->post('search');
        //     $this->session->set_userdata(array("search" => $search));
        // } else {
        //     if ($this->session->userdata('search') != null) {
        //         $search = $this->session->userdata('search');
        //     }
        // }

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } 


        // Menghitung data yang diambil berdasarkan pencarian
        $allcount = $artikel->getRecordCount($search, $kategori_id);
        
        // konfigurasi pagination
        $this->load->library('pagination');
        $per_page = 6;
        $base_url = site_url('esai');
        $page     = (isset($_GET['page'])) ? $_GET['page'] : 0;
        $this->pagination->initialize($this->configPagination($per_page, $allcount, $base_url));
        // ambil data dari 0
        $start = (($page - 1 < 0 ? $page = 0 : $page - 1)) * $per_page;

        // variable pagination dan data artikel
        $data['pagination'] = $this->pagination->create_links();
        $data['artikel'] = $artikel->allPaginationSearch($per_page, $start, $search, $kategori_id);
        $data['base_url'] = $base_url;

        $this->load->view("main/artikel.php", $data);
    }

    private function configPagination($per_page, $total_rows, $base_url)
    {
        $config['base_url']             = $base_url;
        $config['total_rows']           = $total_rows; //total row
        $config['per_page']             = $per_page; //show record per halaman
        $choice                         = $config["total_rows"] / $config["per_page"];
        $config["num_links"]            = floor($choice);
        $config['page_query_string']    = true;
        $config['use_page_numbers']     = true;
        $config['query_string_segment'] = 'page';
        $config['reuse_query_string'] = true;
        // $config["uri_segment"]          = 2; // uri parameter

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        return $config;
    }

    public function artikelSingle($slug)
    {
        $artikel         = $this->artikel_model;
        $data["artikel"] = $artikel->getBySlug($slug);
        $this->load->view("main/singleartikel.php", $data);
    }

    public function beritaSingle($slug)
    {
        $artikel         = $this->artikel_model;
        $data["artikel"] = $artikel->getBySlug($slug);
        $this->load->view("main/singleartikel.php", $data);
    }

    public function esaiSingle($slug)
    {
        $artikel         = $this->artikel_model;
        $data["artikel"] = $artikel->getBySlug($slug);
        $this->load->view("main/singleartikel.php", $data);
    }
}
