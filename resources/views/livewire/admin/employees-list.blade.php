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
                <div class="small-box bg-info">
                <div class="inner">
                    <h3> {{ $employees->total() }} </h3>
                    <p>All Employees</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-4">
                <div class="small-box bg-success">
                <div class="inner">
                    <h3> {{ $employees->total() }} </h3>

                    <p>Active Employees</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-link"></i>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-4">
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3> {{ $employees->total() }} </h3>

                    <p>Inactive Employees</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-link-slash"></i>
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
                            <button wire:click.prevent="show_new_employer_form" class="btn btn-primary mr-2">
                                <i class="fa fa-plus-circle mr-2"></i> Add New Employer
                            </button>
                            <button wire:click.prevent="show_import_form" class="btn btn-primary">
                                <i class="fa-solid fa-table mr-2"></i> Import Employees From Excel
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Full name</th>
                                <th scope="col">National number</th>
                                <th scope="col">Phone number</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ @$employee->id }}</td>
                                        <td>{{ @$employee->fullName }}</td>
                                        <td>{{ @$employee->nationalNumber }}</td>
                                        <td>+963-{{ @$employee->phoneNumber }}</td>
                                        <td>
                                            <a wire:click.prevent="show_edit_employer_form( {{ $employee }} )" href=""><i class="fa fa-edit mr-2"></i></a>
                                            <a wire:click.prevent="show_unlink_conformation_model( {{ $employee->id }} )" href=""><i class="fa-solid fa-link-slash text-warning mr-2"></i></a>
                                            <a wire:click.prevent="show_delete_conformation_model( {{ $employee->id }} )" href=""><i class="fa fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer d-flex justify-content-centerId">
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
                        <input wire:model.defer="perInfo.id" type="text" class="form-control @error('id') is-invalid @enderror" id="id" placeholder="Enter Employee Code">
                        @error('id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-9">
                        <label for="fullName">Full name</label>
                        <input wire:model.defer="perInfo.fullName" type="text" class="form-control @error('fullName') is-invalid @enderror" id="fullName" placeholder="" disabled>
                        @error('fullName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="firstName">First name</label>
                        <input wire:model.defer="perInfo.firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName" placeholder="Enter first name">
                        @error('firstName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fatherName">Father name</label>
                        <input wire:model.defer="perInfo.fatherName" type="text" class="form-control @error('fatherName') is-invalid @enderror" id="fatherName" placeholder="Enter father name">
                        @error('fatherName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="lastName">Last name</label>
                        <input wire:model.defer="perInfo.lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" placeholder="Enter last name">
                        @error('lastName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="motherName">Mother name</label>
                        <input wire:model.defer="perInfo.motherName" type="text" class="form-control @error('motherName') is-invalid @enderror" id="motherName" placeholder="Enter mother name">
                        @error('motherName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="nationalNumber">National Number</label>
                        <input wire:model.defer="perInfo.nationalNumber" type="text" class="form-control @error('nationalNumber') is-invalid @enderror" id="nationalNumber" placeholder="02000000000">
                        @error('nationalNumber')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div><div class="form-group col-md-3">
                        <label for="phoneNumber">Phone Number</label>
                        <input wire:model.defer="perInfo.phoneNumber" type="text" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber" placeholder="0900000000">
                        @error('phoneNumber')
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
                    {{-- <div class="form-group col-md-3">
                        <label for="birthdate">Birth date</label>
                        <input wire:model.defer="perInfo.birthdate" type="text" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" placeholder="YYYY-MM-DD">
                        @error('birthdate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> --}}
                    <div class="form-group col-md-3">
                        <label for="birthAndPlace">Birth & Place</label>
                        <input wire:model.defer="perInfo.birthAndPlace" type="text" class="form-control @error('birthAndPlace') is-invalid @enderror" id="birthAndPlace" placeholder="YYYY-Place">
                        @error('birthAndPlace')
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
                        <label for="birthdate">Degree</label>
                        <input wire:model.defer="perInfo.degree" type="text" class="form-control @error('degree') is-invalid @enderror" id="degree" placeholder="Degree">
                        @error('degree')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="startDate">Start date</label>
                        <input wire:model.defer="perInfo.startDate" type="text" class="form-control @error('startDate') is-invalid @enderror" id="startDate" placeholder="YYYY-MM-DD">
                        @error('startDate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="quitDate">Quit date</label>
                        <input wire:model.defer="perInfo.quitDate" type="text" class="form-control @error('quitDate') is-invalid @enderror" id="quitDate" placeholder="YYYY-MM-DD">
                        @error('quitDate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="isActive">Is Active</label>
                        <select wire:model.defer="perInfo.isActive" class="custom-select rounded-0 @error('isActive') is-invalid @enderror" id="isActive">
                            <option selected>Is Active?</option>
                            <option value="1"> Active </option>
                            <option value="0"> Inactive </option>
                        </select>
                          @error('isActive')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="centerId">Center</label>
                        <select wire:model.defer="perInfo.centerId" class="custom-select rounded-0 @error('centerId') is-invalid @enderror" id="centerId">
                            <option selected>Choose Center:</option>
                            @foreach ($centers as $center)
                                <option value="{{ $center->id }}">{{ $center->centerName }}</option>
                            @endforeach
                        </select>
                          @error('centerId')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="departmentId">Department</label>
                        <select wire:model.defer="perInfo.departmentId" class="custom-select rounded-0 @error('departmentId') is-invalid @enderror" id="departmentId">
                            <option selected>Choose Department:</option>
                            @foreach ($departments as $department)
                                <option value="{{ @$department->id }}">{{ @$department->departmentName }}</option>
                            @endforeach
                        </select>
                          @error('departmentId')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="positionId">Position</label>
                        <select wire:model.defer="perInfo.positionId" class="custom-select rounded-0 @error('positionId') is-invalid @enderror" id="positionId">
                            <option selected>Choose Position:</option>
                            @foreach ($positions as $position)
                                <option value="{{ @$position->id }}">{{ @$position->positionName }}</option>
                            @endforeach
                        </select>
                          @error('positionId')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="earlyPositionId">Early Position</label>
                        <select wire:model.defer="perInfo.earlyPositionId" class="custom-select rounded-0 @error('earlyPositionId') is-invalid @enderror" id="earlyPositionId">
                            <option selected>Choose Position:</option>
                            @foreach ($positions as $position)
                                <option value="{{ @$position->id }}">{{ @$position->positionName }}</option>
                            @endforeach
                        </select>
                          @error('earlyPositionId')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label for="address">Address</label>
                        <input wire:model.defer="perInfo.address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Martini">
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label for="notes">Notes</label>
                        <textarea wire:model.defer="perInfo.notes" type="text" class="form-control @error('notes') is-invalid @enderror" id="notes" placeholder="Notes" rows="4"></textarea>
                        @error('notes')
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

    {{-- Import form --}}
    <div wire:ignore.self class="modal fade" id="import-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <form
        action="{{ route('import_employees') }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <span>Import Employees</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col">
                        <label for="file">Choose File</label>
                        <input type="file" name="file" class="form-control" id="file">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                        <span>Import File</span>
                </button>
            </div>
            </div>
        </form>
        </div>
    </div>

    {{-- Unlink conformation model --}}
    <div wire:ignore.self class="modal fade" id="unlink-conformation-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unlink employer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to Unlink this employer?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <button wire:click.prevent="unlink_employee( {{ $employee }} )" type="button" class="btn btn-warning"><i class="fa-solid fa-link-slash mr-1"></i>Unlink</button>
            </div>
            </div>
        </div>
    </div>

    {{-- Delete conformation model --}}
    <div wire:ignore.self class="modal fade" id="delete-conformation-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    {{-- Error Modal Alert --}}
	@if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div id="errorModal" class="modal fade">
            <div class="modal-dialog modal-error">
                <div class="modal-content">
                    <div class="modal-header">
                    <div class="icon-box">
                    <i class="material-icons fa fa-times" aria-hidden="true"></i>
                    </div>
                    <h4 class="modal-title">Sorry</h4>
                    </div>
                    <div class="modal-body">
                    <p class="text-center">{{$error}}</p>
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-danger btn-block" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif

    {{-- Confirm Modal Alert --}}
    @if($message = Session::get('success'))
    <div id="confirmModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                    <i class="material-icons fa fa-check" aria-hidden="true"></i>
                    </div>
                    <h4 class="modal-title">Success</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">{{$message}}</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block" data-dismiss="modal" id="button">OK</button>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
