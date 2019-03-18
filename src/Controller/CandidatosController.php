<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Candidatos Controller
 *
 * @property \App\Model\Table\CandidatosTable $Candidatos
 *
 * @method \App\Model\Entity\Candidato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CandidatosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $candidatos = $this->paginate($this->Candidatos);

        $this->set(compact('candidatos'));
    }

    /**
     * View method
     *
     * @param string|null $id Candidato id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $candidato = $this->Candidatos->get($id, [
            'contain' => ['Mesas']
        ]);

        $this->set('candidato', $candidato);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $candidato = $this->Candidatos->newEntity();
        if ($this->request->is('post')) {
            $candidato = $this->Candidatos->patchEntity($candidato, $this->request->getData());
            if ($this->Candidatos->save($candidato)) {
                $this->Flash->success(__('The candidato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidato could not be saved. Please, try again.'));
        }
        $mesas = $this->Candidatos->Mesas->find('list', ['limit' => 200]);
        $this->set(compact('candidato', 'mesas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Candidato id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $candidato = $this->Candidatos->get($id, [
            'contain' => ['Mesas']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidato = $this->Candidatos->patchEntity($candidato, $this->request->getData());
            if ($this->Candidatos->save($candidato)) {
                $this->Flash->success(__('The candidato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidato could not be saved. Please, try again.'));
        }
        $mesas = $this->Candidatos->Mesas->find('list', ['limit' => 200]);
        $this->set(compact('candidato', 'mesas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Candidato id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $candidato = $this->Candidatos->get($id);
        if ($this->Candidatos->delete($candidato)) {
            $this->Flash->success(__('The candidato has been deleted.'));
        } else {
            $this->Flash->error(__('The candidato could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
