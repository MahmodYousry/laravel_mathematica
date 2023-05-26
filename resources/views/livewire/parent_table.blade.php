<div class="block block-content block-rounded">

    <button type="button" class="btn btn-success btn-sm btn-lg pull-right text-capitalize mb-3" wire:click="showformadd">
        <i class="fa fa-fw fa-plus"></i> {{ trans('Parent_trans.add_parent') }}
    </button>

    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table id="datatable" class="table table-bordered table-striped table-vcenter js-dataTable-full">
        <thead>
            <tr class="text-center">
                <th style="width: 60px;">ID</th>
                <th>{{ trans('Parent_trans.Email') }}</th>
                <th>{{ trans('Parent_trans.Name_Father') }}</th>
                <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
                <th>{{ trans('Parent_trans.Passport_ID_Father') }}</th>
                <th>{{ trans('Parent_trans.Phone_Father') }}</th>
                <th>{{ trans('Parent_trans.Job_Father') }}</th>
                <th style="width: 15%;">{{ trans('Parent_trans.Processes') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($my_parents as $my_parent)
                <tr>
                    <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                    <td class="font-w600 font-size-sm">{{$my_parent->Email}}</td>
                    <td class="text-center font-w600 font-size-sm">{{ $my_parent->Name_Father }}</td>
                    <td class="text-center">{{ $my_parent->National_ID_Father }}</td>
                    <td class="text-center">{{ $my_parent->Passport_ID_Father }}</td>
                    <td class="text-center">{{ $my_parent->Phone_Father }}</td>
                    <td class="text-center">{{ $my_parent->Job_Father }}</td>
                    <td>
                        <div class="d-flex flex-xs-column flex-sm-column flex-md-row justify-content-start">
                            <button type="button" class="btn btn-sm btn-primary m-1" wire:click="edit({{ $my_parent->id }})" title="{{ trans('grades.edit') }}">
                                <i class="fa fa-fw fa-pen"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger m-1" wire:click="delete({{ $my_parent->id }})" title="{{ trans('grades.delete') }}">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- END Dynamic Table Full -->
</div>

