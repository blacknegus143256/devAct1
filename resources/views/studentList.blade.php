@extends('base')
@section('title', 'Student Lists')

<div>
    <!-- Display Status Message -->
    @if(session('success'))
    <div class="alert alert-success" id="success">
        {{ Session::get('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger" id="danger">
        {{ Session::get('error') }}
    </div>
    @endif

    <!-- Display Student Lists Table -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;"><strong>Student Lists</strong></h6>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#studentListsModal">
                                Add New Student
                            </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th style="text-align: center;">ID</th>
                                    <th style="text-align: center;">Name</th>
                                    <th style="text-align: center;">Age</th>
                                    <th style="text-align: center;">Gender</th>
                                    <th style="text-align: center;">Edit</th>
                                    <th style="text-align: center;">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>

                                    <td style="text-align: center;">{{ $student->id }}</td>
                                    <td style="text-align: center;">{{ $student->name }}</td>
                                    <td style="text-align: center;">{{ $student->age }}</td>
                                    <td style="text-align: center;">{{ $student->gender }}</td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                                        data-bs-target="#editStudentModal{{ $student->id }}"> UPDATE </button>
                                    </td>
                                    <td style="text-align: center;">
    <form id="delete-form-{{ $student->id }}" action="{{ route('std.delete', $student->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $student->id }})"> DELETE </button>
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
@foreach($students as $student)
    <!-- Modal -->
    <div class="modal fade" id="studentListsModal" tabindex="-1" aria-labelledby="studentListsModalLabel" >
        <div class="modal-dialog">
            <form action="{{ route('std.create') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="studentListsModalLabel">Add New Student</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="stdName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="stdName" name="stdName" value="{{ old('stdName') }}" placeholder="Enter Name">
                            @error('stdName')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stdAge" class="form-label">Age</label>
                            <input type="text" class="form-control" id="stdAge" name="stdAge" value="{{ old('stdAge') }}" placeholder="Enter Age">
                            @error('stdAge')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stdGender" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="stdGender" name="stdGender" value="{{ old('stdGender') }}" placeholder="Enter Gender">
                            @error('stdGender')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editStudentModal{{  $student->id }}" tabindex="-1" aria-labelledby="editStudentModalLabel{{ $student->id }}">
    <div class="modal-dialog">
        <form action="{{ route('std.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit Student</h1>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="stdName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="stdName" value="{{ $student->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="stdAge" class="form-label">Age</label>
                        <input type="text" class="form-control" name="stdAge" value="{{ $student->age }}">
                    </div>
                    <div class="mb-3">
                            <label for="stdGender" class="form-label">Gender</label>
                            <input type="text" class="form-control" name="stdGender" value="{{ $student->gender }}">
                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach