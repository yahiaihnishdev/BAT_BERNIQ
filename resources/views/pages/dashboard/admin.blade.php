<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee ID Card</title>
    <!-- Bootstrap CSS -->
    <link href="{{url('assets/dist/css/bootstrap.rtl.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <link href="{{url('assets/dist/css/main.css')}}" rel="stylesheet">
    <style>
      .id-card {
        width: 350px;
        height: 220px;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin: 20px auto;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      }
      .id-card img {
        border-radius: 50%;
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin-bottom: 10px;
      }
      .id-card h5 {
        margin: 10px 0;
      }
      .id-card p {
        margin: 5px 0;
        font-size: 14px;
      }
      .id-card .btn-edit {
        margin-top: 15px;
      }
    </style>
  </head>
  <body>
    <div class="id-card">
      <img src="{{ $employee->photo_url ?? 'https://via.placeholder.com/80' }}" alt="Employee Photo">
      <h5>{{ $employee->emp_name }}</h5>
      <p><strong>ID:</strong> {{ $employee->emp_num_id }}</p>
      <p><strong>Job Title:</strong> {{ $employee->job->job_title }}</p>
      <p><strong>Hire Date:</strong> {{ $employee->hire_date }}</p>
      <button class="btn btn-primary btn-edit" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
    </div>

    <!-- Edit Employee Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('employees.update', $employee->emp_id) }}" method="post" enctype="multipart/form-data" novalidate>
              @csrf
              @method('PUT')

              <!-- Employee Name -->
              <div class="mb-3">
                <label for="emp_name" class="form-label">Employee Name</label>
                <input type="text" name="emp_name" class="form-control" value="{{ $employee->emp_name }}" required>
              </div>

              <!-- Job Title -->
              <div class="mb-3">
                <label for="job_id" class="form-label">Job Title</label>
                <select name="job_id" class="form-control" required>
                  @foreach($jobs as $job)
                    <option value="{{ $job->job_id }}" {{ $employee->job_id == $job->job_id ? 'selected' : '' }}>
                      {{ $job->job_title }}
                    </option>
                  @endforeach
                </select>
              </div>

              <!-- Hire Date -->
              <div class="mb-3">
                <label for="hire_date" class="form-label">Hire Date</label>
                <input type="date" name="hire_date" class="form-control" value="{{ $employee->hire_date }}" required>
              </div>

              <!-- Employee Photo -->
              <div class="mb-3">
                <label for="photo" class="form-label">Employee Photo</label>
                <input type="file" name="photo" class="form-control">
                <small class="text-muted">Leave blank to keep current photo.</small>
              </div>

              <button type="submit" class="btn btn-success">Save Changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="{{url('assets/dist/js/bootstrap.bundle.min.js')}}"></script>
  </body>
</html>
