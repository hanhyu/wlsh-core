<?php
declare(strict_types=1);


namespace App\Domain\System;

use App\Models\Mysql\SystemMenuMysql;

class MenuDomain
{
    public function getList(array $data): ?array
    {
        $res = [];
        if ($data['curr_page'] > 0) {
            $data['curr_data'] = ($data['curr_page'] - 1) * $data['page_size'];
        } else {
            $data['curr_data'] = 0;
        }

        $data['where'] = [];

        $res['count'] = SystemMenuMysql::getInstance()->getListCount();
        $res['list']  = SystemMenuMysql::getInstance()->getMenuList($data);
        return $res;
    }

}