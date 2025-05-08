<?php

namespace App\Models;

class User extends BaseModel
{
    public string $tableName = 'users';
    public string $primaryKey = "id";

    public array $columns = [
        "username",
        "firstname",
        "lastname",
        "phone",
        "email",
        "password",
        "created",
        "updated",
        "is_deleted"
    ];

    public array $hidden = [
        'password'
    ];
    public static function create(array $data): bool
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return parent::create($data);
    }
}
