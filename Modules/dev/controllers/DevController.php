<?php
class DevController extends Controller {

	protected function defineMainView() {
	    $this->mainView = "default";
	}

	protected function errorLoadingController() {
		Navigation::navigateTo('login');
	    //$this->mainView = "404";
	}

    public function dev_roles() {
        $this->mainView = 'dev_roles';
		$roles = Role::getAllRoles();
		$permissions = Permission::getAllPermissions();
		$this->arrTplVar([
			'roles' => $roles,
			'permissions' => $permissions
		]);
        parent::main();
    }

	public function dev_routes() {
        $this->mainView = 'dev_routes';
		$this->tplVar('routes', RoutesManager::getRoutesManager()->getRoutes());
        parent::main();
    }

	public function dev_modules() {
        $this->mainView = 'dev_modules';
		$modules = Module::getAll();
		$this->tplVar('modules', $modules);
        parent::main();
    }

	public function permissions_update(){
		$roles_ids = [];
		foreach($this->POST('permissions') as $data){
			$arr = explode('-', $data);
			if(!isset($roles_ids[$arr[0]]))
				$roles_ids[$arr[0]] = [];
			$roles_ids[$arr[0]][] = $arr[1];
		}

		foreach($roles_ids as $role_id => $perms_ids) {

			$Role = new Role($role_id);
			if(!$Role->exist())
				continue;

			$Role->linkPermissions($perms_ids);

		}

		Navigation::navigateTo('dev_roles');
	}

	public function roles_add(){
		$Role = new Role();
		$Role->setName(ucfirst($this->POST('role_name')));
		$Role->setDescription($this->POST('role_description'));
		$Role->create();

		Navigation::navigateTo('dev_roles');
	}

	public function permissions_add(){
		$Permission = new Permission();
		$Permission->setAction(strtoupper($this->POST('permission_action')));
		$Permission->setDescription($this->POST('permission_description'));
		$Permission->create();

		Navigation::navigateTo('dev_roles');
	}

}