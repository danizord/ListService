<?php

namespace LSUser\Controller;

use Zend\View\Model\ViewModel;
use LSBase\Controller\CrudController;

/**
 * UserController
 *
 * Classe Controller UserController
 *
 * @package LSUser\Controller
 * @author Jesus Vieira <jesusvieiradelima@gmail.com>
 * @version  v1.0
 */
class UserController extends CrudController
{

    public function __construct ()
    {
        $this->controller = 'user';
        $this->entity = 'LSUser\Entity\User';
        $this->form = 'LSUser\Form\User';
        $this->service = 'LSUser\Service\User';
        $this->route = 'user';

    }

    /**
     * newAction
     * 
     * Exibe pagina de cadastro.
     * 
     * @author Jesus Vieira <jesusvieiradelima@gmail.com>
     * @access public
     * @return \Zend\View\Model\ViewModel
     */
    public function newAction ()
    {
        $form = $this->getServiceLocator ()->get ($this->form);

        $request = $this->getRequest ();

        if ( $request->isPost () ) {

            $form->setData ($request->getPost ());

            if ( $form->isValid () ) {

                $service = $this->getServiceLocator ()->get ($this->service);
                $service->insert ($request->getPost ()->toArray ());

                return $this->redirect ()->toRoute ($this->route, array('controller' => $this->controller));
            }
        }

        return new ViewModel (array('form' => $form));

    }

}