@extends('admin.layouts.master')
@section('title','Edit Application')
@section('content')

<div class="dashboard-wrapper" style="background: radial-gradient(circle, rgba(135,104,0,1) 1%, rgba(2,87,159,1) 100%)">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card" style="border: solid cadetblue 12px; border-style: outset; border-radius: 22px;">
                    <h5 class="card-header">Edit Application</h5>
                    <div class="card-body">
                        <form action="{{ url('/admin/dashboard/update_app/'.$app->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <h5 for="app_name">Application Name<span style="color: red">*</span></h5>
                                <input id="app_name" type="text" name="app_name" data-parsley-trigger="change" required="" placeholder="Enter Application Name" autocomplete="on" class="form-control">
                            </div>
                            <div class="form-group">
                                <h5 for="app_os">Application Operating Environment<span style="color: red">*</span></h5>
                                <input id="app_os" type="text" name="app_os" data-parsley-trigger="change" required="" placeholder="Enter Application Operating Environment" autocomplete="on" class="form-control">
                            </div>
                            <div class="form-group">
                                <h5 for="app_desc">Application Description<span style="color: red">*</span></h5>
                                <input id="app_desc" name="app_desc" type="text" required="" placeholder="Enter Application Description" class="form-control">
                            </div>
                            <div class="form-group">
                                <h5 for="app_owner">Application Owner Name<span style="color: red">*</span></h5>
                                <input id="app_owner" name="app_owner" type="text" placeholder="Enter Application Owner Name" class="form-control">
                            </div>
                            <div class="form-group">
                                <h5 for="owner_email">Email<span style="color: red">*</span></h5>
                                <input id="owner_email" name="owner_email" type="email" required="" placeholder="Enter Application Owner Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <h5 for="owner_number">Number<span style="color: red">*</span></h5>
                                <input id="owner_number" name="owner_number" type="number" required="" placeholder="Enter Application Owner Number" class="form-control">
                            </div>
                            <div class="form-group">
                                <h5 for="icon_picture">Icon Picture<span style="color: red">*</span></h5>
                                <input id="icon_picture" name="icon_picture" type="file" required="" class="form-control" onchange="previewImage(this, 'iconPreview')">
                                <img id="iconPreview" src="#" alt="Icon Preview" style="display: none; max-width: 200px; max-height: 200px;">
                            </div>
                            <div class="form-group">
                                <h5 for="feature_picture">Feature Picture<span style="color: red">*</span></h5>
                                <input id="feature_picture" name="feature_picture" type="file" required="" class="form-control" onchange="previewImage(this, 'featurePreview')">
                                <img id="featurePreview" src="#" alt="Feature Preview" style="display: none; max-width: 200px; max-height: 200px;">
                            </div>
                            <div class="form-group">
                                <h5 for="gameplay_screenshots">Gameplay Screenshots (up to 8)</h5>
                                <input id="gameplay_screenshots" name="gameplay_screenshots[]" type="file" multiple class="form-control" onchange="previewImages(this, 'screenshotPreview')">
                                <div id="screenshotPreview" class="row">
                                    <!-- Preview images will be displayed here -->
                                </div>
                            </div>
                            <div class="form-group">
                                <h5 for="compressed_file">Compressed File (ZIP)</h5>
                                <input id="compressed_file" name="compressed_file" type="file" required="" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center">
                                        <button type="submit" class="btn btn-space btn-primary">Upload Application</button>
                                        <button class="btn btn-space btn-secondary">Cancel</button>
                                    </p>
                                </div>
                            </div>
                            <!-- Add other form fields here with respective values -->

                            <button type="submit" class="btn btn-primary">Update Application</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
