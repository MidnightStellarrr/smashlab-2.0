@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <h3>Welcome, {{ auth()->guard('admin')->user()->name }}!</h3>
        <p>You are logged in as an admin.</p>
    </div>
</div>
@endsection