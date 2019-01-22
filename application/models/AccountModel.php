<?php
class AccountModel extends MY_Model
{
    protected $table = 'user';

    public function getValidationRules()
    {
        return [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => [
                    'trim',
                    'required',
                    'max_length[32]',
                    'callback_isUsernameUnik'
                ]
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim'
            ],
            [
                'field' => 'passConf',
                'label' => 'Konfirmasi Password',
                'rules' => 'trim|matches[password]'
            ]
        ];
    }

    public function getDefaultValues()
    {
        return [
            'username' => '',
            'password' => '',
        ];
    }
}
