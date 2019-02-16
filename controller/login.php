<?php    

class LoginController
{
    function loginAction()
    {
        $username = $this->request->get('username');
        $password = $this->request->get('password');

        $this->loadModel('users');
        if ($this->users->validate($username, $password))
        {
            $userData = $this->users->fetch($username);
            AuthStorage::save($username, $userData);
            $this->redirect('secret_area');
        }
        else
        {
            $this->view->message = 'Invalid login';
            $this->view->render('error');
        }
    }

    function logoutAction()
    {
        if (AuthStorage::logged())
        {
            AuthStorage::remove();
            $this->redirect('index');
        }
        else
        {
            $this->view->message = 'You are not logged in.';
            $this->view->render('error');
        }
    }

    function defaultAction()
    {
        include_once "./controller/default.php";
        $controller = new DefaultController();
        $controller->defaultAction();
    }
}