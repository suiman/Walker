<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 17/3/17
 * Time: 下午1:51
 */

namespace App\Controller;

use App\Model;

class Home extends Base
{
    public function test() {
        $userMod = new Model\User();
        $user = $userMod->getUser();
        print_r($user);
    }

}