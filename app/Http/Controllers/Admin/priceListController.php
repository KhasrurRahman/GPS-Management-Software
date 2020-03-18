<?php

namespace App\Http\Controllers\Admin;

use App\Price_categaroy;
use App\Price_sub_category;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class priceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $price_category = Price_categaroy::latest()->get();
        return  view('backend.price_list.add_price_cat',compact('price_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('bg_image');
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('price_list'))
            {
                Storage::disk('public')->makeDirectory('price_list');
            }

            $moveImage = Image::make($image)->stream();
            Storage::disk('public')->put('price_list/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }

        $price = new Price_categaroy();
        $price->bg_image = $imageName;
        $price->name = $request->name;
        $price->device_price = $request->device_price;
        $price->monthly_charge = $request->monthly_charge;
        $price->save();

        Toastr::success('save Successfully :)','Success');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $price = Price_categaroy::find($id);
        return view('backend.price_list.edit_price_category',compact('price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $price = Price_categaroy::find($id);

        $image = $request->file('bg_image');
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('price_list'))
            {
                Storage::disk('public')->makeDirectory('price_list');
            }
//            delete old post image
            if(Storage::disk('public')->exists('price_list/'.$price->bg_image))
            {
                Storage::disk('public')->delete('price_list/'.$price->bg_image);
            }
            $moveImage = Image::make($image)->resize(286,200)->stream();
            Storage::disk('public')->put('price_list/'.$imageName,$moveImage);

        } else {
            $imageName = $price->bg_image;
        }

        $price->bg_image = $imageName;
        $price->name = $request->name;
        $price->device_price = $request->device_price;
        $price->monthly_charge = $request->monthly_charge;
        $price->update();

        Toastr::success('update Successfully :)','Success');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function price_cat_delete($id)
    {
        $home = Price_categaroy::findOrfail($id);
         if (Storage::disk('public')->exists('price_list/'.$home->bg_image))
        {
            Storage::disk('public')->delete('price_list/'.$home->bg_image);
        }
        $home->delete();

        Toastr::success('Successfully Deleted :)','Success');
        return redirect()->back();
    }

    public function add_price_subcategory($id)
    {
        $price = Price_categaroy::find($id);

        $sub_cat = Price_sub_category::where('price_id',$id)->get();

        return view('backend.price_list.add_price_sub_cat',compact('price','sub_cat'));
    }


    public function sub_cat_save(Request $request)
    {
        $sub = new Price_sub_category();
        $sub->price_id = $request->price_id;
        $sub->active_status = $request->active_status;
        $sub->name = $request->name;
        $sub->save();

        Toastr::success('Successfully saved :)','Success');
        return redirect()->back();
    }

    public function delete_sub($id)
    {
        $sub = Price_sub_category::find($id)->delete();
        Toastr::success('Successfully deleted :)','Success');
        return redirect()->back();

    }


    public function sub_edit($id)
    {
        $sub = Price_sub_category::find($id);
        return view('backend.price_list.edit_price_sub_cat',compact('sub'));
    }

    public function sub_update(Request $request,$id){
            $sub = Price_sub_category::find($id);
            $sub->name = $request->name;
            $sub->active_status = $request->active_status;
            $sub->update();

            Toastr::success('Successfully updated :)','Success');
            return redirect()->back();
    }


}
