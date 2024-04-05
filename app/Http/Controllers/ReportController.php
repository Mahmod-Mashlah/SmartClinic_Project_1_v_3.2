<?php

namespace App\Http\Controllers;

use App\Models\Lap;
use App\Models\Doctor;
use App\Models\Report;
use App\Models\Patiant;
use Illuminate\Http\Request;
use App\Http\Resources\ReportResource;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$input = Visit::query()->get();
        //return response()->json($input,Response::HTTP_OK);

        $reports = Report::paginate(100);

        $reports = Report::query()->with(
            ['Doctor' => function ($query) {
                $query->select('id', 'employee_id', 'Clinic_id');  },

                'Patiant' => function ($query) {
                    $query->select('id','Careear','weigh','description', 'user_id','clinic_id','doctor_id');},

            'Secretary' => function ($query) {
                $query->select('*');},

            'Lap' => function ($query) {
               $query->select('*'); },
            ])->get();

        return response()->json(
            [
                "message" => "All Reports data",
                "data :" => ReportResource::collection($reports)
            ],
            200
        );
    }

    public function idSearch($id)
    {
        //
        return Report::where("id","like","%".$id."%")->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validator = Validator::make($request->all(), [


            "clinic_id"    => "required | integer",
            "doctor_id"    => "required | integer",
            "patiant_id"   => "required | integer",
            "secretary_id" => "required | integer",
            "lap_id"       => "required | integer",
        ]);
        /* this will give an Error
            "treatment_id" => "require",
                                                     */
        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $report = new Report ;

        $report->clinic_id = $request->clinic_id ;
        $report->doctor_id = $request->doctor_id ;
        $report->patiant_id = $request->patiant_id ;
        $report->secretary_id = $request->secretary_id ;
        $report->lap_id = $request->lap_id ;

        if ($report->save()) {
            return response()->json(
                [
                    "message" => "All Report data are Validated and saved",
                    "data :" => new ReportResource($report)
                ],
                200);
        }
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
        $report = Report::findOrFail($id);

        return response()->json(
            [
                "message" => "The Report with the id $id data is :",
                "data :" =>new ReportResource($report)
                    ],
            200);
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
        //
        $validator = Validator::make($request->all(), [


            "clinic_id"    => "required | integer",
            "doctor_id"    => "required | integer",
            "patiant_id"   => "required | integer",
            "secretary_id" => "required | integer",
            "lap_id"       => "required | integer",
        ]);
        /* this will give an Error
            "treatment_id" => "require",
                                                     */
        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $report = Report::findOrFail($id);

        $report->clinic_id = $request->clinic_id ;
        $report->doctor_id = $request->doctor_id ;
        $report->patiant_id = $request->patiant_id ;
        $report->secretary_id = $request->secretary_id ;
        $report->lap_id = $request->lap_id ;

        if ($report->save()) {

            return response()->json(
                [
                    "message" => "The update of data are Validated and saved",
                    "data :" => new ReportResource($report)
                ],
                200
            );
        }

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
        $report = Report::findOrFail($id) ;

        if ($report->delete()) {

            return response()->json(
                [
                    "message" => "The Report  deleted Successfully",
                    "data :" => new ReportResource($report)
                ],
                200
            );
        }
        else
        { return "the report hasn't been deleted";}
    }
}
