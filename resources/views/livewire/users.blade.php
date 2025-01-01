<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* تحسين تنسيق الجدول */
        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
            padding: 15px;
        }

        .table thead {
            background-color: #f0f0f0;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }
    </style>

@livewireStyles
        <link rel="stylesheet"
            href="{{ mix('css/app.css') }}">
</head>

<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Import Users from Excel</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('import.users') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload Excel File:</label>
                        <input type="file" name="file" id="file" class="form-control" accept=".xlsx, .xls" required>
                        @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Import</button>
                </form>

            </div>
        </div>

        @if (session('done'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Toastify({
                    text: "{{ session('done') }}",
                    className: "info",
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    }
                }).showToast();
            });
        </script>
        @endif

        @if($users->count() > 0)
        <div class="card mt-4">
            <input wire:model='search' type="search" class="form-control mb-3" placeholder="Search users by name or email" />
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">Imported Users</h4>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0" style="background-color: #f9f9f9;">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
        @else
        <div class="alert alert-info mt-4">
            No users imported yet.
        </div>
        @endif
    </div>

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
