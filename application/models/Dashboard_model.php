<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function total_alternatif($bulan, $tahun)
    {
        return $this->db
            ->count_all_results('alternatif');
    }

    public function total_kriteria()
    {
        return $this->db->count_all('kriteria');
    }

    public function ranking_teratas($bulan, $tahun)
    {
        return $this->db
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->order_by('nilai', 'DESC')
            ->limit(1)
            ->get('hasil')
            ->row();
    }

    public function grafik_nilai($bulan, $tahun)
    {
        return $this->db
            ->select('alternatif.nama, hasil.nilai')
            ->join('alternatif', 'alternatif.id_alternatif = hasil.id_alternatif')
            ->order_by('hasil.nilai', 'DESC')
            ->limit(5)
            ->get('hasil')
            ->result();
    }
}
