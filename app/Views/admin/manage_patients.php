<?= $this->extend('template/admin_master') ?>

<?= $this->section('styles'); ?>
<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container mt-5">
    <h1>Manage Patients</h1>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPatientModal">Add Patient</button>
    <div id="patientsTablebutton"></div>
    <table id="patientsTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Address</th>
                <th>Medical Record</th>
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
                        <label for="addAge" class="form-label">Age</label>
                        <input type="number" class="form-control" id="addAge" required>
                    </div>
                    <div class="mb-3">
                        <label for="addAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="addAddress" required>
                    </div>
                    <div class="mb-3">
                        <label for="addMedicalRecord" class="form-label">Medical Record</label>
                        <textarea class="form-control" id="addMedicalRecord" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Patient</button>
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
                <p><strong>Age:</strong> <span id="viewAge"></span></p>
                <p><strong>Address:</strong> <span id="viewAddress"></span></p>
                <p><strong>Medical Record:</strong> <span id="viewMedicalRecord"></span></p>
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
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAge" class="form-label">Age</label>
                        <input type="number" class="form-control" id="editAge" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="editAddress" required>
                    </div>
                    <div class="mb-3">
                        <label for="editMedicalRecord" class="form-label">Medical Record</label>
                        <textarea class="form-control" id="editMedicalRecord" required></textarea>
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
        var table = $('#patientsTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "http://localhost:8080/api/patients",
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
                    "data": "age"
                },
                {
                    "data": "address"
                },
                {
                    "data": "medical_record"
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
            e.preventDefault();
            $.ajax({
                url: 'http://localhost:8080/api/patients',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                data: $(this).serialize(),
                success: function(response) {
                    $('#addPatientModal').modal('hide');
                    table.ajax.reload();
                },
                error: function(xhr) {
                    alert('Error saving patient');
                }
            });
        });

        // View Patient
        $(document).on('click', '.btn-view', function() {
            var id = $(this).data('id');
            $.ajax({
                url: 'http://localhost:8080/api/patients/' + id,
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                success: function(response) {
                    $('#viewName').text(response.name);
                    $('#viewAge').text(response.age);
                    $('#viewAddress').text(response.address);
                    $('#viewMedicalRecord').text(response.medical_record);
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
                url: 'http://localhost:8080/api/patients/' + id,
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                success: function(response) {
                    $('#editId').val(response.id);
                    $('#editName').val(response.name);
                    $('#editAge').val(response.age);
                    $('#editAddress').val(response.address);
                    $('#editMedicalRecord').val(response.medical_record);
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
            var age = document.getElementById('editAge').value;
            var address = document.getElementById('editAddress').value;
            var medical_record = document.getElementById('editMedicalRecord').value;

            let data = {
                'name': name,
                'age': age,
                'address': address,
                'medical_record': medical_record
            }
            $.ajax({
                url: 'http://localhost:8080/api/patients/' + id,
                type: 'PUT',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                data: JSON.stringify(data),
                success: function(response) {
                    $('#editPatientModal').modal('hide');
                    table.ajax.reload();
                },
                error: function(xhr) {
                    alert('Error updating patient');
                }
            });
        });

        // Delete Patient
        $(document).on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this patient?')) {
                $.ajax({
                    url: 'http://localhost:8080/api/patients/' + id,
                    type: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    },
                    success: function(response) {
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        alert('Error deleting patient');
                    }
                });
            }
        });
    });
</script>

</script>

<?= $this->endSection(); ?>