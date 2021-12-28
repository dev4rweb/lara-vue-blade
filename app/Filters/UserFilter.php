<?php


namespace App\Filters;


class UserFilter extends QueryFilter
{
    public function role_id($role = 0)
    {
        return $this->builder
            ->where('is_admin', $role);
    }

    public function search_name($search = '')
    {
        return $this->builder
            ->where('name', 'LIKE', '%' . $search . '%');
    }
}
