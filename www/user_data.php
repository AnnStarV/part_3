<?
    include 'Logger.php';

    class Database extends Logger{
        const database = "localhost:/home/part_3/www/DB.FDB";
        const username = "SYSDBA";
        const password = "masterkey";

        public $result_valid; 
        public $result_non_valid; 


        function connect(){
            $db = ibase_connect(Database::database, Database::username, Database::password);
        }
        function validation($array){
            $count = count(array_filter($array));
            if ($count!=6){
                 $this->result_valid = false;
            }
            else  $this->result_valid = true;
            
        }
    
         function non_valid($array){
            if (preg_match("/^([0-9])+$/", $array['FIRSTNAME'])) {
                $this->result_non_valid =   $this->result_non_valid +1;
            }
           else if (preg_match("/^([0-9])+$/", $array['LASTNAME'])) {
            $this->result_non_valid =   $this->result_non_valid +1;
            }
           else if (!preg_match("/^([0-9])+$/", $array['AGE'])) {
            $this->result_non_valid =  $this->result_non_valid +1;
            }
           else if (preg_match("/^([0-9])+$/", $array['ADDRESS'])) {
            $this->result_non_valid=   $this->result_non_valid +1;
            }
           
        else  $this->result_non_valid = 0;
        }

        function insert(){
           
                 
                $sql =  "INSERT INTO tab_users (LASTNAME, FIRSTNAME, AGE, ADDRESS, PHONE_NUMBER, EMAIL) 
                VALUES ('".$_POST['LASTNAME']."','".$_POST['FIRSTNAME']."',".(int)$_POST['AGE'].",'".$_POST['ADDRESS']."', '".$_POST['PHONE_NUMBER']."', '".$_POST['EMAIL']."')";
                
                $array = array(
                    'FIRSTNAME' => $_POST['FIRSTNAME'], 
                    'LASTNAME' => $_POST['LASTNAME'], 
                    'AGE' => $_POST['AGE'], 
                    'ADDRESS' => $_POST['ADDRESS'], 
                    'PHONE_NUMBER' => $_POST['PHONE_NUMBER'],
                    'EMAIL' => $_POST['EMAIL']
                );
              
                $json = json_encode($array);

                $this -> validation($array);
                $this -> non_valid($array);
                $this -> getSqlResult(ibase_query($sql), $json, $_POST['EMAIL'],  $this->result_non_valid,  $this->result_valid);

            }
        }
    };

    

    $inst = new Database();
   
    $inst -> connect();
    $inst -> insert();
   
?>