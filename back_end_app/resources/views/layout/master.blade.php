<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>BAT</title>
    <!-- Bootstrap CSS -->
    <link href="{{url('assets/dist/css/bootstrap.rtl.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <link href="{{url('assets/dist/css/main.css')}}" rel="stylesheet">
    {{-- <link href="{{url('assets/dist/css/sidebars.css')}}" rel="stylesheet"> --}}
</head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container-fluid">
            <!-- Toggler button for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="تبديل التنقل">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar items -->
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <!-- User Profile on the left -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <span class="nav-link" href="#" aria-label="user">
                            <img src="https://via.placeholder.com/30" alt="User" class="rounded-circle me-2">
                            المستخدم
                        </span>

                    </li>
                </ul>

                <!-- Icons on the right -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" aria-label="Settings">
                            <i class="bi bi-gear-fill"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" aria-label="Logout">
                            <i class="bi bi-box-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

  <main>
    <div class="d-flex">
      @include('layout.links')

      <!-- Main content goes here -->
        @yield('content')
    </div>
  </main>

  <script src="{{url('assets/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const navLinks = document.querySelectorAll(".sidebar .nav-link");

        navLinks.forEach(link => {
            link.addEventListener("click", function() {
                // إزالة الفئة "active" من جميع الروابط
                navLinks.forEach(nav => nav.classList.remove("active"));
                // إضافة الفئة "active" للعنصر الذي تم النقر عليه
                this.classList.add("active");
            });

            // التأكد من إزالة أي '/' إضافية في نهاية الـ URL قبل المطابقة
            const linkHref = link.href.replace(/\/$/, '');
            const currentHref = window.location.href.replace(/\/$/, '');

            // إذا كان الرابط يحتوي على رابط يطابق URL الحالي، اضف فئة "active"
            if (linkHref === currentHref || (link.getAttribute('href') === "#" && linkHref === currentHref)) {
                link.classList.add("active");
            }
        });
    });


    </script>
  </body>
</html>
