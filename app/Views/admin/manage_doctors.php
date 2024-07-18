<?= $this->extend('template/admin_master') ?>

<?= $this->section('styles'); ?>
<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container mt-5">
    <h1>Manage Doctors</h1>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPatientModal">Add Doctor</button>
    <div id="doctorsTablebutton"></div>
    <table id="doctorsTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Spesialisasi</th>
                <th>Hari Kerja</th>
                <th>Waktu Kerja</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Add Patient Modal -->
<div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPatientModalLabel">Add Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPatientForm">
                    <div class="mb-3">
                        <label for="addName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="addName" required>
                    </div>
                    <div class="mb-3">
                        <label for="addDay" class="form-label">Hari</label>
                        <select class="form-select" id="addDay" required>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jum'at">Jum'at</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addSpecialization" class="form-label">Spesialis</label>
                        <input type="text" class="form-control" id="addSpecialization" required>
                    </div>
                    <div class="mb-3">
                        <label for="addTimeStart" class="form-label">Waktu Mulai</label>
                        <input type="time" class="form-control" id="addTimeStart" required>
                    </div>
                    <div class="mb-3">
                        <label for="addTimeEnd" class="form-label">Waktu Selesai</label>
                        <input type="time" class="form-control" id="addTimeEnd" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Doctor</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Patient Modal -->
<div class="modal fade" id="viewPatientModal" tabindex="-1" aria-labelledby="viewPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPatientModalLabel">View Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="viewName"></span></p>
                <p><strong>Spesialisasi:</strong> <span id="viewSpecialization"></span></p>
                <p><strong>Hari:</strong> <span id="viewDay"></span></p>
                <p><strong>Waktu:</strong> <span id="viewTime"></span></p>

            </div>
        </div>
    </div>
</div>

<!-- Edit Patient Modal -->
<div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPatientModalLabel">Edit Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPatientForm">
                    <input type="hidden" id="editId">

                    <div class="mb-3">
                        <label for="addName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" required>
                    </div>
                    <div class="mb-3">
                        <label for="addDay" class="form-label">Hari</label>
                        <select class="form-select" id="editDay" required>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jum'at">Jum'at</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addSpecialization" class="form-label">Spesialis</label>
                        <input type="text" class="form-control" id="editSpecialization" required>
                    </div>
                    <div class="mb-3">
                        <label for="addTimeStart" class="form-label">Waktu Mulai</label>
                        <input type="time" class="form-control" id="editTimeStart" required>
                    </div>
                    <div class="mb-3">
                        <label for="addTimeEnd" class="form-label">Waktu Selesai</label>
                        <input type="time" class="form-control" id="editTimeEnd" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Patient Modal -->
<div class="modal fade" id="deletePatientModal" tabindex="-1" aria-labelledby="deletePatientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePatientModalLabel">Delete Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this patient?</p>
                <form id="deletePatientForm">
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
        var table = $('#doctorsTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "http://localhost:8080/api/doctors",
                "type": "GET",
                "beforeSend": function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                "dataSrc": function(json) {
                    // Inspect the JSON response
                    console.log(json);
                    // Ensure the data is returned in the expected format
                    if (json.data) {
                        return json.data;
                    } else {
                        return [];
                    }
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "specialization"
                },
                {
                    "data": "day"
                },
                {
                    "data": "time"
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return `
                        <button class="btn btn-info btn-view" data-id="${row.id}">View</button>
                        <button class="btn btn-warning btn-edit" data-id="${row.id}">Edit</button>
                        <button class="btn btn-danger btn-delete" data-id="${row.id}">Delete</button>
                    `;
                    }
                }
            ]
        });

        // Add Patient
        $('#addPatientForm').submit(function(e) {

            var name = document.getElementById('addName').value;
            var day = document.getElementById('addDay').value;
            var specialization = document.getElementById('addSpecialization').value;
            var time_start = document.getElementById('addTimeStart').value;
            var end_time = document.getElementById('addTimeEnd').value;

            let data = {
                name: name,
                day: day,
                specialization: specialization,
                time_start: time_start,
                end_time: end_time,
            }
            e.preventDefault();
            $.ajax({
                url: 'http://localhost:8080/api/doctors',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },

                data: JSON.stringify(data),
                success: function(response) {
                    if (response.sts == 'ok') {
                        toastr.success(response.message);
                        $('#addPatientModal').modal('hide');
                        document.getElementById('addName').value = '';
                        document.getElementById('addDay').value = '';
                        document.getElementById('addSpecialization').value = '';
                        document.getElementById('addTimeStart').value = '';
                        document.getElementById('addTimeEnd').value = '';

                        table.ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    alert('Error saving doctor');
                }
            });
        });

        // View Patient
        $(document).on('click', '.btn-view', function() {
            var id = $(this).data('id');
            $.ajax({
                url: 'http://localhost:8080/api/doctors/' + id,
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                success: function(response) {
                    $('#viewName').text(response.name);
                    $('#viewSpecialization').text(response.specialization);
                    $('#viewDay').text(response.day);
                    $('#viewTime').text(response.time);
                    $('#viewPatientModal').modal('show');
                },
                error: function(xhr) {
                    alert('Error fetching patient details');
                }
            });
        });

        // Edit Patient
        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');

            $.ajax({
                url: 'http://localhost:8080/api/doctors/' + id,
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                success: function(response) {
                    $('#editId').val(response.id);
                    $('#editName').val(response.name);
                    $('#editDay').val(response.day);
                    $('#editSpecialization').val(response.specialization);
                    $('#editTimeStart').val(response.time_start);
                    $('#editTimeEnd').val(response.end_time);
                    $('#editPatientModal').modal('show');
                },
                error: function(xhr) {
                    alert('Error fetching patient details');
                }
            });
        });

        // Save changes to Patient
        $('#editPatientForm').submit(function(e) {

            e.preventDefault();
            var id = $('#editId').val();

            var name = document.getElementById('editName').value;
            var day = document.getElementById('editDay').value;
            var specialization = document.getElementById('editSpecialization').value;
            var time_start = document.getElementById('editTimeStart').value;
            var end_time = document.getElementById('editTimeEnd').value;

            let data = {
                name: name,
                day: day,
                specialization: specialization,
                time_start: time_start,
                end_time: end_time,
            }
            $.ajax({
                url: 'http://localhost:8080/api/doctors/' + id,
                type: 'PUT',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                data: JSON.stringify(data),
                success: function(response) {
                    if (response.sts == 'ok') {
                        toastr.success(response.message);
                        $('#editPatientModal').modal('hide');
                        table.ajax.reload();
                    } else {
                        toastr.error(response.message);

                    }
                },
                error: function(xhr) {
                    alert('Error updating doctor');
                }
            });
        });

        // Delete Patient
        $(document).on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this patient?')) {
                $.ajax({
                    url: 'http://localhost:8080/api/doctors/' + id,
                    type: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    },
                    success: function(response) {
                        if (response.sts == 'ok') {
                            toastr.success(response.message);
                            $('#addPatientModal').modal('hide');
                            table.ajax.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Error deleting doctor');
                    }
                });
            }
        });
    });
</script>


<?= $this->endSection(); ?>