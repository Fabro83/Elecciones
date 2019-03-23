<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MesasCandidatos Controller
 *
 * @property \App\Model\Table\MesasCandidatosTable $MesasCandidatos
 *
 * @method \App\Model\Entity\MesasCandidato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MesasCandidatosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Candidatos', 'Mesas']
        ];
        $mesasCandidatos = $this->paginate($this->MesasCandidatos);

        $this->set(compact('mesasCandidatos'));
    }

    /**
     * View method
     *
     * @param string|null $id Mesas Candidato id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mesasCandidato = $this->MesasCandidatos->get($id, [
            'contain' => ['Candidatos', 'Mesas']
        ]);

        $this->set('mesasCandidato', $mesasCandidato);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        if ($this->request->is('post')) {
            $record = $this->request->getData();
            // file_put_contents('fede.txt',$this->request->getData());
            // pr($record);
            foreach ($record as $key => $value) {
                $mesasCandidato = $this->MesasCandidatos->newEntity();
                $mesasCandidato = $this->MesasCandidatos->patchEntity($mesasCandidato, $value);
                $this->MesasCandidatos->save($mesasCandidato);
            }
            return $this->redirect(['action' => 'add']);
            
        }
        $candidatos = $this->MesasCandidatos->Candidatos->find('all');
        $establecimientos = $this->MesasCandidatos->Mesas->Establecimientos->find('all', ['contain' => 'Mesas'])->toArray();
        //pr($mesas);
        $this->set(compact('mesasCandidato', 'candidatos', 'establecimientos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mesas Candidato id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mesasCandidato = $this->MesasCandidatos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mesasCandidato = $this->MesasCandidatos->patchEntity($mesasCandidato, $this->request->getData());
            if ($this->MesasCandidatos->save($mesasCandidato)) {
                $this->Flash->success(__('The mesas candidato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mesas candidato could not be saved. Please, try again.'));
        }
        $candidatos = $this->MesasCandidatos->Candidatos->find('list', ['limit' => 200]);
        $mesas = $this->MesasCandidatos->Mesas->find('list', ['limit' => 200]);
        $this->set(compact('mesasCandidato', 'candidatos', 'mesas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mesas Candidato id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mesasCandidato = $this->MesasCandidatos->get($id);
        if ($this->MesasCandidatos->delete($mesasCandidato)) {
            $this->Flash->success(__('The mesas candidato has been deleted.'));
        } else {
            $this->Flash->error(__('The mesas candidato could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
