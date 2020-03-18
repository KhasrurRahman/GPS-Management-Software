<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FeatureController extends Controller
{
    public function add_feature()
    {
        $feature  = Feature::latest()->get();
        return view('backend.feature.add_feature',compact('feature'));
    }

    public function feature_save(Request $request)
    {
        $image = $request->file('image');
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('feature'))
            {
                Storage::disk('public')->makeDirectory('feature');
            }

            $moveImage = Image::make($image)->resize(70,70)->stream();
            Storage::disk('public')->put('feature/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }

        $price = new Feature();
        $price->image = $imageName;
        $price->name = $request->name;
        $price->save();

        Toastr::success('save Successfully :)','Success');
        return redirect()->back();

    }

    public function feature_delete($id)
    {
        $feature = Feature::find($id)->delete();
        Toastr::success('Deleted Successfully :)','Success');
        return redirect()->back();
    }

    public function feature_edit($id)
    {
        $feature = Feature::find($id);
        return view('backend.feature.edit_feature',compact('feature'));
    }

    public function update_feature(Request $request,$id)
    {
        $price = Feature::find($id);

        $image = $request->file('image');
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('feature'))
            {
                Storage::disk('public')->makeDirectory('feature');
            }
//            delete old post image
            if(Storage::disk('public')->exists('feature/'.$price->bg_image))
            {
                Storage::disk('public')->delete('feature/'.$price->bg_image);
            }
            $moveImage = Image::make($image)->resize(70,70)->stream();
            Storage::disk('public')->put('feature/'.$imageName,$moveImage);

        } else {
            $imageName = $price->bg_image;
        }

        $price->image = $imageName;
        $price->name = $request->name;
        $price->update();

        Toastr::success('update Successfully :)','Success');
        return redirect()->back();
    }


}
