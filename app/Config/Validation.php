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
        'kedatangan'                => 'required',
        'pelayanan_id'              => 'required',
	];

	public $data_administrasi_errors = [
		'nama'      	            => [
			'required'			    => 'Nama Tidak Boleh Kosong'
        ],
        'nik'      	                => [
			'required'			    => 'Nik Tidak Boleh Kosong'
        ],
        'kk'      	                => [
			'required'			    => 'kk Tidak Boleh Kosong'
        ],
        'alamat'      	            => [
			'required'			    => 'alamat Tidak Boleh Kosong'
        ],
        'kedatangan'      	        => [
			'required'			    => 'kedatangan Tidak Boleh Kosong'
        ],
        'pelayanan_id'              => [
			'required'			    => 'pelayanan Tidak Boleh Kosong'
        ]
	];
}
