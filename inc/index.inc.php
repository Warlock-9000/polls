<?php
/**
 * Created by PhpStorm.
 * User: Aldan
 * Date: 12.05.2019
 * Time: 21:36
 */

$res = $mysqli->query("SELECT * FROM tests ORDER BY id ASC");
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>Добрый день, выберите тестирование чтобы начать</h3>
        </div>
        <div class="col-10">
<?php
$string='';
for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
    $res->data_seek($row_no);
    $row = $res->fetch_assoc();
    foreach (json_decode($row['questions_list'])as $value){
        $string=$string.$value.' ';
    }
//    <button type="button" class="btn btn-primary">$row[name_test]</button>
//                <p>Айдишники вопросов:$string </p>
//                <hr>


    echo <<<TESTS
               <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">$row[name_test]</h5>
                        <p class="card-text">Тест содержит вопросы: $string</p>
                        <a href="?id=test&test=$row[id]&status=start" class="card-link">Начать прохождение</a>
                    </div>
                </div>
TESTS;
    $string='';
}
?>
        </div>
        <div class="col-2">Блок под рекламу XD</div>
    </div>
</div>
