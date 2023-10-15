@extends('agent.agent_dashboard')
@section('agent')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('agent.add.property') }}" class="btn btn-inverse-info"> Add Property </a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property All </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl </th>
                                        <th>Image </th>
                                        <th>Name </th>
                                        <th>Property Type</th>
                                        <th>Status Type </th>
                                        <th>City </th>
                                        <th>code </th>
                                        <th>Status </th>
                                        <th>featured </th>
                                        <th>hot </th>

                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($property as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset($item->property_thambnail) }}"
                                                    style="width:50px; height:50px;"> </td>
                                            <td>{{ $item->property_name }}</td>
                                            <td>{{ $item['type']['type_name'] }}</td>
                                            <td>{{ $item->property_status }}</td>
                                            <td>{{ $item->city }}</td>
                                            <td>{{ $item->property_code }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge rounded-pill bg-success">Active</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger">InActive</span>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($item->featured == 1)
                                                    <span style="" class="text-success"><i
                                                            data-feather="check-circle"></i> </span>
                                                @else
                                                    <span class="text-danger"><i data-feather="x-circle"></i></span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->hot == 1)
                                                    <span style="" class="text-success"><i
                                                            data-feather="check-circle"></i> </span>
                                                @else
                                                    <span class="text-danger"><i data-feather="x-circle"></i></span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('agent.details.property', $item->id) }}"
                                                    class="btn btn-inverse-info" title="Details"><i
                                                        data-feather="eye"></i></a>
                                                <a href="{{ route('agent.edit.property', $item->id) }}"
                                                    class="btn btn-inverse-warning" title="Edit"><i
                                                        data-feather="edit"></i></a>
                                                <a href="{{ route('agent.delete.property', $item->id) }}"
                                                    class="btn btn-inverse-danger" title="Delete" id="delete"><i
                                                        data-feather="trash-2"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
