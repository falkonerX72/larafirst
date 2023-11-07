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

                            <h6 class="card-title">Add State </h6>

                            <form method="POST" action="{{ route('reply.message') }}" class="forms-sample">
                                @csrf
                                <input type="hidden" name="id" value="{{ $comment->id }}">
                                <input type="hidden" name="user_id" value="{{ $comment->user_id }}">
                                <input type="hidden" name="post_id" value="{{ $comment->post_id }}">

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">user name: </label>
                                    <code> {{ $comment['user']['name'] }}</code>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">post title: </label>
                                    <code> {{ $comment['post']['post_title'] }}</code>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">subject: </label>
                                    <code> {{ $comment->subject }}</code>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">message: </label>
                                    <code> {{ $comment->message }}</code>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">reply subject </label>
                                    <input type="text" name="subject" class="form-control ">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">reply message </label>
                                    <textarea type="textarea" name="message" class="form-control" rows="6" cols="40"> </textarea>
                                </div>


                                <button type="submit" class="btn btn-primary me-2">Save Changes </button>

                            </form>

                        </div>
                    </div>




                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->

            <!-- right wrapper end -->
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
