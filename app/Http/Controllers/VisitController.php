<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Doctor;
use App\Models\Patiant;
use App\Models\Treatment;
use Illuminate\Http\Request;
use App\Http\Resources\VisitResource;
use Illuminate\Database\Eloquent\Collection;

use App\Http\Requests\StoreVisitsRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateVisitsRequest;
use Illuminate\Validation\Rule;

////////////////////
////////////////////////
/* don't forget to make a Visit store and update Request*/

///////////////////////////

class VisitController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    //
        //$input = Visit::query()->get();
        // Visit::with('Patiant','Clinic',)->get();

        $visits = Visit::query()->with(
            ['Doctor' => function ($query) {
                $query->select('*');
            },
            'Patiant' => function ($query) {
                $query->select('*',);
            },

            'Treatment' => function ($query) {
                $query->select('*',);
            },
        ],)->get();

        return response()->json(
            [
                "message" => "All visits data",
                "data :" => VisitResource::collection($visits)
            ],
            200
        );
    }

    //  public function index()
    //     {

    //         $employees = User::wherehas('Employee')->with('Employee')->paginate(10);
    //         // return EmployeeResource::collection($employees);
    //         return $this->successResponse( $employees,"All Employee");
    //     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dateSearch($date)
    {
        //
        return Visit::where("date", "like", "%" . $date . "%")->get();
    }

    public function noteSearch($note)
    {
        //
        return Visit::where("notes", "like", "%" . $note . "%")->get();
    }

    public function daySearch($day)
    {
        //
        return Visit::where("day", "like", "%" . $day . "%")->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoressVisitsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [

            "notes" => "required",
            "Date" => "required",
            "time" => "required",
            //  "Day" => "required",
            'Day' => [
                'required',
                Rule::in([
                    'Sunday', 'Monday',
                    'Tuesday', 'Wednesday', 'Thursday',
                    'Friday', 'Saturday',
                ])
            ],

            "clinic_id"    => "required | integer",
            "doctor_id"    => "required | integer",
            "patiant_id"   => "required | integer",
            "treatment_id" => "required | integer",
        ]);
        /* this will give an Error
            "treatment_id" => "require",
                                                     */
        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $visit = new Visit;
        $visit->notes = $request->notes;
        $visit->Day = $request->Day;
        $visit->Date = $request->Date;
        $visit->time = $request->time;

        $visit->clinic_id = $request->clinic_id;
        $visit->doctor_id = $request->doctor_id;
        $visit->patiant_id = $request->patiant_id;
        $visit->treatment_id = $request->treatment_id;

        if ($visit->save()) {

            return response()->json(
                [
                    "message" => "All visits data are Validated and saved",
                    "data :" => new VisitResource($visit)
                ],
                200
            );
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visit  $visits
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        // $employee = Employee::findOrFail($id);
        // return new EmployeeResource($employee) ;

         $visit = Visit::findOrFail($id);

        return response()->json(
            [
                "message" => "The visit with the id $id data is :",
                "data :" =>new VisitResource($visit)
                    ],
            200);

    // $visits = Visit::query()->with(
    //     ['Doctor' => function ($query) {
    //         $query->select('id', 'employee_id', 'Clinic_id');
    //     }],

    //     ['Patiant' => function ($query) {
    //         $query->select('id', 'user_id',);
    //     }],

    //     ['Treatment' => function ($query) {
    //         $query->select('id',);
    //     }],
    // )->get();


}



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visit  $visits
     * @return \Illuminate\Http\Response
     */
    public function edit(Visit $visits)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVisitsRequest  $request
     * @param  \App\Models\Visit  $visits
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [

            "notes" => "required",
            "Date" => "required",
            "time" => "required",
            //  "Day" => "required",
            'Day' => [
                'required',
                Rule::in([
                    'Sunday', 'Monday',
                    'Tuesday', 'Wednesday', 'Thursday',
                    'Friday', 'Saturday',
                ])
            ],

            "clinic_id"    => "required | integer",
            "doctor_id"    => "required | integer",
            "patiant_id"   => "required | integer",
            "treatment_id" => "required | integer",
        ]);
        /* this will give an Error
            "treatment_id" => "require",
                                                     */
        if ($validator->fails()) {
            return $validator->errors()->all();
        }
        $visit = visit::findOrFail($id);

        $visit->notes = $request->notes;
        $visit->Day = $request->Day;
        $visit->Date = $request->Date;
        $visit->time = $request->time;

        $visit->clinic_id = $request->clinic_id;
        $visit->doctor_id = $request->doctor_id;
        $visit->patiant_id = $request->patiant_id;
        $visit->treatment_id = $request->treatment_id;


        if ($visit->save()) {
            return response()->json(
                [
                    "message" => "The update of data are Validated and saved",
                    "data :" => new VisitResource($visit)
                ],
                200
            );

        }


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visit  $visits
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $visit = Visit::findOrFail($id);

        if ($visit->delete()) {

            return response()->json(
                [
                    "message" => "The Visit Deleted Successfully",
                    "data :" => new VisitResource($visit)
                ],
                200
            );
        } else {
            return "the visit hasn't been deleted";
        }
    }
}
