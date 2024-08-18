<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function index()
    {
        // Load the curl library
        $this->load->library('curl');
        $this->load->helper('url');

        // Fetch data from the API endpoints
        $lokasi_data = $this->curl->simple_get('http://localhost:8080/api/lokasi');
        $proyek_data = $this->curl->simple_get('http://localhost:8080/api/proyek');

        // Decode the JSON response into an associative array
        $lokasi_list = json_decode($lokasi_data, true);
        $proyek_list = json_decode($proyek_data, true);

        // Pass the data to the view
        $data['lokasi'] = $lokasi_list;
        $data['proyek'] = $proyek_list;

        // Load the view and pass the data
        $this->load->view('welcome_message', $data);
    }
}
