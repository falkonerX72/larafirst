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

                            <h6 class="card-title">Add permission </h6>

                            <form id="myForm" method="POST" role="form" action="{{ route('store.permission') }}"
                                class="forms-sample">
                                @csrf
                                <div class="mb-3 form-group">
                                    <label for="" class="form-label">permission Name </label>
                                    <input required='' type="text" name="name" class="form-control  ">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="" class="form-label">Group Name </label>
                                    <select name="group_name" class="form-select" id="select1">
                                        <option selected="" disabled="">Select Group</option>
                                        <option value="agent">agent</option>
                                        <option value="type">Property Type</option>
                                        <option value="state">State</option>
                                        <option value="amenities">Amenities</option>
                                        <option value="property">Property</option>
                                        <option value="history">Package History </option>
                                        <option value="message">Property Message </option>
                                        <option value="testimonials">Testimonials</option>
                                        <option value="agent">Manage Agent</option>
                                        <option value="category">Blog Category</option>
                                        <option value="post">Blog Post</option>
                                        <option value="comment">Blog Comment</option>
                                        <option value="smtp">SMTP Setting</option>
                                        <option value="site">Site Setting</option>
                                        <option value="role">Role & Permission </option>
                                    </select>
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
    <script>
        $('myForm').on('submit', function(e) {
            e.preventDefault(); // prevent the form submit


            var formData = new FormData(this);

            $.ajax({
                url: '{{ route('store.permission') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // handle success response
                    console.log(response.data);
                },
                error: function(response) {
                    // handle error response
                    console.log(response.data);

                },
                contentType: false,
                processData: false
            });
        })
    </script>
@endsection
