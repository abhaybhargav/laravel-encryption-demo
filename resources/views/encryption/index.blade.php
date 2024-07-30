<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Encryption Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Laravel Encryption Lab</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('encryption.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="sensitive_data" class="form-label">Sensitive Data</label>
                <input type="text" class="form-control" id="sensitive_data" name="sensitive_data" required>
            </div>
            <div class="mb-3">
                <label for="mode" class="form-label">Encryption Mode</label>
                <select class="form-select" id="mode" name="mode" required>
                    <option value="secure">Secure</option>
                    <option value="insecure">Insecure</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Encrypt and Store</button>
        </form>

        <h2 class="mb-3">Stored Encrypted Data</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Encrypted Data</th>
                    <th>Mode</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->encrypted_data }}</td>
                        <td>{{ $item->mode }}</td>
                        <td>
                            <button class="btn btn-sm btn-info decrypt-btn" data-id="{{ $item->id }}">Decrypt</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.decrypt-btn').click(function() {
                var id = $(this).data('id');
                $.get('/decrypt/' + id, function(data) {
                    alert('Decrypted data: ' + data.decrypted_data);
                });
            });
        });
    </script>
</body>
</html>