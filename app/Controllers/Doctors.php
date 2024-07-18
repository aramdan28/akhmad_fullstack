<?php

namespace App\Controllers;

use App\Models\DoctorModel;
use App\Models\DoctorScheduleModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Doctors extends ResourceController
{
    protected $modelName = 'App\Models\DoctorModel';
    protected $format    = 'json';

    public function index()
    {
        // Get parameters sent by DataTables
        $doctorModel = new DoctorModel();

        if (isset($_GET['all']) && $_GET['all'] == '1') {
            $doctors = $doctorModel->findAll();

            return $this->respond(['data' => $doctors]);
        }

        $draw = $this->request->getVar('draw');
        $start = $this->request->getVar('start');
        $length = $this->request->getVar('length');
        $searchValue = $this->request->getVar('search')['value'];

        // Query the database

        // Count all records
        $totalRecords = $doctorModel->countAll();

        // Search and limit the query
        if (!empty($searchValue)) {
            $doctors = $doctorModel->like('name', $searchValue)
                ->orLike('name', $searchValue)
                ->orLike('specialization', $searchValue)
                ->findAll($length, $start);

            // Count filtered records
            $totalFilteredRecords = $doctorModel->like('name', $searchValue)
                ->orLike('name', $searchValue)
                ->orLike('specialization', $searchValue)
                ->countAllResults();
        } else {
            $doctors = $doctorModel->join('doctorschedules', 'doctorschedules.id_doctor = doctors.id', 'left')->findAll($length, $start);
            $totalFilteredRecords = $totalRecords;
        }
        $datad = [];
        foreach ($doctors as $key => $value) {
            $datad[] = [
                'id' => $value['id_doctor'],
                'name' => $value['name'],
                'specialization' => $value['specialization'],
                'day' => $value['day'],
                'time' => $value['time_start'] . '-' . $value['end_time'],
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
        $data = $this->request->getJSON(true);

        $datad['name'] = $data['name'];
        $datad['specialization'] = $data['specialization'];

        if ($this->model->save($data)) {

            $datas['id_doctor'] = $this->model->getInsertID();
            $datas['day'] = $data['day'];
            $datas['time_start'] = $data['time_start'];
            $datas['end_time'] = $data['end_time'];

            $DoctorScheduleModel = new DoctorScheduleModel();
            if ($DoctorScheduleModel->save($datas)) {

                return $this->respond([$data, 'status' => 200, 'sts' => 'ok', 'message' => 'data telah ditambahkan']);
            } else {
                return $this->respond([$data, 'status' => 200, 'sts' => 'error', 'message' => 'data gagal ditambahkan']);
            }
        } else {

            return $this->respond([$data, 'status' => 200, 'sts' => 'error', 'message' => 'data gagal ditambahkan']);
        }
    }

    public function show($id = null)
    {
        $doctor = $this->model->join('doctorschedules', 'doctorschedules.id_doctor = doctors.id', 'left')->find($id);
        $datad = [
            'id' => $doctor['id_doctor'],
            'name' => $doctor['name'],
            'specialization' => $doctor['specialization'],
            'day' => $doctor['day'],
            'time' => $doctor['time_start'] . '-' . $doctor['end_time'],
            'time_start' => $doctor['time_start'],
            'end_time' =>  $doctor['end_time'],
        ];
        return $this->respond($datad);
    }

    public function update($id = null)
    {

        $data = $this->request->getJSON(true);

        $datad['name'] = $data['name'];
        $datad['specialization'] = $data['specialization'];

        if ($this->model->update($id, $datad)) {

            $datas['id_doctor'] = $id;
            $datas['day'] = $data['day'];
            $datas['time_start'] = $data['time_start'];
            $datas['end_time'] = $data['end_time'];

            $DoctorScheduleModel = new DoctorScheduleModel();
            $fs = $DoctorScheduleModel->where('id_doctor', $id)->get()->getResultArray();

            if ($DoctorScheduleModel->update($fs[0]['id'], $datas)) {

                return $this->respond([$data, 'status' => 200, 'sts' => 'ok', 'message' => 'data telah diperbaharui']);
            } else {
                return $this->respond([$data, 'status' => 200, 'sts' => 'error', 'message' => 'data gagal diperbaharui']);
            }
        } else {

            return $this->respond([$data, 'status' => 200, 'sts' => 'error', 'message' => 'data gagal diperbaharui']);
        }
    }

    public function delete($id = null)
    {
        $userModel = new UserModel();
        $DoctorScheduleModel = new DoctorScheduleModel();

        $doctor =  $this->model->find($id);
        $iddoctor =  $doctor['id'];
        $iduser =  $doctor['id_user'];

        $userModel->where('id', $iduser)->delete();
        $DoctorScheduleModel->where('id_doctor', $iddoctor)->delete();


        if ($this->model->delete($id)) {
            return $this->respond(['status' => 200, 'sts' => 'ok', 'message' => 'data telah dihapus']);
        } else {

            return $this->respond(['status' => 200, 'sts' => 'error', 'message' => 'error']);
        }
    }

    public function doctorsall()
    {
        // Get parameters sent by DataTables
        $doctorModel = new DoctorModel();

        if (isset($_GET['all']) && $_GET['all'] == '1') {
            $doctors = $doctorModel->findAll();

            return $this->respond(['data' => $doctors]);
        }

        $draw = $this->request->getVar('draw');
        $start = $this->request->getVar('start');
        $length = $this->request->getVar('length');
        $searchValue = $this->request->getVar('search')['value'];

        // Query the database

        // Count all records
        $totalRecords = $doctorModel->countAll();

        // Search and limit the query
        if (!empty($searchValue)) {
            $doctors = $doctorModel->join('doctorschedules', 'doctorschedules.id_doctor = doctors.id', 'left')
                ->orLike('name', $searchValue)
                ->orLike('specialization', $searchValue)
                ->findAll($length, $start);

            // Count filtered records
            $totalFilteredRecords = $doctorModel->join('doctorschedules', 'doctorschedules.id_doctor = doctors.id', 'left')
                ->orLike('name', $searchValue)
                ->orLike('specialization', $searchValue)
                ->countAllResults();
        } else {
            $doctors = $doctorModel->join('doctorschedules', 'doctorschedules.id_doctor = doctors.id', 'left')->findAll($length, $start);
            $totalFilteredRecords = $totalRecords;
        }
        $datad = [];
        foreach ($doctors as $key => $value) {
            $datad[] = [
                'id' => $value['id_doctor'],
                'name' => $value['name'],
                'specialization' => $value['specialization'],
                'day' => $value['day'],
                'time' => $value['time_start'] . '-' . $value['end_time'],
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
}
