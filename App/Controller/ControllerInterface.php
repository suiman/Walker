<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 17/3/18
 * Time: 上午11:33
 */

namespace App\Controller;


interface ControllerInterface
{
    public function before();

    public function after();

}