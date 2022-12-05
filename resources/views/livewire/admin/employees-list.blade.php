<div>
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Employees</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Employees</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
        {{-- Boxes --}}
        <div class="row">
            <div class="col-lg-4 col-4">
                <div class="small-box bg-success">
                <div class="inner">
                    <h3> {{ count($employees) }} </h3>
                    <p>All Employees</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-4">
                <div class="small-box bg-info">
                <div class="inner">
                    <h3> {{ count($employees) }} </h3>

                    <p>Active Employees</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-4">
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3> {{ count($employees) }} </h3>

                    <p>Inactive Employees</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                </div>
            </div>
        </div>
        {{-- Main --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-end">
                            <button wire:click.prevent="show_new_employer_form" class="btn btn-primary">
                                <i class="fa fa-plus-circle mr-2"></i> Add New Employer
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">National number</th>
                                <th scope="col">Full name</th>
                                <th scope="col">Birth date</th>
                                <th scope="col">Start date</th>
                                <th scope="col">Phone number</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ @$employee->id }}</td>
                                        <td>{{ @$employee->nationalnumber }}</td>
                                        <td>{{ @$employee->fullname }}</td>
                                        <td>{{ @$employee->birthdate }}</td>
                                        <td>{{ @$employee->startdate }}</td>
                                        <td>+963-{{ @$employee->phonenumber }}</td>
                                        <td>
                                            <a wire:click.prevent="show_edit_employer_form( {{ $employee }} )" href=""><i class="fa fa-edit mr-2"></i></a>
                                            <a wire:click.prevent="{{-- EDIT HERE --}}" href=""><i class="fa-solid fa-link-slash text-warning mr-2"></i></a>
                                            <a wire:click.prevent="show_conformation_model( {{ $employee->id }} )" href=""><i class="fa fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer d-flex justify-content-centerid">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    {{-- Employer form --}}
    <div wire:ignore.self class="modal fade" id="employer-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <form wire:submit.prevent="{{ $showEditEmployerForm ? 'edit_employer' : 'new_employer' }}" autocomplete="off">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                @if ($showEditEmployerForm)
                    <span>Edit employer</span>
                @else
                    <span>Add new employer</span>
                @endif
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="id">ID</label>
                        {{-- <input wire:model.defer="perInfo.id" type="text" class="form-control @error('id') is-invalid @enderror" id="id" placeholder="Automatically generate" disabled> --}}
                        <input wire:model.defer="perInfo.id" type="text" class="form-control @error('id') is-invalid @enderror" id="id" placeholder="Enter Employee Code">
                        @error('id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-9">
                        <label for="fullname">Full name</label>
                        <input wire:model.defer="perInfo.fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" placeholder="" disabled>
                        @error('fullname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="firstname">First name</label>
                        <input wire:model.defer="perInfo.firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" placeholder="Enter first name">
                        @error('firstname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fathername">Father name</label>
                        <input wire:model.defer="perInfo.fathername" type="text" class="form-control @error('fathername') is-invalid @enderror" id="fathername" placeholder="Enter father name">
                        @error('fathername')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="lastname">Last name</label>
                        <input wire:model.defer="perInfo.lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" placeholder="Enter last name">
                        @error('lastname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="mothername">Mother name</label>
                        <input wire:model.defer="perInfo.mothername" type="text" class="form-control @error('mothername') is-invalid @enderror" id="mothername" placeholder="Enter mother name">
                        @error('mothername')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="nationalnumber">National Number</label>
                        <input wire:model.defer="perInfo.nationalnumber" type="text" class="form-control @error('nationalnumber') is-invalid @enderror" id="nationalnumber" placeholder="02000000000">
                        @error('nationalnumber')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div><div class="form-group col-md-3">
                        <label for="phonenumber">Phone Number</label>
                        <input wire:model.defer="perInfo.phonenumber" type="text" class="form-control @error('phonenumber') is-invalid @enderror" id="phonenumber" placeholder="0900000000">
                        @error('phonenumber')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- <div class="form-group col-md-3">
                        <label for="birthdate">Birth date</label>
                        <div class="input-group date" id="birthdate" data-target-input="nearest">
                            <input wire:model.defer="perInfo.birthdate" type="text" class="form-control @error('birthdate') is-invalid @enderror datetimepicker-input" id="birthdate" data-target="#birthdate" placeholder="YYYY-MM-DD"/>
                            <div class="input-group-append" data-target="#birthdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            @error('birthdate')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="form-group col-md-3">
                        <label for="birthdate">Birth date</label>
                        <input wire:model.defer="perInfo.birthdate" type="text" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" placeholder="YYYY-MM-DD">
                        @error('birthdate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="startdate">Start date</label>
                        <input wire:model.defer="perInfo.startdate" type="text" class="form-control @error('startdate') is-invalid @enderror" id="startdate" placeholder="YYYY-MM-DD">
                        @error('startdate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="gender">Gender</label>
                        <select wire:model.defer="perInfo.gender" class="custom-select rounded-0 @error('gender') is-invalid @enderror" id="gender">
                            <option selected>Choose Gender:</option>
                            <option value="1"> Male </option>
                            <option value="0"> Female </option>
                        </select>
                          @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="positionid">Position</label>
                        <select wire:model.defer="perInfo.positionid" class="custom-select rounded-0 @error('positionid') is-invalid @enderror" id="positionid">
                            <option selected>Choose Position:</option>
                            @foreach ($positions as $position)
                                <option value="{{ @$position->id }}">{{ @$position->positionname }}</option>
                            @endforeach
                        </select>
                          @error('positionid')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="departmentid">Department</label>
                        <select wire:model.defer="perInfo.departmentid" class="custom-select rounded-0 @error('departmentid') is-invalid @enderror" id="departmentid">
                            <option selected>Choose Department:</option>
                            @foreach ($departments as $department)
                                <option value="{{ @$department->id }}">{{ @$department->departmentname }}</option>
                            @endforeach
                        </select>
                          @error('departmentid')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="centerid">Center</label>
                        <select wire:model.defer="perInfo.centerid" class="custom-select rounded-0 @error('centerid') is-invalid @enderror" id="centerid">
                            <option selected>Choose Center:</option>
                            @foreach ($centers as $center)
                                <option value="{{ @$center->id }}">{{ @$center->centername }}</option>
                            @endforeach
                        </select>
                          @error('centerid')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                    @if ($showEditEmployerForm)
                        <span>Save Changes</span>
                    @else
                        <span>Save</span>
                    @endif
                </button>
            </div>
          </div>
        </form>
        </div>
    </div>

    {{-- Conformation model --}}
    <div wire:ignore.self class="modal fade" id="conformation-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete employer</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this employer?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <button wire:click.prevent="delete_employee( {{ $employee }} )" type="button" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
            </div>
          </div>
        </div>
    </div>
</div>
