<?php

namespace App\Http\Controllers;
//use App\
use App\Models\UserDetail;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo "hi";
        // exit();
        $userdetail = UserDetail::select('user_details.*')
         
            // ->LeftJoin('countries', 'countries.id', '=', 'user_details.Country')
            //  ->LeftJoin('states', 'states.id', '=', 'user_details.State')
            //   ->LeftJoin('cities', 'cities.id', '=', 'user_details.City')
             ->get();
                 $countries = DB::table("countries")->get();
               $states = DB::table("states")
               ->get();
               $cities = DB::table("cities")
                ->get();
                //echo "<pre>";print_r($userdetail->countries.c_name);exit;
             $userdetail = UserDetail::latest()->paginate(10);
            
          return view('user.index',compact('userdetail','countries','states','cities'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $countries = DB::table("countries")->get();
            return view('user.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $images = $request->file('Image');

        $new_image = rand() . '.' . $images->getClientOriginalExtension();
        $images->move(public_path('upload'), $new_image);
        $user_data = array(
             'FirstName'       =>   $request->FirstName,
             'LastName'      =>   $request->LastName,
             'UserName'      =>   $request->UserName,
             'Email'         =>   $request->Email,
             'password' => Hash::make($request->password),
             'Phone'      =>   $request->Phone,
             'Address'      =>   $request->Address,
             'Country'      =>   $request->Country,
             'State'      =>   $request->State,
             'City'      =>   $request->City,
             'ZipCode'      =>   $request->ZipCode,
             'Gender'      =>   $request->Gender,
             'Hobbies'      =>   implode(",",$request->Hobbies),
             'Image'     =>   $new_image
             

        );

        UserDetail::create($user_data);
        return redirect()->route('users.index')
                        ->with('success', 'user created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Userdatalist = UserDetail::find($id);
        return view('user.show', compact('Userdatalist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_userdetail = UserDetail::find($id);
        $user_hobby = explode(",",$edit_userdetail->Hobbies);
        $countries = DB::table("countries")->get();
        $states = DB::table("states")
            ->get();
        $cities = DB::table("cities")
            ->get();
        return view('user.edit', compact('edit_userdetail','user_hobby','countries','states','cities'));
   
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
        $image_name = $request->hidden_image;
        $image_data = $request->file('Image');
        if($image_data != '')
        {
            

            $image_name = rand() . '.' . $image_data->getClientOriginalExtension();
            $image_data->move(public_path('upload'), $image_name);
        }
        else
        {
            
        
         }
        $user_data = array(
             'FirstName'       =>   $request->FirstName,
             'LastName'      =>   $request->LastName,
             'UserName'      =>   $request->UserName,
             'Email'         =>   $request->Email,
             'password' => Hash::make($request->password),
             'Phone'      =>   $request->Phone,
             'Address'      =>   $request->Address,
             'Country'      =>   $request->Country,
             'State'      =>   $request->State,
             'City'      =>   $request->City,
             'ZipCode'      =>   $request->ZipCode,
             'Gender'      =>   $request->Gender,
             'Hobbies'      =>   implode(",",$request->Hobbies),
             'Image'     =>   $image_name
          );
          $user= UserDetail::find($id);
          $user->update($user_data);
        
        
        return redirect()->route('users.index')
                        ->with('success', 'user updated successfully');
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $User_delete = UserDetail::find($id);
        $User_delete->delete();
        return redirect()->route('users.index')
                        ->with('success', 'user deleted successfully');
    }
    public function getStateList(Request $request)
    {
         $states = DB::table("states")
            ->where("country_id",$request->country_id)
            ->pluck("s_name","id");
            return response()->json($states);
    }
    public function getCityList(Request $request)
    {
         $cities = DB::table("cities")
            ->where("state_id",$request->state_id)
            ->pluck("ci_name","id");
            return response()->json($cities);
    }
    
}
