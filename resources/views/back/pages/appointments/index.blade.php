<!-- resources/views/back/pages/campaign/index.blade.php -->

@extends('back.inc.master')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Ensure the table takes the full width of its container */
        .table-responsive {
            overflow-x: auto;
        }

        /* Add horizontal scrolling for the table on smaller screens */
        /* .table {
                white-space: nowrap;
            } */

        /* Add responsive breakpoints and adjust table font size and padding as needed */
        @media (max-width: 768px) {
            .table {
                font-size: 12px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">All Appointments</h4>

                    </div>
                    <div class="card">
                        <div class="card-header bg-soft-dark">
                            All Appointments
                            {{-- <button class="btn btn-outline-primary btn-sm float-right ml-2"
                                title="New" data-toggle="modal" data-target=""><i
                                    class="fas fa-plus-circle"></i></button> --}}
                                    {{-- <button class="btn btn-outline-primary btn-sm float-right" style="margin-right: 5px" title="helpModal" data-toggle="modal" data-target="#helpModal">How to Use</button> --}}
                                    @include('components.modalform')
                            <a href="{{ url('appointment', [encrypt(Auth::id())]) }}"
                            target="_blank"style="margin-right: 5px" class="btn btn-outline-primary btn-sm float-right mr-2"
                            title="appointments">Booking Link</a>

                            <button class="btn btn-outline-primary btn-sm float-right mr-2"
                                id="copyButton" title="Embed Code" data-toggle="modal" data-target="">Copy Embed Code</button>
                            {{-- <button id="copyButton">Copy Embed Code</button> --}}
                                <textarea id="embedCode" rows="4" cols="50" style="display: none">
                                    <iframe src='https://app.reifuze.com/appointment/embeded-code' frameborder='0' width='100%' height='400'>Embed Booking Link</iframe>
                                </textarea>



                            {{-- <button class="btn btn-outline-primary btn-sm float-right mr-2" style="margin-right: 5px"title="helpModal" data-toggle="modal"
                        data-target="#helpModal">How to Use</button>   --}}

                        </div>
                        <div class="card-body">
                            @if ($appointments->isEmpty())
                                <p>No Appointments Booked.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Mobile</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Reminder</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($appointments as $appt)
                                                <tr>
                                                    <td>{{ $appt->name }}</td>
                                                    <td>{{ $appt->email }}</td>
                                                    <td>{{ $appt->mobile }}</td>
                                                    <td>{{ date('m-d-Y', strtotime($appt->appt_date)) }}</td>
                                                    <td>{{ date('H:i', strtotime($appt->appt_time)) }}</td>
                                                    <td>{{ $appt->status }}</td>
                                                    <td><a href="/manage-appointments/{{ $appt->id }}/reminder"><i class="fa fa-bell"></i></a></td>

                                                    <td>
                                                        <button class="btn btn-danger" title="Remove {{ $appt->name }}"
                                                            data-id="{{ $appt->id }}" data-toggle="modal"
                                                            data-target="#deleteModal">Cancel</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div> <!-- container-fluid -->
    </div>

    {{-- Modal Add on 31-08-2023 --}}
    <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">How to Use</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div style="position:relative;height:0;width:100%;padding-bottom:65.5%">
                        <iframe src="" frameBorder="0"
                            style="position:absolute;width:100%;height:100%;border-radius:6px;left:0;top:0"
                            allowfullscreen="" allow="autoplay">
                        </iframe>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Video Url</label>
                            <input type="url" class="form-control" placeholder="Enter link" name="video_url"
                                value="" id="video_url">
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal on 31-08-2023 --}}

    <!-- Add Campaign Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Campaign</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- For example, you can use Laravel Collective's Form or standard HTML form -->
                    <!-- Add the form for adding the campaign here -->
                    <form action="{{ route('admin.campaigns.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Campaign Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>


                        <div class="form-group">
                            <label for="active">Active Status</label>
                            <select name="active" id="active" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Campaign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Campaign Modal -->
    <div class="modal fade" id="editCampaignModal" tabindex="-1" role="dialog"
        aria-labelledby="editCampaignModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCampaignModalLabel">Edit Campaign</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @isset($campaign)
                        <!-- Add the form for editing the campaign here -->
                        <form action="{{ route('admin.campaigns.update', $campaign->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Campaign Name</label>
                                <input type="hidden" name="id" id="id_edit" class="form-control" value="0"
                                    required>
                                <input type="text" name="name" id="name_edit" class="form-control" value=""
                                    required>
                            </div>


                            <!-- Add other fields for campaign details -->
                            <!-- For example, schedule, message content, etc. -->
                            <div class="form-group">
                                <label for="active">Active Status</label>
                                <select name="active" id="active" class="form-control" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Campaign</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Delete --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cancel Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post" id="editForm">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <div class="modal-body">
                                <p class="text-center">
                                    Are you sure you want to cancel this Appointment?
                                </p>
                                <input type="hidden" id="id" name="id" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            function share(lnk) {
                var lnnk = lnk;
                window.location.href = lnnk;
            }

            function getTemplate(type) {
                var url = '<?php echo url('/admin/get/template/'); ?>/' + type;
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: '',
                    processData: false,
                    contentType: false,
                    success: function(d) {
                        $('#update-templates').html(d);
                    }
                });
            }


            $('#editCampaignModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var name = button.data('name');
                var type = button.data('type');
                var template_id = button.data('template');
                getTemplateEdit(type, template_id);
                var id = button.data('id');
                var sendafterdays = button.data('sendafterdays');
                var sendafterhours = button.data('sendafterhours');
                var group_id = button.data('group');
                var modal = $(this);

                $('#name_edit').val(name);
                $('#id_edit').val(id);
                $('#type_edit').val(type);
                $('#send_after_days_edit').val(sendafterdays);
                $('#send_after_hours_edit').val(sendafterhours);
                $('#group_id_edit').val(group_id);
            });

            function getTemplateEdit(type, template_id) {
                var url = '<?php echo url('/admin/get/template/'); ?>/' + type;
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: '',
                    processData: false,
                    contentType: false,
                    success: function(d) {
                        $('#update-templates-edit').html(d);
                        setTimeout(function() {
                            $('#template-select-edit').val(template_id);
                        }, 500);

                    }
                });
            }
            $(document).ready(function() {
                $('#deleteModal').on('show.bs.modal', function(event) {
                    //var button = $(event.relatedTarget);
                    // var id = button.data('id');
                    // var modal = $(this);
                    //modal.find('.modal-body #id').val(id);
                });
            });
        </script>
        {{-- <script>
            const copyButton = document.getElementById('copyButton');
            const embedCode = document.getElementById('embedCode');
            copyButton.addEventListener('click', () => {
                embedCode.select();
               document.execCommand('copy');
              copyButton.textContent = 'Code Copied!';
              setTimeout(() => {
                copyButton.textContent = 'Copy Embed Code';
              }, 2000); // Reset button text after 2 seconds

            });
          </script> --}}
          <script>
            const copyButton = document.getElementById('copyButton');
            const embedCode = document.getElementById('embedCode');

            copyButton.addEventListener('click', () => {
                // Create a temporary textarea element
                const tempTextarea = document.createElement('textarea');
                tempTextarea.value = embedCode.value;
                document.body.appendChild(tempTextarea);
                tempTextarea.select();
                document.execCommand('copy');
                document.body.removeChild(tempTextarea);
                copyButton.textContent = 'Code Copied!';
                setTimeout(() => {
                    copyButton.textContent = 'Copy Embed Code';
                }, 2000); // Reset button text after 2 seconds
            });
        </script>
    @endsection
