<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PessoaController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for pessoa
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Pessoa", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $pessoa = Pessoa::find($parameters);
        if (count($pessoa) == 0) {
            $this->flash->notice("The search did not find any pessoa");

            return $this->dispatcher->forward(array(
                "controller" => "pessoa",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $pessoa,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displayes the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a pessoa
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $pessoa = Pessoa::findFirstByid($id);
            if (!$pessoa) {
                $this->flash->error("pessoa was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "pessoa",
                    "action" => "index"
                ));
            }

            $this->view->id = $pessoa->id;

            $this->tag->setDefault("id", $pessoa->id);
            $this->tag->setDefault("nome", $pessoa->nome);
            $this->tag->setDefault("sobrenome", $pessoa->sobrenome);
            
        }
    }

    /**
     * Creates a new pessoa
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "pessoa",
                "action" => "index"
            ));
        }

        $pessoa = new Pessoa();

        $pessoa->nome = $this->request->getPost("nome");
        $pessoa->sobrenome = $this->request->getPost("sobrenome");
        

        if (!$pessoa->save()) {
            foreach ($pessoa->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "pessoa",
                "action" => "new"
            ));
        }

        $this->flash->success("pessoa was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "pessoa",
            "action" => "index"
        ));

    }

    /**
     * Saves a pessoa edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "pessoa",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $pessoa = Pessoa::findFirstByid($id);
        if (!$pessoa) {
            $this->flash->error("pessoa does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "pessoa",
                "action" => "index"
            ));
        }

        $pessoa->nome = $this->request->getPost("nome");
        $pessoa->sobrenome = $this->request->getPost("sobrenome");
        

        if (!$pessoa->save()) {

            foreach ($pessoa->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "pessoa",
                "action" => "edit",
                "params" => array($pessoa->id)
            ));
        }

        $this->flash->success("pessoa was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "pessoa",
            "action" => "index"
        ));

    }

    /**
     * Deletes a pessoa
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $pessoa = Pessoa::findFirstByid($id);
        if (!$pessoa) {
            $this->flash->error("pessoa was not found");

            return $this->dispatcher->forward(array(
                "controller" => "pessoa",
                "action" => "index"
            ));
        }

        if (!$pessoa->delete()) {

            foreach ($pessoa->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "pessoa",
                "action" => "search"
            ));
        }

        $this->flash->success("pessoa was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "pessoa",
            "action" => "index"
        ));
    }

}
