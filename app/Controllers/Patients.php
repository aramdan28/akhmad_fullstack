<?php

namespace App\Controllers;

use App\Models\PatientModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Patients extends ResourceController
{
    protected $modelName = 'App\Models\PatientModel';
    protected $format    = 'json';

    public function index()
    {
        // Get parameters sent by DataTables
        $patientModel = new PatientModel();

        if (isset($_GET['all']) && $_GET['all'] == '1') {
            $patient = $patientModel->findAll();

            return $this->respond(['data' => $patient]);
        }

        $draw = $this->request->getVar('draw');
        $start = $this->request->getVar('start');
        $length = $this->request->getVar('length');
        $searchValue = $this->request->getVar('search')['value'];

        // Query the database

        // Count all records
        $totalRecords = $patientModel->countAll();

        // Search and limit the query
        if (!empty($searchValue)) {
            $patients = $patientModel->like('name', $searchValue)
                ->orLike('phone', $searchValue)
                ->orLike('address', $searchValue)
                ->orLike('age', $searchValue)
                ->orLike('medical_record', $searchValue)
                ->findAll($length, $start);

            // Count filtered records
            $totalFilteredRecords = $patientModel->like('name', $searchValue)
                ->orLike('phone', $searchValue)
                ->orLike('address', $searchValue)
                ->orLike('age', $searchValue)
                ->orLike('medical_record', $searchValue)
                ->countAllResults();
        } else {
            $patients = $patientModel->findAll($length, $start);
            $totalFilteredRecords = $totalRecords;
        }

        // Return the data in DataTables format
        $data = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalFilteredRecords,
            'data' => $patients
        ];

        return $this->respond($data);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if ($this->model->save($data)) {
            return $this->respond([$data, 'status' => 200, 'sts' => 'ok', 'message' => 'Data pasien telah ditambahkan']);
        } else {

            return $this->respond([$data, 'status' => 200, 'sts' => 'error', 'message' => 'error']);
        }
    }

    public function show($id = null)
    {
        $patient = $this->model->find($id);
        return $this->respond($patient);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if ($this->model->update($id, $data)) {
            return $this->respond([$data, 'status' => 200, 'sts' => 'ok', 'message' => 'Data telah diperbaharui']);
        } else {

            return $this->respond([$data, 'status' => 200, 'sts' => 'error', 'message' => 'error']);
        }
    }

    public function delete($id = null)
    {
        $userModel = new UserModel();

        $patient =  $this->model->find($id);

        $iduser =  $patient['id_user'];

        $deleted = $this->model->delete($id);

        if ($patient) {
            $userModel->where('id', $iduser)->delete();
        }

        if ($deleted) {
            return $this->respond(['status' => 200, 'sts' => 'ok', 'message' => 'Data telah dihapus']);
        } else {

            return $this->respond(['status' => 200, 'sts' => 'error', 'message' => 'error']);
        }
    }
}
