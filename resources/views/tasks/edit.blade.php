<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        .btn-custom {
            background-color: #0077be;
            color: white;
        }

        .btn-custom:hover {
            background-color: #005fa3;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-back {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="header">
        <h2>Edit Tugas</h2>
        <p>Perbarui informasi tugas di bawah ini.</p>
    </div>

    <!-- Form Edit Tugas -->
    <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" id="judul" name="judul" value="{{$task->judul}}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4"
                      required>{{$task->deskripsi}}</textarea>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Tanggal Jatuh Tempo</label>
            <input type="date" id="due_date" name="due_date" value="{{$task->due_date}}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="attachment" class="form-label">Lampiran</label>
            <input type="file" id="attachment" name="attachment" class="form-control">
            @if($task->attachment)
                <small class="text-muted">Lampiran saat ini: <a href="{{ asset('storage/' . $task->attachment) }}"
                                                                target="_blank">Lihat</a></small>
            @endif
        </div>

        <div class="mb-3">
            <label for="divisi" class="form-label">Divisi</label>
            <select id="divisi" name="divisi" class="form-select">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $task->divisi == $user->id ? 'selected' : '' }}>
                        {{ $user->divisi }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Simpan -->
        <div class="mt-3">
            <button style="margin:5px;" type="submit" class="btn btn-custom">Simpan Perubahan</button>
        </div>
    </form>

    <div style="display:flex; justify-content:flex-end" ;>
        <!-- Tombol Hapus Tugas -->
        <div class="mt-3">
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                @csrf
                @method('DELETE')
                <button style="margin:5px;" type="submit" class="btn btn-danger">Hapus Tugas</button>
            </form>
        </div>
        <!-- Tombol Kembali -->
        <div class="mt-3">
            <a style="margin:5px;" href="{{ url()->previous() }}" class="btn btn-secondary btn-back">&#8592; Kembali</a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
