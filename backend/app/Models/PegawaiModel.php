<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table            = 'pegawai';
    protected $returnType       = 'object';

    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'email', 'jabatan', 'posisi', 'avatar'];

    protected $validationRules  = [
        'nama'      => 'required|min_length[3]|max_length[100]',
        'email'     => 'required|max_length[100]|valid_email',
        'jabatan'   => 'required|in_list[pejabat,guru,staf]',
        'posisi'    => 'required|min_length[3]|max_length[50]',
        'avatar'    => 'max_length[2083]',
    ];
}