<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .header {
            background-color: #0077be;
            color: white;
            padding: 15px;
        }

        .header h3 {
            margin: 0;
        }

        .sidebar {
            background-color: #ffffff;
            padding: 20px;
            border-right: 1px solid #ddd;
            min-height: 100vh;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            padding: 10px;
            display: block;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .sidebar ul li a:hover, .sidebar ul li a.active {
            background-color: #0077be;
            color: white;
        }

        .card-task {
            margin: 15px 0;
            transition: transform 0.3s;
        }

        .card-task:hover {
            transform: scale(1.02);
        }

        .dropdown-menu a.active {
            font-weight: bold;
        }

        .btn-custom {
            background-color: #0077be;
            color: white;
        }

        .btn-custom:hover {
            background-color: #005fa3;
            color: white;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<div class="header d-flex justify-content-between align-items-center px-4">
    <h3>Maritim Internship</h3>
    <div>
        <span>{{ ucfirst(session()->get("username")) }} </span>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
        </form>

    </div>
</div>

<div class="d-flex">
    <!-- SIDEBAR -->
    <div class="sidebar">
        <ul class="list-group list-group-flush">
            <li><a class="nav-link {{ request('status') == 'To Do' ? 'active' : '' }}"
                   href="{{ route('tasks.index', ['status' => 'To Do']) }}">To Do</a></li>
            <li><a class="nav-link {{ request('status') == 'In Progress' ? 'active' : '' }}"
                   href="{{ route('tasks.index', ['status' => 'In Progress']) }}">In Progress</a></li>
            <li><a class="nav-link {{ request('status') == 'On Review' ? 'active' : '' }}"
                   href="{{ route('tasks.index', ['status' => 'On Review']) }}">On Review</a></li>
            <li><a class="nav-link {{ request('status') == 'Approve' ? 'active' : '' }}"
                   href="{{ route('tasks.index', ['status' => 'Approve']) }}">Approve</a></li>
            <li><a class="nav-link {{ request('status') == 'Reject' ? 'active' : '' }}"
                   href="{{ route('tasks.index', ['status' => 'Reject']) }}">Reject</a></li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Daftar Tugas - {{ $status }}</h3>
            @if($status == 'To Do' && session()->get('role') == 'admin')
                <a href="{{ route('tasks.create') }}" class="btn btn-custom">Tambah Tugas</a>
            @endif
        </div>

        @if(session()->get("role") == "admin")
            <form method="GET" action="{{ route('tasks.index') }}">
                <div class="d-flex gap-3 mb-4">
                    <div>
                        <button class="btn btn-custom dropdown-toggle" type="button" id="divisiDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            {{ request('divisi') ? 'Divisi ' . request('divisi') : 'Semua Divisi' }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="divisiDropdown">
                            <li><a class="dropdown-item {{ request('divisi') == '' ? 'active' : '' }}"
                                   href="{{ route('tasks.index', ['status' => $status, 'divisi' => '']) }}">Semua
                                    Divisi</a>
                            </li>
                            <li><a class="dropdown-item {{ request('divisi') == '2' ? 'active' : '' }}"
                                   href="{{ route('tasks.index', ['status' => $status, 'divisi' => '2']) }}">Website
                                    Developer and Administrator</a></li>
                            <li><a class="dropdown-item {{ request('divisi') == '3' ? 'active' : '' }}"
                                   href="{{ route('tasks.index', ['status' => $status, 'divisi' => '3']) }}">Blue
                                    Economy
                                    Kitchen Officer</a></li>
                            <li><a class="dropdown-item {{ request('divisi') == '4' ? 'active' : '' }}"
                                   href="{{ route('tasks.index', ['status' => $status, 'divisi' => '4']) }}">Blue
                                    Economy
                                    Science Officer</a></li>
                            <li><a class="dropdown-item {{ request('divisi') == '5' ? 'active' : '' }}"
                                   href="{{ route('tasks.index', ['status' => $status, 'divisi' => '5']) }}">Administrator
                                    Finance Officer</a></li>
                        </ul>
                    </div>
                </div>
            </form>
        @endif

        <div class="row">
            @foreach($tasks as $task)
                <div class="col-md-4">
                    <div class="card card-task shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5>{{ $task->judul }}</h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $task->deskripsi }}</p>
                            <p><strong>Due:</strong> {{ $task->due_date }}</p>
                            <p><strong>Status:</strong> {{ $task->status }}</p>
                            @if($task->attachment)
                                <a href="{{ asset('storage/' . $task->attachment) }}" target="_blank"
                                   class="btn btn-outline-primary btn-sm">Lihat Lampiran</a>
                            @endif
                        </div>
                        <div class="card-footer d-flex gap-2">
                            @if($status == 'To Do')
                                @if(session()->get('role') == 'admin')
                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                       class="btn btn-outline-primary btn-sm">Edit</a>
                                @else
                                    <a href="{{ route('tasks.do', $task->id) }}" class="btn btn-outline-primary btn-sm">Do</a>
                                @endif
                            @endif

                            @if($status == 'In Progress' && session()->get('role') == 'user')
                                <a href="{{ route('tasks.review', $task->id) }}"
                                   class="btn btn-outline-primary btn-sm">Send To Review</a>
                            @endif

                            @if($status == 'On Review' && session()->get('role') == 'admin')
                                <form action="{{ route('tasks.approve', $task->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
                                <form action="{{ route('tasks.reject', $task->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            @endif

                            @if($status == 'Reject' && session()->get('role') == 'user')
                                <form action="{{ route('tasks.revision', $task->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-warning btn-sm">Revision</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
