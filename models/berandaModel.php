<?php
defined('BASEPATH') or exit('No direct script access allowed');

class berandaModel extends CI_Model
{
	public function getTotalSantri()
	{
		$query = "SELECT COUNT(id_santri) AS total FROM data_santri WHERE status_santri > 0 AND status_santri < 10";
		$data = $this->db->query($query)->row_object();
		$total = $data->total;

		$queryl = "SELECT COUNT(id_santri) AS total FROM data_santri WHERE tipe_santri = 1 AND status_santri > 0 AND status_santri < 10";
		$datal = $this->db->query($queryl)->row_object();
		$totall = $datal->total;

		$queryp = "SELECT COUNT(id_santri) AS total FROM data_santri WHERE tipe_santri = 2 AND status_santri > 0 AND status_santri < 10";
		$datap = $this->db->query($queryp)->row_object();
		$totalp = $datap->total;

		$queryb = "SELECT COUNT(id_santri) AS total FROM data_santri WHERE status_santri = 0 AND status_santri < 10";
		$datab = $this->db->query($queryb)->row_object();
		$totalb = $datab->total;



		return [$total, $totall, $totalp, $totalb];
	}


	public function getTotalSantriBaru($periode)
	{
		$query = "SELECT COUNT(id_santri) AS total FROM data_santri WHERE status_santri > 0 AND status_santri < 10 AND periode_masuk = '$periode'";
		$data = $this->db->query($query)->row_object();
		$total = $data->total;

		$queryl = "SELECT COUNT(id_santri) AS total FROM data_santri WHERE tipe_santri = 1 AND status_santri > 0 AND status_santri < 10 AND periode_masuk = '$periode'";
		$datal = $this->db->query($queryl)->row_object();
		$totall = $datal->total;

		$queryp = "SELECT COUNT(id_santri) AS total FROM data_santri WHERE tipe_santri = 2 AND status_santri > 0 AND status_santri < 10 AND periode_masuk = '$periode'";
		$datap = $this->db->query($queryp)->row_object();
		$totalp = $datap->total;

		$queryb = "SELECT COUNT(id_santri) AS total FROM data_santri WHERE status_santri = 0 AND status_santri < 10 AND periode_masuk = '$periode'";
		$datab = $this->db->query($queryb)->row_object();
		$totalb = $datab->total;



		return [$total, $totall, $totalp, $totalb];
	}


	public function getPerKab()
	{

		$this->db->select('domisili_santri, COUNT(id_santri) AS total');
		$this->db->from('data_santri');
		$this->db->where(['status_santri >' => 0, 'status_santri <' => 10]);
		$this->db->group_by('domisili_santri');
		$datab = $this->db->get()->result_object();

		$queryc = "SELECT domisili_santri, COUNT(id_santri) AS total FROM data_santri WHERE tipe_santri = 1 GROUP BY domisili_santri";
		$datac = $this->db->query($queryc)->result_object();

		$queryd = "SELECT domisili_santri, COUNT(id_santri) AS total FROM data_santri WHERE tipe_santri = 2 GROUP BY domisili_santri";
		$datad = $this->db->query($queryd)->result_object();

		return [$datab, $datac, $datad];
	}

	public function getDataPerKab($tipe)
	{

		// $queryb = "SELECT domisili_santri, COUNT(id_santri) AS total FROM data_santri GROUP BY domisili_santri";
		// $datab = $this->db->query($queryb)->result_object();
		$this->db->select('domisili_santri, COUNT(id_santri) AS total');
		$this->db->from('data_santri');
		$this->db->where(['status_santri >' => 0, 'status_santri <' => 10]);
		$this->db->group_by('domisili_santri');
		$datab = $this->db->get()->result_object();

		$this->db->select('domisili_santri, COUNT(id_santri) AS total');
		$this->db->from('data_santri');
		$this->db->where(['tipe_santri' => $tipe, 'status_santri >' => 0, 'status_santri <' => 10]);
		$this->db->group_by('domisili_santri');
		$datac = $this->db->get()->result_object();

		return [$datab, $datac];
	}

	public function getKamar($tipe)
	{
		return $this->db->get_where('data_kamar', ['tipe_kamar' => $tipe])->result_object();
	}

	public function getDataDetail($tipe)
	{
		$kamar = $this->input->post('kamar', true);

		$this->db->select('domisili_santri, nomor_kamar_santri, COUNT(id_santri) AS total');
		$this->db->from('data_santri');
		$this->db->where([
			'status_santri >' => 0, 'status_santri <' => 10,
			'domisili_santri' => $kamar, 'tipe_santri' => $tipe
		]);
		$this->db->order_by('nomor_kamar_santri', 'ASC')->group_by('nomor_kamar_santri');
		return $this->db->get()->result_object();
	}

	public function getDataDetailKamar($tipe)
	{
		$daerah = $this->input->post('daerah', true);
		$kamar = $this->input->post('kamar', true);

		$this->db->select('*');
		$this->db->from('data_santri');
		$this->db->where([
			'status_santri >' => 0,
			'status_santri <' => 10,
			'domisili_santri' => $daerah,
			'nomor_kamar_santri' => $kamar,
			'tipe_santri' => $tipe
		]);
		$this->db->order_by('id_santri', 'ASC');
		return $this->db->get()->result_object();
	}
}
