<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{
    public function __construct(){
        parent::__construct();
        
    }

    public function index(){
        // menampilkan halaman index di depan
        $this->load->view("main/index.php");
    }
}