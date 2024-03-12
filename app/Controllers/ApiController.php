<?php

namespace App\Controllers;

// use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmployeeModel;
use CodeIgniter\RESTful\ResourceController;

class ApiController extends ResourceController
{
    public function addEmployee()
    {
        $rules = array(
            "name" => "required",
            "email" => "required|valid_email|is_unique[employees.email]"
        );
        if(!$this->validate($rules)) {
            $response = [
                "status" => false,
                "message" => $this->validator->getErrors(),
                "data" => []
            ];
        } else {
            $fileImage = $this->request->getFile("profile_image");
            if(!empty($fileImage))
             {
                $imageName = $fileImage->getName();
                $temp = explode(".", $imageName);
                $newImageName = round(microtime(true)) . "." .end($temp);
                if($fileImage->move("images", $newImageName)) {
                    $data = [
                        "name" => $this->request->getVar("name"),
                        "email" => $this->request->getVar("email"),
                        "profile_image" => "/images/" . $newImageName
                    ];
                    $employeeObject = new EmployeeModel();
                    if($employeeObject->insert($data)) {
                        $response = [
                            "status" => true,
                            "message" => "Employee created successfully",
                            "data" => []
                        ];
                    } else{
                        $response = [
                            "status" => false,
                            "message" => "Failed to Create Employee",
                            "data" => []
                        ];
                    }
                } else {
                    $response = [
                        "status" => false,
                        "message" => "Failed to Create Profile_Image",
                        "data" => []
                    ];
                }
            } else {
                $data = [
                    "name" => $this->request->getVar("name"),
                    "email" => $this->request->getVar("email"),
                ];
                $employeeObject = new EmployeeModel();
                if ($employeeObject->insert($data)) {
                  $response = [
                        "status" => true,
                        "message" => "Employee Created Successfully",
                        "data" => []
                    ];
                } else {
                    $response = [
                        "status" => false,
                        "message" => "Failed to Create Employee",
                        "data" => []
                    ];
                }
            }
        }
        return $this->respondCreated($response);
    }
    
    public function listEmployee()
    {
        $employeeObject = new EmployeeModel();
        $employees = $employeeObject->findAll();
                if(!empty($employees)){
                  $response = [
                        "status" => true,
                        "message" => "Employee Listed Successfully",
                        "data" => $employees
                    ];
                } else {
                    $response = [
                        "status" => false,
                        "message" => "Failed to List Employee",
                        "data" => []
                    ];
                }
                return $this->respondCreated($response);
    }

    public function getSingleEmployee($Id)
    {
        $employeeObject = new EmployeeModel();
        $data = $employeeObject->find($Id);
                if(!empty($data)){
                  $response = [
                        "status" => true,
                        "message" => "Employee Single Successfully",
                        "data" => $data
                    ];
                } else {
                    $response = [
                        "status" => false,
                        "message" => "Failed to List Single Employee",
                        "data" => []
                    ];
                }
                return $this->respondCreated($response);
    }

    public function updateEmployee($Id)
    {
        $employeeObject = new EmployeeModel();
        $data = $employeeObject->find($Id);

        if(!empty($data)){
            $rules =[
                "name" => "required",
                "email" => "required|valid_email|is_unique[employees.email]"
            ];
        }
        if(!$this->validate($rules)) {
            $response = [
                "status" => false,
                "message" => $this->validator->getErrors(),
                "data" => []
            ];
        } else {
            $fileImage = $this->request->getFile("profile_image");
            if(!empty($fileImage))
             {
                $fileName = $fileImage->getName();
                $temp = explode(".", $fileName);
                $newImageName = round(microtime(true)) . "." .end($temp);
                if($fileImage->move("images", $newImageName)) {
                    $updatedata = [
                        "name" => $this->request->getVar("name"),
                        "email" => $this->request->getVar("email"),
                        "profile_image" => "/images/" . $newImageName
                    ];
                    // $employeeObject = new EmployeeModel();
                    if($employeeObject->update($Id, $updatedata)) {
                        $response = [
                            "status" => true,
                            "message" => "Employee Update successfully",
                            "data" => []
                        ];
                    } else{
                        $response = [
                            "status" => false,
                            "message" => "Failed to Update Employee",
                            "data" => []
                        ];
                    }
                } else {
                    $response = [
                        "status" => false,
                        "message" => "Failed to update Profile_Image",
                        "data" => []
                    ];
                }
            } else {
                $updatedata = [
                    "name" => $this->request->getVar("name"),
                    "email" => $this->request->getVar("email"),
                ];
                $employeeObject = new EmployeeModel();
                if ($employeeObject->update($Id, $updatedata)) {
                  $response = [
                        "status" => true,
                        "message" => "Employee Updated Successfully",
                        "data" => []
                    ];
                } else {
                    $response = [
                        "status" => false,
                        "message" => "Failed to Update Employee",
                        "data" => []
                    ];
                } 
            }
        }
        return $this->respondCreated($response);
    }

    public function deleteEmployee($Id)
    {
        $employeeObject = new EmployeeModel();
        $empdata = $employeeObject->find($Id);

        if(!empty($empdata)){
           if($employeeObject->delete($Id)){
            $response =[
                "status"=> true,
                "message"=> "Empoyee deleted successfully",
                "data"=>[]
            ];
           }else{
            $response =[
                "status"=> false,
                "message"=> "Failed to delete employee",
                "data"=>[]
            ];
           }
        }  else{
            $response =[
                "status"=> false,
                "message"=> "Employee not found",
                "data"=>[]
            ];
        }  
        return $this->respondCreated($response);
    }

}
