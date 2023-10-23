@extends('back.inc.master')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-o9b12nEp6qOBHnpd3b05NUOBtJ9osd/Jfnvs59GpTcf6bd3NUGw+XtfPpCUVHsWqvyd2uuOVxOwXaVRoO2s2KQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <h4 class="mb-0 font-size-18">Scraping Requests</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Scraping Requests</li>
                                <li class="breadcrumb-item active">Requests</li>
                            </ol>
                        </div>
                    </div>
                    @include('back.pages.partials.messages')
                    <div class="card">
                        <div class="card-header bg-soft-dark ">
                            All Requests
                            @if (auth()->user()->can('administrator') ||
                                    auth()->user()->can('scraping_create'))
                            @endif
                            {{-- <button class="btn btn-outline-primary btn-sm float-right mr-2" title="helpModal" data-toggle="modal"
                        data-target="#helpModal">How to Use</button>   --}}
                            @include('components.modalform')
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Job Name</th>
                                        <th scope="col">State</th>
                                        <th scope="col">Price Range</th>
                                        <th scope="col">Property Type</th>
                                        <th scope="col">Beds</th>
                                        <th scope="col">Baths</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">File</th>
                                        <th scope="col">Upload</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($scrapingdata as $data)
                                        <tr>
                                            <td>{{ $data->job_name }}</td>
                                            <td>{{ $data->state }}</td>
                                            <td>{{ $data->formatted_price_range }}</td>
                                            <td>
                                                @php
                                                    $propertyTypes = explode(', ', $data->property_type);
                                                @endphp

                                                @foreach ($propertyTypes as $property)
                                                    <span class="badge badge-info">{{ trim($property) }}</span>
                                                    @unless ($loop->last)
                                                        ,
                                                    @endunless
                                                @endforeach
                                            </td>

                                            <td>{{ $data->no_of_bedrooms }}</td>
                                            <td>{{ $data->no_of_bathrooms }}</td>
                                            <td>
                                                @if ($data->status == 0)
                                                    <span>
                                                        <i class="fas fa-spinner fa-spin text-warning"></i> In-Process
                                                    </span>
                                                @else
                                                    <span
                                                        style="border-radius: 6px; padding: 5px; background-color: transparent;">
                                                        <i class="fa fa-check-circle"></i> Data Ready
                                                    </span>
                                                @endif
                                            </td>


                                            <td>
                                                @if ($data->hasMedia('scraping_requests'))
                                                    @php
                                                        $media = $data->getFirstMedia('scraping_requests');
                                                    @endphp
                                                    @if ($media)
                                                        <a href="{{ $media->getUrl() }}" download target="_blank">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-download"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M7.293 1.293a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L8 4.414V11a1 1 0 11-2 0V4.414L2.293 6.707a1 1 0 01-1.414-1.414l4-4z" />
                                                                <path fill-rule="evenodd"
                                                                    d="M7 0a1 1 0 011 1v10a1 1 0 11-2 0V1a1 1 0 011-1z" />
                                                            </svg>
                                                            Download
                                                        </a>
                                                    @endif
                                                @else
                                                    No File
                                                @endif
                                            </td>

                                            <td>
                                                <form method="POST"
                                                    action="{{ route('admin.scraping.upload', $data->id) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="input-group input-group-sm">
                                                        <!-- Add input-group-sm to make it smaller -->
                                                        <div class="custom-file" style="width: 150px;">
                                                            <!-- Adjust the width as needed -->
                                                            <input type="file" class="custom-file-input"
                                                                id="excelFileInput" name="excel_file" accept=".xlsx, .xls">
                                                            <label class="custom-file-label" for="excelFileInput">Choose
                                                                file</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                                                <i class="fas fa-upload"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>

                                            <td>
                                                @if (auth()->user()->can('administrator') ||
                                                        auth()->user()->can('scraping_edit'))
                                                    <a href="{{ route('admin.scraping.edit', $data->id) }}"
                                                        class="btn btn-outline-primary btn-sm" title="Edit  User"><i
                                                            class="fas fa-edit"></i></a> -
                                                @endif
                                                @if (auth()->user()->can('administrator') ||
                                                        auth()->user()->can('scraping_delete'))
                                                    <a href="{{ route('admin.scraping.destroy', $data->id) }}"
                                                        class="btn btn-outline-danger btn-sm" title="Remove"
                                                        onclick="event.preventDefault(); confirmDelete({{ $data->id }});">
                                                        <i class="fas fa-times-circle"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $data->id }}"
                                                        action="{{ route('admin.scraping.destroy', $data->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });

        function confirmDelete(roleId) {
            if (confirm('Are you sure you want to delete this record?')) {
                document.getElementById('delete-form-' + roleId).submit();
            }
        }
    </script>
    <script></script>
@endsection
