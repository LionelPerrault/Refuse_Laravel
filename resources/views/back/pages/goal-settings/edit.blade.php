@extends('back.inc.master')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
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
                        <h4 class="mb-0 font-size-18">Data Management</h4>
                       
                    </div>
                    <div class="card">
                        <div class="card-header bg-soft-dark ">
                            Create Goal
                            <a href="{{ URL::previous() }}" class="btn btn-outline-primary btn-sm float-right"
                                title="New"><i class="fas fa-arrow-left"></i></a>
                            @include('components.modalform')
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.update.goals', $goal->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- CSRF Token -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="goal">Goal</label>
                                        <input type="text" class="form-control @error('country') is-invalid @enderror"
                                            id="goal" name="goal" value="{{ $goal->goals }}">
                                        @error('goal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="money_per_month">How much money do you want to make per month?</label>
                                        <input type="number"
                                            class="form-control @error('money_per_month') is-invalid @enderror"
                                            value="{{ $goal->money_per_month }}" id="money_per_month" name="money_per_month"
                                            placeholder="10000" step="any">
                                        @error('money_per_month')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gross_profit">What is your average gross profit per deal?</label>
                                        <input type="number"
                                            class="form-control @error('gross_profit') is-invalid @enderror"
                                            id="gross_profit" value="{{ $goal->gross_profit }}" name="gross_profit"
                                            placeholder="1000" step="any">
                                        @error('gross_profit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_trun_into_lead">What percentage of the people you contact turn
                                            into leads? (Average is 1.5%)</label>
                                        <input type="number"
                                            class="form-control @error('contact_trun_into_lead') is-invalid @enderror"
                                            value="{{ $goal->contact_trun_into_lead }}" id="contact_trun_into_lead"
                                            step="any" name="contact_trun_into_lead" placeholder="10">
                                        @error('contact_trun_into_lead')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="leads_into_phone">What percentage of your leads are you able to get on
                                            the phone? (Average is 50%)</label>
                                        <input type="number"
                                            class="form-control @error('leads_into_phone') is-invalid @enderror"
                                            value="{{ $goal->leads_into_phone }}" id="leads_into_phone" step="any"
                                            name="leads_into_phone" placeholder="10">
                                        @error('leads_into_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="signed_agreements">Of the people you talk to on the phone, what
                                            percentage will you get a signed purchase agreement from? (Average is
                                            10%)</label>
                                        <input type="number"
                                            class="form-control @error('signed_agreements') is-invalid @enderror"
                                            value="{{ $goal->signed_agreements }}" id="signed_agreements" step="any"
                                            name="signed_agreements" step="any" placeholder="10%">
                                        @error('signed_agreements')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="escrow_closure">Of the signed contracts you get back, what percentage
                                            close escrow? (Average is 80%)</label>
                                        <input type="number"
                                            class="form-control @error('escrow_closure') is-invalid @enderror"
                                            value="{{ $goal->escrow_closure }}" id="escrow_closure" step="any"
                                            name="escrow_closure" step="any" placeholder="80%">
                                        @error('escrow_closure')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="passed_inspection">Passed Inspection </label>
                                        <input type="number"
                                            class="form-control @error('passed_inspection') is-invalid @enderror"
                                            id="passed_inspection" value="{{ $goal->passed_inspection }}" step="any"
                                            name="passed_inspection" step="any" placeholder="">
                                        @error('passed_inspection')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="passed_title_search">Passed Title Search </label>
                                        <input type="number"
                                            class="form-control @error('passed_title_search') is-invalid @enderror"
                                            id="passed_title_search" value="{{ $goal->passed_title_search }}"
                                            step="any" name="passed_title_search" step="any" placeholder="">
                                        @error('passed_title_search')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deal_closed">Deal Closed</label>
                                        <input type="number"
                                            class="form-control @error('deal_closed') is-invalid @enderror"
                                            id="deal_closed" value="{{ $goal->deal_closed }}" step="any"
                                            name="deal_closed" step="any" placeholder="5">
                                        @error('deal_closed')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="attribute">Attribute</label>
                                        <select class="form-control @error('attribute') is-invalid @enderror"
                                            id="attribute" name="attribute">
                                            <option value="{{ $goal->attribute_id }}" selected>
                                                {{ $goal->goal_attribute['attribute'] }}
                                            </option>
                                            @foreach ($attributes as $data)
                                                <option value="{{ $data->id }}">{{ $data->attribute }}</option>
                                            @endforeach
                                        </select>
                                        @error('attribute')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="user">User</label>
                                        <select class="form-control @error('user') is-invalid @enderror" id="user"
                                            name="user">
                                            <option value="">Select User</option>
                                            <option value="{{ $goal->user_id }}" selected>
                                                {{ $goal->user['name'] }}
                                            </option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">

                                </div>
                                <button type="submit" class="btn btn-primary">Add Data</button>
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
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
            $('select').select2();

        });
    </script>
    <script></script>
@endsection
