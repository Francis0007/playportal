@extends('admin.layouts.master')
@section('title', 'View Application')
@section('content')
<!-- wrapper  -->
<!-- ============================================================== -->

            <!-- basic table  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">View Application
                        <a href="{{ url('/admin/dashboard/upload_app') }}" class="upload"> Upload Application</a>
                    </h5>
                    @if(Session::has('flash_message_error'))
                    <div class="alert alert-sm alert-danger alert-block" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{!! session('flash_message_error') !!}</strong>
                    </div>
                    @endif
                    @if(Session::has('flash_message_success'))
                    <div class="alert alert-sm alert-success alert-block" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
                    @endif
                    <div id="message_success" style="display: none;" class="alert alert-sm alert-success">Status Enabled</div>
                    <div id="message_error" style="display: none;" class="alert alert-sm alert-danger">Status Disabled</div>    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                                <thead>
                                    <tr>
                                        <th>Application ID</th>
                                        <th>App Name</th>
                                        <th>App Category</th>
                                        <th>App OS</th>
                                        <th>App Description</th>
                                        <th>App Owner</th>
                                        <th>Owner E-mail</th>
                                        <th>Owner Number</th>
                                        <th>Icon Image</th>
                                        <th>Feature Image</th>
                                        <th>Gameplay Screenshots</th>
                                        <th>Compressed File</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                    @forelse($apps as $app)
                                    <tr>
                                        <td>S - {{$app->id}}</td>
                                        <td>{{$app->app_name}}</td>
                                        <td>{{$app->app_cat}}</td>
                                        <td>{{$app->app_os}}</td>
                                        <td>{{$app->app_desc}}</td>
                                        <td>{{$app->app_owner}}</td>
                                        <td>{{$app->owner_email}}</td>
                                        <td>{{$app->owner_number}}</td>
                                            <td>
                                                @if(!empty($app->icon_picture))
                                                    <button onclick="openImageWindow('{{ asset($app->icon_picture) }}')">View Icon Image</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($app->feature_picture))
                                                    <button onclick="openImageWindow('{{ asset($app->feature_picture) }}')">View Feature Image</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($app->gameplay_screenshots))
                                                    @foreach(json_decode($app->gameplay_screenshots) as $screenshot)
                                                        <button onclick="openImageWindow('{{ asset($screenshot) }}')">View Screenshot</button>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($app->compressed_file))
                                                    <a href="{{ asset($app->compressed_file) }}" class="btn btn-primary" download>Download Compressed File</a>
                                                @endif
                                            </td>
                                            <!-- <td>
                                                <a class="btn btn-primary" href="{{ url('/admin/dashboard/edit_app/'.$app->id) }}">Edit</a>
                                            </td> -->
                                            </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8">No apps uploaded</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end basic table  -->
        </div>
    </div>
</div>

<script>
    function openImageWindow(imageUrl) {
        window.open(imageUrl, '_blank');
    }

    $(document).ready(function() {
        $('#fetchUploadedAppsBtn').click(function() {
            $.ajax({
                url: "{{ route('admin.my_uploaded_apps') }}",
                type: "GET",
                success: function(response) {
                    var apps = response.apps;
                    var html = '<h3>My Uploaded Apps</h3>';
                    $.each(apps, function(index, app) {
                        html += '<div class="card">';
                        html += '<div class="card-header">' + app.app_name + '</div>';
                        html += '<div class="card-body">' + app.app_desc + '</div>';
                        html += '</div>';
                    });
                    $('#uploadedAppsContainer').html(html);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#fileUploadForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('upload_zip') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $('#progressBar').width(percentComplete + '%');
                            $('#progressText').text(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                beforeSend: function() {
                    $('#progressContainer').show();
                },
                success: function(response) {
                    // Handle success
                    alert('File uploaded successfully!');
                },
                error: function(xhr, status, error) {
                    // Handle error
                    alert('An error occurred: ' + error);
                }
            });
        });
    });
</script>





   



<!-- Add the script for handling the AJAX request -->


@endsection