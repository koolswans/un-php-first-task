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

        return Employee::where('department_id', $department->id)->where('name', "a")->active()->get();
    }
}
