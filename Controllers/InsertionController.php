<?php

class Insertion{

    protected $ch;
    public $result;
    
    static public function getGithubUsers($url){   // эта статичная функция возвращает объект, со свойством result, в котором массив пользователей
        
        $obj = new Insertion();

        $obj->ch = curl_init();
        curl_setopt($obj->ch, CURLOPT_URL, $url);
        curl_setopt($obj->ch, CURLOPT_USERAGENT, 'Agent smith');
        curl_setopt($obj->ch, CURLOPT_HEADER, 0);
        curl_setopt($obj->ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($obj->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($obj->ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($obj->ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($obj->ch);
        curl_close($obj->ch);
        $obj->result = json_decode(trim($output), true);

        return $obj;
    }

    public function insertRows($arr){

        require_once('./Config/settings.config.php'); // подключаем конфигурацию для БД
        require_once('DBController.php'); // подключаем контроллер, для подключения к БД

        $database = new DBController($localhost);
        $index = 0; //счётчик записей

        foreach($arr as $value){
            
        $githubID = $value['id'];
        $githubLogin = $value['login'];            
        $stmt = $database->dbc->prepare("SELECT * FROM user WHERE github_id = ? AND github_login <> ?"); // выводим строку, в которой по данному github_id иной логин
        $stmt->execute(array($githubID, $githubLogin));
        
        $row = $stmt->rowCount();
        
        if($row <> 0){
            $stmt = $database->dbc->prepare("UPDATE user SET github_login = ? WHERE github_id = ?"); // если нашли такие строки - заменяем
            $stmt->execute(array($githubLogin, $githubID));
//            echo 'Обновлены данные: github_login для github_id = '.$githubID.' новый логин: `'.$githubLogin.'` | '; // выводим в консоль информацию о новом логине (опционально)
        }
        else{    

        $stmt = $database->dbc->prepare("INSERT INTO user (github_id, github_login) VALUES (?, ?)"); // если такой записи нет, то вносим, ключ unique не даст создать дубликаты
        $stmt->execute(array($githubID, $githubLogin));        
        }
        $index++;

        }

    }

}

