<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\City;
use App\Models\Street;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Passport\Token;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Models\Communication;

class personLogController extends Controller
{
    use ApiResponder;
    // public function index()
    // {
    //     $input = User::query() ->get();
    //     return response()->json($input,Response::HTTP_OK);
    // }

    public function profile($id)
    {
        $in=User::query()->find($id);
        if (is_null($in)) {
            return response()->json(["msg"=>"User not found"]);
        }
        return response()->json([
            "status" => true,
            "message" => "User data",
            "data" => $in
        ]);
    }

    public function createAccount(Request $request)
    {
     // validation
     $validator=Validator::make($request->all(),[
        "Fname" => "required",
        "Lname" => "required",
        "email" => "required|email|unique:users",
        "password" => "required",
        "Birthday" => "required",
        "Image",
        "Gender" => "required",

    ]);
     if ($validator->fails()){
            return $validator->errors()->all();
        }
        // if ($request->has("Image")) {
        //     $file_extention=$request->Image;
        //     $file_name=time().'.'.$file_extention->extension();
        //     $path='Image';
        //     $request->Image->move($path,$file_name);

        //     $image=asset($path.$file_name);
        // }
    // create data
    $person = new User();
   // $person->Role_id = 1;
    $person->Fname = $request->Fname;
    $person->Lname = $request->Lname;
    $person->email = $request->email;
    $person->password = bcrypt($request->password);
    $person->Birthday = $request->Birthday;
   // ($request->has("Image"))?$person->image=$image:0;
    $person->Image = $request->Image;
    $person->Gender = $request->Gender;
    $person->Address = $request->address;
     $person->save();

     $tokenResult = $person->createToken('Personal Access Token');

     $data["user"] = $person;
     $data["token_type"] = 'Bearer';
     $data["access_token"] = $tokenResult->accessToken;


    return $this->successResponse($data,"user data");

    }
    function Address(Request $request){
        $id = $request->user()->id;
        $Country=new Country();
        $Country->Country = $request->Country;
        $Country->id=$id;
        $Country->save();
        $City=new City();
        $City->City = $request->City;
        $Country->Cities()->save($City);
        $Street=new Street();
        $Street->street=$request->street;
    }
    function Communication(Request $request)
    {
        $id = $request->user()->id;
        $comm=new Communication();
        $comm->name_way=$request->name_way;
        $comm->identaty=$request->identaty;
        $comm->user_id=$id;

    }
    public function login(Request $request)
    {
        // validation
        $login_data = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        // validate author data
        if(!auth()->attempt($login_data)){

            return response()->json([
                "status" => false,
                "message" => "Invalid Credentials"
            ]);
        }

        // token
        $token = auth()->user()->createToken("auth_token")->accessToken;

        // send response
        return $this->successResponse( $token,"Logged in successfully");

    }
    public function logout(Request $request)
    {
        // get token value
        $token = $request->user()->token();

        // revoke this token value
        $token->revoke();
        return $this->successResponse(null,"logged out successfully");

    }

    /////////////////////////search////////////////////////

    public function search(Request $request)
    {
        if (User::where("Fname", "like", "%" . $request->Fname . "%")->orderby("Fname", "asc")->exists()) {
            $result = User::where("Fname", "like", "%" . $request->Fname . "%")->orderby("Fname", "asc")->get();
            return $this->successResponse($result,"Search User");
        }
        else
        return $this->successResponse(Null,"Not found !");
    }


    /////////////////////////////////////////////////////////////////////////////

    public function update(Request $request)
    {
        $User=User::find($request->id);
        isset($request->Fname)==true?($User->Fname=$request->Fname):0;
        isset($request->Lname)==true?($User->Lname=$request->Lname):0;
        isset($request->email)==true?($User->email=$request->email):0;
        isset($request->password)==true?($User->password=$request->password):0;
        isset($request->Barthday)==true?($User->Barthday=$request->Barthday):0;
        isset($request->Gender)==true?($User->Gender=$request->Gender):0;
       //image update
        if ($request->has("Image")) {
            $file_extention=$request->image;
            $file_name=time().'.'.$file_extention->extension();
            $path='Image';
            $request->image->move($path,$file_name);
            $User->image=$file_name;
        }

        //save data


        //send response
        return $this->successResponse(null,"user Updated");





    }
}
