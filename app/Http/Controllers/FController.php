<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class FController extends Controller
{
    public function setroles()
    {
        $role1 = Role::create(['name' => 'reg_user']); // کاربر ثبت نام کرده
        $role2 = Role::create(['name' => 'admin']); // مدیر سامانه
        $role3 = Role::create(['name' => 'manufactory']); // مدیر کارخانه
        $role4 = Role::create(['name' => 'secretary']); //منشی 
        $role5 = Role::create(['name' => 'store_keeper']); //انباردار 
        $role6 = Role::create(['name' => 'producer']); // مسئول تولید 
        $permission = Permission::create(['name' => 'browse_dashboard']);
        $role2->givePermissionTo($permission);
        $role3->givePermissionTo($permission);
        $role4->givePermissionTo($permission);
        $role5->givePermissionTo($permission);
        $role6->givePermissionTo($permission);

        return 'ceated';
    }
}
