

use Illuminate\Support\Facades\Response;

public function export()
{
    $employees = Employee::where('emp_active', 1)->with(['job', 'department'])->get();

    $csvData = "Emp ID,Emp Num ID,Name,Username,Job,Department,Basic Salary,Hire Date\n";

    foreach ($employees as $emp) {
        $csvData .= "{$emp->emp_id},{$emp->emp_num_id},{$emp->emp_name},{$emp->emp_username},{$emp->job->job_name},{$emp->department->dept_name},{$emp->basic_salary},{$emp->hire_date}\n";
    }

    $filename = "employees_export_" . date('Ymd_His') . ".csv";

    return Response::make($csvData, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename={$filename}",
    ]);
}
