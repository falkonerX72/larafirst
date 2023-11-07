@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">


        <div class="row profile-body">
            <!-- left wrapper start -->

            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Add Roles </h6>

                            <form id="myForm" method="POST" role="form" action="{{ route('store.roles') }}"
                                class="forms-sample">
                                @csrf
                                <div class="mb-3 form-group">
                                    <label for="" class="form-label">role Name </label>
                                    <input required='' type="text" name="name" class="form-control  ">
                                </div>

                                <button type="submit" id="submit" class="btn btn-primary me-2">Save Changes </button>
                            </form>
                            <div id="success"></div>

                        </div>
                    </div>




                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->

            <!-- right wrapper end -->
        </div>
    </div>
@endsection
