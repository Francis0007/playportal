<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\App;
use App\Models\Consolen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UploaderController extends Controller
{
    public function Upload_App(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'app_name' => 'required|string|max:255',
                'app_cat' => 'required|string|max:255',
                'app_os' => 'required|string|max:255',
                'app_desc' => 'required|string',
                'app_owner' => 'required|string|max:255',
                'owner_email' => 'required|email|max:255',
                'owner_number' => 'required|string|max:255',
                'icon_picture' => 'required|image|max:2048', // 2MB max
                'feature_picture' => 'required|image|max:2048', // 2MB max
                'gameplay_screenshots.*' => 'image|max:2048', // 2MB max per screenshot
                'compressed_file' => 'required|file|max:5242880', // 5GB max
            ]);
    
            $addApp = new App;
            $addApp->app_name = $data['app_name'];
            $addApp->app_cat = $data['app_cat'];
            $addApp->app_os = $data['app_os'];
            $addApp->app_desc = $data['app_desc'];
            $addApp->app_owner = $data['app_owner'];
            $addApp->owner_email = $data['owner_email'];
            $addApp->owner_number = $data['owner_number'];

            // Upload icon picture
            if ($request->hasFile('icon_picture')) {
                $iconPath = $request->file('icon_picture')->store('public/icons');
                $addApp->icon_picture = Storage::url($iconPath);
            }

            // Upload feature picture
            if ($request->hasFile('feature_picture')) {
                $featurePath = $request->file('feature_picture')->store('public/features');
                $addApp->feature_picture = Storage::url($featurePath);
            }

            // Upload gameplay screenshots (up to 8)
            $screenshots = [];
            if ($request->hasFile('gameplay_screenshots')) {
                foreach ($request->file('gameplay_screenshots') as $index => $screenshot) {
                    if ($index < 8 && $screenshot->isValid()) {
                        $screenshotPath = $screenshot->store('public/screenshots');
                        $screenshots[] = Storage::url($screenshotPath);
                    }
                }
            }
            $addApp->gameplay_screenshots = json_encode($screenshots);

            // Upload compressed file (ZIP)
            if ($request->hasFile('compressed_file')) {
                $compressedPath = $request->file('compressed_file')->store('public/compressed');
                $addApp->compressed_file = Storage::url($compressedPath);
            }

            $addApp->save();

            return redirect('/admin/dashboard/view_app')->with('flash_message_success', 'Application uploaded successfully!');
        }
        return view('admin.uploader.upload_app');
    }

    public function view_app(Request $request)
    {
        // $id = Auth::user()->id;
        // $apps = DB::table('apps')->where('id', $id)->first();

        // if($apps){
        //     return view('admin.uploader.view_app', compact('apps'));
        // } else {
        //     $apps = null; // Assigning null to $apps if there are no apps
        //     return view('admin.uploader.view_app');
        // }
        $apps = App::all(); // Retrieve all apps from the database
        return view('admin.uploader.view_app', compact('apps'));
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
    public function edit_app($id)
    {
       $app = App::find($id);
       return view('admin.uploader.edit_app', compact('app'));
    }

    public function update_app(Request $request, $id)
    {
        $app = App::find($id);
        $app->app_name = $request->input('app_name');
        // Update other fields similarly
    
        $app->save();
    
        return redirect('/admin/dashboard/view_app')->with('flash_message_success', 'Application updated successfully!');
    }

    public function my_uploaded_apps()
    {
        $user = Auth::user();
        $apps = $user->apps; // Assuming 'apps' is the relationship method
        
        return response()->json(['apps' => $apps]);
    }

    public function viewUploadedApp($appId)
    {
        $app = App::find($appId);
        return view('view_uploaded_app', compact('app'));
    }

    public function uploadZip(Request $request)
    {
        if ($request->hasFile('zip_file')) {
            $zipFile = $request->file('zip_file');
            $filename = time() . '.' . $zipFile->getClientOriginalExtension();
            $path = $zipFile->storeAs('uploads', $filename, 'public');
            return response()->json(['message' => 'File uploaded successfully!', 'path' => $path]);
        } else {
            return response()->json(['error' => 'No file uploaded.'], 400);
        }
    }
}