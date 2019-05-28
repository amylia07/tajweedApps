<?php 
    class API{
        private $table = "question";

        function __construct(){
            $this->configs = include('config.php');
            $this->db = new mysqli($this->configs['db_host'], $this->configs['db_user'], $this->configs['db_pass'], $this->configs['db_name']);
            $this->db->autocommit(TRUE);
        }

        function addQuestion(){
            $answer = $_GET['answer'];

            $sql = "INSERT INTO question (Answer) VALUES (?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('s', $answer);
            $stmt->execute();
        }

        function getQuestion(){
            $sql = "SELECT QnID, Qn, Option1, Option2, Option3, Option4 FROM question";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            $result = $stmt->get_result();

            $data = array();
            while($row = $result->fetch_assoc()){
                // echo "OPT1 => ".$row['Option1'];
                $data[] = $row['QnID'];
                $data[] = $row['Qn'];
                $data[] = $row['Option1'];
                $data[] = $row['Option2'];
                $data[] = $row['Option3'];
                $data[] = $row['Option4'];
            }
            // echo $data[0]['QnID'];

            $column_list = array('QnID', 'Qn', 'Option1', 'Option2', 'Option3', 'Option4');

            $this->outputResult("QUESTION OK", $column_list, $data);

        }

        function outputResult($tx_result, $column_list, $data_list) {
            $result = array(
                'tx_result' => $tx_result,
                'columns' => $column_list,
                'values' => $data_list
            );
            echo json_encode($result);
        }


    }

    $api = new API;

    if (isset($_GET['process'])) {
        $process = $_GET['process'];
        switch ($process) {
            case 1:
                $api->addQuestion();
                break;
            case 2: 
                $api->getQuestion();
                break;
            default:
                break;
        }
    } else {
        $tx_result = 'Invalid use...';
        $result = array(
            'tx_result' => $tx_result);

        echo json_encode($result);

    }

?>