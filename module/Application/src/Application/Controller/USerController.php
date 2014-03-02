<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
	protected $_objectManager;
	
    public function listAction()
    {
    	$fieldsToOrder = array('id', 'email');
		$order_by = $this->params()->fromRoute('order_by') ?
                $this->params()->fromRoute('order_by') : 'id';
        $order = $this->params()->fromRoute('order') ?
                $this->params()->fromRoute('order') : 'ASC';
        $users = $this->getServiceLocator()->get('entity_manager')
            ->getRepository('Application\Entity\User')
            ->findBy(array(), array($order_by => $order));
		
		$sorting = array();
		foreach($fieldsToOrder as $key=>$value)
		{
			$ord = 'ASC';
			if($order_by == $value && $order == 'ASC')
			{
				$ord = 'DESC';
			}
			$sorting[$value] = $ord;
		}

        return new ViewModel(array(
            'users' =>  $users,
            'sorting' => $sorting
        ));
    }

    public function addAction()
    {
        /* @var $form \Application\Form\UserForm */
        $form = $this->getServiceLocator()->get('formElementManager')->get('form.user');

        $data = $this->prg();

        if ($data instanceof \Zend\Http\PhpEnvironment\Response) {
            return $data;
        }

        if ($data != false) {
            $form->setData($data);
            if ($form->isValid()) {

                /* @var $user \Application\Entity\User */
                $user = $form->getData();

                /* @var $serviceUser \Application\Service\UserService */
                $serviceUser = $this->getServiceLocator()->get('application.service.user');

                $serviceUser->saveUser($user);

                $this->redirect()->toRoute('users');
            }
        }

        return new ViewModel(array(
            'form'  =>  $form
        ));
    }

    public function removeAction()
    {
    	$id = (int) $this->params()->fromRoute('user_id', 0);
		$user = $this->getObjectManager()->find('\Application\Entity\User', $id); 
        
		if ($this->request->isPost()) {
            $this->getObjectManager()->remove($user);
            $this->getObjectManager()->flush();

            return $this->redirect()->toRoute('users');
        }
		return new ViewModel(array(
            'user'  =>  $user
        ));
    }

    public function editAction()
    {
        $form = $this->getServiceLocator()->get('formElementManager')->get('form.user');

        $userToEdit = $this->getServiceLocator()->get('entity_manager')
            ->getRepository('Application\Entity\User')
            ->find($this->params()->fromRoute('user_id'));

        $form->bind($userToEdit);
        $form->get('firstname')->setValue($userToEdit->getFirstName());
		$form->get('lastname')->setValue($userToEdit->getLastName());
		$form->get('birth')->setValue($userToEdit->getBirth());

        $data = $this->prg();

        if ($data instanceof \Zend\Http\PhpEnvironment\Response) {
            return $data;
        }

        if ($data != false) {
            $form->setData($data);
            if ($form->isValid()) {
				
                /* @var $user \Application\Entity\User */
                $user = $form->getData();
				$serviceUser = $this->getServiceLocator()->get('application.service.user');

                $serviceUser->saveUser($user);
                //Save the user

                $this->redirect()->toRoute('users');
            }
        }

        return new ViewModel(array(
            'form'  =>  $form
        ));
    }
	
    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
	

}