<?php
class UrlResolver{

    private $urlParameters = array("content");

    function generateUrl($content){
        //CHANGE URL FOR PRODUCTION
        $url = "http://localhost/CMD_WEBSITES/JCRFoodTrailers/index.php?content=".$content;

        return $url;
    }


    function addCustomURLParameter($content,$parameter_name,$parameter_value){
        $url = $this->generateUrl($content);
        $url = $url."&".$parameter_name."=".$parameter_value;

        return $url;
    }

    function checkUrlParameters($url){

        for($i=0;$i<count($urlParameters);$i++){
            if(!str_contains($url,$urlParameters[$i])){
                return false;
            }
        }
               return true;

    }

    
}

?>

