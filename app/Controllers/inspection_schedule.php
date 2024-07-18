<?php

namespace App\Controllers;

use App\Models\DoctorModel;
use App\Models\DoctorScheduleModel;
use App\Models\InspectionScheduleModel;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class inspection_schedule extends ResourceController
{
    protected $modelName = 'App\Models\InspectionScheduleModel';
    protected $format    = 'json';

    public function index()
    {
        // Get parameters sent by DataTables
        $draw = $this->request->getVar('draw');
        $start = $this->request->getVar('start');
        $length = $this->request->getVar('length');
        $searchValue = $this->request->getVar('search')['value'];

        // Query the database
        $InspectionScheduleModel = new InspectionScheduleModel();

        // Count all records
        $totalRecords = $InspectionScheduleModel->countAll();

        // Search and limit the query
        if (!empty($searchValue)) {
            $doctors = $InspectionScheduleModel->like('name', $searchValue)
                ->orLike('name', $searchValue)
                ->orLike('specialization', $searchValue)
                ->findAll($length, $start);

            // Count filtered records
            $totalFilteredRecords = $InspectionScheduleModel->like('name', $searchValue)
                ->orLike('name', $searchValue)
                ->orLike('specialization', $searchValue)
                ->countAllResults();
        } else {
            $doctors = $InspectionScheduleModel
                ->select('inspectionschedules.*,doctors.name as dname,patients.name as pname ')
                ->join('doctors', 'doctors.id = inspectionschedules.id_doctor', 'left')
                ->join('patients', 'patients.id = inspectionschedules.id_patient', 'left')
                ->findAll($length, $start);
            $totalFilteredRecords = $totalRecords;
        }
        $datad = [];
        foreach ($doctors as $key => $value) {
            $datad[] = [
                'id' => $value['id'],
                'doctor' => $value['dname'],
                'patient' => $value['pname'],
                'date_time' => $value['date_time'],
                'time' => $value['time'],
                'status' => $value['status'],
            ];
        }

        // Return the data in DataTables format
        $data = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalFilteredRecords,
            'data' => $datad,
        ];

        return $this->respond($data);
    }

    public function create()
    {
        $InspectionScheduleModel = new InspectionScheduleModel();


        $data = $this->request->getJSON(true);

        $datad['id_doctor'] = $data['doctor_id'];
        $datad['id_patient'] = $data['patient_id'];
        $datad['date_time'] = $data['date_time'];
        $datad['time'] = $data['time'];
        $datad['status'] = $data['status'];

        if ($InspectionScheduleModel->save($data)) {

            return $this->respond([$data, 'status' => 200, 'sts' => 'ok', 'message' => 'data telah ditambahkan']);
        } else {

            return $this->respond([$data, 'status' => 200, 'sts' => 'error', 'message' => 'data gagal ditambahkan']);
        }
    }

    public function show($id = null)
    {
        $doctor = $this->model->find($id);

        return $this->respond($doctor);
    }

    public function update($id = null)
    {

        $data = $this->request->getJSON(true);

        if ($this->model->update($id, $data)) {
            return $this->respond([$data, 'status' => 200, 'sts' => 'ok', 'message' => 'data telah diperbaharui']);
        } else {

            return $this->respond([$data, 'status' => 200, 'sts' => 'error', 'message' => 'data gagal diperbaharui']);
        }
    }

    public function delete($id = null)
    {

        if ($this->model->delete($id)) {
            return $this->respond(['status' => 200, 'sts' => 'ok', 'message' => 'data telah dihapus']);
        } else {

            return $this->respond(['status' => 200, 'sts' => 'error', 'message' => 'error']);
        }
    }
}
