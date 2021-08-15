<?php

namespace Classes;

include_once 'Controller.class.php';


class AdminController extends Controller
{

    private $user = "";
   
    function __construct(array $data = [])
    {

        parent::__construct($data);

        $this->user =  getUserSession();

        $user = $this->user;

        if (!$user->isAdmin()) {

            $this->forbidden();

        } else {

        return $user;

        }
    }
    
    public function forbidden()
    {
        echo "<h2> Access forbidden </h2>";
        header('index.php');
    }


    public function displayContent(array $data,$obj)
    {
        try {
        $page = new parent($data);
            parent::getPage($obj);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
       
    }
}
