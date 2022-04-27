<?php
    require_once("chainingyeso/class.pdofactory.php");
    require_once("chainingyeso/class.Searcher.php");

    $strDSN = "pgsql:dbname=postgres;host=localhost;port=5432";
    $objPDO = PDOFactory::GetPDO($strDSN, "postgres", "aA123456789!2", 
        array());
    $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
            SELECT id FROM searches
            WHERE paraula LIKE '" . $_POST["search"] . "%'
            ORDER BY total DESC
            LIMIT 5;
    ";

    $arr = $objPDO -> query($sql) -> fetch();

    if($arr != false)
    {
        echo json_encode($arr);
    }
    else
    {
        $searcher = new Searcher($objPDO);

        $searcher   -> SetParaula($_POST["search"])
                    -> SetTotal(1)
                    -> SetLastVisit(Date('Y-m-d H:m:s'))
                    -> Save();
    }

    /*$searcher = new Searcher($objPDO);

    $searcher   -> SetParaula($_POST["search"])
                -> Save();

    echo $searcher -> Show();*/
?>