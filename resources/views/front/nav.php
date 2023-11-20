<div class="container bg-gray-500 rounded-top">
<nav class="navbar navbar-expand-lg navbar-light bg-blue">
  <a class="navbar-brand" href="/Amoreb/MCallCenter"><img src="<?= UrlTo('Assets/img/logo.png')?>" height="32px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="mr-auto navbar-nav">
    <?php if(isset($_SESSION['ventas']))
    {?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ventas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?=isset($_SESSION['ptv'])?'<a class="dropdown-item" href="ptv">PTV</a>':''?>
          
          <?=isset($_SESSION['cajashacercorte']) && isset($_SESSION["IdCajaMovi"])  && ($_SESSION["IdCajaMovi"])>0?'<div class="dropdown-divider"></div><a class="dropdown-item" href="cajashacercorte">Realizar un corte de caja</a>':''?>
          
          <?=isset($_SESSION['xxx'])?'<div class="dropdown-divider"></div><a class="dropdown-item" href="ReenviarCorreoDis">¿Cual ser vendio más?</a>':''?>   
          <?=isset($_SESSION['venxxxtas'])?'<div class="dropdown-divider"></div><a class="dropdown-item" href="ReenviarCorreoReg">Ventas por fechas</a>':''?>
        </div>
      </li>
      <?php } ?>    
      <!-- MENU DIVISION -->    
    <?php if(isset($_SESSION['reportes']))
    {?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Reportes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?=isset($_SESSION['ventadeldia'])?'<a class="dropdown-item" href="ventadeldia">Ventas del día</a>':''?>
          <div class="dropdown-divider"></div>
          <?=isset($_SESSION['stock'])?'<a class="dropdown-item" href="stock">Stock</a>':''?>
          <div class="dropdown-divider"></div>
          <?=isset($_SESSION['cualsevendiomas'])?'<a class="dropdown-item" href="cualsevendiomas">¿Cual ser vendio más?</a>':''?>
          <div class="dropdown-divider"></div>               
          <?=isset($_SESSION['ventas'])?'<a class="dropdown-item" href="ventas">Ventas por fechas</a>':''?>
          <div class="dropdown-divider"></div>               
          <?=isset($_SESSION['cajascierres'])?'<a class="dropdown-item" href="cajascierres">Cierres de Caja</a>':''?>          
        </div>
      </li>
      <?php } ?>
      <!-- MENU DIVISION -->
      <?php if(isset($_SESSION['almacen'])){?>      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Almacen
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?=isset($_SESSION['productos'])?'<a class="dropdown-item" href="productos">Productos</a>':''?>
          <?=isset($_SESSION['productosentradas'])?'<a class="dropdown-item" href="productosentradas">Productos Altas</a>':''?>
          <?=isset($_SESSION['productostraspasos'])?'<a class="dropdown-item" href="productostraspasos">Productos Traspasos</a>':''?>
        </div>        
      </li>
      <?php } ?>
      <!-- MENU DIVISION -->
      <?php if(isset($_SESSION['configuracion'])){?>      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Configuración
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?=isset($_SESSION['sucursales'])?'<a class="dropdown-item" href="sucursales">Sucursales</a>':''?>
          <?=isset($_SESSION['cajas'])?'<a class="dropdown-item" href="cajas">Cajas</a>':''?>
          <?=isset($_SESSION['clientes'])?'<a class="dropdown-item" href="clientes">Clientes</a>':''?>      
          <?=isset($_SESSION['sistema'])?'<a class="dropdown-item" href="sistema">Sistema</a>':''?>      
        </div>        
      </li>
      <?php } ?>      
    </ul>

    <ul class="navbar-nav">
    <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Bienvenido: <stronperfilg><?=$_SESSION['nombre']?></strong>
    </a>
    <!-- Dropdown - User Information -->
    <div class="shadow dropdown-menu dropdown-menu-right animated--grow-in" aria-labelledby="userDropdown">
      <?php 
      if($_SESSION['perfil']=='Administrador')
      {
      ?>
      <a class="dropdown-item" href="usuarios">
        <i class="mr-2 text-gray-400 fas fa-user-tie fa-sm fa-fw"></i>Usuarios</a>           
      <a class="dropdown-item" href="perfiles">
        <i class="mr-2 text-gray-400 fas fa-user-tie fa-sm fa-fw"></i>Perfiles</a>           
      <a class="dropdown-item" href="modulos">
        <i class="mr-2 text-gray-400 fas fa-user-tie fa-sm fa-fw"></i>Perfiles-Modulos</a>      
      <?php
      }
      ?>  
      <a class="dropdown-item" href="modulosPermisosCargar">
        <i class="mr-2 text-gray-400 fas fa-user-tie fa-sm fa-fw"></i>CargarPermisos</a>            
      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
        <i class="mr-2 text-gray-400 fas fa-sign-out-alt fa-sm fa-fw"></i>        Cerrar sesión      </a>
    </div>
  </li>
    </ul>
  </div>
</nav>
</div>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Cerrar sesión?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Se cerrará tu sesión activa.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <form action="logout" method="post" id="logout">
            <?=GetTokenCsfrHTML()?>            
            <input type="submit" class="btn btn-danger" value="Salir">
        </form>
        </div>
      </div>
    </div>
  </div>
<?php if(EsDebug()){?>
<div class="container bg-success">
  <div class="row">
    <div class="col">
    Esta abierta la caja: <?=$_SESSION["CajaEstatus"]?>
    </div>
    <div class="col">IdCajaMovi: <?=$_SESSION["IdCajaMovi"]?>
    </div>
    <div class="col">Caja Id: <?=$_SESSION['CajaId']?>
    </div>
    <div class="col">xidUsuario: <?=$_SESSION['idUsuario']?>
    </div>
  </div>
</div>
<?php } ?>
<div class="container bg-gray-400" id="contenido">
<br />
