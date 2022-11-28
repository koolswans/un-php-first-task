<?php

declare(strict_types=1);

namespace App\Repository;

use App\Contract\EmployeeRepositoryInterface;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function findActiveByDepartment(Department $department): Collection
    {
        // TODO: 3. Third issue. Need get ACTIVE employees by department a

        return Employee::select(
            "users.name",
            "departments.name"
        )
        ->join("users", "users.id", '=', "employees.user_id")
        ->join("departments", "departments.id", '=', "employees.department_id")
        ->where("departments.name", '=', "a")
        ->where("employees.status", '=', 1)->get();
    }
}
