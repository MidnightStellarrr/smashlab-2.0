<!DOCTYPE html>
<html>
<head>
    <title>Front Desk Login - SmashLab</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0a1628 0%, #1a2a4a 50%, #2a3a6a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .login-container { width: 100%; max-width: 420px; padding: 20px; }
        .login-card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .login-logo { text-align: center; margin-bottom: 30px; }
        .login-logo h1 { color: #111827; font-size: 24px; }
        .login-logo p { color: #6b7280; font-size: 14px; }
        .login-badge {
            display: inline-block;
            background: #1f47d8;
            color: white;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 8px;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .alert-danger { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
        .alert-success { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; color: #374151; font-size: 13px; font-weight: 600; margin-bottom: 4px; }
        .input-wrapper { position: relative; }
        .input-wrapper i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9ca3af; }
        .form-input {
            width: 100%;
            padding: 12px 14px 12px 44px;
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            color: #111827;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            outline: none;
            transition: all 0.3s ease;
        }
        .form-input:focus { border-color: #1f47d8; box-shadow: 0 0 0 4px rgba(31,71,216,0.1); }
        .password-wrapper { position: relative; }
        .password-wrapper i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9ca3af; }
        .password-input {
            width: 100%;
            padding: 12px 44px 12px 44px;
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            color: #111827;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            outline: none;
            transition: all 0.3s ease;
        }
        .password-input:focus { border-color: #1f47d8; box-shadow: 0 0 0 4px rgba(31,71,216,0.1); }
        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            font-size: 18px;
        }
        .toggle-password:hover { color: #374151; }
        .login-btn {
            width: 100%;
            padding: 12px;
            background: #1f47d8;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .login-btn:hover { background: #1a3ab8; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(31,71,216,0.35); }
        .login-footer { text-align: center; margin-top: 20px; color: #9ca3af; font-size: 13px; }
        .login-footer span { color: #1f47d8; font-weight: 600; }
        .switch-link { text-align: center; margin-top: 16px; font-size: 14px; color: #6b7280; }
        .switch-link a { color: #1f47d8; text-decoration: none; font-weight: 600; }
        .switch-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-logo">
                <h1>🏸 WELCOME BACK!</h1>
                <p>Front Desk Staff Login</p>
                <span class="login-badge">Staff Only</span>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('frontdesk.login.post') }}">
                @csrf
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="frontdesk@smashlab.com" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" id="passwordInput" class="password-input" placeholder="••••••••" required>
                        <button type="button" id="togglePassword" class="toggle-password">
                            <i class="fa-regular fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="login-btn">Sign In</button>
            </form>

            <div class="switch-link">
                <a href="{{ route('admin.login') }}">→ Admin Login</a>
            </div>

            <div class="login-footer">
                <i class="fa-solid fa-shield-halved"></i> Secure Staff Access · <span>SmashLab</span>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const input = document.getElementById('passwordInput');
            const icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'fa-regular fa-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'fa-regular fa-eye';
            }
        });
    </script>
</body>
</html>