<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;

use App\Models\Treatment;
use App\Models\Examination;
use Illuminate\Http\Request;
use App\Models\Internal_procedures;

use Illuminate\Validation\Rule;


use App\Http\Resources\DiagnosisResource;
use App\Http\Resources\TreatmentResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ExaminationResource;
use App\Http\Resources\Internal_procedureResource;
use App\Http\Resources\PrescriptionResource;
use App\Http\Resources\MedicineResource;
use App\Models\Medicine;
use App\Models\Prescription;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

///////////////////////////////////////////////////////////////////////////////
//                  Treatments المعالجة
///////////////////////////////////////////////////////////////////////////////

public function index()
{
    //
    $treatment =  Treatment::query()->with(

            ['Doctor' => function ($query) {
                $query->select('*');
            },
            'Patiant' => function ($query) {
                $query->select('*',);
            },

            'Clinic' => function ($query) {
                $query->select('*',);
            },

            'Report' => function ($query) {
                $query->select('*',);
            },
        ],)->get();


    return response()->json(
        [
            "message" => "All Treatments data is :",
            "data :" => TreatmentResource::collection($treatment)
        ],
        200
    );

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
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{
    //
    $validator = Validator::make($request->all(), [

        "treatment_date" => "required | date ",

        "clinic_id"    => "required | integer",
        "doctor_id"    => "required | integer",
        "patiant_id"   => "required | integer",
        "report_id" => "required | integer",
    ]);
    /* this will give an Error
        "treatment_id" => "require",
                                                 */
    if ($validator->fails()) {
        return $validator->errors()->all();
    }
    $treatment = new Treatment ;

    $treatment->treatment_date= $request->treatment_date ;

    $treatment->clinic_id= $request->clinic_id ;
    $treatment->doctor_id = $request->doctor_id ;
    $treatment->patiant_id = $request->patiant_id ;
    $treatment->report_id = $request->report_id ;

    if ($treatment->save()) {

        return response()->json(
            [
                "message" => "All treatments data are Validated and saved",
                "data :" => new TreatmentResource($treatment)
            ],
            200
        );
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
    $treatment = Treatment::findOrFail($id);

    return response()->json(
        [
            "message" => "The treatment with the id $id data is :",
            "data :" =>   new TreatmentResource($treatment)
                ],
        200);

}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    //
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

        "treatment_date" => "required | date ",

        "clinic_id"    => "required | integer",
        "doctor_id"    => "required | integer",
        "patiant_id"   => "required | integer",
        "report_id" => "required | integer",
    ]);
    /* this will give an Error
        "treatment_id" => "require",
                                                 */
    if ($validator->fails()) {
        return $validator->errors()->all();
    }

    $treatment = Treatment::findOrFail($id);

    $treatment->treatment_date= $request->treatment_date ;

    $treatment->clinic_id= $request->clinic_id ;
    $treatment->doctor_id = $request->doctor_id ;
    $treatment->patiant_id = $request->patiant_id ;
    $treatment->report_id = $request->report_id ;


    if ($treatment->save()) {

        return response()->json(
            [
                "message" => "The update of data are Validated and saved",
                "data :" => new TreatmentResource($treatment)
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
    $treatment = Treatment::findOrFail($id) ;

    if ($treatment->delete()) {

        return response()->json(
            [
                "message" => "The Treatment Deleted Successfully",
                "data :" => new TreatmentResource($treatment)
            ],
            200
        );
    } else {
        return "the Treatment hasn't been deleted";
    }

}

/////////////////////////////////////////////////////////////////////////////////
//              diagnosis   التشخيص
/////////////////////////////////////////////////////////////////////////////////

    public function diagnosis_index()
    {
        //

        $diagnosis = Diagnosis::query()
        ->with(
            ['Visit' => function ($query) {
                $query->select('*');
            },
        ],)
        ->get();

        return response()->json(
            [
                "message" => "All Diagnosis data is :",
                "data :" => DiagnosisResource::collection($diagnosis)
            ],
            200
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function diagnosis_create()
    {
        //

    }

    public function nameSearch($name)
    {
        //
        return Diagnosis::where("name","like","%".$name."%")->get();
    }

    public function typeSearch($type)
    {
        //
        return Diagnosis::where("type","like","%".$type."%")->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function diagnosis_store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [

            "name" => "required",
            "type" => "required",

            "visit_id"    => "required | integer",

        ]);
        /* this will give an Error
            "treatment_id" => "require",
                                                     */
        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $diagnosis = new Diagnosis ;

        $diagnosis->name= $request->name ;
        $diagnosis->type = $request->type ;

        $diagnosis->visit_id = $request->visit_id ;

        if ($diagnosis->save()) {

            return response()->json(
                [
                    "message" => "All Diagnosis data are Validated and saved",
                    "data :" => new DiagnosisResource($diagnosis)
                ],
                200
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function diagnosis_show($id)
    {
        //
        $diagnosis = Diagnosis::findOrFail($id);

        return response()->json(
            [
                "message" => "The Diagnosis with the id $id data is :",
                "data :" =>new DiagnosisResource($diagnosis)
                    ],
            200);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function diagnosis_edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function diagnosis_update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [

            "name" => "required",
            "type" => "required",

            "visit_id"    => "required | integer",

        ]);
        /* this will give an Error
            "treatment_id" => "require",
                                                     */
        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $diagnosis = Diagnosis::findOrFail($id);

        $diagnosis->name= $request->name ;
        $diagnosis->type = $request->type ;

        $diagnosis->visit_id = $request->visit_id ;

        if ($diagnosis->save()) {

            return response()->json(
                [
                    "message" => "The update of data are Validated and saved",
                    "data :" => new DiagnosisResource($diagnosis)
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
    public function diagnosis_destroy($id)
    {
        //
        $diagnosis = Diagnosis::findOrFail($id) ;

        if ($diagnosis->delete()) {

            return response()->json(
                [
                    "message" => "The Diagnosis Deleted Successfully",
                    "data :" => new DiagnosisResource($diagnosis)
                ],
                200
            );
        }
        else
        { return " there is an error on delete";}

    }


/////////////////////////////////////////////////////////////////////////////////////
//                      examinations        التحليل (الفحوصات)
/////////////////////////////////////////////////////////////////////////////////////

public function examination_index()
{
    //



        $examination = Examination::query()->with(
            ['Doctor' => function ($query) {
                $query->select('*');
            },
            'Patiant' => function ($query) {
                $query->select('*',);
            },


        ],)->get();

        return response()->json(
            [
                "message" => "All Examinations data ",
                "data :" =>  ExaminationResource::collection($examination)
            ],
            200
        );
}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function examination_create()
{
    //
}

public function examinations_nameSearch($name)
{
    //
    return Examination::where("name","like","%".$name."%")->get();
}

public function examinations_typeSearch($type)
{
    //
    return Examination::where("type","like","%".$type."%")->get();
}
/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function examination_store(Request $request)
{
    //

    $validator = Validator::make($request->all(), [

        "name" => "required",
        "type" => "required",
        "examination_date" => "required",

        "doctor_id"    => "required | integer",
        "patiant_id"   => "required | integer",
        "clinic_id"    => "required | integer",
        "report_id"    => "required | integer",
    ]);
    /* this will give an Error
        "treatment_id" => "require", (dont forget d)
                                                 */
    if ($validator->fails()) {
        return $validator->errors()->all();
    }

    $examination = new Examination ;

    $examination-> name= $request->name ;
    $examination-> type= $request->type ;
    $examination-> examination_date= $request->examination_date ;

    $examination-> clinic_id= $request->clinic_id ;
    $examination-> doctor_id= $request->doctor_id ;
    $examination-> patiant_id= $request->patiant_id ;
    $examination-> report_id= $request->report_id ;

    if ($examination->save()) {
        return response()->json(
            [
                "message" => "All Examination data are Validated and saved",
                "data :" => new ExaminationResource($examination)
            ],
            200
        );
    }

}

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function examination_show($id)
{
    //

    $examination = Examination::findOrFail($id);
    return response()->json(
        [
            "message" => "The Examination with the id $id data is :",
            "data :" =>new ExaminationResource($examination)
                ],
        200);
}
/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function examination_edit($id)
{
    //
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function examination_update(Request $request, $id)
{
    //
    $validator = Validator::make($request->all(), [

        "name" => "required",
        "type" => "required",
        "examination_date" => "required",

        "doctor_id"    => "required | integer",
        "patiant_id"   => "required | integer",
        "clinic_id"    => "required | integer",
        "report_id"    => "required | integer",
    ]);
    /* this will give an Error
        "treatment_id" => "require", (dont forget d)
                                                 */
    if ($validator->fails()) {
        return $validator->errors()->all();
    }
    $examination = Examination::findOrFail($id);

    $examination-> name= $request->name ;
    $examination-> type= $request->type ;
    $examination-> examination_date= $request->examination_date ;

    $examination-> clinic_id= $request->clinic_id ;
    $examination-> doctor_id= $request->doctor_id ;
    $examination-> patiant_id= $request->patiant_id ;
    $examination-> report_id= $request->report_id ;

    if ($examination->save()) {

        return response()->json(
            [
                "message" => "The update of data are validated and saved",
                "data :" => new ExaminationResource($examination)
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
public function examination_destroy($id)
{
    //
    $examination = Examination::findOrFail($id) ;

    if ($examination->delete()) {

        return response()->json(
            [
                "message" => "The Examination Deleted Successfully",
                "data :" => new ExaminationResource($examination)
            ],
            200
        );
    }
    else
    { return " there is an error";}
}



/////////////////////////////////////////////////////////////////////////////////////
//          Internal_procedures     الاجراءات الداخلية
/////////////////////////////////////////////////////////////////////////////////////


public function internal_procedures_index()
{
    //
    $Internal_procedures = Internal_procedures::query()->with(
        ['Examination' => function ($query) {
            $query->select('*');
        },
        'Treatment' => function ($query) {
            $query->select('*');
        },

                     ],)->get();

    return response()->json(
        [
            "message" => "All Internal_procedures data",
            "data :" => Internal_procedureResource::collection($Internal_procedures)
        ],
        200
    );
}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function internal_procedures_create()
{
    //
}

public function internal_procedures_nameSearch($name)
{
    //
    return Internal_procedures::where("name","like","%".$name."%")->get();
}

public function internal_procedures_typeSearch($type)
{
    //
    return Internal_procedures::where("type","like","%".$type."%")->get();
}

public function internal_procedures_placeSearch($place)
{
    //
    return Internal_procedures::where("place","like","%".$place."%")->get();
}
/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function internal_procedures_store(Request $request)
{
    //
    $validator = Validator::make($request->all(), [

        "name" => "required",
        "type" => "required",
        "place" => "required",


        "examination_id"    => "required | integer",
        "treatment_id"    => "required | integer",

    ]);

    if ($validator->fails()) {
        return $validator->errors()->all();
    }
    $Internal_procedures = new Internal_procedures ;

    $Internal_procedures-> name= $request->name ;
    $Internal_procedures-> type= $request->type ;
    $Internal_procedures-> place= $request->place ;

    $Internal_procedures-> examination_id= $request->examination_id ;
    $Internal_procedures-> treatment_id= $request->treatment_id ;


      if ($Internal_procedures->save()) {

          return response()->json(
            [
                "message" => "All Internal_Procedure data are Validated and saved",
                "data :" =>new Internal_procedureResource($Internal_procedures)
            ],
            200
        );
        }



}

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function internal_procedures_show($id)
{
    //
    $Internal_procedures = Internal_procedures::findOrFail($id);

    return response()->json(
        [
            "message" => "The internal_procedure with the id $id data is :",
            "data :" =>new Internal_procedureResource($Internal_procedures)
                ],
        200);

}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function internal_procedures_edit($id)
{
    //
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function internal_procedures_update(Request $request, $id)
{
    //
    $validator = Validator::make($request->all(), [

        "name" => "required",
        "type" => "required",
        "place" => "required",


        "examination_id"    => "required | integer",
        "treatment_id"    => "required | integer",

    ]);

    if ($validator->fails()) {
        return $validator->errors()->all();
    }

    $Internal_procedures = Internal_procedures::findOrFail($id);

    $Internal_procedures-> name= $request->name ;
    $Internal_procedures-> type= $request->type ;
    $Internal_procedures-> place= $request->place ;

    $Internal_procedures-> examination_id= $request->examination_id ;
    $Internal_procedures-> treatment_id= $request->treatment_id ;

    if ($Internal_procedures->save()) {

        return response()->json(
            [
                "message" => "The update of data are Validated and saved",
                "data :" => new Internal_procedureResource($Internal_procedures)
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
public function internal_procedures_destroy($id)
{
    //
    $Internal_procedures = Internal_procedures::findOrFail($id) ;

    if ($Internal_procedures->delete()) {

        return response()->json(
            [
                "message" => "The Visit Deleted Successfully",
                "data :" => new Internal_procedureResource($Internal_procedures)
            ],
            200
        );
      }
    else
    { return " there is an error";}
}



///////////////////////////////////
//              prescriptions  الوصفة
///////////////////////////////////

public function prescription_index()
    {    //
        //$input = Visit::query()->get();
        // Visit::with('Patiant','Clinic',)->get();

        $prescriptions = Prescription::query()->with(
            [ 'Treatment' => function ($query) {
                $query->select('*',);
            },
        ],)->get();

        return response()->json(
            [
                "message" => "All Prescriptions data",
                "data :" => PrescriptionResource::collection($prescriptions)
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoressVisitsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function prescription_store(Request $request)
    {


        $validator = Validator::make($request->all(), [

            "note" => "required",
            "prescription_date" => "required",

            "treatment_id" => "required | integer",
        ]);
        /* this will give an Error
            "treatment_id" => "require",
                                                     */
        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $prescription = new Prescription;
        $prescription->note = $request->note;
        $prescription->prescription_date = $request->prescription_date;

        $prescription->treatment_id = $request->treatment_id;

        if ($prescription->save()) {

            return response()->json(
                [
                    "message" => "All prescription data are Validated and saved",
                    "data :" => new PrescriptionResource($prescription)
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
    public function prescription_show($id ) {


        $ide = Prescription::where('id',$id)->pluck('id');
        $medicine = Medicine::where('prescription_id',$ide)->get();

     $m['prescription']=  Prescription::where('id',$id)->get();
    $m['medicine']=Medicine::where('prescription_id',$ide)->get();
         //  ->with('Medicine')->get();

        return response()->json($m);

       }
        //  $ide = Prescription::where('id',$id)->with('medicines')->get();
        //  $medicine = Medicine::where('prescription_id',$id)->get();

        //   //  ->with('Medicine')->get();

        //  return response()->json($ide);

        // }
              /*
                    "message" => "The prescription with the id $id data is :",
                    "data :" =>*




        // Prescription::findOrFail($id)->with('Medicine'));

        // return response()->json(
        //     [presc
        //         "message" => "The prescription with the id $id data is :",
        //         "data :" =>new PrescriptionResource($prescription)
        //             ],
        //     200);


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVisitsRequest  $request
     * @param  \App\Models\Visit  $visits
     * @return \Illuminate\Http\Response
     */
    public function prescription_update(Request $request, $id)
    {
        //

        $validator = Validator::make($request->all(), [

            "note" => "required",
            "prescription_date" => "required",

            "treatment_id" => "required | integer",
        ]);
        /* this will give an Error
            "treatment_id" => "require",
                                                     */
        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $prescription = Prescription::findOrFail($id);

        $prescription->note = $request->note;
        $prescription->prescription_date = $request->prescription_date;

        $prescription->treatment_id = $request->treatment_id;


        if ($prescription->save()) {
            return response()->json(
                [
                    "message" => "The update of data are Validated and saved",
                    "data :" => new PrescriptionResource($prescription)
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
    public function prescription_destroy($id)
    {
        //
        $prescription = Prescription::findOrFail($id);

        if ($prescription->delete()) {

            return response()->json(
                [
                    "message" => "The Prescription Deleted Successfully",
                    "data :" => new PrescriptionResource($prescription)
                ],
                200
            );
        } else {
            return "this  hasn't been deleted";
        }
    }

/////////////////////////////////////////////
//              Medicine الدواء
/////////////////////////////////////////////
public function medicine_index()
    {    //

        $medicines = Medicine::query()
        // ->with(
        //     ['Prescription' => function ($query) {
        //         $query->select('*');
        //     },
        // ],)
        ->get();

        return response()->json(
            [
                "message" => "All Medicines data",
                "data :" => MedicineResource::collection($medicines)
            ],
            200
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function dateSearch($date)
    // {
    //     //
    //     return Visit::where("date", "like", "%" . $date . "%")->get();
    // }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoressVisitsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function medicine_store(Request $request)
    {


        $validator = Validator::make($request->all(), [

            "name" => "required",
            "type_medicine" => "required",
            "type_give" => "required",
            "number_give" => "required | integer ",

            "prescription_id" => "required | integer ",

        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $medicine = new Medicine();

        $medicine->name = $request->name;
        $medicine->type_medicine = $request->type_medicine;
        $medicine->type_give = $request->type_give;
        $medicine->number_give = $request->number_give;

        $medicine->prescription_id = $request->prescription_id;


        if ($medicine->save()) {

            return response()->json(
                [
                    "message" => "All Medicine data are Validated and saved",
                    "data :" => new MedicineResource($medicine)
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
    public function medicine_show($id) {

        $medicine = Medicine::findOrFail($id);

        return response()->json(
            [
                "message" => "The medicine with the id $id data is :",
                "data :" => new MedicineResource($medicine)
                    ],
            200);


}
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVisitsRequest  $request
     * @param  \App\Models\Visit  $visits
     * @return \Illuminate\Http\Response
     */
    public function medicine_update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [

            "name" => "required",
            "type_medicine" => "required",
            "type_give" => "required",
            "number_give" => "required | integer ",

            "prescription_id" => "required | integer ",

        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }


        $medicine = Medicine::findOrFail($id);

        $medicine->name = $request->name;
        $medicine->type_medicine = $request->type_medicine;
        $medicine->type_give = $request->type_give;
        $medicine->number_give = $request->number_give;

        $medicine->prescription_id = $request->prescription_id;

        if ($medicine->save()) {
            return response()->json(
                [
                    "message" => "The update of data are Validated and saved",
                    "data :" => new MedicineResource($medicine)
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
    public function medicine_destroy($id)
    {
        //
        $medicine = Medicine::findOrFail($id);

        if ($medicine->delete()) {

            return response()->json(
                [
                    "message" => "The medicine Deleted Successfully",
                    "data :" => new MedicineResource($medicine)
                ],
                200
            );
        } else {
            return "the medicine hasn't been deleted";
        }
    }
}
