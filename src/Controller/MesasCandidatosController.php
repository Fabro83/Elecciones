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
    public function charts ($funcion_id = null){
        // $mesas_candidatos = $this->MesasCandidatos->find('personalData',['funcion_id'=>$funcion_id]);
        $this->loadModel('Candidatos');
        $mesas_candidatos = $this->Candidatos->find('personalData',['funcion_id'=>$funcion_id]);
        for ($i=0; $i < sizeof($mesas_candidatos); $i++) {
            $cant_votos=0; 
            if(isset($mesas_candidatos[$i]['mesas'])){
                for ($j=0; $j < sizeof($mesas_candidatos[$i]['mesas']); $j++) { 
                    $cant_votos = $cant_votos + $mesas_candidatos[$i]['mesas'][$j]['_joinData']['votos'];
                }
                $mesas_candidatos[$i]['cantidad_votos'] = $cant_votos;
                unset($mesas_candidatos[$i]['mesas']);
            }
        }
        $candidatos = $this->MesasCandidatos->Candidatos->find('all');
        $this->set(compact('mesas_candidatos','candidatos'));
        // pr($mesas_candidatos);
    }
    public function todos ($tipo_grafico = null){
        // $mesas_candidatos = $this->MesasCandidatos->find('personalData',['funcion_id'=>$funcion_id]);
        if($tipo_grafico == 1){
            $tipo_grafico = "column";
        }else{
            $tipo_grafico = "pie";
        }
        $this->loadModel('Candidatos');
        $gobernadores = $this->Candidatos->find('personalData',['funcion_id'=>1]);
        $gobernadores = $this->cargar_arre($gobernadores);
        $proporcionales = $this->Candidatos->find('personalData',['funcion_id'=>2]);
        $proporcionales = $this->cargar_arre($proporcionales);
        $provinciales = $this->Candidatos->find('personalData',['funcion_id'=>3]);
        $provinciales = $this->cargar_arre($provinciales);
        $intendentes = $this->Candidatos->find('personalData',['funcion_id'=>4]);
        $intendentes = $this->cargar_arre($intendentes);
        $concejales = $this->Candidatos->find('personalData',['funcion_id'=>5]);
        $concejales = $this->cargar_arre($concejales);    
        $this->set(compact('gobernadores','proporcionales','provinciales','intendentes','concejales','tipo_grafico'));
        // pr($mesas_candidatos);
    }
    public function paramesas ($tipo_grafico = null,$mesa_id = null){
        
        if($tipo_grafico == 1){
            $tipo_grafico = "column";
        }else{
            $tipo_grafico = "pie";
        }
        $this->loadModel('Candidatos');
        $gobernadores = $this->Candidatos->find('personalMesaData',['funcion_id'=>1,'mesa_id'=>$mesa_id]);
        $gobernadores = $this->cargar_arre($gobernadores);
        // pr($gobernadores);
        $proporcionales = $this->Candidatos->find('personalMesaData',['funcion_id'=>2,'mesa_id'=>$mesa_id]);
        $proporcionales = $this->cargar_arre($proporcionales);
        $provinciales = $this->Candidatos->find('personalMesaData',['funcion_id'=>3,'mesa_id'=>$mesa_id]);
        $provinciales = $this->cargar_arre($provinciales);
        $intendentes = $this->Candidatos->find('personalMesaData',['funcion_id'=>4,'mesa_id'=>$mesa_id]);
        $intendentes = $this->cargar_arre($intendentes);
        $concejales = $this->Candidatos->find('personalMesaData',['funcion_id'=>5,'mesa_id'=>$mesa_id]);
        $concejales = $this->cargar_arre($concejales);    
        $this->set(compact('gobernadores','proporcionales','provinciales','intendentes','concejales','tipo_grafico'));
        // pr($mesas_candidatos);
    }
    public function paraestablecimientos ($tipo_grafico = null,$establecimiento_id = null){
        
        if($tipo_grafico == 1){
            $tipo_grafico = "column";
        }else{
            $tipo_grafico = "pie";
        }
        $this->loadModel('Candidatos');
        $gobernadores = $this->Candidatos->find('PersonalEstablecimientoData',['funcion_id'=>1,'establecimiento_id'=>$establecimiento_id]);
        $gobernadores = $this->cargar_arre($gobernadores);
        // pr($gobernadores);
        $proporcionales = $this->Candidatos->find('PersonalEstablecimientoData',['funcion_id'=>2,'establecimiento_id'=>$establecimiento_id]);
        $proporcionales = $this->cargar_arre($proporcionales);
        $provinciales = $this->Candidatos->find('PersonalEstablecimientoData',['funcion_id'=>3,'establecimiento_id'=>$establecimiento_id]);
        $provinciales = $this->cargar_arre($provinciales);
        $intendentes = $this->Candidatos->find('PersonalEstablecimientoData',['funcion_id'=>4,'establecimiento_id'=>$establecimiento_id]);
        $intendentes = $this->cargar_arre($intendentes);
        $concejales = $this->Candidatos->find('PersonalEstablecimientoData',['funcion_id'=>5,'establecimiento_id'=>$establecimiento_id]);
        $concejales = $this->cargar_arre($concejales);    
        $this->set(compact('gobernadores','proporcionales','provinciales','intendentes','concejales','tipo_grafico'));
        // pr($mesas_candidatos);
    }
    public function cargar_arre($arre = null){
        for ($i=0; $i < sizeof($arre); $i++) {
            $cant_votos=0; 
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
    public function elegircharts(){

    }
    public function individual ($tipo_grafico = null,$funcion_id = null){
        // $mesas_candidatos = $this->MesasCandidatos->find('personalData',['funcion_id'=>$funcion_id]);
        if($tipo_grafico == 1){
            $tipo_grafico = "column";
        }else{
            $tipo_grafico = "pie";
        }
        $this->loadModel('Candidatos');
        switch ($funcion_id) {
                case 1:
                $funcionario = $this->Candidatos->find('personalData',['funcion_id'=>1]);
                $funcionario = $this->cargar_arre($funcionario);
                break;
                case 2:
                $funcionario = $this->Candidatos->find('personalData',['funcion_id'=>2]);
                $funcionario = $this->cargar_arre($funcionario);
                break;
                case 3:
                $funcionario = $this->Candidatos->find('personalData',['funcion_id'=>3]);
                $funcionario = $this->cargar_arre($funcionario);
                break;
                case 4:
                $funcionario = $this->Candidatos->find('personalData',['funcion_id'=>4]);
                $funcionario = $this->cargar_arre($funcionario);
                break;
                case 5:
                $funcionario = $this->Candidatos->find('personalData',['funcion_id'=>5]);
                $funcionario = $this->cargar_arre($funcionario);  
                break;
            
            default:
                # code...
                break;
        }
         
        $this->set(compact('funcionario','tipo_grafico','funcion_id'));
        // pr($mesas_candidatos);
    }

}
