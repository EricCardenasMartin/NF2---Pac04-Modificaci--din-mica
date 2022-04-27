<?php

require_once("abstract.databoundobject.php");

class Searcher extends DataBoundObject {

protected $Paraula;
protected $Total;
protected $UltimaVisita;

protected function DefineTableName() {
        return('searches');
}

protected function DefineRelationMap() {
        return(array(
                "id" => "ID",
                "paraula" => "Paraula",
                "total" => "Total",
                "ultimaVisita" => "UltimaVisita"));
        }
        
        public function Show(){
                return  "<h1>Table id</h1>" . $this -> ID . "<br><br>" .
                        "<h1>ScreenName: </h1>" . $this -> Paraula . "<br><br>" .
                        "<h1>ScreenName: </h1>" . $this -> Total . "<br><br>" .
                        "<h1>Tweet: </h1>" . $this -> UltimaVisita . "<br><br>";
        }
}
?>
