<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
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

    public function tambah_penilaian()
    {
        $bulan         = $this->input->post('bulan');
        $tahun         = $this->input->post('tahun');
        $id_alternatif = $this->input->post('id_alternatif');
        $id_kriteria = $this->input->post('id_kriteria');
        $nilai = $this->input->post('nilai');
        $i = 0;
        echo var_dump($nilai);
        foreach ($nilai as $key) {
            $this->Penilaian_model->tambah_penilaian($id_alternatif, $id_kriteria[$i], $key, $bulan, $tahun);
            $i++;
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
        redirect('Penilaian?bulan=' . $bulan . '&tahun=' . $tahun);
    }

    public function update_penilaian()
    {
        $id_alternatif = $this->input->post('id_alternatif');
        $id_kriteria   = $this->input->post('id_kriteria');
        $nilai         = $this->input->post('nilai');
        $bulan         = $this->input->post('bulan');
        $tahun         = $this->input->post('tahun');

        $i = 0;
        foreach ($nilai as $val) {
            $cek = $this->Penilaian_model
                ->data_penilaian($id_alternatif, $id_kriteria[$i], $bulan, $tahun);

            if ($cek) {
                $this->Penilaian_model
                    ->edit_penilaian($id_alternatif, $id_kriteria[$i], $val, $bulan, $tahun);
            } else {
                $this->Penilaian_model
                    ->tambah_penilaian($id_alternatif, $id_kriteria[$i], $val, $bulan, $tahun);
            }
            $i++;
        }

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">Data berhasil diupdate</div>'
        );
        redirect('Penilaian?bulan=' . $bulan . '&tahun=' . $tahun);
    }
}
