<!-- resources/views/back/pages/campaign/create.blade.php -->
@extends('back.inc.master')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')
    <!-- <div class="modal fade" id="addCampaignModal" tabindex="-1" role="dialog" aria-labelledby="addCampaignModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCampaignModalLabel">Add Goals</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add the form for adding the campaign here -->
                    <!-- <form action="{{ route('admin.savegoals') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">People to contact Per Day</label>
                            <input type="text" name="contact_people" id="contact_people" class="form-control numeric" value="" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Goal</button>
                    </form> -->
                <!-- </div>
                
            </div>
        </div>
    </div> --> -->
    <div class="card-header bg-soft-dark mt-5">
                            All Data
                            @if(auth()->user()->can('administrator'))
                            <a href="{{route('admin.create.goals')}}"class="btn btn-outline-primary btn-sm float-right" title="New" ><i class="fas fa-plus-circle"></i></a>
                            @endif
                        </div>
    <div class="card-body mt-5">
                            <table class="table table-striped table-bordered" id="datatable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Attribute</th>
                                    <th scope="col">Goal set</th>
                                    <th scope="col">User id</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($goal as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->attribute_id }}</td>
                                        <td>{{ $data->goals }}</td>
                                        <td>{{ $data->user_id }}</td>
                                        <td> @if(auth()->user()->can('administrator'))
                                        <a href="{{route('admin.edit.goals', $data->id)}}" class="btn btn-outline-primary btn-sm" title="Edit  User" ><i class="fas fa-edit"></i></a> -
                                        @endif
                                        @if(auth()->user()->can('administrator'))
                                        <a href="{{route('admin.delete.goals', $data->id)}}" class="btn btn-outline-danger btn-sm"
                                        title="Remove" onclick="event.preventDefault(); confirmDelete({{ $data->id }});">
                                        <i class="fas fa-times-circle"></i>
                                        </a>
                                        <form id="delete-form-{{ $data->id }}" action="{{ route('admin.delete.goals', $data->id) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        @endif</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
    <!-- Add any required scripts for the popup here -->
    @section('scripts')
    <!-- <script>
        $(window).on('load', function() {
        $('#addCampaignModal').modal('show');
    });
            // $("#addCampaignModal").show();
        $(document).on("input", ".numeric", function (e) {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    });

    </script> -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script >
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );
        function confirmDelete(roleId) {
        if (confirm('Are you sure you want to delete this record?')) {
            document.getElementById('delete-form-' + roleId).submit();
        }
    }
</script>
<script >

</script>
    @endsection

@endsection
