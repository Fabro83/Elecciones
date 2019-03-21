<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Funciones Controller
 *
 * @property \App\Model\Table\FuncionesTable $Funciones
 *
 * @method \App\Model\Entity\Funcione[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FuncionesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $funciones = $this->paginate($this->Funciones);

        $this->set(compact('funciones'));
    }

    /**
     * View method
     *
     * @param string|null $id Funcione id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $funcione = $this->Funciones->get($id, [
            'contain' => []
        ]);

        $this->set('funcione', $funcione);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $funcione = $this->Funciones->newEntity();
        if ($this->request->is('post')) {
            $funcione = $this->Funciones->patchEntity($funcione, $this->request->getData());
            if ($this->Funciones->save($funcione)) {
                $this->Flash->success(__('The funcione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The funcione could not be saved. Please, try again.'));
        }
        $this->set(compact('funcione'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Funcione id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $funcione = $this->Funciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $funcione = $this->Funciones->patchEntity($funcione, $this->request->getData());
            if ($this->Funciones->save($funcione)) {
                $this->Flash->success(__('The funcione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The funcione could not be saved. Please, try again.'));
        }
        $this->set(compact('funcione'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Funcione id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $funcione = $this->Funciones->get($id);
        if ($this->Funciones->delete($funcione)) {
            $this->Flash->success(__('The funcione has been deleted.'));
        } else {
            $this->Flash->error(__('The funcione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
