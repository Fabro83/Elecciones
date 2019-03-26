<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Mesas Controller
 *
 * @property \App\Model\Table\MesasTable $Mesas
 *
 * @method \App\Model\Entity\Mesa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MesasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $mesas = $this->paginate($this->Mesas->find('all')->contain(['Establecimientos']));

        $this->set(compact('mesas'));
    }

    /**
     * View method
     *
     * @param string|null $id Mesa id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mesa = $this->Mesas->get($id, [
            'contain' => ['Candidatos']
        ]);

        $this->set('mesa', $mesa);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mesa = $this->Mesas->newEntity();
        if ($this->request->is('post')) {
            $mesa = $this->Mesas->patchEntity($mesa, $this->request->getData());
            if ($this->Mesas->save($mesa)) {
                $this->Flash->success(__('The mesa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mesa could not be saved. Please, try again.'));
        }
        $establecimientos = $this->Mesas->Establecimientos->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre_establecimiento'
        ])->where(['Establecimientos.delete'=>0])->toArray();
        $this->set(compact('mesa', 'establecimientos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mesa id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mesa = $this->Mesas->get($id, [
            'contain' => ['Establecimientos']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mesa = $this->Mesas->patchEntity($mesa, $this->request->getData());
            if ($this->Mesas->save($mesa)) {
                $this->Flash->success(__('The mesa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mesa could not be saved. Please, try again.'));
        }
        $establecimientos = $this->Mesas->Establecimientos->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre_establecimiento'
        ])->where(['Establecimientos.delete'=>0])->toArray();
        $this->set(compact('mesa', 'establecimientos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mesa id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mesa = $this->Mesas->get($id);
        if ($this->Mesas->delete($mesa)) {
            $this->Flash->success(__('The mesa has been deleted.'));
        } else {
            $this->Flash->error(__('The mesa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
}
