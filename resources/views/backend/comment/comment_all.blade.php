@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">



        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">all blog comment</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>s1</th>
                                        <th>post title</th>
                                        <th>user name</th>
                                        <th>subject</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comment as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item['post']['post_title'] }}</td>
                                            <td>{{ $item['user']['name'] }}</td>
                                            <td>{{ $item->subject }}</td>

                                            <td>
                                                <a href="{{ route('admin.comment.reply', $item->id) }}"
                                                    class="btn btn-inverse-warning"> reply </a>
                                                <a href="{{ route('delete.state', $item->id) }}"
                                                    class="btn btn-inverse-danger" id="delete"> Delete </a>
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
