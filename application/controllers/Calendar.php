<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("kegiatan_model");        
    }

    public function kegiatan(){
        // ambil semua data kegiatan diubah menjadi json
        $all = $this->kegiatan_model->kegiatanAll();
        $data = array();
        foreach ($all as $single) {
            $row = [
                'id' => ucfirst($single->id),
                'title' => ucwords($single->nama),
                'pembicara' => ucfirst($single->pembicara),
                'pj' => ucfirst($single->pj),
                'date' => $single->waktu,
                'lokasi' => ucwords($single->lokasi),
                'catatan' => ucfirst($single->catatan),
                'deskripsi' => ucfirst($single->deskripsi),
                'review' => ucfirst($single->review),
                'jenis' => ucfirst($this->kegiatan_model->getJenis($single->jenis_id)),
                'owner' => ucfirst($this->kegiatan_model->getOwner($single->user_id)),
                // 'color' => '#800080'
            ];
            $data[] = $row;
        }
        echo json_encode($data);
    }
}