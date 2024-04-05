<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Traits\ApiResponder;

class DoctorController extends Controller
{
    use ApiResponder;
///////////////البحث عن دكتور معين////////////////////////////////////
    // public function search(Request $request)
    // {
    //     $Fname =$request->Fname ;

    //     if ($Fname==null)
    //     return response()->json('not found',404);

    //     $doctor = User::query()->where("Fname",$Fname)->select('id')->get();
    //     $ee =Employee::where("id",$doctor);
    //     if($ee){
    //         $eee =Employee::where("id",$doctor)->select('id')->get();
    //         $fdsv=Doctor::where("id",$eee);
    //         if($fdsv){
    //             $s = Doctor::where("id",$fdsv)->get();
    //             return response()->json($s,Response::HTTP_OK);
    //         }
    //     }
    // }

    // public function search(Request $request)
    // {
    //     $rr=User::where("Fname", "like", "%" . $request->Fname . "%")->orderby("Fname", "asc")->exists();
    //     // if ($rr) {
    //         // $qq=User::where("Fname", "like", "%" . $request->Fname . "%")->select('id')->get();
    //         // $yyy =Employee::where($qq, "=", "employee_id")->exists();
    //         // if($yyy){
    //         // $eee =Doctor::where($yyy, "=", "doctor_id")->exists();
    //         //
    //          if($rr){
    //             $result = User::where("Fname", "like", "%" . $request->Fname . "%")->orderby("Fname", "asc")->get();
    //             return $this->successResponse($result,"Search Doctor");
    //             }

    //         // }
    //     else
    //         return $this->successResponse(Null,"Not found !");
    // }


//////////////عرض كل الدكاترة//////////////////////////////////////
    public function index()
    {
        $input = Doctor::query()->get();
        return response()->json($input,Response::HTTP_OK);

    }
    // public function index()
    // {
    //     $input = Doctor::query();

    //     if (is_null($input)) {
    //         return response()->json(["msg"=>"the Doctor not found"],Response::HTTP_NOT_FOUND);
    //     }
    //     else {
    //         $in =Doctor::query()->with('user')->get();
    //         return response()->json(["msg" => "the data Doctor is", $in]);
    //     }
    // }

/////////////نريد ربط الدكتور مع العيادة //إضافة دكتور عن طريق الادمن الذي معرفه 1/////////////
    public function addDoctor(Request $request)
    {
        $rule=[
            "Fname" => "required",
            "Lname" => "required",
            "email" => "required|email",
            "password" => "required|min:8",
            "description" => "required",
            "work_day" => "required",
            "start_time" => "required",
            "end_time" => "required",
            "clinic_id"=>"required"
        ];
        $validate =Validator::make($request->all(),$rule);
        if($validate->fails())
        {
            return response()->json($validate->errors()->all(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        // create data
        $doctor = new Doctor();
        $doctor->Fname = $request->Fname;
        $doctor->Lname = $request->Lname;
        $doctor->email = $request->email;
        $doctor->password = bcrypt($request->password);
        $doctor->description = $request->description;
        $doctor->work_day = $request->work_day;
        $doctor->start_time = $request->start_time;
        $doctor->end_time = $request->end_time;
        $doctor->save();

        return response()->json(["msg" => "the doctor created", "data" => $doctor]);
    }

/////////////////////عرض صفحة دكتور محدد////////////////////////////
    public function show($id)
    {
        $in=Doctor::query()->find($id);
        if (is_null($in)) {
            return response()->json(["msg"=>"Doctor not found"]);
        }
        $doctor_data = $in->get();

        return response()->json([
            "status" => true,
            "message" => "Doctor data",
            "data" => $in
        ]);
    }

///////////////تحديث معلومات دكتور معين مسموح فقط للادمن ذو المعرف 1////////////
    public function update(Request $request,$id)
    {
        $i=Doctor::query()->find($id);
        if (is_null($i)) {
            return response()->json(["msg"=>"the patiant not found"],Response::HTTP_NOT_FOUND);}
        $tt =Auth::id();
        if($tt==1){
        $rule=[
            "Fname" => "required",
            "Lname" => "required",
            "description" => "required",
            "work_day" => "required",
            "start_time" => "required",
            "end_time" => "required",
        ];
        $validate =Validator::make($request->all(),$rule);
        if($validate->fails())
        {
            return response()->json($validate->errors()->all(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $Fname = $request->Fname;
        $Lname = $request->Lname;
        $description = $request->description;
        $work_day = $request->work_day;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $doctor =Doctor::query()->find($id)->update([
            'Fname'=>$Fname,
            'Lname'=>$Lname,
            'description'=>$description,
            'work_day'=>$work_day,
            'start_time'=>$start_time,
            'end_time'=>$end_time,
        ]);

        return response()->json(["msg" => "the doctor updated", "data" => $doctor]);

    }
    else{
        return response()->json(["msg"=>"you dont have Permissions"],Response::HTTP_FORBIDDEN);
        }
    }

///////////////////حذف دكتور مسموح للادمن ذو المعرف 1//////////////////////
    public function destroy($id)
    {
        $in=Doctor::query()->find($id);
        if (is_null($in)) {
            return response()->json(["msg"=>"Doctor not found"]);
        }
        if (Auth::id()!=1) {
            return response()->json(["msg" => "you dont have the Permissions"]);
        }
        $input=Doctor::query()->find($id)->delete();

      return response()->json($input,Response::HTTP_NO_CONTENT);

    }
}


    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//     use App\Models\Product;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\Validator;
// use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Carbon;

// class ProductController extends Controller
// {





//     public function addDoctor(Request $request,Product $product)
//     {

//         $validator=Validator::make( $request->all(),[
//             'name'=>['required','min:3','max:22',Rule::unique('products','name')],
//             'price',
//           'exp_date'=>'required',
//             'description'=>'required',
//             'img_url','quantity',
//              'category_id'
//         ]);
//         if ($validator->fails()){
//             return response()->json($validator->errors()->all(),Response::HTTP_UNPROCESSABLE_ENTITY);
//         }
//         $name= $request->name ;
//         $price =$request->price ;
//         $exp_date=$request->exp_date ;
//         $description=$request->description ;
//         $img_url=$request->img_url ;
//         $quantity=$request->quantity ;
//         $category_id=$request->category_id ;
//        $input=Product::query()->create([
//            'name'=>$name,
//            'price'=>$price,
//            'exp_date'=>$exp_date,
//            'description'=>$description,
//            'img_url'=>$img_url,
//            'quantity'=>$quantity,
//            'category_id'=>$category_id,
//            'owner_id'=>Auth::id()
//        ]);

//        foreach ($request->list_discounts as $discount){
//            $input->discounts()->create([
//                'date'=>$discount['date'],
//                'discount_percentage'=>$discount['discount_percentage'],
//            ]);
//        }
//         return response()->json($input,Response::HTTP_CREATED);


//     }


//     public function show(Product $product,$in)
//     {
//         $input = Product::query()->find($in);
//         if (is_null($input)) {
//             return response()->json(["msg"=>"product not found"]);
//         }

//         $discounts=$input->discounts()->get();
//         $maxDiscount=null;
//         foreach ($discounts as $discount){
//             if(Carbon::parse($discount['date'])<=now()){
//                 $maxDiscount=$discount;
//             }
//         }
//         if (!is_null($maxDiscount)){
//             $discount_value=($input->price*$maxDiscount['discount_percentage'])/100;
//             $input['current_price']=$input->price-$discount_value;
//         }
//         $input->increment('views');
//         return response()->json($input);
//         //لتسجيل عدد المشاهدات
//     }


//     public function update(Request $request, Product $product,$in)
//     {
//         $validator=Validator::make( $request->all(),[
//             'name'=>['required','min:3','max:22'],
//             'price',
//             'exp_date'=>'required',
//             'description'=>'required',
//             'img_url','quantity',
//             'category_id'
//         ]);
//         if ($validator->fails()){
//             return response()->json($validator->errors()->all(),Response::HTTP_UNPROCESSABLE_ENTITY);
//         }
//         $name= $request->name ;
//         $price =$request->price ;
//         $exp_date=$request->exp_date ;
//         $description=$request->description ;
//         $img_url=$request->img_url ;
//         $quantity=$request->quantity ;
//         $category_id=$request->category_id ;
//         $input=Product::query()->find($in);
//         if (is_null($input)) {
//             return response()->json(["msg"=>"product not found"]);
//         }

//         if ($input->owner_id !=Auth::id()) {
//             return response()->json(["msg" => "you dont have the product"]);
//         }
//         $input=Product::query()->find($in)->update([
//             'name'=>$name,
//             'price'=>$price,
//              'exp_date'=>$exp_date,
//             'description'=>$description,
//             'img_url'=>$img_url,
//             'quantity'=>$quantity,
//             'category_id'=>$category_id
//         ]);
//        $test=[ 'name'=>$name,
//             'price'=>$price,
//             'exp_date'=>$exp_date,
//             'description'=>$description,
//             'img_url'=>$img_url,
//             'quantity'=>$quantity,
//            'category_id'=>$category_id
//        ];
//        // return response()->json($test,Response::HTTP_OK,["msg"=>"product updated"]);
//         return response()->json(["msg"=>"product updated","data"=>$test]);
//     }

//     public function destroy(Product $product,$in)
//     {
//         $input=Product::query()->find($in);
//         if (is_null($input)) {
//             return response()->json(["msg"=>"product not found"]);
//         }
//         if ($input->owner_id !=Auth::id()) {
//             return response()->json(["msg" => "you dont have the product"]);
//         }
//         $input=Product::query()->find($in)->delete();

//       return response()->json($input,Response::HTTP_NO_CONTENT);

//     }

//     ///////////////////////////////////////////////////////////////

//     public function index(Request $request,Product$product)
//     {
//        $comments=$product->comments()->get();
//        return response()->json($comments);
//     }
//     public function store(Request $request,Product$product)
//     {
//         $request->validate(['value'=>['required','string','min:1','max:400']]);
//         $comment=$product->comments()->create([
//             'value'=>$request->value,
//             'owner_id'=>Auth::id()
//         ]);
//         return response()->json($comment);
//     }
//     public function update(Request $request,Product$product,User$user)
//     {
//         $request->validate(['value'=>['required','string','min:1','max:400']]);

//         $input=$product->comments()->find($user);

//      /*   if ($input->owner_id !=Auth::id()){
//             return response()->json(["msg"=>"you dont have the comment"]);
//         }*/

//         $s=$product->comments()->update([
//             'value'=>$request->value,
//             'owner_id'=>Auth::id()
//         ]);
//         return response()->json($s);
//     }
//     public function destroy(Request $request ,Product $product,$id)
//     {
//        // $comments=$product->comments()->get();
//         $comments=$product->comments()->delete();
//         return response()->json($comments,Response::HTTP_NO_CONTENT);
//     }

//     ////////////////////////////////////////////////////

//     public function index(Request $request, Product $product)
//     {
//         $likes = $product->likes()->get();
//         return response()->json($likes);
//     }


//     public function store(Request $request, Product $product)
//     {
//         if ($product->likes()->where('owner_id', Auth::id())->exists()) {
//             $product->likes()->where('owner_id', Auth::id())->delete();
//         } else {
//             $product->likes()->create([
//                 'owner_id' => Auth::id()
//             ]);
//         }
//         return response()->json(null);
//     }


