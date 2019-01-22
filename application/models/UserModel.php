<?php
class UserModel extends MY_Model
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
                'rules' => 'trim|callback_isPasswordRequired'
            ],
            [
                'field' => 'level',
                'label' => 'Level',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'isBlokir',
                'label' => 'Blokir?',
                'rules' => 'trim|required'
            ]
        ];
    }

    public function getDefaultValues()
    {
        return [
            'username' => '',
            'password' => '',
            'level'    => '',
            'isBlokir' => ''
        ];
    }
}
