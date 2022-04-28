<?php
    require_once("chainingyeso/class.pdofactory.php");
    require_once("chainingyeso/class.Searcher.php");

    $strDSN = "pgsql:dbname=postgres;host=localhost;port=5432";
    $objPDO = PDOFactory::GetPDO($strDSN, "postgres", "aA123456789!2", 
        array());
    $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
            SELECT id FROM searches
            WHERE paraula = '" . $_POST["search"] . "';
    ";

    $arr = $objPDO -> query($sql) -> fetch();

    if(is_array($arr))
    {
        $arr = $arr[0];

        $searcher = new Searcher($objPDO, $arr);

        $searcher   -> SetTotal($searcher -> GetTotal() + 1)
                    -> SetUltimaVisita(Date('Y-m-d H:m:s'))
                    -> Save();

        $sql = "
                SELECT * FROM searches
                WHERE paraula LIKE '" . $_POST["search"] . "%'
                ORDER BY total DESC
                LIMIT 5;
                ";

        $arr = $objPDO -> query($sql);
        $i = 0;

        echo "[";
        while($item = $arr -> fetch()){
            echo json_encode($item);
            
            if($i < $arr -> rowCount() - 1)
                echo ",";

            $i++;
        }
        echo "]";
    }
    else
    {
        $searcher = new Searcher($objPDO);

        $searcher   -> SetParaula($_POST["search"])
                    -> SetTotal(1)
                    -> SetUltimaVisita(Date('Y-m-d H:m:s'))
                    -> Save();
    }
?>