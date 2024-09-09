<div class="sidebar d-flex flex-column flex-shrink-0 p-3 bg-light" ">
    <a href="/" class="d-flex align-items-center justify-content-center mb-3 mb-md-0 link-dark text-decoration-none">
      <img src="{{url('assets/images/logo.png')}}" alt="Logo" class="logo" style="max-width: 100%;   height: auto;">
    </a>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ url('#') }}" class="nav-link link-dark" data-link="admin" aria-current="page">
                <i class="bi bi-house-door"></i>
                <span>لوحة النظام</span>
            </a>
        </li>

            <li class="nav-item">
                <a href="{{ route('user_type.index') }}" class="nav-link link-dark" data-link="user-types">
                    <i class="bi bi-people"></i>
                    <span>أنواع المستخدمين</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('jobs.index') }}" class="nav-link link-dark" data-link="jobs">
                    <i class="bi bi-calendar-check"></i>
                    <span>الوظائف</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('index_department') }}" class="nav-link link-dark" data-link="departments">
                    <i class="bi bi-card-checklist"></i>
                    <span>الأقسام</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('holidays.index') }}" class="nav-link link-dark" data-link="holidays.index">
                    <i class="bi bi-calendar-x"></i>
                    <span>العطل</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link link-dark" data-link="employee-index">
                    <i class="bi bi-wallet2"></i>
                    <span>الموظفين</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link link-dark" data-link="salary-index">
                    <i class="bi bi-wallet2"></i>
                    <span>الرواتب</span>
                </a>
            </li>
        <li class="nav-item">
            <a href="#" class="nav-link link-dark" data-link="complaints">
                <i class="bi bi-file-earmark-text"></i>
                <span>إدارة الشكاوي</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link link-dark" data-link="reports">
                <i class="bi bi-bar-chart"></i>
                <span>التقارير</span>
            </a>
        </li>
    </ul>
  </div>
