@extends('back.inc.master')
@section('styles')
@endsection
@section('content')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Zoom Meeting Management</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item">Zoom Meeting  Management</li>
                                <li class="breadcrumb-item active">Zoom Meeting</li>
                            </ol>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-soft-dark ">
                            Create Zoom Meeting
                            <a href="{{URL::previous()}}" class="btn btn-outline-primary btn-sm float-right" title="New" ><i class="fas fa-arrow-left"></i></a>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.zoom.store') }}" enctype="multipart/form-data">
                                @csrf <!-- CSRF Token -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meeting_name">Meeting Topic <strong style="color:red;">*</strong></label>
                                        <input type="text" class="form-control @error('meeting_name') is-invalid @enderror" id="meeting_name" name="meeting_name" autocomplete="off" aria-autocomplete="none" value="{{ old('meeting_name') }}"  >
                                        @error('meeting_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meeting_password">Meeting Password <strong style="color:red;">*</strong></label>
                                        <input type="password" class="form-control @error('meeting_password') is-invalid @enderror" id="meeting_password" autocomplete="off" aria-autocomplete="none" name="meeting_password"> <i class="fas fa-eye d-flex justify-content-end align-items-end" style="margin-top: -22px;
    margin-right: 12px;" onclick="ShowHidePassword();"></i>
                                        @error('meeting_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meeting_date_timezone">Select Timezone <strong style="color:red;">*</strong></label>
                                        <select name="meeting_date_timezone" id="meeting_date_timezone" class="form-control" required>
    <option value="">Select</option>
                                        @foreach($timezones as $id => $timezones)
                                        <option value="{{ $id }}">{{ $timezones->time_zone }}</option>
                                        @endforeach
                                    </select>
                                        @error('meeting_date_timezone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meeting_date">Meeting Date Time <strong style="color:red;">*</strong></label>
                                        <input type="text" class="form-control @error('meeting_date') is-invalid @enderror" id="meeting_date" name="meeting_date" value="{{ old('meeting_date') }}"  >
                                        @error('meeting_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="duration_minute">Meeting Duration (Minutes) <strong style="color:red;">*</strong></label>
                                        <input type="tel" class="form-control @error('duration_minute') is-invalid @enderror" id="duration_minute" name="duration_minute" value="{{ old('duration_minute') }}"  >
                                        @error('start_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="host_video">Host Video</label>
                                        <select name="host_video" id="host_video" class="form-control" required>
                                <option value="">Select</option>
                                <option value="0">Enable</option>
                                <option value="1">Disable</option>
                            </select>
                                        @error('host_video')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="host_video">Participant Video</label>
                                        <select name="client_video" id="client_video" class="form-control" required>
                                <option value="">Select</option>
                                <option value="0">Enable</option>
                                <option value="1">Disable</option>
                            </select>
                                        @error('client_video')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meeting_status">Status <strong style="color:red;">*</strong></label>
                                        <select name="meeting_status" id="meeting_status" class="form-control" required>
                                <option value="">Select</option>
                                <option value="0">Awaited</option>
                                <option value="1">Finished</option>
                                <option value="2">Cancelled</option>
                            </select>
                                        @error('meeting_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meeting_note">Meeting Agenda</label>
                                        <textarea class="form-control @error('meeting_note') is-invalid @enderror" id="meeting_note" name="meeting_note" value="">{{ old('meeting_note') }}</textarea>
                                        @error('meeting_note')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                               





                                <div class="col-md-6 d-flex justify-content-end align-items-end">
                                    <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create Meeting</button>
</div>
</div>
</div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @endsection
@section('scripts')
<!-- jQuery CDN -->
<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <!-- CSS CDN -->
    <link rel="stylesheet"
          href=
"https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"
    />
    <!-- datetimepicker jQuery CDN -->
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
   </script>
 <script>
  
  function ShowHidePassword() {
  var x = document.getElementById("meeting_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}   
 $("#meeting_date").datetimepicker({
  format: 'Y-m-d H:i',
  minDate: 0
});
    </script>
@endsection