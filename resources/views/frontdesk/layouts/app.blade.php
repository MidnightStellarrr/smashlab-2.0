<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Front Desk Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #f3f4f6; }
        .frontdesk-wrapper { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #0a1628; padding: 24px; color: white; min-height: 100vh; }
        .sidebar h2 { margin-bottom: 24px; }
        .sidebar a { display: block; padding: 10px; color: #9ca3af; text-decoration: none; border-radius: 8px; margin-bottom: 4px; }
        .sidebar a:hover { background: #1a2a4a; color: white; }
        .sidebar a.active { background: #1f47d8; color: white; }
        .main-content { flex: 1; padding: 24px; }
        .stats-grid { display: grid; grid-template-columns: 1fr; gap: 20px; }
        .stat-card { background: white; border-radius: 16px; padding: 24px; border: 1px solid #e5e7eb; }
        .stat-card h3 { color: #111827; margin-bottom: 8px; }
        .stat-card p { color: #6b7280; }
        .logout-btn {
            width: 100%;
            padding: 10px;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            margin-top: 20px;
        }
        .logout-btn:hover { background: #b91c1c; }
    </style>
</head>
<body>
    <div class="frontdesk-wrapper">
        <div class="sidebar">
            <h2>🏸 Front Desk</h2>
            <nav>
                <a href="{{ route('frontdesk.dashboard') }}" class="active">Dashboard</a>
                <a href="#">Bookings</a>
                <a href="#">Customers</a>
                <a href="#">Shop</a>
                <a href="#">Classes</a>
            </nav>
            <form method="POST" action="{{ route('frontdesk.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</body>
</html>