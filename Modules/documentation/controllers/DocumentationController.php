<?php
class DocumentationController extends Controller {
	protected function defineMainView() {
	    $this->mainView = "default";
	}

	protected function errorLoadingController() {
	    $this->mainView = "404";
    }
    
    public function doc_docAction() {
        $this->mainView = 'doc_doc'; 
        parent::main();
    }

    public function doc_installAction() {
        $this->mainView = 'doc_install'; 
        parent::main();
    }


    public function doc_configAction() {
        $this->mainView = 'doc_config'; 
        parent::main();
    }


    public function doc_moduleAction() {
        $this->mainView = 'doc_module'; 
        parent::main();
    }


    public function doc_routeAction() {
        $this->mainView = 'doc_route'; 
        parent::main();
    }


    public function doc_controllerAction() {
        $this->mainView = 'doc_controller'; 
        parent::main();
    }


    public function doc_classeAction() {
        $this->mainView = 'doc_classe'; 
        parent::main();
    }


    public function doc_databaseAction() {
        $this->mainView = 'doc_database'; 
        parent::main();
    }


    public function doc_viewAction() {
        $this->mainView = 'doc_view'; 
        parent::main();
    }

    public function doc_devAction(){
        $this->mainView = 'doc_dev'; 
        parent::main();
    }

}