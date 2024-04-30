<?php

namespace App\Controllers\Api;

use App\Models\PegawaiModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Pegawai extends ResourceController
{

    /** 
     * response format menggunakan jsend
     * references : https://github.com/omniti-labs/jsend
     * 
     * **/

    public function __construct()
    {
        $this->model = model(PegawaiModel::class);
    }

    /**
     * Return an array of resource pegawai, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $pegawai = $this->model->orderBy('id', 'DESC')->findAll();

        $responseBody['data']['pegawai'] = $pegawai;

        return $this->respond($responseBody);
    }

    /**
     * Return the properties of a resource pegawai.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $pegawai = $this->model->find($id);

        if (is_null($pegawai)) {
            return $this->failNotFound('Data pegawai dengan id ' . $id . ' tidak ditemukan.');
        }

        $responseBody['data']['pegawai'] = $pegawai;

        return $this->respond($responseBody);
    }

    /**
     * Create a new resource pegawai, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $pegawai = [
            'nama'      => esc($this->request->getVar('nama')),
            'email'     => esc($this->request->getVar('email')),
            'jabatan'   => esc($this->request->getVar('jabatan')),
            'posisi'    => esc($this->request->getVar('posisi')),
            'avatar'    => esc($this->request->getVar('avatar')),
        ];

        if ($this->model->insert($pegawai) === false) {
            return $this->failValidationErrors($this->model->errors());
        }

        $responseBody['data']['pegawai'] = $pegawai;

        return $this->respondCreated($responseBody);
    }

    /**
     * Add or update a model pegawai, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {

        $pegawai = $this->model->find($id);

        if (is_null($pegawai)) {
            return $this->failResourceGone('Data pegawai gagal diperbaharui, pegawai dengan id ' . $id . ' tidak ditemukan.');
        }

        $pegawai = [
            'nama'      => esc($this->request->getVar('nama')),
            'email'     => esc($this->request->getVar('email')),
            'jabatan'   => esc($this->request->getVar('jabatan')),
            'posisi'    => esc($this->request->getVar('posisi')),
            'avatar'    => esc($this->request->getVar('avatar')),
        ];

        if ($this->model->update($id, $pegawai) === false) {
            return $this->failValidationErrors($this->model->errors());
        }

        $responseBody['data']['pegawai'] = $pegawai;

        return $this->respondUpdated($responseBody);
    }

    /**
     * Delete the designated resource pegawai from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $pegawai = $this->model->find($id);

        if (is_null($pegawai)) {
            return $this->failResourceGone('Data pegawai gagal dihapus, pegawai dengan id ' . $id . ' tidak ditemukan.');
        }

        $this->model->delete($id);

        $responseBody['data']['pegawai'] = $pegawai;

        return $this->respondDeleted($responseBody);
    }
}