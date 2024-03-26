<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Image;
use App\App;
use App\Consolen;
use Auth;
use DB;

class UploaderController extends Controller
{
    public function Upload_app(Request $request)
    {
        if($request->ismethod('post')){
            $data = $request->all();

            $addApp = new App;
            $addApp->app_name = $data['app_name'];
            $addApp->app_cat = $data['app_cat'];
            $addApp->app_os = $data['app_os'];
            $addApp->app_desc = $data['app_desc'];
            $addApp->app_owner = $data['app_owner'];
            $addApp->owner_email = $data['owner_email'];
            $addApp->owner_number = $data['owner_number'];

            // Upload icon picture
            if($request->hasfile('icon_picture')){
                $icon_img_tmp = $request->file('icon_picture');
                if($icon_img_tmp->isValid()){
                    $icon_extension = $icon_img_tmp->getClientOriginalExtension();
                    $icon_filename  = 'icon_' . rand(111, 99999) . '.' . $icon_extension;
                    $icon_img_path = 'uploads/uploader/' . $icon_filename;
                    $icon_img_tmp->move(public_path($icon_img_path));
                    $addApp->icon_picture = $icon_img_path;
                }
            }

            // Upload feature picture
            if($request->hasfile('feature_picture')){
                $feature_img_tmp = $request->file('feature_picture');
                if($feature_img_tmp->isValid()){
                    $feature_extension = $feature_img_tmp->getClientOriginalExtension();
                    $feature_filename  = 'feature_' . rand(111, 99999) . '.' . $feature_extension;
                    $feature_img_path = 'uploads/uploader/' . $feature_filename;
                    $feature_img_tmp->move(public_path($feature_img_path));
                    $addApp->feature_picture = $feature_img_path;
                }
            }

           // Upload gameplay screenshots (up to 8)
$screenshots = [];
if ($request->hasfile('gameplay_screenshots')) {
    $counter = 0; // Initialize a counter to keep track of the number of screenshots processed
    foreach ($request->file('gameplay_screenshots') as $screenshot) {
        if ($counter < 8) { // Limit the number of screenshots to 8
            if ($screenshot->isValid()) {
                $screenshot_extension = $screenshot->getClientOriginalExtension();
                $screenshot_filename  = 'screenshot_' . rand(111, 99999) . '.' . $screenshot_extension;
                $screenshot_path = 'uploads/uploader/' . $screenshot_filename;
                $screenshot->move(public_path($screenshot_path));
                $screenshots[] = $screenshot_path;
                $counter++; // Increment the counter
            }
        } else {
            // If more than 8 screenshots are attempted to be uploaded, you can handle it here
            // For example, you can break out of the loop or display a message to the user
            break;
        }
    }
}


            // Upload compressed file (ZIP)
            if($request->hasfile('compressed_file')){
                $compressed_file_tmp = $request->file('compressed_file');
                if($compressed_file_tmp->isValid()){
                    $compressed_extension = $compressed_file_tmp->getClientOriginalExtension();
                    if($compressed_extension == 'zip'){
                        $compressed_filename  = 'compressed_' . rand(111, 99999) . '.' . $compressed_extension;
                        $compressed_file_path = 'uploads/uploader/' . $compressed_filename;
                        $compressed_file_tmp->move(public_path($compressed_file_path));
                        $addApp->compressed_file = $compressed_file_path;
                    } else {
                        return redirect('/admin/dashboard/upload_app')->with('error_message','Invalid file type. Please upload a ZIP file.');
                    }
                }
            }

            // Store up to 8 screenshots in the database (as JSON)
            if(!empty($screenshots)){
                $addApp->gameplay_screenshots = json_encode($screenshots);
            }

            $addApp->save();

            return redirect('/admin/dashboard/view_app')->with('flash_message_success','Application Uploaded successfully !');
        }
        return view('admin.uploader.upload_app');
    }

    public function view_app(Request $request)
    {
        $id = Auth::user()->id;
        $apps['data'] = DB::table('apps')->where('id','=', $id)->first();
        if(count ($apps)>0){
            return view('admin.uploader.view_app',compact('apps'));
        }
        else {
            return view('admin.uploader.view_app');
        }
    }

    public function payment(Request $request)
    {
        if($request->ismethod('post')){
            $data = $request->all();
            $addApp = new Consolen;
            $addApp->c_type = $data['c_type'];
            $addApp->save();
            return redirect('/admin/dashboard/proceed_to');
        }
        return view('admin.uploader.payment');
    }

    public function proceed_to(Request $request)
    {
        $consoles = Consolen::get();
        return view('admin.uploader.proceed_to', compact('consoles'));
    }
}
