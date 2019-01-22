<?php
class SmsScheduledModel extends MY_Model
{
    protected $table   = 'schedule';
    protected $perPage = 5;

    public function getValidationRules()
    {
        return [
            [
            'field' => 'no_hp',
            'label' => 'Nomor HP',
            'rules' => 'trim|required|numeric|max_length[15]'
            ],
            [
            'field' => 'waktu',
            'label' => 'Waktu',
            'rules' => 'trim|required'
            ],
            [
            'field' => 'pesan',
            'label' => 'Pesan',
            'rules' => 'trim|required|max_length[160]'
            ]
        ];
    }

    public function getDefaultValues()
    {
        return [
            'no_hp' => '',
            'waktu' => '',
            'pesan' => ''
        ];
    }

    public function insert($data)
    {
        $data->no_hp = $this->formatPhoneNumber($data->no_hp);
        $data->tanggal = $this->parseTanggal($data->waktu);
        $data->jam = $this->parseJam($data->waktu);

        // Data waktu tidak perlu disimpan. Kita sudah memparse data
        // waktu menjadi tanggal dan jam.
        unset($data->waktu);

        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    private function parseTanggal($waktu)
    {
        return substr($waktu, 0, 10);
    }

    private function parseJam($waktu)
    {
        return substr($waktu, -5, 5);
    }

    public function paginate($page)
    {
        $offset = $this->calcRealOffset($page);
        $schedule = $this->db->select(
                                'ID,
                                 tanggal,
                                 jam,
                                 no_hp,
                                 pesan'
                              )
                             ->order_by('ID', 'desc')
                             ->limit($this->perPage, $offset)
                             ->get($this->table)
                             ->result();
        $schedule = $this->prepDestinationName($schedule);
        return $schedule;
    }

    private function prepDestinationName($schedule)
    {
        foreach($schedule as $row) {
            $noHP = $row->no_hp;
            $found = $this->getContactName($noHP);
            if ($found) {
                $nama = $found->Name;
                $row->no_hp = "<span>$nama</span>$noHP";
            } else {
                $row->no_hp = $noHP;
            }
        }
        return $schedule;
    }

    /*
    |-----------------------------------------------------------------
    | Cek apakah ada sms yang sudah terjadwal untuk waktu saat ini?
    | Jika ada, kirimkan.
    |-----------------------------------------------------------------
    */
    public function runDaemon()
    {
        $tanggalSekarang = date('Y-m-d');
        $jamSekarang = date('H:i');

        $schedule = $this->getSchedule(
            $tanggalSekarang,
            $jamSekarang
        );

        if ($schedule) {
            return $this->sendSms($schedule);
        }
    }

    private function getSchedule($tanggal, $jam)
    {
        return $this->db->where('tanggal', $tanggal)
                        ->where('jam', $jam)
                        ->where('status', 'belum')
                        ->get($this->table)
                        ->row();
    }

    private function sendSms($schedule)
    {
        $data = (object) $this->prepData($schedule);
        $this->db->insert('outbox', $data);
        $this->changeStatus($data->ID);
    }

    private function prepData($schedule)
    {
        $data = [
            'ID'                => $schedule->ID,
            'DestinationNumber' => $schedule->no_hp,
            'TextDecoded'       => $schedule->pesan
        ];

        return $data;
    }

    private function changeStatus($ID)
    {
        $data = ['status' => 'terkirim'];
        $this->db->where('ID', $ID)->update('schedule', $data);
    }
}
