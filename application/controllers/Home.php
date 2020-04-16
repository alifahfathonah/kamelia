<?php
class Home extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model("user_model");
    if($this->user_model->isNotLogin()) redirect(site_url('auth/login'));
  }
 
  public function index(){
    //Allowing akses to admin only
      if($this->session->userdata('role')==='1'){
          $this->load->view('home/index');
      }else{
          echo "Access Denied";
      }
 
  }
  public function kom(){
    //Allowing akses to staff only
    if($this->session->userdata('role')==='2'){
      $this->load->view('home/index');
    }else{
        echo "Access Denied";
    }
  } 
}