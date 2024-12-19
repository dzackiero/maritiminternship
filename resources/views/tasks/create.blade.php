<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Tambah Tugas Baru</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Tanggal Jatuh Tempo</label>
                                <input type="date" name="due_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="attachment" class="form-label">Lampiran</label>
                                <input type="file" name="attachment" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="divisi" class="form-label">Divisi</label>
                                <select name="divisi" class="form-control" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->divisi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex" style="justify-content: flex-end;">
                                <button style="margin:5px;" type="button" class="btn btn-secondary" onclick="history.back()">Back</button>
                                <button style="margin:5px;" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
