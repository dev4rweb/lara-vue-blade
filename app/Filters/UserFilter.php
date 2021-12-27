<?php


namespace App\Filters;


class UserFilter extends QueryFilter
{
    public function search_name($search = '')
    {
        return $this->builder
            ->where('name', 'LIKE', '%' . $search . '%');
    }
}
