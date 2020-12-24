<?php
/**
 * Created by PhpStorm.
 * User: Aldan
 * Date: 13.05.2019
 * Time: 16:23
 */


function getQuestionsArray($testid,$mysqli){
    $res = $mysqli->query("SELECT questions_list FROM tests WHERE id=$testid");
    $res= json_decode($res->fetch_assoc()['questions_list']);
    return $res;

}

function getQuestion($questionid, $mysqli){
    $res = $mysqli->query("SELECT * FROM questions WHERE id=$questionid");
    $res=$res->fetch_assoc();
    return $res;

}

function writeAnswear($arrayAnswears,$mysqli,$timeStart,$timeEnd,$mark,$count_all,$link){
    $arrayAnswears=json_encode($arrayAnswears);
    $timeStart=date('Y-m-d H:i:s',$timeStart);
    if (!$mysqli->query("INSERT INTO `result_test`(`user_answers`, `mark`, `count_all`, `time_start`, `time_end`,`link`)
                                VALUES('$arrayAnswears','$mark','$count_all','$timeStart',now(),'$link') "))  {
        echo "Что-то пошло не так!: (" . $mysqli->errno . ") " . $mysqli->error;
    }
}

function getAnswear($link,$mysqli){
    $res = $mysqli->query("SELECT * FROM result_test WHERE link='$link'");
    $res=$res->fetch_assoc();
    return $res;
}
//отладочные функции

function printvar($a){
    echo '<pre>';
    print_r($a);
    echo '</pre><hr>';
}

function printdump($a){
    echo '<pre>';
    var_dump($a);
    echo '</pre><hr>';
}