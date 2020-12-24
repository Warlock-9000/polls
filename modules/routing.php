<?php
/**
 * Created by PhpStorm.
 * User: Aldan
 * Date: 12.05.2019
 * Time: 20:09
 */

switch($id){
    case 'result': include 'inc/result.inc.php'; break;
    case 'test': include 'inc/test.inc.php'; break;
    case 'addquestion': include 'inc/addquestion.inc.php'; break;
    case 'addtest': include 'inc/addtest.inc.php'; break;
    case 'exe': include 'inc/exe.inc.php'; break;
    default: include 'inc/index.inc.php';
}