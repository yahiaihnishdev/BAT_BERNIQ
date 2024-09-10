<div class="sidebar d-flex flex-column flex-shrink-0 p-3 bg-light" ">
    <a href="/" class="d-flex align-items-center justify-content-center mb-3 mb-md-0 link-dark text-decoration-none">
      <img src="{{ url('assets/images/logo.png') }}" alt="Logo" class="logo" style="max-width: 100%;   height: auto;">
    </a>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('employees.index') }}" class="nav-link link-dark" aria-current="page">
                <i class="bi bi-house-door"></i>
                <span>الرجوع</span>
            </a>
        </li>

        <!-- Example: If an employee is selected, use their ID in the links -->
        @if(isset($employee))
            <li class="nav-item">
                <a href="{{ route('emp_family.index', ['emp_id' => $employee->emp_id]) }}" class="nav-link link-dark">
                    <i class="bi bi-people"></i>
                    <span>أفراد العائلة</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('employees.emergencyContacts', ['emp_id' => $employee->emp_id]) }}" class="nav-link link-dark">
                    <i class="bi bi-calendar-check"></i>
                    <span>جهة اتصال الطوارء</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('employees.documents', ['emp_id' => $employee->emp_id]) }}" class="nav-link link-dark">
                    <i class="bi bi-card-checklist"></i>
                    <span>مستنادات</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('employees.holidays', ['emp_id' => $employee->emp_id]) }}" class="nav-link link-dark">
                    <i class="bi bi-calendar-x"></i>
                    <span>العطل المقدم عليها</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('employees.performance', ['emp_id' => $employee->emp_id]) }}" class="nav-link link-dark">
                    <i class="bi bi-wallet2"></i>
                    <span>تقيم الاداء</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('employees.salary', ['emp_id' => $employee->emp_id]) }}" class="nav-link link-dark">
                    <i class="bi bi-wallet2"></i>
                    <span>الراتب</span>
                </a>
            </li>
        {{-- @else
            <!-- Default Links if no employee is selected -->
            <li class="nav-item">
                <a href="{{ route('emp_family.index') }}" class="nav-link link-dark">
                    <i class="bi bi-people"></i>
                    <span>أفراد العائلة</span>
                </a>
            </li>
            <!-- Add other default links here --> --}}
        @endif
    </ul>
</div>
