<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 17/3/18
 * Time: 上午11:33
 */

namespace Walker\Interfaces;


interface Controller
{
    /**
     * invoke before action
     */
    public function before();

    /**
     * invoke after action
     */
    public function after();

}