<?php

namespace App\Http\Controllers\Admin;

use App\TrackingDevice;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TrackingDeviceController extends Controller
{
    public function tracking_device()
    {
        $device = TrackingDevice::latest()->get();
        return view('backend.tracking_device',compact('device'));
    }


    public function tracking_device_save(Request $request)
    {
        $image = $request->file('image');
        if(isset($image))
        {
//          make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('tracking_device'))
            {
                Storage::disk('public')->makeDirectory('tracking_device');
            }

            $moveImage = Image::make($image)->resize(286,180)->stream();
            Storage::disk('public')->put('tracking_device/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }


        $device = new TrackingDevice();
        $device->device_name = $request->name;
        $device->image = $imageName;
        $device->description = $request->description;
        $device->save();


        Toastr::success('save Successfully :)','Success');
        return redirect()->back();



    }



    public function tracking_device_delete($id)
    {
        $home = TrackingDevice::findOrfail($id);
         if (Storage::disk('public')->exists('tracking_device/'.$home->image))
        {
            Storage::disk('public')->delete('tracking_device/'.$home->image);
        }
        $home->delete();
        Toastr::success('Successfully Deleted :)','Success');
        return redirect()->back();
    }


}
