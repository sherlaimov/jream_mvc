<?php

class Controller_Note extends Controller
{

    function __construct()
    {


        parent::__construct();
        $this->model = $this->load_model('note');
        $this->handleLogin();
//        $logged = Session::get('loggedIn');
//        $role = Session::get('role');
//
//        if ($logged == false || $role == 'default') {
//            Session::destroy();
//            header('location: ' . URL .'login');
//            exit;
//        }

    }

    public function index()
    {
       $data = $this->view->noteList = $this->model->noteList();

       // var_dump($data);
       $this->view->render('note/index');
    }

    public function create()
    {
        $data = array(
            'title' => trim($_POST['title']),
            'content' => trim($_POST['content'])
        );
//        $data['login'] = trim($_POST['login']);
//        $data['password'] = trim($_POST['password']);
//        $data['role'] = trim($_POST['role']);

        $this->model->insertNote($data);
        header('Location: ' . URL . 'note');

    }
//does this matter to Git?

    public function edit($id)
    {
        //fetch individual user
        $this->view->note = $this->model->singleNoteList($id);
        //var_dump($this->view->note);
        $this->view->render('note/edit');
    }

    public function editSave($id){

        $data = array(
            'title' => trim($_POST['title']),
            'content' => trim($_POST['content']),
            'note_id' => $id
        );


        $this->model->editNote($data);
        header('Location: ' . URL . 'note');
    }

    public function delete($id)
    {
        $this->model->deleteNote($id);
        header('Location: ' . URL . 'note');


    }
}
