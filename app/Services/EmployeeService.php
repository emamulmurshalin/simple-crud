<?php


namespace App\Services;


use App\Models\Employee;

class EmployeeService
{
    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }

    public function showEmployees()
    {
        return $this->model->paginate(10);
    }

    public function saveEmployee($inputData, $imageFile)
    {
        $imageFileName = 'image_'.time().'.'.$imageFile->getClientOriginalExtension();

        if($imageFile->move('image-files', $imageFileName))
        {
            $dataSaved = $this->model->create($inputData);
            if ($dataSaved){
                return [
                    'status' => 200,
                    'message' => 'Employee created successfully',
                ];
            }
        } else
        {
            return [
                'status' => 404,
                'message' => 'File not uploaded',
            ];
        }
    }

    public function deleteEmployee($id)
    {
        $employee = $this->model->findOrFail($id);
        $dataDeleted = $employee->delete();

        if ($dataDeleted){
            return [
                'status' => 200,
                'message' => 'Employee deleted successfully',
            ];
        }
    }

    public function detailsEmployee($id)
    {
        return $this->model->findOrFail($id);
    }

    public function updateEmployee($inputData, $id, $imageFile)
    {
        $employee = $this->model->findOrFail($id);
        $fileUploaded = '';

        if ($imageFile){
            $imageFileName = 'cv_'.time().'.'.$imageFile->getClientOriginalExtension();
            $fileUploaded = $imageFile->move('cv-files', $imageFileName);
        }

        if ($fileUploaded)
        {
            $dataSaved = $employee->update($inputData);

            if ($dataSaved){
                return [
                    'status' => 200,
                    'message' => 'Employee updated successfully',
                ];
            }
        }else{
            $dataSaved = $employee->update($inputData);

            if ($dataSaved){
                return [
                    'status' => 404,
                    'message' => 'File not uploaded',
                ];
            }
        }
    }

}
