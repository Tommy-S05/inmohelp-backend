<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as PermissionAlias;

class Permission extends PermissionAlias
{
    use HasFactory;
}
