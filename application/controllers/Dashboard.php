<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('Penilaian_model');

        if ($this->session->userdata('id_user_level') != "1") {
?>
            <script type="text/javascript">
                alert('Anda tidak berhak mengakses halaman ini!');
                window.location = '<?php echo base_url("Login/home"); ?>'
            </script>
<?php
        }
    }

    public function index()
    {
        $bulan = $this->input->get('bulan') ?? date('n');
        $tahun = $this->input->get('tahun') ?? date('Y');

        $data = [
            'page' => "Penilaian",
            'bulan' => $bulan,
            'tahun' => $tahun,
            'list' => $this->Penilaian_model->tampil($bulan, $tahun),
            'kriteria' => $this->Penilaian_model->get_kriteria(),
            'alternatif' => $this->Penilaian_model->get_alternatif(),
            'sub_kriteria' => $this->Penilaian_model->get_sub_kriteria()
        ];
        $this->load->view('penilaian/index', $data);
    }
}
