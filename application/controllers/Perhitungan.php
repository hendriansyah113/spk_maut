<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan extends CI_Controller
{

    public function __construct()
    {
        Parent::__construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('Perhitungan_model');
    }

    public function index()
    {
        if ($this->session->userdata('id_user_level') != "1") {
            echo "<script>alert('Anda tidak berhak mengakses halaman ini!'); window.location='" . base_url("Login/home") . "'</script>";
            return;
        }

        // CEK TOTAL BOBOT
        $total_bobot = $this->Perhitungan_model->total_bobot();

        if ($total_bobot != 100) {
            echo "<script>
            alert('Total bobot kriteria saat ini = {$total_bobot}.\\nHarap sesuaikan total bobot menjadi 100 terlebih dahulu.');
            window.location='" . base_url("Kriteria") . "'
        </script>";
            return;
        }

        $bulan = $this->input->get('bulan') ?? date('n');
        $tahun = $this->input->get('tahun') ?? date('Y');

        $this->Perhitungan_model->hapus_hasil($bulan, $tahun); // optional, bisa diganti update

        $data = [
            'page' => "Perhitungan",
            'bulan' => $bulan,
            'tahun' => $tahun,
            'kriteria' => $this->Perhitungan_model->get_kriteria(),
            'alternatif' => $this->Perhitungan_model->get_alternatif($bulan, $tahun) // nanti di model kita filter
        ];

        $this->load->view('Perhitungan/perhitungan', $data);
    }


    public function hasil()
    {
        $kriteria = $this->Perhitungan_model->get_kriteria();
        $alternatif = $this->Perhitungan_model->get_alternatif();
        $bulan = $this->input->get('bulan') ?? date('n');
        $tahun = $this->input->get('tahun') ?? date('Y');

        $this->Perhitungan_model->hapus_hasil($bulan, $tahun); // optional, bisa diganti update
        foreach ($alternatif as $keys) {
            $nilai_total = 0;
            foreach ($kriteria as $key) {
                $data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria, $bulan, $tahun);
                $min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria, $bulan, $tahun);
                $selisih = $min_max['max'] - $min_max['min'];

                $hasil_normalisasi = @(round(($data_pencocokan['nilai'] - $min_max['min']) / ($min_max['max'] - $min_max['min']), 4));
                $bobot = $key->bobot;
                $nilai_total += $bobot * $hasil_normalisasi;
            }
            $hasil_akhir = [
                'id_alternatif' => $keys->id_alternatif,
                'nilai' => $nilai_total
            ];

            $result = $this->Perhitungan_model->insert_nilai_hasil($hasil_akhir, $bulan, $tahun);
        }

        $data = [
            'page' => "Hasil",
            'hasil' => $this->Perhitungan_model->get_hasil($bulan, $tahun),
        ];

        $this->load->view('Perhitungan/hasil', $data);
    }
}
