@extends('layouts.template')

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
</head>

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-warning text-white">
                        <h1 class="card-title mb-0 text-dark">Data Ministry</h1>
                    </div>
                    <div class="card-body">
                        <script>
                            @if (session('success'))
                                Swal.fire({
                                    title: 'Success!',
                                    text: '{{ session('success') }}',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            @endif
                        </script>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                New Record <i class="bi bi-plus-circle-fill"></i>
                            </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning text-white">
                                        <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">New Record Data</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('store') }}" method="post">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <label for="title" class="col-form-label">Title</label>
                                                <input type="text" class="form-control" id="title" name="title">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-warning">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="example" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%;"></th>
                                        <th scope="col" style="width: 25%;">Deskripsi</th>
                                        <th scope="col" style="width: 10%;">Count</th>
                                        <th scope="col" style="width: 20%;">Hari/Tanggal</th>
                                        <th scope="col" style="width: 20%;">Pukul</th>
                                        <th scope="col" style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row['title'] }}</td>
                                            <td>{{ $row['count'] }}</td>
                                            <td>{{ $row['created_at_formatted'] }}</td>
                                            <td>{{ $row['created_at_time'] }} WIB</td>
                                            <td>
                                                <form method="POST" action="/update/{{ $row['id'] }}"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success mb-1 mb-md-0 mr-1"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                </form>
                                                <form id="delete-form-{{ $row['id'] }}"
                                                    action="{{ route('delete', ['id' => $row['id']]) }}" method="post"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger mb-1 mb-md-0"
                                                        onclick="confirmDelete({{ $row['id'] }})"><i
                                                            class="bi bi-trash-fill"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- SweetAlert Script -->
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

    <script>
        new DataTable('#example');
    </script>
@endsection
