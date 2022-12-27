<div>
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Discount</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Discount</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            {{-- Boxes --}}
            <div class="row">
                <div class="col-12">
                    <div class="small-box bg-warning">
                    <div class="inner">
                        <h3> {{ $mustBeCheckedCases->count() }} </h3>
                        <p>All Employees with unexplained days: <b>{{ $firstDate }}</b> - <b>{{ $secondDate }}</b></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    </div>
                </div>
            </div>
            {{-- Main --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5 class="modal-title">Filter Data Between</h5>
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-between">
                            <div class="form-group col-md-6">
                                <label for="firstDate">Start Date</label>
                                <input wire:model="firstDate" type="date" class="form-control" id="firstDate">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="secondDate">End Date</label>
                                <input wire:model="secondDate" type="date" class="form-control" id="secondDate">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="d-flex justify-content-end">
                                <button wire:click.prevent="test" class="btn btn-primary">
                                    <i class="fa-solid fa-arrows-rotate mr-2"></i> Cases Justification Check
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Cases Must Be Checked!</th>
                                    {{-- <th scope="col">Duration Must Be Verified!</th> --}}
                                    {{-- <th scope="col">Explained Days</th>
                                    <th scope="col">Explained Duration</th> --}}
                                    <th scope="col">Discounts Days</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mustBeCheckedCases as $mustBeCheckedCase)
                                        <tr>
                                            <td>{{$mustBeCheckedCase->employeeId}}</td>
                                            <td>{{ $this->get_name_by_id( $mustBeCheckedCase->employeeId ) }}</td>
                                            <td>{{$mustBeCheckedCase->mustVerifiedCases}}</td>
                                            <td>{{$mustBeCheckedCase->discountsDays . ' D - ' . $mustBeCheckedCase->discountsHours . ' H'}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer d-flex justify-content-centerid">
                            {{-- {{ $mustBeCheckedCases->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
