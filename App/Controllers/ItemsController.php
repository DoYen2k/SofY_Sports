<?php 
    use App\Core\Controller;

    class ItemsController extends Controller {
        private $itemsmodel;
        function __construct()
        {
            $this->itemsmodel = $this->model('itemsmodel');
        }
        function index(){
            if(isset($_GET['id'])){
                $idItems = $_GET['id'];
            }
            $data['items'] = $this->itemsmodel->getByItems($idItems);
            $data['comment'] = $this->itemsmodel->getComment($idItems);
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
            $this->view("/items/index", $data);
        }
        function search(){
            $keyword = $_GET['keyword'];
            $items = $this->itemsmodel->getByKeyword($keyword);
            $data['keyword'] = $keyword;
            $data['items'] = $items;

            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
            $this->view('/items/search', $data);
        }
        function comment(){
            $id = $_SESSION['user']['id'];
            if (isset($_POST)) {
                $data =$_POST;
                $result = $this->itemsmodel->comment($id, $data);
                if ($result) {
                    header("Location: " . DOCUMENT_ROOT . "/items/detail?id=".$_POST['idItem']."");
                }
            }
        }
    }
?>