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
                            <button wire:click.prevent="show_new_employer_form" class="btn btn-primary">
                                <i class="fa fa-plus-circle mr-2"></i> Add New Vacation
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Full name</th>
                                <th scope="col">Vacations count</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ @$employee->id }}</td>
                                        <td>{{ @$employee->fullname }}</td>
                                        <td>Vacations count</td>
                                        <td>
                                            <a wire:click.prevent="show_edit_employer_form( {{ $employee }} )" href=""><i class="fa fa-edit mr-2"></i></a>
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
</div>
