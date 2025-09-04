<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prueba Tecnica</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- Estilos para formularios expandibles -->
  <link rel="stylesheet" href="assets/dist/css/form-toggle.css">
  <!-- Estilo para edicion registros -->
  <link rel="stylesheet" href="assets/dist/css/inline-edit.css">
  <!-- Estilos para el theme switcher -->
  <link rel="stylesheet" href="assets/dist/css/theme-switcher.css">
</head>
<body class="hold-transition sidebar-mini theme-light">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Inicio</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Buscar">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Theme Toggle Button -->
      <li class="nav-item">
        <button class="nav-link theme-toggle-btn" id="theme-toggle-btn" title="Cambiar a tema oscuro">
          <i class="fas fa-moon" id="theme-icon"></i>
        </button>
      </li>

      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Prueba Tecnica</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrador</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Buscar">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    
    <!-- Menú Servicios -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-cogs"></i>
        <p>
          Proyectos
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="?c=projects" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Iniciar Proyecto</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="?c=purchaseorders" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Generar Orden de Compra</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="?c=donationsallocations" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Nueva Donación</p>
          </a>
        </li>
          <li class="nav-item">
          <a href="?c=donors" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Nueva Donador</p>
          </a>
        </li>
      </ul>
    </li>

    <!-- Menú Gastos -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Gastos
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="?c=budgetitems" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Listado Rubros</p>
          </a>
        </li>
      </ul>
    </li>

        <!-- Menú Proveedores -->
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user-tie"></i>
        <p>
          Proveedores
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="?c=suppliers" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Listado de Proveedores</p>
          </a>
        </li>
      </ul>
    </li>


  </ul>
</nav>
<!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    
    </div>
    <!-- /.content-header -->