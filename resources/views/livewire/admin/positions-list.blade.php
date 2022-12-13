<div>
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Positions</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Positions</li>
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
                    <h3> {{ $positions->total() }} </h3>

                    <p>All Positions</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-4">
                <div class="small-box bg-info">
                <div class="inner">
                    <h3> {{ $positions->total() }} </h3>

                    <p>All Vacancies</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-4">
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3> {{ $positions->total() }} </h3>
                    <p>Empty Vacancies</p>
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
                        <form wire:submit.prevent="{{ $showEditPositionForm? 'edit_position' : 'newPositionForm' }}" autocomplete="off">
                            <h5 class="modal-title" id="exampleModalLabel">
                                @if ($showEditPositionForm)
                                    <span>Edit Position</span>
                                @else
                                    <span>Add New Position</span>
                                @endif
                            </h5>
                            <br>
                            <div class="d-flex justify-content-between">
                                <div class="col-5">
                                    <input wire:model.defer="perInfo.positionName" type="text" class="form-control @error('positionName') is-invalid @enderror" id="positionName" placeholder="Position Name">
                                    @error('positionName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-5">
                                    <input wire:model.defer="perInfo.numberOfVacancies" type="text" class="form-control @error('numberOfVacancies') is-invalid @enderror" id="numberOfVacancies" placeholder="Vacancies Number">
                                    @error('numberOfVacancies')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary">
                                        <i class="fa fa-plus-circle mr-2"></i>
                                        @if ($showEditPositionForm)
                                        <span>Save Changes</span>
                                        @else
                                            <span>Save</span>
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Position</th>
                                <th scope="col">Vacancies</th>
                                <th scope="col">Employee</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($positions as $position)
                                    <tr>
                                        <td>{{ $position->positionName }}</td>
                                        <td>{{ $position->numberOfVacancies }}</td>
                                        <td>1</td>

                                        <td>
                                            <a wire:click.prevent="show_edit_employer_form(  )" href=""><i class="fa-solid fa-folder-open text-success mr-2"></i></a>
                                            <a wire:click.prevent="show_edit_position_form( {{ $position }} )" href=""><i class="fa fa-edit mr-2"></i></a>
                                            <a wire:click.prevent="show_conformation_model( {{ $position->id }} )" href=""><i class="fa fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer d-flex justify-content-centerid">
                        {{-- {{ $positions->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    {{-- Conformation model --}}
    <div wire:ignore.self class="modal fade" id="conformation-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Position</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this position?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <button wire:click.prevent="delete_position( {{ $position }} )" type="button" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
            </div>
          </div>
        </div>
    </div>
</div>
