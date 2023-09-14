<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as RoleAlias;

class Role extends RoleAlias
{
    use HasFactory;
}
