<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\EmployeeStoreRequest;
use App\Http\Requests\Employees\EmployeeUpdateRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $employees = Employee::paginate(10);
        return EmployeeResource::collection($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeStoreRequest $request
     * @return void
     */
    public function store(EmployeeStoreRequest $request)
    {
        $data = $request->validated();

        // Create a new employee
        $employee = Employee::create($data);
    
        return new EmployeeResource($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return void
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeeUpdateRequest $request
     * @param Employee $employee
     * @return void
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
 
        return new EmployeeResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return void
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
 
        return response()->noContent();
    }
}
