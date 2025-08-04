<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Transfers</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container my-5">

        <div class="row mb-4">
            @foreach ($statusCounts as $status => $count)
                <div class="col-md-3 mb-2">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-uppercase">{{ $status }}</h6>
                            <h4 class="text-primary">{{ $count }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ✅ DataTable -->
        <div class="card shadow-sm">

            <div class="card-body">
                <table id="transfersTable" class="table table-striped table-bordered w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Creator</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#transfersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('stock_transfers.index') }}',
                columns: [{
                        data: 'id',
                        name: 'id',
                        title: 'ID'
                    },
                    {
                        data: 'from',
                        name: 'warehouseFrom.name'
                    },
                    {
                        data: 'to',
                        name: 'warehouseTo.name'
                    },
                    {
                        data: 'creator',
                        name: 'creator.name'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ],
                order: [
                    [0, 'desc']
                ]
            });
        });
    </script>

</body>

</html>
