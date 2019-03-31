<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Candidatostwo Controller
 *
 * @property \App\Model\Table\CandidatostwoTable $Candidatostwo
 *
 * @method \App\Model\Entity\Candidatostwo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CandidatostwoController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    { 
        $this->paginate = [
            'contain' => ['Funcions', 'Partidos']
        ];
        $candidatostwo = $this->paginate($this->Candidatostwo);

        $this->set(compact('candidatostwo'));
    }

    /**
     * View method
     *
     * @param string|null $id Candidatostwo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $candidatostwo = $this->Candidatostwo->get($id, [
            'contain' => ['Funcions', 'Partidos']
        ]);

        $this->set('candidatostwo', $candidatostwo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $candidatostwo = $this->Candidatostwo->newEntity();
        if ($this->request->is('post')) {
            $candidatostwo = $this->Candidatostwo->patchEntity($candidatostwo, $this->request->getData());
            if ($this->Candidatostwo->save($candidatostwo)) {
                $this->Flash->success(__('The candidatostwo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidatostwo could not be saved. Please, try again.'));
        }
        $funcions = $this->Candidatostwo->Funcions->find('list', ['limit' => 200]);
        $partidos = $this->Candidatostwo->Partidos->find('list', ['limit' => 200]);
        $this->set(compact('candidatostwo', 'funcions', 'partidos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Candidatostwo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $candidatostwo = $this->Candidatostwo->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidatostwo = $this->Candidatostwo->patchEntity($candidatostwo, $this->request->getData());
            if ($this->Candidatostwo->save($candidatostwo)) {
                $this->Flash->success(__('The candidatostwo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidatostwo could not be saved. Please, try again.'));
        }
        $funcions = $this->Candidatostwo->Funcions->find('list', ['limit' => 200]);
        $partidos = $this->Candidatostwo->Partidos->find('list', ['limit' => 200]);
        $this->set(compact('candidatostwo', 'funcions', 'partidos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Candidatostwo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $candidatostwo = $this->Candidatostwo->get($id);
        if ($this->Candidatostwo->delete($candidatostwo)) {
            $this->Flash->success(__('The candidatostwo has been deleted.'));
        } else {
            $this->Flash->error(__('The candidatostwo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
