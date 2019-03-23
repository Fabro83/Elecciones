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
        $candidatos = $this->Candidatos->find('all')->contain(['Funciones','Partidos']);
        // pr($candidatos);
        $candidatos = $this->paginate($candidatos);
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
            'contain' => ['Mesas','Funciones','Partido']
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
        $partidos = $this->Candidatos->Partidos->find('list');
        $funciones = $this->Candidatos->Funciones->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre'
        ])->where(['Funciones.delete'=>0]);
        $this->set(compact('candidato', 'mesas','partidos','funciones'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Candidato id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $partido_id = null, $funcion_id = null)
    {
        $candidato = $this->Candidatos->find('all')
                                                ->where(['Candidatos.id'=>$id, 'Candidatos.partido_id'=>$partido_id, 'Candidatos.funcion_id'=> $funcion_id])
                                                ->contain(['Partidos','Funciones'])
                                                ->first();
                                                
        if ($this->request->is(['patch', 'post', 'put'])) {
                
            $candidato = $this->Candidatos->patchEntity($candidato, $this->request->getData());
            pr($candidato);
            //pr($candidato);
            if ($this->Candidatos->save($candidato)) {
                $this->Flash->success(__('The candidato has been saved.'));

                //return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The candidato could not be saved. Please, try again.'));
        }
        $partidos = $this->Candidatos->Partidos->find('list')->toArray();
        $funciones = $this->Candidatos->Funciones->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre'
        ])->where(['Funciones.delete'=>0])->toArray();
        //pr($partidos);
        $this->set(compact('candidato','partidos','funciones'));
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
