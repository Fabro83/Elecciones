<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MesasCandidatostwo Controller
 *
 * @property \App\Model\Table\MesasCandidatostwoTable $MesasCandidatostwo
 *
 * @method \App\Model\Entity\MesasCandidatostwo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MesasCandidatostwoController extends AppController
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
        $mesasCandidatostwo = $this->paginate($this->MesasCandidatostwo);

        $this->set(compact('mesasCandidatostwo'));
    }

    /**
     * View method
     *
     * @param string|null $id Mesas Candidatostwo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mesasCandidatostwo = $this->MesasCandidatostwo->get($id, [
            'contain' => ['Candidatos', 'Mesas']
        ]);

        $this->set('mesasCandidatostwo', $mesasCandidatostwo);
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
            $this->loadModel('Mesas');
            // file_put_contents('fede.txt',$this->request->getData());
            $mesa = $record[sizeof($record)-1];
            // pr($mesa);
            if(!empty($mesa)){
                $aux_mesa = $this->Mesas->get($mesa['Mesa']['id']);
                $aux_mesa->total_gobernador = $mesa['Mesa']['total_gobernador'];
                $aux_mesa->total_intendente = $mesa['Mesa']['total_intendente'];
                $aux_mesa->parcial_votantes = $mesa['Mesa']['parcial_votantes'];
                $this->Mesas->save($aux_mesa);
            }
            foreach ($record as $key => $value) {
                $mesasCandidato = $this->MesasCandidatostwo->newEntity();
                $mesasCandidato = $this->MesasCandidatostwo->patchEntity($mesasCandidato, $value);
                $this->MesasCandidatostwo->save($mesasCandidato);
            }
            return $this->redirect(['action' => 'add']);
            
        }
        // $this->loadModel('Mesas');
        $candidatos = $this->MesasCandidatostwo->Candidatostwo->find('all');
        $establecimientos = $this->MesasCandidatostwo->Mesas->Establecimientos->find('all') 
                            ->contain(['Mesas'=>function($q)
                            {
                            return $q->where(['Mesas.delete'=>0]);
                            }])
                            ->toArray();
        //pr($mesas);
        $this->set(compact('candidatos', 'establecimientos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mesas Candidatostwo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mesasCandidatostwo = $this->MesasCandidatostwo->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mesasCandidatostwo = $this->MesasCandidatostwo->patchEntity($mesasCandidatostwo, $this->request->getData());
            if ($this->MesasCandidatostwo->save($mesasCandidatostwo)) {
                $this->Flash->success(__('The mesas candidatostwo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mesas candidatostwo could not be saved. Please, try again.'));
        }
        $candidatos = $this->MesasCandidatostwo->Candidatos->find('list', ['limit' => 200]);
        $mesas = $this->MesasCandidatostwo->Mesas->find('list', ['limit' => 200]);
        $this->set(compact('mesasCandidatostwo', 'candidatos', 'mesas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mesas Candidatostwo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mesasCandidatostwo = $this->MesasCandidatostwo->get($id);
        if ($this->MesasCandidatostwo->delete($mesasCandidatostwo)) {
            $this->Flash->success(__('The mesas candidatostwo has been deleted.'));
        } else {
            $this->Flash->error(__('The mesas candidatostwo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
