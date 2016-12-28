<?php
class ExportController extends Controller{

    public function index() {
        UserModel::isAdmin();
        $this->render('index');
    }

    public function postprocess() {
        UserModel::isAdmin();
        if(count($_POST)) {
            UserModel::export($_POST['nom']);
            ArticleModel::export($_POST['nom']);
            CommentaireModel::export($_POST['nom']);
        }
        header('Location:'.WEBROOT.'export/index');
    }

}
?>