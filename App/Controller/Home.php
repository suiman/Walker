<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 17/3/17
 * Time: 下午1:51
 */

namespace App\Controller;

use App\Model;
use App\Util;
use App\Constant;
use App\Traits;

class Home extends Base
{
    use Traits\Controller;

    public function index()
    {
        echo Util\Str::withNL('index from home');
    }

    public function ping()
    {
        print_r($this->request->getUri());
    }


    public function user()
    {
        $userMod = new Model\User();
        $user = $userMod->getUser();
        print_r($user);
    }

    public function time()
    {
        $time = Util\Time::friendly(time() - 100000);
        echo Util\Str::withNL($time);
    }

    public function where()
    {
        $distance = Util\Distance::fromCoordinate(22.9, 110, 23, 110.1);
        $distance = Util\Distance::friendly($distance);
        echo Util\Str::withNL($distance);
    }

    public function error()
    {
        echo Util\Str::withNL(Constant\ErrorCode::URL_NO_EXIST);
    }

    public function json()
    {
        $data = array(
            'time' => date('Y-m-d H:i:s'),
            'weather' => 'rainy'
        );
        $this->responseJson(Constant\ErrorCode::NO_ERROR, $data);
    }

}