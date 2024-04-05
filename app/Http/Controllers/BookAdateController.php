<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Support\Responsable;
use App\Models\BookAdate;
use App\Models\Date;
use App\Models\Patiant;
use App\Models\User;
use Carbon\Carbon;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookAdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_date = Carbon::now()->format('d-m');
        return response()->json( $current_date,);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $rule=[
            "date" => "required",
            "time" => "required",
            "doctor_id" => "required",
            "clinic_id" => "required",
            "patiant_id" => "required",
        ];
        $validate =Validator::make($request->all(),$rule);
        if($validate->fails())
        {
            return response()->json([
                $validate->errors()->all()
             ]);
        }
        $date= $request->date ;
        $time= $request->time ;
        $doctor_id= $request->doctor_id ;
        $clinic_id= $request->clinic_id ;
        $patiant_id= $request->patiant_id ;

        // if ($time<1||$time>24) {
        //     return response()->json([
        //        "wrong inpot !"
        //      ]);
        // }
        // if ($time<6||$time>18) {
        //     return response()->json([
        //        "the clinic is close sorry"
        //      ]);
        // }
        $check=BookAdate::query()
        ->where('date','=', $date)
        ->where('time','=', $time)
        ->where('doctor_id','=', $doctor_id)
        ->where('clinic_id','=', $clinic_id)->exists();
        if ($check) {
            return response()->json([
                "the date is detained"
            ]);
        }

        $current_date = Carbon::now()->format('y-m-d');
        //return $current_date;
        $pp = Carbon::parse($date)->format('y-m-d');
        if ($pp<=$current_date) {
            return response()->json([
            "not available !"
            ]);}
        // $patiant_id =Patiant::query()->where('id',Auth::id())->value('id');
        $input=BookAdate::query()->create([

            'date'=>$date,
            'time'=>$time,
            'doctor_id'=>$doctor_id,
            'clinic_id'=>$clinic_id,
            'patiant_id'=>$patiant_id,

        ]);

        return response()->json( $input,);
    }

    public function update(Request $request, $id)
    {
        $input=BookAdate::query()->find($id);
        // if (!Auth::id()) {
        //     return response()->json(["msg" => "you dont have the date"]);
        // }
        if (is_null($input)) {
            return response()->json(["msg"=>"the date not found"],Response::HTTP_NOT_FOUND);
        }
        $rule=[
            "date" => "required",
            "time" => "required",
            "doctor_id" => "required",
            "clinic_id" => "required",
            "patiant_id" => "required",

        ];
        $validate =Validator::make($request->all(),$rule);
        if($validate->fails())
        {
            return response()->json([
                $validate->errors()->all()
             ]);
        }
        $date= $request->date ;
        $time= $request->time ;
        $doctor_id= $request->doctor_id ;
        $clinic_id= $request->clinic_id ;
        $patiant_id= $request->patiant_id ;

        // if ($time<6&&$time>18) {
        //     return response()->json([
        //        " the clinic is close sorry"
        //      ]);
        // }
        $check=BookAdate::query()
        ->where('date','=', $date)
        ->where('time','=', $time)
        ->where('doctor_id','=', $doctor_id)
        ->where('clinic_id','=', $clinic_id)->exists();
        if ($check) {
            return response()->json([
                "the date is detained "
        ]);
        }

        $current_date = Carbon::now()->format('d-m-Y');
        $pp = Carbon::parse($date)->format('d-m-Y');
        if ($pp<=$current_date) {
            return response()->json([
            " not available !"
            ]);}
        // $patiant_id =User::query()->where('id',Auth::id())->value('id');
        $input=BookAdate::query()->find($id)->update([

            'date'=>$date,
            'time'=>$time,
            'doctor_id'=>$doctor_id,
            'clinic_id'=>$clinic_id,
            'patiant_id'=>$patiant_id,

        ]);

        return response()->json( $input,);
    }}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

