<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 17/3/17
 * Time: 下午2:08
 */

namespace App\Model;


class User extends Base
{
    public function getUser()
    {
        $user = array(
            'name' => 'white',
            'age' => '23'
        );
        return $user;
    }

}