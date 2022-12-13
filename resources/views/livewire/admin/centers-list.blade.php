<div>
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Centers</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Centers</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
        {{-- Boxes --}}
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="small-box bg-success">
                <div class="inner">
                    <h3> {{ $centers->total() }} </h3>

                    <p>All Centers</p>
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
                <form wire:submit.prevent="{{ $showEditCenterForm? 'edit_center' : 'newCenterForm' }}" autocomplete="off">
                <h5 class="modal-title" id="exampleModalLabel">
                @if ($showEditCenterForm)
                    <span>Edit Center</span>
                @else
                    <span>Add New Center</span>
                @endif
</h5><br>
<div class="d-flex justify-content-between">
<div class="col-10">
                        <input wire:model.defer="perInfo.centerName" type="text" class="form-control @error('centerName') is-invalid @enderror" id="centerName" placeholder="Center Name">
                        @error('centerName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        </div>
                        <div class="col">
                        <button class="btn btn-primary">
                                <i class="fa fa-plus-circle mr-2"></i>
                                @if ($showEditCenterForm)
                        <span>Save Changes</span>
                    @else
                        <span>Save</span>
                    @endif
                            </button>
</div>
</div>
                </form>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Center</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($centers as $center)
                                    <tr>
                                        <td>{{ $center->centerName }}</td>

                                        <td>
                                            <a wire:click.prevent="show_edit_center_form({{ $center }})" href=""><i class="fa fa-edit mr-2"></i></a>
                                            <a wire:click.prevent="show_conformation_model( {{ $center->id }} )" href=""><i class="fa fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer d-flex justify-content-centerid">
                         {{ $centers->links() }}
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
              <h5 class="modal-title" id="exampleModalLabel">Delete Center</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this Center ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                <button wire:click.prevent="delete_center( {{ $center }} )" type="button" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
            </div>
          </div>
        </div>
    </div>
</div>

