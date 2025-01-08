<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndexController extends CI_Controller {

    public function index() {
        // Load view
        $this->load->helper('url');
        $this->load->view('home');
    }
}
