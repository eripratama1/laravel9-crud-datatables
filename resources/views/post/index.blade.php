@extends('layouts.app')

@section('style-css')
    
    {{-- Inisiasi cdn CSS bootstrap dan Datatables --}}
            
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">List Post's
                        <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm float-end">Create</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-bordered" id="dataCategory">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Kategori</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <form action="" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Hapus" style="display: none">
                </form>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    {{-- Inisiasi jquery serta jquery datatable dan juga bootstrap --}}

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    {{-- Inisiasi jquery serta jquery datatable dan juga bootstrap
        lalu menambahkan function DataTable dan me-rendernya secara serverside --}}

    <script>
        $(function() {
            $('#dataCategory').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: true,
                autoWidth: true,
                ajax: '{{ route('data-posts') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'image'
                    },
                    {
                        data: 'category'
                    },
                    {
                        data: 'action'
                    }
                ]
            })
        })
    </script>
@endpush
