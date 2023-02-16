<?php
declare(strict_types=1);


namespace App\Modules\System\Controllers;

use App\Domain\System\MenuDomain;
use App\Models\Forms\SystemMenuForms;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Wlsh\Router;

class MenuController
{
    protected MenuDomain $menu;

    public function __construct()
    {
        $this->menu = new MenuDomain();
    }

    #[Router(method: 'GET', auth: false)]
    public function getMenuListAction(Request $request, Response $response): void
    {
        $data = validator($request, SystemMenuForms::$getMenuList);
        $res = $this->menu->getList($data);
        $response->end(httpJson(data: $res));
    }

}