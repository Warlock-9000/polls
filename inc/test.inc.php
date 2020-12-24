<?php
/**
 * Created by PhpStorm.
 * User: Aldan
 * Date: 12.05.2019
 * Time: 21:57
 */

require_once 'modules/testsfunctions.php';
//проверяем запуск тестирования, начали ли мы тестирование по правильной ссылке
if (isset($_REQUEST['status'])){
    if ($_REQUEST['status']=='start'){
        $_SESSION['currenttest']['status']='start';
    }

}


//если ссылка битая или что-то пошло не так выкинем на главную страницу. Если все норм продолжаем.
if ($_SESSION['currenttest']['status']=='start'){
    //получаем id теста
    $_SESSION['currenttest']['id']=$_REQUEST['test'];
    //получаем массив айдишников вопросов теста
    $_SESSION['currenttest']['list']=getQuestionsArray($_SESSION['currenttest']['id'],$mysqli);
    //На сколько вопросов уже ответили
    $_SESSION['currenttest']['count_current']=0;
    //получаем id текущего вопроса
    $_SESSION['currenttest']['id_question']=$_SESSION['currenttest']['list'][$_SESSION['currenttest']['count_current']];
    //что бы не грузить бд, здесь же будем хранить вопрос
    $_SESSION['currenttest']['questionBody']=[];
    //Записываем время начала опроса
    $_SESSION['currenttest']['time_start']=time();
    //Сколько всего вопросов в тесте
    $_SESSION['currenttest']['count_all']=count($_SESSION['currenttest']['list']);

    //Список ответов опрашиваемого array каждый элемент в json
    $_SESSION['currenttest']['answears']=[];
    //Оценка прохождения теста
    $_SESSION['currenttest']['mark']=0;

    //получим первый вопрос
    $questionBody=getQuestion($_SESSION['currenttest']['id_question'],$mysqli);
    $_SESSION['currenttest']['questionBody']=$questionBody;
    //только сам вопрос
    $questionTitle=$questionBody['question'];
    //варанты ответа
    $versions=array_diff_key($questionBody,['id'=>123,'question'=>123,'true_anser'=>123]);

    //Покажем вопрос и варианты ответа


    ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-primary" role="alert">
                        <?php echo 'Прохождение: вы ответили на '.$_SESSION['currenttest']['count_current'].' из '.$_SESSION['currenttest']['count_all'];?>
                    </div>
                    <h3>Вопрос: <?=$questionTitle?></h3>
                    <form action="?id=test" method="post">
                    <?php
                    $counterform=1;
                    foreach ($versions as $value){
                        echo <<<VERSIONS
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="version[]" value="var$counterform">
                            <label class="form-check-label">$value</label>
                        </div>
VERSIONS;
                        $counterform++;
                    }
                    $counterform=0;
                    ?>
                        <button type="submit" class="btn btn-primary">Далее</button>
                    </form>
                </div>
            </div>
        </div>
                    
                <?php
    //Если к этому моменту ничего не отлетело с ошибкой значит стартовые данные у нас есть и дальше тоже все будет нормально, переходим в режим "заполнение теста"
    $_SESSION['currenttest']['status']='process';
}
//Если мы уже начали проходить тестирование то переходим к процессу его прохождения.
elseif ($_SESSION['currenttest']['status']=='process'){
    //Получаем и записываем данные полученные при старте теста, что бы не нагружать бд пишем в сессию, запись в бд будет произведена при окончании теста.
    //Запишем ответ
    if (isset($_REQUEST['version'])){
        $getAnswears=json_encode($_REQUEST['version']);
    }
    else{
        $getAnswears='';
    }
    $_SESSION['currenttest']['answears'][$_SESSION['currenttest']['id_question']]=$getAnswears;
    //Проверим совпадает ли ответ с правильным ответом и если да, то повысим оценку.
    if ($getAnswears==$_SESSION['currenttest']['questionBody']['true_anser']){
        $_SESSION['currenttest']['mark']++;
    }
    //перейдем к следующему вопросу

    $tempCount = $_SESSION['currenttest']['count_current']++;
    //проверим не закончили ли мы тест.
    //минусуем один раз, т.к. изначально count_current = 0, но вопрос то  у нас не нулевой, а первый. и когда мы считаем  count_all то получается что  каунт у нас равен 1, а вот итератор count_current равен 0 хотя указывает это на одно и то же.
    if ($_SESSION['currenttest']['count_current']>$_SESSION['currenttest']['count_all']-1){
        //похоже вопросов больше нет, время записать результат в бд.
        //создадим уникальную ссылку на основе сессионной куки и функции time()
        $link=session_id().time();

        writeAnswear($_SESSION['currenttest']['answears'],$mysqli,$_SESSION['currenttest']['time_start'],time(),$_SESSION['currenttest']['mark'],$_SESSION['currenttest']['count_all'],$link);

        //Почистим все за собой
        $_SESSION['currenttest'] = array();
        /* Перенаправление браузера на другую страницу в той же директории, что и
        изначально запрошенная */
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = '?id=result'.'&tid='.$link;
        header("Location: http://$host$uri/$extra");
        /* Убедиться, что код ниже не выполнится после перенаправления .*/
        exit();

    }

    //видимо еще не закончили.
    if (isset($_SESSION['currenttest']['list'][$_SESSION['currenttest']['count_current']])){
        $_SESSION['currenttest']['id_question']=$_SESSION['currenttest']['list'][$_SESSION['currenttest']['count_current']];
    }


    //получим очередной вопрос
    $questionBody=getQuestion($_SESSION['currenttest']['id_question'],$mysqli);
    $_SESSION['currenttest']['questionBody']=$questionBody;
    //только сам вопрос
    $questionTitle=$questionBody['question'];
    //варанты ответа
    $versions=array_diff_key($questionBody,['id'=>123,'question'=>123,'true_anser'=>123]);


    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-primary" role="alert">
                    <?php echo 'Прохождение: Вы ответили на '.$_SESSION['currenttest']['count_current'].' из '.$_SESSION['currenttest']['count_all'];?>
                </div>
                <h3>Вопрос: <?=$questionTitle?></h3>
                <form action="?id=test" method="post">

                    <?php
                    $counterform=1;
                    foreach ($versions as $value){
                        echo <<<VERSIONS
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="version[]" value="var$counterform">
                            <label class="form-check-label">$value</label>
                        </div>

VERSIONS;
                        $counterform++;

                    }
                    $counterform=0;
                    ?>
                    <button type="submit" class="btn btn-primary">Далее</button>
                </form>
            </div>
        </div>
    </div>

    <?php
}

else{
/* Перенаправление браузера на другую страницу в той же директории, что и
изначально запрошенная */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = '';
header("Location: http://$host$uri/$extra");
/* Убедиться, что код ниже не выполнится после перенаправления .*/
exit;
}
?>






