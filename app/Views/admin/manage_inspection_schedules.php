<?= $this->extend('template/admin_master') ?>

<?= $this->section('styles'); ?>
<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container mt-5">
    <h1>Manage Jadwal Pemeriksaan</h1>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addScheduleModal">Add Schedule</button>
    <table id="inspectionScheduleTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Dokter</th>
                <th>Pasien</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Add Schedule Modal -->
<div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addScheduleModalLabel">Add Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addScheduleForm">
                    <div class="mb-3">
                        <label for="addDoctor" class="form-label">Dokter</label>
                        <select class="form-select" id="addDoctor" required></select>
                    </div>
                    <div class="mb-3">
                        <label for="addPatient" class="form-label">Pasien</label>
                        <select class="form-select" id="addPatient" required></select>
                    </div>
                    <div class="mb-3">
                        <label for="addDate" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="addDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="addTime" class="form-label">Waktu</label>
                        <input type="time" class="form-control" id="addTime" required>
                    </div>
                    <div class="mb-3">
                        <label for="addStatus" class="form-label">Status</label>
                        <select class="form-select" id="addStatus" required>
                            <option value="Pending">Pending</option>
                            <option value="Approve">Approve</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Schedule</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Schedule Modal -->
<div class="modal fade" id="editScheduleModal" tabindex="-1" aria-labelledby="editScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editScheduleModalLabel">Edit Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editScheduleForm">
                    <input type="hidden" id="editId">
                    <div class="mb-3">
                        <label for="editDoctor" class="form-label">Dokter</label>
                        <select class="form-select" id="editDoctor" required></select>
                    </div>
                    <div class="mb-3">
                        <label for="editPatient" class="form-label">Pasien</label>
                        <select class="form-select" id="editPatient" required></select>
                    </div>
                    <div class="mb-3">
                        <label for="editDate" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="editDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTime" class="form-label">Waktu</label>
                        <input type="time" class="form-control" id="editTime" required>
                    </div>
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select class="form-select" id="editStatus" required>
                            <option value="Pending">Pending</option>
                            <option value="Approve">Approve</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Schedule Modal -->
<div class="modal fade" id="deleteScheduleModal" tabindex="-1" aria-labelledby="deleteScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteScheduleModalLabel">Delete Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this schedule?</p>
                <form id="deleteScheduleForm">
                    <input type="hidden" id="deleteId">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- Include jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>


<script>
    $(document).ready(function() {
        var table = $('#inspectionScheduleTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "http://localhost:8080/api/inspection_schedule",
                "type": "GET",
                "beforeSend": function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "doctor"
                },
                {
                    "data": "patient"
                },
                {
                    "data": "date_time"
                },
                {
                    "data": "time"
                },
                {
                    "data": "status"
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return `
                        <button class="btn btn-info btn-edit" data-id="${row.id}">Edit</button>
                        <button class="btn btn-danger btn-delete" data-id="${row.id}">Delete</button>
                    `;
                    }
                }
            ]
        });

        // Load doctors and patients for the select options
        function loadSelectOptions() {
            $.ajax({
                url: 'http://localhost:8080/api/doctors?all=1',
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                success: function(response) {
                    $('#addDoctor, #editDoctor').empty();
                    response.data.forEach(function(doctor) {
                        $('#addDoctor, #editDoctor').append(`<option value="${doctor.id}">${doctor.name}</option>`);
                    });
                }
            });

            $.ajax({
                url: 'http://localhost:8080/api/patients?all=1',
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                success: function(response) {
                    $('#addPatient, #editPatient').empty();
                    response.data.forEach(function(patient) {
                        $('#addPatient, #editPatient').append(`<option value="${patient.id}">${patient.name}</option>`);
                    });
                }
            });
        }

        // Open add schedule modal
        $('#addScheduleModal').on('show.bs.modal', function() {
            loadSelectOptions();
        });

        // Add Schedule
        $('#addScheduleForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'http://localhost:8080/api/inspection_schedule',
                type: 'POST',
                data: JSON.stringify({
                    doctor_id: $('#addDoctor').val(),
                    patient_id: $('#addPatient').val(),
                    date_time: $('#addDate').val(),
                    time: $('#addTime').val(),
                    status: $('#addStatus').val()
                }),
                contentType: 'application/json',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                success: function(response) {
                    table.ajax.reload();
                    if (response.sts == 'ok') {
                        toastr.success(response.message);
                        $('#addScheduleModal').modal('hide');
                        $('#addScheduleForm')[0].reset();

                        table.ajax.reload();
                    } else {
                        toastr.error(response.message);

                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        // Edit Schedule
        $('#inspectionScheduleTable').on('click', '.btn-edit', function() {
            loadSelectOptions();
            var id = $(this).data('id');
            $.ajax({
                url: `http://localhost:8080/api/inspection_schedule/${id}`,
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                success: function(response) {
                    $('#editId').val(response.id);
                    $('#editDoctor').val(response.id_doctor).trigger('change');
                    $('#editPatient').val(response.id_patient);
                    $('#editDate').val(response.date_time);
                    $('#editTime').val(response.time);
                    $('#editStatus').val(response.status);
                    $('#editScheduleModal').modal('show');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $('#editScheduleForm').on('submit', function(e) {
            e.preventDefault();
            var id = $('#editId').val();
            $.ajax({
                url: `http://localhost:8080/api/inspection_schedule/${id}`,
                type: 'PUT',
                data: JSON.stringify({
                    id_doctor: $('#editDoctor').val(),
                    id_patient: $('#editPatient').val(),
                    date_time: $('#editDate').val(),
                    time: $('#editTime').val(),
                    status: $('#editStatus').val()
                }),
                contentType: 'application/json',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                success: function(response) {
                    $('#editScheduleModal').modal('hide');
                    $('#editScheduleForm')[0].reset();
                    table.ajax.reload();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        // Delete Schedule
        $('#inspectionScheduleTable').on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this schedule?')) {
                $.ajax({
                    url: `http://localhost:8080/api/inspection_schedule/${id}`,
                    type: 'DELETE',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                    },
                    success: function(response) {
                        table.ajax.reload();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
    });
</script>

<?= $this->endSection(); ?>