<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property string $name
 */
class Department extends Model
{
    protected $table = 'departments';

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'department_id');
    }
}
