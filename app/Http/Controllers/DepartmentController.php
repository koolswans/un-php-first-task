<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Contract\EmployeeRepositoryInterface;
use App\Enums\EmployeeStatusEnum;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\EmployeeRepository;

class DepartmentController extends Controller implements EmployeeRepositoryInterface
{
    /**
     * TODO: 1. First issue. You need to bind a concrete instance of EmployeeRepositoryInterface
     */
    public function getActiveEmployees(int $departmentId): JsonResponse
    {
        /**
         * TODO: 2. Second issue. Need find concrete department by $departmentId
         *
         * @var Department $department
         */
        $department = Department::where("departments.id", '=', $departmentId)->first();

        $employeeRepository = new EmployeeRepository(); 

        $employees = $employeeRepository->findActiveByDepartment($department);

        return response()->json($employees);
    }

    public function blockEmployees(int $departmentId): JsonResponse{

        /**
         * TODO: 4. Second issue. You need to find a specific department by $departmentId
         *
         * @var Department $department
         */
        $department = Department::where("departments.id", '=', $departmentId)->select("name")->first();

        /**
         * TODO: 5. Five issue. We need to block all employees of the department
         * @see EmployeeStatusEnum
         */
        $result = Department::where("departments.id", '=', $departmentId)
        ->update(["status"=>3]);

        return response()->json($department);
    }
}
