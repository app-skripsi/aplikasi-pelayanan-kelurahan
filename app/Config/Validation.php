<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $data_administrasi = [
		'nama'                      => 'required',
        'nik'                       => 'required',
        'kk'                        => 'required',
        'alamat'                    => 'required',
        'kedatangan'                => 'required',
        'pelayanan'                 => 'required',
	];

	public $data_administrasi_errors = [
		'nama'      	        => [
			'required'			=> 'Nama Tidak Boleh Kosong'
        ],
        'nik'      	            => [
			'required'			=> 'Nik Tidak Boleh Kosong'
        ],
        'kk'      	            => [
			'required'			=> 'kk Tidak Boleh Kosong'
        ],
        'alamat'      	        => [
			'required'			=> 'alamat Tidak Boleh Kosong'
        ],
        'kedatangan'      	    => [
			'required'			=> 'kedatangan Tidak Boleh Kosong'
        ],
        'pelayanan'    => [
			'required'			=> 'pelayanan Tidak Boleh Kosong'
        ]
	];
}
