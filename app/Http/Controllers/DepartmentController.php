<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contract\EmployeeRepositoryInterface;
use App\Enums\EmployeeStatusEnum;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DepartmentController extends Controller
{
    /**
     * TODO: 1. First issue. You need to bind a concrete instance of EmployeeRepositoryInterface
     */
    public function getActiveEmployees(EmployeeRepositoryInterface $employeeRepository, int $departmentId): JsonResponse
    {
        /**
         * TODO: 2. Second issue. Need find concrete department by $departmentId
         *
         * @var Department $department
         */
        $department = Department::find($departmentId);

        if (!$department) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'response' => 'Invalid department id'
            ], Response::HTTP_NOT_FOUND);
        }

        $employees = $employeeRepository->findActiveByDepartment($department);

        return response()->json($employees);
    }

    public function blockEmployees(int $departmentId): JsonResponse
    {

        /**
         * TODO: 4. Second issue. You need to find a specific department by $departmentId
         *
         * @var Department $department
         */
        $department = Department::find($departmentId);

        if (!$department) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'response' => 'Invalid department id'
            ], Response::HTTP_NOT_FOUND);
        }

        /**
         * TODO: 5. Five issue. We need to block all employees of the department
         * @see EmployeeStatusEnum
         */

        $updateEmployeeStatus = $department->employees()->each(function ($employee) {
            $employee->status = EmployeeStatusEnum::BLOCKED->id();
            $employee->save();
        });

        if (false == $updateEmployeeStatus) {
            return response()->json([
                'response' => 'internal server error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'response' => 'user blocked successfully.'
        ]);
    }
}
