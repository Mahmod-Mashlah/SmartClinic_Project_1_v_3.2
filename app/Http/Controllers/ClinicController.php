<?php
namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\User;
use App\Models\Doctor;
use App\Traits\ApiResponder;
use App\Models\Clinic_Date;
class ClinicController extends Controller
{
    use ApiResponder;
/////////////////////جديد وائل///////////////////////////////////////////////////////////////

    function get_clinic_doctors( $id)///////////////عرض دكاترة عيادة محددة
    {
       $clinic =Clinic::find($id);
       $clinicDoctors =$clinic->doctors;
        return  $clinicDoctors;
    }

    function get_clinic_patiants( $id)///////////////عرض مرضى عيادة محددة
    {
       $clinic =Clinic::find($id);
       $clinicPatiants =$clinic->patiants;
        return  $clinicPatiants;
    }

    public function show($id) /////////////////////////عرض معلومات عيادة محددة
    {
        $in=Clinic::query()->find($id);
        if (is_null($in)) {
            return response()->json(["msg"=>"Clinic not found"]);
        }
        return response()->json([
            "status" => true,
            "message" => "Clinic data",
            "data" => $in
        ]);
    }

    public function index()//////////////عرض كل العيادت
    {
        $input = Clinic::query()->get();
        return response()->json($input,Response::HTTP_OK);
    }

    public function search(Request $request)//////////////البحث عن عيادة
    {
        $name =$request->name ;
        if ($name==null)
        return response()->json('not found',404);
        $ee = Clinic::query()->where('name',$name)->get();
        //$s = $ee->get();
        return response()->json($ee,Response::HTTP_OK);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////
    function Add_Clinc(request $request)
    {
        $user = $request->user();
        $role = Role::where('id', $user->role_id)->first();

       $Clinic =new Clinic();
       $Clinic->name = $request->name;
       $Clinic->specialize=$request->specialize;

       $id=$Clinic->id;


    }
    function Get_Doctor(){

        $Doctor=User::where('Clinic_id','=',null)->Employee()->Doctor()->get();

        return $this->successResponse($Doctor,"");
    }
    function Add_Doctor(request $request){

        foreach($request as $id_Doctor){
          $D=Doctor::where('id','=',$id_Doctor);
          $D->Clinic_id=$request->Clinic_id;
        }
        return $this->successResponse(null,"successfully");

    }
    function Get_Clinic(){
        $Clinic=Clinic::with('Clinic_Dates')->get();
        return $this->successResponse($Clinic,"");
    }
    function Add_Schedule_Clinic(request $request){

        $Clinic_Date = new Clinic_Date();
        $Clinic_Date->Day = $request->Day;
        $Clinic_Date->startHour = $request->startHour;
        $Clinic_Date->EndHour = $request->EndHour;
        $Clinic_Date->Date = $request->Date;
        $Clinic_Date->clinic_id = $request->clinic_id;
        return $this->successResponse(null,"successfully");


    }
    function Delete_Schedule_Clinic(request $request){
        $id=$request->id;
        Clinic_Date::where('id','=',$id)->Delete();
        return $this->successResponse(null,"successfully");
    }
    function Update_Scheduled_Date(request $request){
        $id=$request->id;
        $product=Clinic_Date::find($id);
        isset($request->Day)==true?($product->Day=$request->Day):0;
        isset($request->startHour)==true?($product->startHour=$request->startHour):0;
        isset($request->EndHour)==true?($product->EndHour=$request->EndHour):0;
        return $this->successResponse(null,"successfully");

    }
function Update_Clinic(request $request){
        $id=$request->id;
        $product=Clinic_Date::find($id);
        isset($request->name)==true?($product->name=$request->name):0;
        isset($request->specialize)==true?($product->specialize=$request->specialize):0;
        return $this->successResponse(null,"successfully");

}

function Search_Clinic(request $request){
    $R=Clinic::where('name', 'like', '%' . $request->name . '%')->get();
    return $this->successResponse( $R,"successfully");
}
}
