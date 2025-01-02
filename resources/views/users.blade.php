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
        @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Toastify({
                    text: "{{ session('error') }}",
                    className: "info",
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    }
                }).showToast();
            });
        </script>
        @endif
        @if (session('secondError'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Toastify({
                    text: "{{ session('secondError') }}",
                    className: "info",
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    }
                }).showToast();
            });
        </script>
        @endif

        <livewire:showusers />
    </div>


    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    @livewireScripts
</body>

</html>
