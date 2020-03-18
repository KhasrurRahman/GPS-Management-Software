<?php

namespace App\Http\Controllers\Admin;

use App\AllUser;
use App\Billing_shedule;
use App\Contact_info;
use App\Demo;
use App\HappyClient;
use App\HomePageModel;
use App\order;
use App\payment_history;
use App\service;
use App\Team;
use App\technician_device_stock;
use App\Transaction_history;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class AdminDashboardController extends Controller
{
    public function index(){
        $order = order::where('order_status',0)->get();
        $registered_user = AllUser::where('order_status',0)->get();
        $total_collected_amount = payment_history::sum('payment_this_date');
        $total_device_sale = technician_device_stock::sum('quantity');
        $today_collected_bill = payment_history::whereDate('updated_at', Carbon::today())->sum('payment_this_date');
        $total_due_user = AllUser::where('payment_status',0)->get()->count();
        $total_device_sale_tk = Transaction_history::sum('sell_price');
        $total_expair_user = AllUser::where('expair_status',1)->get()->count();


        $day_by_day_payment_history = payment_history::whereDate('created_at', '>', Carbon::now()->subDays(30))->get()
                            ->groupBy(function ($grouped) {
                                return $grouped->created_at->format('d');
                            });

        $day_by_day_sales_history = technician_device_stock::whereDate('created_at', '>', Carbon::now()->subDays(30))->get()
                            ->groupBy(function ($grouped) {
                                return $grouped->created_at->format('d');
                            });

        $schedule = Billing_shedule::whereDate('date', Carbon::today())->get();

        return view('backend.dashboard',compact('order','registered_user','total_collected_amount','day_by_day_payment_history','day_by_day_payment_history','day_by_day_sales_history','total_device_sale','schedule','today_collected_bill','total_due_user','total_expair_user','total_device_sale_tk'));
    }


    public function blank()
    {
        return view('backend.blank');
    }

    public function home_page_banner()
    {
        $home = HomePageModel::latest()->get();
        return view('backend.add_home_page_banner',compact('home'));
    }

    public function home_page_banner_save(Request $request)
    {
        $image = $request->file('cover_image');
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('home_cover'))
            {
                Storage::disk('public')->makeDirectory('home_cover');
            }

            $moveImage = Image::make($image)->stream();;
            Storage::disk('public')->put('home_cover/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }


        $home_page = new HomePageModel();
        $home_page->cover_image = $imageName;
        $home_page->animated_text = $request->animated_text;
        $home_page->small_text = $request->cover_small_text;
        $home_page->save();

        Toastr::success('save Successfully :)','Success');
        return redirect()->back();


    }

    public function home_page_banner_delete($id)
    {
        $home = HomePageModel::findOrfail($id);
         if (Storage::disk('public')->exists('home_cover/'.$home->cover_image))
        {
            Storage::disk('public')->delete('home_cover/'.$home->cover_image);
        }
        $home->delete();
        Toastr::success('Post Successfully Deleted :)','Success');
        return redirect()->back();
    }




    //happy client
    public function happy_client()
    {
        $client = HappyClient::all();
        return view('backend.add_happy_client',compact('client'));
    }

    public function happy_client_save(Request $request)
    {
        $image = $request->file('image');
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('happy_client'))
            {
                Storage::disk('public')->makeDirectory('happy_client');
            }

            $moveImage = Image::make($image)->resize(95,67)->stream();
            Storage::disk('public')->put('happy_client/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }

        $client = new HappyClient();
        $client->image = $imageName;
        $client->save();

        Toastr::success('save Successfully :)','Success');
        return redirect()->back();
    }

    public function happy_client_delete($id)
    {
        $home = HappyClient::findOrfail($id);
         if (Storage::disk('public')->exists('happy_client/'.$home->image))
        {
            Storage::disk('public')->delete('happy_client/'.$home->image);
        }
        $home->delete();
        Toastr::success('Successfully Deleted :)','Success');
        return redirect()->back();
    }



    //    services

    public function add_services()
    {
        $service = service::all();
        return view('backend.add_service',compact('service'));
    }

    public function add_services_save(Request $request)
    {
        $image = $request->file('image');
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('service'))
            {
                Storage::disk('public')->makeDirectory('service');
            }

            $moveImage = Image::make($image)->resize(200,200)->stream();;
            Storage::disk('public')->put('service/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }

        $service = new service();
        $service->image = $imageName;
        $service->title = $request->title;
        $service->description = $request->description;
        $service->save();

        Toastr::success('save Successfully :)','Success');
        return redirect()->back();
    }



    public function service_delete($id)
    {
        $home = service::findOrfail($id);
         if (Storage::disk('public')->exists('service/'.$home->image))
        {
            Storage::disk('public')->delete('service/'.$home->image);
        }
        $home->delete();
        Toastr::success('Successfully Deleted :)','Success');
        return redirect()->back();
    }



//demo

public function add_demo()
{
    $demo = Demo::all();
    return view('backend.demo',compact('demo'));
}

public function demo_save(Request $request)
{
    $image = $request->file('image');
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('demo'))
            {
                Storage::disk('public')->makeDirectory('demo');
            }

            $moveImage = Image::make($image)->resize(556,693)->stream();;
            Storage::disk('public')->put('demo/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }

        $demo = new Demo();
        $demo->image = $imageName;
        $demo->link = $request->link;
        $demo->save();

        Toastr::success('save Successfully :)','Success');
        return redirect()->back();
}


public function demo_delete($id)
{
    $home = Demo::findOrfail($id);
         if (Storage::disk('public')->exists('demo/'.$home->image))
        {
            Storage::disk('public')->delete('demo/'.$home->image);
        }
        $home->delete();
        Toastr::success('Successfully Deleted :)','Success');
        return redirect()->back();
}


//team
public function team()
{
    $team = Team::all();
    return view('backend.team',compact('team'));
}

public function team_save(Request $request)
{
    $image = $request->file('image');
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('team'))
            {
                Storage::disk('public')->makeDirectory('team');
            }

            $moveImage = Image::make($image)->resize(270,348)->stream();;
            Storage::disk('public')->put('team/'.$imageName,$moveImage);

        } else {
            $imageName = "default.png";
        }

        $demo = new Team();
        $demo->image = $imageName;
        $demo->name = $request->name;
        $demo->designation = $request->designation;
        $demo->fb_link = $request->fb_link;
        $demo->skipe_link = $request->skipe_link;
        $demo->save();

        Toastr::success('save Successfully :)','Success');
        return redirect()->back();
}


public function team_delete($id)
{
    $home = Team::findOrfail($id);
         if (Storage::disk('public')->exists('team/'.$home->image))
        {
            Storage::disk('public')->delete('team/'.$home->image);
        }
        $home->delete();
        Toastr::success('Successfully Deleted :)','Success');
        return redirect()->back();
}


public function contact()
{
    $contact = Contact_info::all()->first();
    return view('backend.contact',compact('contact'));
}

public function contact_save(Request $request)
{
    $contact = new Contact_info();
        $contact->address = $request->address;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->header_phone_1 = $request->header_phone_1;
        $contact->header_phone_2 = $request->header_phone_2;
        $contact->header_phone_3 = $request->header_phone_3;
        $contact->save();

        Toastr::success('save Successfully :)','Success');
        return redirect()->back();
}


public function contact_delete($id)
{
    $home = Contact_info::findOrfail($id);
        $home->delete();
        Toastr::success('Successfully Deleted :)','Success');
        return redirect()->back();
}



public function sub_admins()
{
    $user = User::where('role',3)->orwhere('role',0)->where('type','sub_admin')->get();

    return view('backend.sub_admin',compact('user'));
}

public function sub_admins_approve($id)
{
    $user = User::find($id);

    if ($user->role == 3)
    {
        $user->role = 0;
        $user->update();
        Toastr::success('Sub admin Active Successfull','Success');
        return redirect()->back();
    }
    elseif($user->role == 0)
    {
        $user->role = 3;
        $user->update();
        Toastr::success('Sub admin Deactive Successfull','Success');
        return redirect()->back();
    }
}






}
