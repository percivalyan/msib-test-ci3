<?php
class Lokasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $response = $this->curl_request('http://localhost:8080/api/lokasi');
        if ($response === false) {
            show_error('Failed to fetch data from the API.', 500);
        } else {
            $data['lokasi'] = json_decode($response, true);
            $this->load->view('lokasi/index', $data);
        }
    }

    public function create()
    {
        $this->load->view('lokasi/create');
    }

    public function store()
    {
        $data = $this->input->post();
        $response = $this->curl_request('http://localhost:8080/api/lokasi', 'POST', $data);
        if ($response === false) {
            show_error('Failed to store data to the API.', 500);
        } else {
            redirect('lokasi');
        }
    }

    public function edit($id)
    {
        $response = $this->curl_request("http://localhost:8080/api/lokasi/$id");

        if ($response === false) {
            show_error('Failed to fetch data from the API.', 500);
            return;
        }

        $data['lokasi'] = json_decode($response, true);

        // Debug output to check the received data
        log_message('debug', 'Lokasi data: ' . print_r($data['lokasi'], true));

        if (json_last_error() !== JSON_ERROR_NONE) {
            show_error('Failed to decode JSON response.', 500);
            return;
        }

        // Check if data is empty or has required keys
        if (empty($data['lokasi']) || !isset($data['lokasi']['id'])) {
            show_error('No data found for the provided ID.', 404);
            return;
        }

        $this->load->view('lokasi/edit', $data);
    }

    public function update($id)
    {
        $data = $this->input->post();
        $response = $this->curl_request("http://localhost:8080/api/lokasi/$id", 'PUT', $data);
        if ($response === false) {
            show_error('Failed to update data to the API.', 500);
        } else {
            redirect('lokasi');
        }
    }

    public function delete($id)
    {
        $response = $this->curl_request("http://localhost:8080/api/lokasi/$id", 'DELETE');
        if ($response === false) {
            show_error('Failed to delete data from the API.', 500);
        } else {
            redirect('lokasi');
        }
    }
    private function curl_request($url, $method = 'GET', $data = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($method != 'GET') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        }

        // Debugging the cURL request
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            log_message('error', 'cURL error: ' . curl_error($ch));
        }
        curl_close($ch);

        return $response;
    }
}
