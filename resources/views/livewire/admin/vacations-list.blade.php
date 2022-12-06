<div>
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Vacations</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Vacations</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-end">
                            <button wire:click.prevent="show_new_daily_vacation_form" class="btn btn-primary mr-2">
                                <i class="fa-solid fa-calendar-days mr-2"></i> Add Daily Vacation
                            </button>
                            <button wire:click.prevent="show_new_hourly_vacation_form" class="btn btn-primary">
                                <i class="fa-solid fa-clock mr-2"></i> Add Hourly Vacation
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Full name</th>
                                <th scope="col">Vacations count</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ @$employee->fullname }}</td>
                                        <td>{{ $dailyvacations->get($employee->id) + $hourlyvacations->get($employee->id) }}</td>
                                        <td>
                                            <a wire:click.prevent="show_employee_vacation_form( {{ $employee->id }} )" href=""><i class="fa-solid fa-folder-open"></i></a>
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

    {{-- Daily vacation form --}}
    <div wire:ignore.self class="modal fade" id="new-daily-vacation-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <form wire:submit.prevent="new_daily_vacation" autocomplete="off">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                @if ($showEditVacationForm)
                    <span>Edit daily vacation</span>
                @else
                    <span>Add daily vacation</span>
                @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="employeeid">ID</label>
                        <input wire:model.defer="dailyVacationInfo.employeeid" wire:model.lazy="employeeId" type="text" class="form-control @error('employeeid') is-invalid @enderror" id="employeeid" placeholder="Enter Employee ID">
                        @error('employeeid')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-9">
                        <label for="fullname">Full name</label>
                        <input wire:model="employeeFullName" type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" disabled>
                        @error('fullname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <hr>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="requestdate">Request Date</label>
                        <input wire:model.defer="dailyVacationInfo.requestdate" type="text" class="form-control @error('requestdate') is-invalid @enderror" id="requestdate" placeholder="YYYY-MM-DD">
                        @error('requestdate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="from">From</label>
                        <input wire:model.defer="dailyVacationInfo.from" wire:model.lazy="dailyVacationFrom" type="text" class="form-control @error('from') is-invalid @enderror" id="from" placeholder="YYYY-MM-DD">
                        @error('from')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="to">To</label>
                        <input wire:model.defer="dailyVacationInfo.to" wire:model.lazy="dailyVacationTo" type="text" class="form-control @error('to') is-invalid @enderror" id="to" placeholder="YYYY-MM-DD">
                        @error('to')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="duration">Duration</label>
                        <input wire:model="dailyVacationDuration" type="text" class="form-control @error('duration') is-invalid @enderror" id="duration" placeholder="{{ $dailyVacationDuration }}" disabled>
                        @error('duration')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="isauthorization">Authorization</label>
                        <select wire:model.defer="dailyVacationInfo.isauthorization" class="custom-select rounded-0 @error('isauthorization') is-invalid @enderror" id="isauthorization">
                            <option selected>Is isauthorization:</option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                            @error('isauthorization')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="type">Type</label>
                        <select wire:model.defer="dailyVacationInfo.type" class="custom-select rounded-0 @error('type') is-invalid @enderror" id="type">
                            <option selected>Choose Type:</option>
                            <option value="0">Mangment</option>
                            <option value="3">Death</option>
                            <option value="4">Marriage</option>
                            <option value="5">Health</option>
                            <option value="6">Motherhood</option>
                            <option value="7">Without salary</option>
                        </select>
                            @error('type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="reason">Reason</label>
                        <input wire:model.defer="dailyVacationInfo.reason" type="text" class="form-control @error('reason') is-invalid @enderror" id="reason" placeholder="Enter vacation reason">
                        @error('reason')
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
                    @if ($showEditVacationForm)
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

    {{-- Hourly vacation form --}}
    <div wire:ignore.self class="modal fade" id="new-hourly-vacation-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <form wire:submit.prevent="new_hourly_vacation" autocomplete="off">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                @if ($showEditVacationForm)
                    <span>Edit hourly vacation</span>
                @else
                    <span>Add hourly vacation</span>
                @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="employeeid">ID</label>
                        <input wire:model.defer="hourlyVacationInfo.employeeid" wire:model.lazy="employeeId" type="text" class="form-control @error('employeeid') is-invalid @enderror" id="employeeid" placeholder="Enter Employee Code">
                        @error('employeeid')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-9">
                        <label for="fullname">Full name</label>
                        <input wire:model="employeeFullName" type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" disabled>
                        @error('fullname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <hr>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="requestdate">Request Date</label>
                        <input wire:model.defer="hourlyVacationInfo.requestdate" type="text" class="form-control @error('requestdate') is-invalid @enderror" id="requestdate" placeholder="YYYY-MM-DD">
                        @error('requestdate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="vacationdate">Vacation Date</label>
                        <input wire:model.defer="hourlyVacationInfo.vacationdate" type="text" class="form-control @error('vacationdate') is-invalid @enderror" id="vacationdate" placeholder="YYYY-MM-DD">
                        @error('vacationdate')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label for="from">From</label>
                        <input wire:model.defer="hourlyVacationInfo.from" wire:model.lazy="hourlyVacationFrom" type="text" class="form-control @error('from') is-invalid @enderror" id="from" placeholder="HH:MM">
                        @error('from')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label for="to">To</label>
                        <input wire:model.defer="hourlyVacationInfo.to" wire:model.lazy="hourlyVacationTo" type="text" class="form-control @error('to') is-invalid @enderror" id="to" placeholder="HH:MM">
                        @error('to')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label for="duration">Duration</label>
                        <input wire:model="hourlyVacationDuration" type="text" class="form-control @error('duration') is-invalid @enderror" id="duration" disabled>
                        @error('duration')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="type">Type</label>
                        <select wire:model.defer="hourlyVacationInfo.type" class="custom-select rounded-0 @error('type') is-invalid @enderror" id="type">
                            <option selected>Choose Type:</option>
                            <option value="0">Mangment</option>
                            <option value="1">Late</option>
                            <option value="2">Bank</option>
                        </select>
                            @error('type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-9">
                        <label for="reason">Reason</label>
                        <input wire:model.defer="hourlyVacationInfo.reason" type="text" class="form-control @error('reason') is-invalid @enderror" id="reason" placeholder="Enter vacation reason">
                        @error('reason')
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
                    @if ($showEditVacationForm)
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

    {{-- Employee vacations form --}}
    <div wire:ignore.self class="modal fade" id="employee-vacations-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <form wire:submit.prevent="{{-- EDIT HERE --}}" autocomplete="off">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <span>{{ $employee->fullname }} / Vacations</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form">
                    <div>
                        <h4>Daily</h4>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Count</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $dailyvacations->get($employee->id) }}</td>
                                        <td>
                                            <a wire:click.prevent="show_employee_vacation_form( {{ $employee->id }} )" href=""><i class="fa-solid fa-folder-open"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div>
                        <h4>Hourly</h4>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Count</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $hourlyvacations->get($employee->id) }}</td>
                                        <td>
                                            <a wire:click.prevent="show_employee_vacation_form( {{ $employee->id }} )" href=""><i class="fa-solid fa-folder-open"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                    @if ($showEditVacationForm)
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
</div>
