@extends('index')

@section('title', 'Manage Armada')

@section('content')




<div class="card">
    <div class="card-body">
        <!-- title -->
        <div class="d-md-flex">
            <div>
                <h4 class="card-title">Armada</h4>
                <a href="{{ route('admin.armadas.create') }}" class="btn btn-primary mb-3">Tambah Armada</a>
            </div>

        </div>
        <!-- title -->
        <div class="table-responsive">
            <table class="table mb-0 table-hover align-middle text-nowrap">
                <thead>
                    <tr>
                        <th class="border-top-0">Nama</th>
                        <th class="border-top-0">Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($armadas as $armada)
                    <tr>
                        <td>{{ $armada->name }}</td>
                        <td>
                            <a href="{{ route('admin.armadas.edit', $armada->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.armadas.destroy', $armada->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection