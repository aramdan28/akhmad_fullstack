<?php

namespace App\Controllers;

use App\Models\PatientModel;
use App\Models\DoctorModel;
use App\Models\DoctorScheduleModel;
use App\Models\InspectionScheduleModel;

class AdminController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Dashboard';
        return view('admin/dashboard', $data);
    }

    public function managePatients()
    {
        $model = new PatientModel();
        $data['title'] = 'Patients';
        $data['patients'] = $model->findAll();
        return view('admin/manage_patients', $data);
    }

    public function manageDoctors()
    {
        $model = new DoctorModel();
        $data['title'] = 'Doctors';

        $data['doctors'] = $model->findAll();
        return view('admin/manage_doctors', $data);
    }

    public function manageDoctorSchedules()
    {
        $model = new DoctorScheduleModel();
        $data['title'] = 'Doctor Schedules';

        $data['doctor_schedules'] = $model->findAll();
        return view('admin/manage_doctor_schedules', $data);
    }

    public function manageInspectionSchedules()
    {
        $model = new InspectionScheduleModel();
        $data['title'] = 'Inspection Schedules';

        $data['inspection_schedules'] = $model->findAll();
        return view('admin/manage_inspection_schedules', $data);
    }
}
