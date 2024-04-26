@extends('admin.layouts.master')
@section('title','Upload Application')
@section('content')
<!-- wrapper  -->
<!-- ============================================================== -->

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header"> Upload Application
                        <a href="{{url ('/admin/dashboard/view_app')}}" class="upload"><i class="fa fa-list"></i> View Application</a>
                    </h5>
                    <p class="mt-2 ml-3" style="color: red">Fields marked <span> * </span> are required</p>
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{url('/admin/dashboard/upload_app')}}" method="post" id="basicform" data-parsley-validate="" data-parsley-max-file-size="1000" data-parsley-errors-container="#error-container">
                            @csrf
                            <div class="form-group">
                                <select class="form-select" aria-label="Default select example" name="app_cat" id="app_cat">
                                    <option selected>Select App Category</option>
                                    <option value="PCGames">PCGames</option>
                                    <option value="MobileGames">MobileGames</option>
                                    <option value="WebGame">WebGames</option>
                                </select>
                            <div class="form-group">
                                <h5 for="app_name">Application Name<span style="color: red">*</span></h5>
                                <input id="app_name" type="text" name="app_name" data-parsley-trigger="change" required="" placeholder="Enter Application Name" autocomplete="on">
                            </div>
                            <div class="form-group">
                                <h5 for="app_os">Application Operating Environment<span style="color: red">*</span></h5>
                                <input id="app_os" type="text" name="app_os" data-parsley-trigger="change" required="" placeholder="Enter Application Operating Environment" autocomplete="on">
                            </div>
                            <div class="form-group">
                                <h5 for="app_desc">Application Description<span style="color: red">*</span></h5>
                                <textarea id="app_desc" name="app_desc" required="" placeholder="Enter Application Description" ></textarea>
                            </div>
                            <div class="form-group">
                                <h5 for="app_owner">Application Owner Name<span style="color: red">*</span></h5>
                                <input id="app_owner" name="app_owner" type="text" placeholder="Enter Application Owner Name">
                            </div>
                            <div class="form-group">
                                <h5 for="owner_email">Email<span style="color: red">*</span></h5>
                                <input id="owner_email" name="owner_email" type="email" required="" placeholder="Enter Application Owner Email">
                            </div>
                            <div class="form-group">
                                <h5 for="owner_number">Number<span style="color: red">*</span></h5>
                                <input id="owner_number" name="owner_number" type="number" required="" placeholder="Enter Application Owner Number">
                            </div>
                            <div class="form-group">
                                <h5 for="icon_picture">Icon Picture<span style="color: red">*</span></h5>
                                <input id="icon_picture" name="icon_picture" type="file" required="" onchange="previewImage(this, 'iconPreview')">
                                <img id="iconPreview" src="#" alt="Icon Preview" style="display: none; max-width: 200px; max-height: 200px;">
                            </div>
                            <div class="form-group">
                                <h5 for="feature_picture">Feature Picture<span style="color: red">*</span></h5>
                                <input  name="feature_picture" type="file" required="" onchange="previewImage(this, 'featurePreview')">
                                <img id="featurePreview" src="#" alt="Feature Preview" style="display: none; max-width: 200px; max-height: 200px;">
                            </div>
                            <div class="form-group">
                                <h5 for="gameplay_screenshots">Gameplay Screenshots (up to 8)</h5>
                                <input  name="gameplay_screenshots[]" type="file" id="fileInput" multiple>
                                <div id="previewContainer"></div>
                                    <!-- Preview images will be displayed here -->
                                </div>
                            </div>
                            <div class="form-group">
                                <h5 for="compressed_file">Compressed File (ZIP) - Up to 1 GB</h5>
                                <input id="compressed_file" name="compressed_file" type="file" required="">
                                <!-- Loading indicator -->
                                <div id="upload-progress" style="display: none;">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p id="upload-status">Uploading...</p>
                                </div>
                            </div>
                            
                            <div id="error-container"></div>
                            <!-- Submit button -->
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center">
                                        <button type="submit" class="btn btn-space btn-primary">Upload Application</button>
                                        <button class="cancel">Cancel</button>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input, imgId) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + imgId)
                .attr('src', e.target.result)
                .show();
        };
        reader.readAsDataURL(input.files[0]);
    }

    function previewImages(input, previewDivId) {
        var files = input.files;
        var imagesDiv = document.getElementById(previewDivId);
        imagesDiv.innerHTML = '';

        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.createElement("img");
                img.src = e.target.result;
                img.style.maxWidth = "200px";
                img.style.maxHeight = "200px";
                imagesDiv.appendChild(img);
            };
            reader.readAsDataURL(input.files[i]);
        }
    }
</script>
<!-- JavaScript for showing/hiding loading indicator -->
<script>
let dragged;

document.addEventListener('dragstart', function(event) {
    dragged = event.target;
    event.target.style.opacity = '0.5';
});

document.addEventListener('dragend', function(event) {
    event.target.style.opacity = '';
});

document.addEventListener('dragover', function(event) {
    event.preventDefault();
});

document.addEventListener('drop', function(event) {
    event.preventDefault();
    if (event.target.classList.contains('draggable')) {
        const rect = event.target.getBoundingClientRect();
        const midY = rect.y + rect.height / 2;
        if (event.clientY > midY) {
            event.target.parentNode.insertBefore(dragged, event.target.nextSibling);
        } else {
            event.target.parentNode.insertBefore(dragged, event.target);
        }
    }
});

const fileInput = document.getElementById('fileInput');
const previewContainer = document.getElementById('previewContainer');

fileInput.addEventListener('change', function() {
    const files = this.files;
    
    // Clear previous previews
    previewContainer.innerHTML = '';

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function(e) {
            const preview = document.createElement('img');
            preview.src = e.target.result;
            preview.classList.add('draggable');
            preview.draggable = true;
            previewContainer.appendChild(preview);
        };

        reader.readAsDataURL(file);
    }
});


    document.getElementById('basicform').addEventListener('submit', function(event) {
        // Show loading indicator when the form is submitted
        document.getElementById('upload-progress').style.display = 'block';
        document.getElementById('upload-status').innerText = 'Uploading...';

        // Disable submit button to prevent multiple submissions
        document.getElementById('upload-button').setAttribute('disabled', 'disabled');
    });
</script>
@endsection