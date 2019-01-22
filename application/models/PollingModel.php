<?php
class PollingModel extends MY_Model
{
    protected $table   = 'polling';

    /*
    |-----------------------------------------------------------------
    | Menampilkan hasil polling.
    |-----------------------------------------------------------------
    */
    public function getJumlahVoting()
    {
        return $this->db->select_sum('voting', 'jumlah_voting')
                        ->get($this->table)
                        ->row();
    }

    public function prepData($polling)
    {
        foreach ($polling as $row) {
            $voting = $row->voting;
            $row->prosentase = $prosentase
                             = $this->calcProsentation($voting);
            $row->grafik = $this->renderPollingGrafik($prosentase);
        }
        return $polling;
    }

    private function calcProsentation($voting)
    {
        $totalVoting = (int) $this->getJumlahVoting()->jumlah_voting;
        if ($totalVoting != 0) {
            $formula     = ($voting / $totalVoting) * 100;
            $prosentase  = sprintf("%2.1f", $formula);
            return "$prosentase %";
        }

        return '0';
    }

    private function renderPollingGrafik($prosentase)
    {
        $picUrl = site_url('asset/images/polling_grafik.png');
        $width = $prosentase * 3;
        return '<img src="' .
                $picUrl .
                '" width="' .
                $width .
                '" height="18">';
    }

    /*
    |-----------------------------------------------------------------
    | Memproses polling secara otomatis.
    |-----------------------------------------------------------------
    */
    public function runDaemon()
    {
        // Cari sms voting di inbox.
        $voting = $this->getVoting();
        if (! $voting) {
            return;
        }

        // Process voting.
        $this->processVoting($voting);

        // Tampung ID sms di inbox yang sudah diproses.
        $IDS = $this->collectID($voting);

        // Hapus sms voting di inbox yang sudah diproses.
        $this->deleteProcessedVoting($IDS);

    }

    private function getVoting()
    {
        return $this->db->select('ID, TextDecoded')
                        ->like('TextDecoded', 'VOTE')
                        ->get('inbox')
                        ->result();
    }

    private function processVoting($voting)
    {
        foreach ($voting as $row) {
            $kode = trim($row->TextDecoded);
            $kode = strtoupper($kode);

            $currentVoting = $this->getCurrentVoting($kode);

            $this->updateVoting($kode, $currentVoting);
        }
    }

    private function getCurrentVoting($kode)
    {
        $query = $this->db->select('voting')
                          ->where('kode', $kode)
                          ->get($this->table)
                          ->row();
        return $query->voting;
    }

    private function updateVoting($kode, $currentVoting)
    {
        $voting = $currentVoting + 1;
        $data = ['voting' => $voting];
        $this->db->where('kode', $kode)->update('polling', $data);
    }

    private function collectID($voting)
    {
        $IDS = [];
        foreach ($voting as $row) {
            $IDS[] = $row->ID;
        }
        return $IDS;
    }

    private function deleteProcessedVoting($IDS)
    {
        $this->db->where_in('ID', $IDS)->delete('inbox');
        return $this->db->affected_rows();
    }
}
