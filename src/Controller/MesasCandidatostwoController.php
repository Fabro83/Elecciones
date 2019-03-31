<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
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
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        //PARA QUE FUNCIONE HAY QUE IMPORTAR EL USE EVENT () use Cake\Event\Event;
        $this->Auth->allow(['provisorio']);
        $this->provisorio(1);
    }
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
        $candidatos = $this->MesasCandidatostwo->Candidatostwo->find('all')->order(['id']);
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

    public function provisorio ($tipo_grafico = null){
        // $mesas_candidatos = $this->MesasCandidatos->find('personalData',['funcion_id'=>$funcion_id]);
        if($tipo_grafico == 1){
            $tipo_grafico = "column";
        }else{
            $tipo_grafico = "pie";
        }
        $this->loadModel('Candidatostwo'); 
        $this->loadModel('Mesas'); 
        $gobernadores = $this->Candidatostwo->find('personalData',['funcion_id'=>1]);        
        $gobernadores = $this->cargar_arre($gobernadores);
        $totalGobernador = $this->Mesas->find();
        $totalGobernador->select(['SUM' => $totalGobernador->func()->sum('total_gobernador')]);
        $intendentes = $this->Candidatostwo->find('personalData',['funcion_id'=>4]);
        
        $totalIntendente = $this->Mesas->find();
        $totalIntendente->select(['SUM' => $totalIntendente->func()->sum('total_intendente')]);
        $intendentes = $this->cargar_arre($intendentes);

        $this->set(compact('gobernadores','intendentes','totalGobernador','totalIntendente','tipo_grafico'));
        //echo ($totalGobernador);
    }
    public function paramesas ($tipo_grafico = null,$mesa_id = null){
        
        if($tipo_grafico == 1){
            $tipo_grafico = "column";
        }else{
            $tipo_grafico = "pie";
        }
        $this->loadModel('Candidatostwo');
        $gobernadores = $this->Candidatostwo->find('personalMesaData',['funcion_id'=>1,'mesa_id'=>$mesa_id]);
        $gobernadores = $this->cargar_arre($gobernadores);
        $intendentes = $this->Candidatostwo->find('personalMesaData',['funcion_id'=>4,'mesa_id'=>$mesa_id]);
        $intendentes = $this->cargar_arre($intendentes);
        $this->set(compact('gobernadores','intendentes','tipo_grafico'));
        // pr($mesas_candidatos);
    }
    public function paraestablecimientos ($tipo_grafico = null,$establecimiento_id = null){
        
        if($tipo_grafico == 1){
            $tipo_grafico = "column";
        }else{
            $tipo_grafico = "pie";
        }
        $this->loadModel('Candidatostwo');
        $gobernadores = $this->Candidatostwo->find('PersonalEstablecimientoData',['funcion_id'=>1,'establecimiento_id'=>$establecimiento_id]);
        $gobernadores = $this->cargar_arre($gobernadores);
        $intendentes = $this->Candidatostwo->find('PersonalEstablecimientoData',['funcion_id'=>4,'establecimiento_id'=>$establecimiento_id]);
        $intendentes = $this->cargar_arre($intendentes);
        $this->set(compact('gobernadores','intendentes','tipo_grafico'));
        // pr($mesas_candidatos);
    }
    public function cargar_arre($arre = null){
        for ($i=0; $i < sizeof($arre); $i++) {
            $cant_votos=0;
            if($arre[$i]['partido']['color']['html']){
                $arre[$i]['color'] = $arre[$i]['partido']['color']['html'];
            }
            unset($arre[$i]['partido']);
            if(isset($arre[$i]['mesas'])){
                for ($j=0; $j < sizeof($arre[$i]['mesas']); $j++) { 
                    $cant_votos = $cant_votos + $arre[$i]['mesas'][$j]['_joinData']['votos'];
                }
                $arre[$i]['cantidad_votos'] = $cant_votos;
                unset($arre[$i]['mesas']);
            }
        }
        return $arre;
    }

    public function individual ($funcion_id = null){
        // $mesas_candidatos = $this->MesasCandidatos->find('personalData',['funcion_id'=>$funcion_id]);
        $this->loadModel('Candidatostwo');

        $funcionario = $this->Candidatostwo->find('personalData',['funcion_id'=>$funcion_id]);
        $funcionario = $this->cargar_arre($funcionario);

        $this->set(compact('funcionario','funcion_id'));
    }

    public function vs ($funcion_id = null){
        $this->loadModel('Candidatostwo');
      
        $funcionario = $this->Candidatostwo->find('personalData',['funcion_id'=>4]);
        $funcionario = $this->cargar_arre($funcionario);
     
        $this->set(compact('funcionario','funcion_id'));
    }


    public function cantidad (){
        $this->autoRender = false;        
        $count = $this->MesasCandidatostwo->find();
        $count->select(['SUM' => $count->func()->sum('votos')]);
        echo json_encode($count);
    }
}
