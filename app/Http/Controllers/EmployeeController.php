<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;

class EmployeeController extends Controller
{
    //

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


        $employees = Employee::paginate(100)->with('Fname','Lname');
        $user=User::with(['Fname','Lname'])->findOr();
        return response()->json(EmployeeResource::collection($employees)) ;

      // return view('tasks.index', ['tasks' => Task::with('status')->get()]);

    }

    public function statusSearch($status)
    {
        //
        return Employee::where("status",$status)->get();
    }

    public function jobTitleSearch($jobTitle)
    {
        //
        return Employee::where("jobTitle","like","%".$jobTitle."%")->get();
    }


    public function startDateSearch($startDate)
    {
        //
        return Employee::where("startDate","like","%".$startDate."%")->get();
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
        $employee = new Employee ;

      $employee-> status= $request->status ;
      $employee-> jobTitle= $request->jobTitle ;
      $employee-> startDate= $request->startDate ;
      $employee-> endDate= $request->endDate ;
      $employee-> user_id= $request->user_id ;


        if ($employee->save()) {
            return new EmployeeResource($employee) ;
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
        $employee = Employee::findOrFail($id);
        return new EmployeeResource($employee) ;

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
        $employee = Employee::findOrFail($id);

        $employee-> status= $request->status ;
        $employee-> jobTitle= $request->jobTitle ;
        $employee-> startDate= $request->startDate ;
        $employee-> endDate= $request->endDate ;
        $employee-> user_id= $request->user_id ;

        if ($employee->save()) {
            return new EmployeeResource($employee) ;
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
        $employee = Employee::findOrFail($id) ;

        if ($employee->delete()) {
            return new EmployeeResource($employee);
        }
        else
        { return " there is an error";}
    }

}
