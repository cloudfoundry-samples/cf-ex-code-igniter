<?php

if ( PHP_SAPI !== 'cli' ) exit('No web access allowed');

class Migrations extends CI_Controller {
    public function index() {
        $this->load->library('migration');
        $this->migration->current();
        
        $data['title'] = 'Migrations';
        $data['type'] = 'current';

        $this->load->view('templates/header', $data);
        $this->load->view('migrations/index');
        $this->load->view('templates/footer');
    }
}

?>
