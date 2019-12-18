<?
class Logger 
{
    
    public function getSqlResult($result_sql, $json, $mail, $result_non_valid, $result_valid){

        if(($result_sql) and ($result_valid) and ($result_non_valid == 0)){
            $log = "\n".'New record:'."\n".date('Y-m-d H:i:s')."\n".$json."\n".'success'."\n\n" ;
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log.dat', $log, FILE_APPEND);
            mail($mail, "Проверка отправки", "Запись успешно добавлена!");
        }
        else{
            $log = "\n".'New record:'."\n".date('Y-m-d H:i:s')."\n".$json."\n".'fail'."\n\n" ;
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log.dat', $log, FILE_APPEND);
        }
       
    }
}
?>