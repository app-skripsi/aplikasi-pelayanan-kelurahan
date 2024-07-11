<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{

    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    public $data_administrasi = [
        'nama'                      => 'required',
        'nik'                       => 'required',
        'kk'                        => 'required',
        'alamat'                    => 'required',
        'no_telephone'              => 'required',
        'email'                     => 'required',
        'kedatangan'                => 'required',
        'pelayanan_id'              => 'required',
    ];

    public $data_administrasi_errors = [
        'nama'                      => [
            'required'                => 'Nama Tidak Boleh Kosong'
        ],
        'nik'                          => [
            'required'                => 'Nik Tidak Boleh Kosong'
        ],
        'kk'                          => [
            'required'                => 'KK Tidak Boleh Kosong'
        ],
        'alamat'                      => [
            'required'                => 'Alamat Tidak Boleh Kosong'
        ],
        'no_telephone'              => [
            'required'                => 'No Telephone Tidak Boleh Kosong'
        ],
        'email'                      => [
            'required'                => 'Email Tidak Boleh Kosong'
        ],
        'kedatangan'                  => [
            'required'                => 'kedatangan Tidak Boleh Kosong'
        ],
        'pelayanan_id'              => [
            'required'                => 'pelayanan Tidak Boleh Kosong'
        ]
    ];
}
