<?php
class MY_Model extends CI_Model
{
    protected $table             = '';
    protected $perPage           = 10;
    protected $paginationLinkNum = 10;

    public function __construct()
    {
        parent::__construct();

        // Set nama tabel secara otomatis jika tidak dideklarasikan
        // variabel $table di child class.
        if (!$this->table) {
            $this->table = strtolower(str_replace(
                'Model',
                '',
                get_class($this)
            ));
        }
    }

    /*
    |-----------------------------------------------------------------
    | Retrieve.
    |-----------------------------------------------------------------
    */
    public function find($id)
    {
        return $this->db->where("$this->table.ID", $id)
                        ->get($this->table)
                        ->row();
    }

    // Mendapatkan multiple record.
    // Override method ini jika memerlukan custom query.
    // Misalnya ketika perlu menambah "where" atau "join".
    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function orderBy($column, $order = 'asc')
    {
        $this->db->order_by($column, $order);
        return $this;
    }

    public function where($column, $where)
    {
        $this->db->where($column, $where);
        return $this;
    }

    /*
    |-----------------------------------------------------------------
    | Create Update Delete.
    |-----------------------------------------------------------------
    */
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where("$this->table.ID", $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where("$this->table.ID", $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    /*
    |-----------------------------------------------------------------
    | Pagination.
    |-----------------------------------------------------------------
    */
    // Mendapatkan multiple record dengan pagination.
    // Override method ini jika memerlukan custom query.
    // Misalnya ketika perlu menambah "where" atau "join".
    public function paginate($page)
    {
        $offset = $this->calcRealOffset($page);
        $this->db->limit($this->perPage, $offset);
        return $this->db->get($this->table)->result();
    }

    // Menghitung nilai offset berdasarkan nomor halaman.
    protected function calcRealOffset($page)
    {
        if (! $page) {
            $offset = 0;
        } else {
            $offset = ($page * $this->perPage) - $this->perPage;
        }
        return $offset;
    }

    public function makePaginationLink(
        $baseUrl,
        $uriSegment,
        $totalRow = null
    ) {
        $this->load->library('pagination');

        $config = [
            // Jangan lupa untuk menghitung nilai offset.
            'use_page_numbers' => true,

            'base_url'         => $baseUrl,
            'uri_segment'      => $uriSegment,
            'per_page'         => $this->perPage,
            'total_rows'       => $totalRow,
            'num_links'        => $this->paginationLinkNum,
            'first_link'       => '&#124;&lt; First',
            'last_link'        => 'Last &gt;&#124;',
            'next_link'        => 'Next &gt;',
            'prev_link'        => '&lt; Prev',

            // Bootstrap
            'full_tag_open'    => '<ul class="pagination' .
                                  ' pagination-sm">',
            'full_tag_close'   => '</ul>',
            'num_tag_open'     => '<li>',
            'num_tag_close'    => '</li>',
            'cur_tag_open'     => '<li class="disabled">' .
                                  '<li class="active"><a href="#">',
            'cur_tag_close'    => '<span class="sr-only">' .
                                  '</span></a></li>',
            'next_tag_open'    => '<li>',
            'next_tagl_close'  => '</li>',
            'prev_tag_open'    => '<li>',
            'prev_tagl_close'  => '</li>',
            'first_tag_open'   => '<li>',
            'first_tagl_close' => '</li>',
            'last_tag_open'    => '<li>',
            'last_tagl_close'  => '</li>',
        ];

        if (count($_GET) > 0) {
            $config['suffix']    = '?' .
                                   http_build_query($_GET, '', "&");
            $config['first_url'] = $config['base_url'] .
                                   '?' .
                                   http_build_query($_GET);
        } else {
            $config['suffix']    = http_build_query($_GET, '', "&");
            $config['first_url'] = $config['base_url'];
        }
        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }

    /*
    |-----------------------------------------------------------------
    | Form validation.
    |-----------------------------------------------------------------
    */
    public function validate()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters(
            '<span class="help-block">',
            '</span>'
        );
        $validationRules = $this->getValidationRules();
        $this->form_validation->set_rules($validationRules);
        return $this->form_validation->run();
    }

    /*
    |-----------------------------------------------------------------
    | Memformat no hp, mengganti "0" dengan "+62".
    |-----------------------------------------------------------------
    */
    public function formatPhoneNumber($num)
    {
        $noHP = $num;
        $pos  = strpos($noHP, '0', 0);

        if ($pos === 0) {
            $noHP = substr_replace($noHP, '+62', 0, 1);
        }

        return $noHP;
    }

    /*
    |-----------------------------------------------------------------
    | Mendapatkan nama di phonebook berdasarkan no hp.
    |-----------------------------------------------------------------
    */
    public function getContactName($phoneNumber)
    {
        $name = $this->db->select("Name")
                         ->where('Number', $phoneNumber)
                         ->get('pbk')
                         ->row();
        return $name;
    }

}
