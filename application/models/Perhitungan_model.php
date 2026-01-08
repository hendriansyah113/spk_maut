<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan_model extends CI_Model
{

    public function tampil()
    {
        $query = $this->db->get('penilaian');
        return $query->result();
    }

    public function get_kriteria()
    {
        $query = $this->db->get('kriteria');
        return $query->result();
    }
    public function get_alternatif()
    {
        $query = $this->db->get('alternatif');
        return $query->result();
    }

    public function data_nilai($id_alternatif, $id_kriteria, $bulan, $tahun)
    {
        $query = $this->db->query("SELECT * FROM penilaian JOIN sub_kriteria WHERE penilaian.nilai=sub_kriteria.id_sub_kriteria AND penilaian.id_alternatif='$id_alternatif' AND penilaian.id_kriteria='$id_kriteria' AND penilaian.bulan='$bulan' AND penilaian.tahun='$tahun';");
        return $query->row_array();
    }

    public function get_max_min($id_kriteria, $bulan, $tahun)
    {
        $query = $this->db->query("SELECT max(sub_kriteria.nilai) as max, min(sub_kriteria.nilai) as min, sub_kriteria.nilai as nilai FROM `penilaian` 
			JOIN sub_kriteria ON penilaian.nilai=sub_kriteria.id_sub_kriteria 
			JOIN kriteria ON penilaian.id_kriteria=kriteria.id_kriteria 
			WHERE penilaian.id_kriteria='$id_kriteria' AND penilaian.bulan='$bulan' AND penilaian.tahun='$tahun';");
        return $query->row_array();
    }

    public function get_hasil($bulan, $tahun)
    {
        $query = $this->db->query("SELECT * FROM hasil WHERE bulan='$bulan' AND tahun='$tahun' ORDER BY nilai DESC;");
        return $query->result();
    }

    public function get_hasil_alternatif($id_alternatif)
    {
        $query = $this->db->query("SELECT * FROM alternatif WHERE id_alternatif='$id_alternatif';");
        return $query->row_array();
    }

    public function insert_nilai_hasil($hasil_akhir = [], $bulan, $tahun)
    {
        $hasil_akhir['bulan'] = $bulan;
        $hasil_akhir['tahun'] = $tahun;
        return $this->db->insert('hasil', $hasil_akhir);
    }

    public function hapus_hasil($bulan, $tahun)
    {
        $query = $this->db->query("DELETE FROM hasil WHERE bulan='$bulan' AND tahun='$tahun';");
        return $query;
    }
}
