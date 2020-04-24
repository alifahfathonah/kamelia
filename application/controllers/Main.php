<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('date');        
    }

    public function index(){
        // menampilkan halaman index di depan
        $data['defaultDate'] = mdate("%Y-%m-%d");
        $this->load->view("main/calendar.php", $data);
    }
}