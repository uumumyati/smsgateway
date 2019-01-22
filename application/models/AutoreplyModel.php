<?php
class AutoreplyModel extends MY_Model
{
    public function runDaemon()
    {
        // Cari semua sms masuk, pilih yang ada kodenya saja.
        $inbox = $this->getInbox();
        if (!$inbox) {
            return;
        }

        // Siapkan balasan.
        $data = $this->prepareReplyData($inbox);

        // Reply SMS.
        $this->reply($data);

        // Tampung ID sms di inbox yang sudah dibalas.
        $IDS = $this->collectID($inbox);

        // Hapus sms di inbox yang sudah dibalas.
        $this->deleteRepliedMessage($IDS);
    }

    private function deleteRepliedMessage($IDS)
    {
        $this->db->where_in('ID', $IDS)->delete('inbox');
        return $this->db->affected_rows();
    }

    private function reply($data)
    {
        $this->db->insert_batch('outbox', $data);
        return $this->db->affected_rows();
    }

    private function getInbox()
    {
        return $this->db->select('ID, TextDecoded, SenderNumber')
                        ->like('TextDecoded', 'LAHIR')
                        ->or_like('TextDecoded', 'TINGGI')
                        ->or_like('TextDecoded', 'BERAT')
                        ->get('inbox')
                        ->result();
    }

    private function collectID($inbox)
    {
        $IDS = [];
        foreach ($inbox as $row) {
            $IDS[] = $row->ID;
        }
        return $IDS;
    }

    private function prepareReplyData($inbox)
    {
        $data = [];

        foreach ($inbox as $row) {
            $kode = $this->parseKode($row->TextDecoded);
            $noAnggota = $this->parseNoAnggota($row->TextDecoded);

            $data[] = [
                'TextDecoded' => $this->setRespond($kode, $noAnggota),
                'DestinationNumber' => $row->SenderNumber
            ];
        }

        return $data;
    }

    private function parseKode($pesan)
    {
        $part = explode(' ', $pesan);
        $kode = strtoupper($part[0]);
        return $kode;
    }

    private function parseNoAnggota($pesan)
    {
        $part = explode(' ', $pesan);
        $noAnggota = $part[1];
        return $noAnggota;
    }

    private function setRespond($kode, $noAnggota)
    {
        $respond = '';

        switch ($kode) {
            case "LAHIR":
                $respond = $this->respondTanggalLahir($noAnggota);
                break;
            case "BERAT":
                $respond = $this->respondBeratBadan($noAnggota);
                break;
            case "TINGGI":
                $respond = $this->respondTinggiBadan($noAnggota);
                break;
        }

        return $respond;
    }

    private function respondTanggalLahir($noAnggota)
    {
        $query        = $this->getTanggalLahir($noAnggota);
        $nama         = strtoupper($query->nama);
        $tanggalLahir = date(
            'd-m-Y',
            strtotime($query->tanggal_lahir)
        );
        return "Tanggal lahir $nama adalah $tanggalLahir.";
    }

    private function respondBeratBadan($noAnggota)
    {
        $query      = $this->getBeratBadan($noAnggota);
        $nama       = strtoupper($query->nama);
        $beratBadan = $query->berat_badan;
        return "Berat badan $nama adalah $beratBadan kg.";
    }

    private function respondTinggiBadan($noAnggota)
    {
        $query       = $this->getTinggiBadan($noAnggota);
        $nama        = strtoupper($query->nama);
        $tinggiBadan = $query->tinggi_badan;
        return "Berat badan $nama adalah $tinggiBadan cm.";
    }

    private function getTanggalLahir($noAnggota)
    {
        return $this->db->select('nama, tanggal_lahir')
                        ->where('no_anggota', $noAnggota)
                        ->get('anggota')
                        ->row();
    }

    private function getBeratBadan($noAnggota)
    {
        return $this->db->select('nama, berat_badan')
                        ->where('no_anggota', $noAnggota)
                        ->get('anggota')
                        ->row();
    }

    private function getTinggiBadan($noAnggota)
    {
        return $this->db->select('nama, tinggi_badan')
                        ->where('no_anggota', $noAnggota)
                        ->get('anggota')
                        ->row();
    }
}
