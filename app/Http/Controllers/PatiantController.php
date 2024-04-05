<?php

namespace App\Http\Controllers;

use App\Models\Patiant;
use App\Models\Doctor;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PatiantController extends Controller
{
//////////////////////////////////////////////////////////////////////
    function get_patiant_dates( $id)///////////////عرض مواعيد مريض محدد
    {
        $w =Patiant::find($id);
        $ww =$w->dates;
        return  $ww;
    }
//////////////////////////////////////////////////////////////////////
    //عرض المرضى كلهم////
    public function index()
    {
        $input = Patiant::query();

        if (is_null($input)) {
            return response()->json(["msg"=>"the patiant not found"],Response::HTTP_NOT_FOUND);
        }
        else {
            $in =Patiant::query()->with('user')->get();
            return response()->json(["msg" => "the data patiant is", $in]);
        }
    }

    ////////////نريد ربط المريض مع الدكتور والعيادة//إضافة مريض
    public function addPatiant(Request $request)
    {
        $rule=[
            "name" => "required",
            "email" => "required",
            "phone" => "required|Digits:9",
            "doctor_id" => "required",
            "clinic_id" => "required",
            "description" => "required",
        ];
        $validate =Validator::make($request->all(),$rule);
        if($validate->fails())
        {
            return response()->json([
                $validate->errors()->all()
             ]);
        }

        $name= $request->name ;
        $email= $request->email ;
        $weigh= $request->weigh ;
        $phone= $request->phone ;
        $doctor_id= $request->doctor_id ;
        $clinic_id= $request->clinic_id ;
        $description= $request->description ;
        $t=User::query()->orderBy('id','desc')->first();
        $n=$t->id;

        $input=Patiant::query()->create([
            'email'=>$email,
            'name'=>$name,
            'weigh'=>$weigh,
            'phone'=>$phone,
            'doctor_id'=>$doctor_id,
            'clinic_id'=>$clinic_id,
            'description'=>$description,
            'user_id'=>$n,

        ]);
        $token =$t->createToken('Personal Access Token');
        $data["input"]=$input;
        $data["token_type"]='Bearer';
        $data["access_token"]=$token->accessToken;
        return response()->json($data,Response::HTTP_OK);

    }

////////////مطلوب ربط المريض مع الدكتور والعيادة//تحديث معلومات المريض
    public function update(Request $request,  $id)
    {
        $input=Patiant::query()->find($id);
        if (is_null($input)) {
            return response()->json(["msg"=>"the patiant not found"],Response::HTTP_NOT_FOUND);
        }
        $rule=[
            "name" => "required",
            "phone" => "required|Digits:9",
            "doctor_id" => "required",
            "clinic_id" => "required",
            "description" => "required",
        ];
        $validate =Validator::make($request->all(),$rule);
        if($validate->fails())
        {
            return response()->json([
                $validate->errors()->all()
             ]);
        }
        $name= $request->name ;
        $weigh= $request->weigh ;
        $phone= $request->phone ;
        $doctor_id= $request->doctor_id ;
        $clinic_id= $request->clinic_id ;
        $description= $request->description ;
        $t=User::query()->orderBy('id','desc')->first();
        $n=$t->id;

        $input=Patiant::query()->find($id)->update([
            'name'=>$name,
            'weigh'=>$weigh,
            'phone'=>$phone,
            'doctor_id'=>$doctor_id,
            'clinic_id'=>$clinic_id,
            'description'=>$description,
            'user_id'=>$n,

        ]);
        return response()->json(["msg" => "the patiant updated", "data" => $input]);
    }


    ///////////////عرض صفحة مريض معين
    public function profile($id)
    {
        $input = Patiant::query()->find($id);

        if (is_null($input)) {
            return response()->json(["msg"=>"the patiant not found"],Response::HTTP_NOT_FOUND);
        }
        else {
            $rrr= Patiant::query()->find($id);
            $rrr->user;
            return response()->json(["msg" => "the data patiant is",$rrr]);
        }
    }

/////////////البحث عن مريض عن طريق الاسم
    public function search(Request $request)
    {
        $name =$request->name ;
        $user = Patiant::query();
        if ($name==null)
        return response()->json('not found',404);

        $s = $user->get();
        return response()->json($s,Response::HTTP_OK);
    }
}
