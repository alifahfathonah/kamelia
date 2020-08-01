<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('date');
        $this->load->model("artikel_model");
    }

    public function index(){
        
        $this->load->view("main/index.php");
    }

    public function calendar()
    {
        // menampilkan halaman index di depan
        $data['defaultDate'] = mdate("%Y-%m-%d");
        $this->load->view("main/calendar.php", $data);
    }

    public function artikel()
    {
        $artikel = $this->artikel_model;
        $data['artikel'] = $artikel->allMain();
        $this->load->view("main/artikel.php", $data);
    }

    public function artikelSingle($slug)
    {
        $artikel = $this->artikel_model;
        $data["artikel"] = $artikel->getBySlug($slug);
        $this->load->view("main/singleartikel.php", $data);
    }
}