<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proyek extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // Fetch data proyek from API
        $response = file_get_contents('http://localhost:8080/api/proyek');
        $data['proyek'] = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            show_error('Failed to decode JSON response.', 500);
            return;
        }

        // Fetch lokasi data for each proyek using the specific API endpoint
        foreach ($data['proyek'] as &$proyek) {
            $proyek_id = $proyek['id'];
            if ($proyek_id) {
                $lokasi_response = file_get_contents("http://localhost:8080/api/proyek/$proyek_id/lokasi");
                $lokasi_data = json_decode($lokasi_response, true);

                if (json_last_error() === JSON_ERROR_NONE && !empty($lokasi_data)) {
                    $proyek['lokasi'] = $lokasi_data;
                } else {
                    $proyek['lokasi'] = null; // Handle if lokasi data not found or error in decoding
                }
            } else {
                $proyek['lokasi'] = null; // Handle if no proyek ID
            }
        }

        // Load the view with proyek and lokasi data
        $this->load->view('proyek/index', $data);
    }

    public function create()
    {
        // Fetch lokasi for the dropdown
        $response = file_get_contents('http://localhost:8080/api/lokasi');
        $data['lokasi'] = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            show_error('Failed to decode JSON response.', 500);
            return;
        }

        // Load the view with lokasi data
        $this->load->view('proyek/create', $data);
    }

    public function store()
    {
        // Retrieve form data
        $namaProyek = $this->input->post('namaProyek');
        $client = $this->input->post('client');
        $tglMulai = $this->input->post('tglMulai');
        $tglSelesai = $this->input->post('tglSelesai');
        $pimpinanProyek = $this->input->post('pimpinanProyek');
        $keterangan = $this->input->post('keterangan');
        $lokasiIds = $this->input->post('lokasiIds'); // Assuming 'lokasiIds' is the name used in your form

        // Prepare the data array
        $data = [
            'namaProyek' => $namaProyek,
            'client' => $client,
            'tglMulai' => $tglMulai,
            'tglSelesai' => $tglSelesai,
            'pimpinanProyek' => $pimpinanProyek,
            'keterangan' => $keterangan,
            'lokasiIds' => $lokasiIds
        ];

        // Send data to the API using the curl_request helper
        $response = $this->curl_request('http://localhost:8080/api/proyek', 'POST', $data);

        if ($response === false) {
            show_error('Failed to store data to the API.', 500);
        } else {
            redirect('proyek');
        }
    }


    public function edit($id)
    {
        // Fetch proyek data
        $response = file_get_contents("http://localhost:8080/api/proyek/$id");
        $data['proyek'] = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE || empty($data['proyek'])) {
            show_error('Failed to decode JSON response or no data found.', 500);
            return;
        }

        // Fetch lokasi for the dropdown
        $response = file_get_contents('http://localhost:8080/api/lokasi');
        $data['lokasi'] = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            show_error('Failed to decode JSON response.', 500);
            return;
        }

        // Fetch the lokasi associated with this proyek
        $response = file_get_contents("http://localhost:8080/api/proyek/$id/lokasi");
        $data['proyek_lokasi'] = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            show_error('Failed to decode JSON response.', 500);
            return;
        }

        // Mark selected lokasi in the dropdown
        if (!empty($data['proyek_lokasi'])) {
            foreach ($data['lokasi'] as &$lokasi) {
                if (in_array($lokasi['id'], array_column($data['proyek_lokasi'], 'id'))) {
                    $lokasi['selected'] = true;
                } else {
                    $lokasi['selected'] = false;
                }
            }
        }

        // Load the view with proyek and lokasi data
        $this->load->view('proyek/edit', $data);
    }

    public function update($id)
    {
        // Retrieve and sanitize form data
        $data = [
            'namaProyek' => $this->input->post('namaProyek', true),
            'client' => $this->input->post('client', true),
            'tglMulai' => $this->input->post('tglMulai', true),
            'tglSelesai' => $this->input->post('tglSelesai', true),
            'pimpinanProyek' => $this->input->post('pimpinanProyek', true),
            'keterangan' => $this->input->post('keterangan', true),
            'lokasiIds' => $this->input->post('lokasi_ids') // Ensure this matches the API expected key
        ];

        // Make the API request to update the data
        $response = $this->curl_request("http://localhost:8080/api/proyek/$id", 'PUT', $data);

        // Check the response for success or failure
        if ($response === false || json_decode($response) === null) {
            show_error('Failed to update data to the API.', 500);
        } else {
            // Redirect to the proyek list page on success
            redirect('proyek');
        }
    }

    public function delete($id)
    {
        $response = $this->curl_request("http://localhost:8080/api/proyek/$id", 'DELETE');
        if ($response === false) {
            show_error('Failed to delete data from the API.', 500);
        } else {
            redirect('proyek');
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
