<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link href="{{ url('assets/dist/css/main.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
            /* لإزالة التمرير */
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Left: Login Form -->
        <div class="login-container">
            <div class="login-form">
                <img src="{{ url('assets/images/logo.png') }}" alt="Logo"
                    style="max-width: 800px; margin-bottom: 20px;">

                <div class="div1">مرحباً بك </div>

                <div class="div2">في نظام الموارد البشرية الخاص ببرنيق لعلوم الطيران</div>
                <br>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="email" name="email" placeholder="البريد الإلكتروني" required>
                    <input type="password" name="password" placeholder="كلمة المرور" required>
                    <button type="submit">تسجيل الدخول</button>
                    <a href="{{ route('admin') }}" class="btn add-button">
                        <i class="bi bi-plus-circle"></i> admin
                    </a>
                </form>
            </div>
        </div>

        <!-- Right: Image -->
        <div class="login-image">
            <img src="{{ url('assets/images/login.png') }}" alt="Login Image">
        </div>
    </div>

</body>

</html>
