<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public function user() {
        return $this->belongsTo(\App\Models\User::class);
    }


    public function test() {
        
    }

    public const PERMISSIONS = [
		'READ'       => 0,
        'EDIT'       => 1,
        'LIKE'       => 2,
        'DELETE'     => 3,
        'EDIT_ALL'   => 4,
        'DELETE_ALL' => 5
	];

	public static function getFlag($perms)
	{
		$flag = 0;
		foreach ($perms as $perm) {
			$flag += 1 << self::PERMISSIONS[$perm];
		}
		return $flag;
	}

	public static function hasPermission($userFlag, $permission) {
		return ($userFlag >> self::PERMISSIONS[$permission]) % 2 == 1;
	}
}