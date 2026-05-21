<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends MY_Controller
{

    public function index()
    {
        $tanggal = $this->input->get('tanggal');
        $q = trim((string) $this->input->get('q'));

        $where = [];
        $params = [];
        if ($tanggal) {
            $where[] = "r.tanggal = ?";
            $params[] = $tanggal;
        }
        if ($q !== '') {
            $where[] = "(p.nama LIKE ? OR d.nama LIKE ?)";
            $like = '%' . $q . '%';
            $params[] = $like;
            $params[] = $like;
        }
        $whereSql = !empty($where) ? (' WHERE ' . implode(' AND ', $where)) : '';

        $data['laporan'] = $this->db->query("
            SELECT r.id, r.tanggal, r.total, p.nama AS pasien_nama, d.nama AS dokter_nama
            FROM resep r
            JOIN pasien p ON p.id = r.pasien_id
            JOIN dokter d ON d.id = r.dokter_id
            $whereSql
            ORDER BY r.tanggal DESC, r.id DESC
        ", $params)->result();

        $data['tanggal_filter'] = $tanggal;
        $data['q'] = $q;
        $data['total_harian'] = $this->sumByRange(date('Y-m-d'), date('Y-m-d'));
        $data['total_mingguan'] = $this->sumByRange(date('Y-m-d', strtotime('monday this week')), date('Y-m-d'));
        $data['total_bulanan'] = $this->sumByRange(date('Y-m-01'), date('Y-m-d'));
        $data['total_tahunan'] = $this->sumByRange(date('Y-01-01'), date('Y-m-d'));
        $data['jumlah_transaksi'] = count($data['laporan']);

        $this->template('laporan/index', $data);
    }

    public function export_csv()
    {
        $rows = $this->db->query("
            SELECT r.tanggal, p.nama AS pasien, d.nama AS dokter, r.total
            FROM resep r
            JOIN pasien p ON p.id = r.pasien_id
            JOIN dokter d ON d.id = r.dokter_id
            ORDER BY r.tanggal DESC, r.id DESC
        ")->result_array();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=laporan-resep.csv');
        $out = fopen('php://output', 'w');
        fputcsv($out, ['Tanggal', 'Pasien', 'Dokter', 'Total']);
        foreach ($rows as $r) {
            fputcsv($out, [$r['tanggal'], $r['pasien'], $r['dokter'], $r['total']]);
        }
        fclose($out);
        exit;
    }

    private function sumByRange($start, $end)
    {
        $row = $this->db->query("SELECT COALESCE(SUM(total),0) AS total FROM resep WHERE tanggal BETWEEN ? AND ?", [$start, $end])->row();
        return (int) $row->total;
    }
}
