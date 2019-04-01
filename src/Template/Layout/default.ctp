<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Elecciones';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->css(['bootstrap.css']) ?>
    <?= $this->Html->css(['bootstrap-glyphicons.css']) ?>
    <?= $this->Html->script(['jquery-3.3.1.slim.min.js']) ?>
    <?= $this->Html->script(['popper.min.js']) ?>
    <?= $this->Html->script(['bootstrap.min.js']) ?>
    <?= $this->Html->script(['angular/angular.js']) ?>
    <?= $this->Html->script(['angular/1.5.6-angular-route.min.js']) ?>
    <?= $this->Html->script(['angular/app/app']) ?>
    <?= $this->Html->script(['canvasjs.min']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body ng-app="mainApp">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <!-- <a class="navbar-brand" href="#">Home</a> -->

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
            <li class="nav-item">
                <?php echo $this->Html->link('Candidatos', array('controller'=> 'candidatos', 'action'=>'index',),array('class'=>'nav-link'));?>
            </li>
            <li class="nav-item">
                <?php echo $this->Html->link('Cargar votos', array('controller'=> 'mesas_candidatos', 'action'=>'add',),array('class'=>'nav-link'));?>
            </li>
            <li class="nav-item">
                <?php echo $this->Html->link('Cargar provisoria', array('controller'=> 'mesas_candidatostwo', 'action'=>'add',),array('class'=>'nav-link'));?>
            </li>
            <li class="nav-item">
                <?php echo $this->Html->link('Establecimientos', array('controller'=> 'establecimientos', 'action'=>'index',),array('class'=>'nav-link'));?>
            </li>  
            <li class="nav-item">
                <?php echo $this->Html->link('Mesas', array('controller'=> 'mesas', 'action'=>'index',),array('class'=>'nav-link'));?>
            </li>  
            <li class="nav-item">
                <?php echo $this->Html->link('Graficos', array('controller'=> 'mesas_candidatos', 'action'=>'todos',1),array('class'=>'nav-link'));?>
            </li>
            <li class="nav-item">
                <?php echo $this->Html->link('Graficos provisorios', array('controller'=> 'mesas_candidatostwo', 'action'=>'provisorio',1),array('class'=>'nav-link'));?>
            </li>
            <li class="nav-item">
            <?php echo $this->Html->link('Salir', array('controller'=> 'users', 'action'=>'logout',),array('class'=>'nav-link'));?>
            </li>        
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="pt-5 container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
