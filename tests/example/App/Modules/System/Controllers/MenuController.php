<?php
declare(strict_types=1);


namespace Modules\System\Controllers;

use Domain\System\MenuDomain;
use Models\Forms\SystemMenuForms;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Wlsh\DI;
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
        $res  = $this->menu->getList($data);
        $response->end(httpJson(data: $res));
    }

    #[Router(method: 'GET', auth: true)]
    public function getMenuInfoAction(Request $request, Response $response): void
    {
        $data['menu']  = $this->menu->getInfo();
        $data['title'] = DI::factory()->get('config_arr')['page']['title'];
        $response->end(httpJson(data: $data));
    }

}
