<body class="hold-transition sidebar-mini sidebar-collapse">

    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

                </li>
            </ul>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="../../index3.html" class="brand-link">
                <img src="<?php echo base_url(); ?>/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">POS EC</span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo base_url(); ?>/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Bienvenid@ Dalton Amay</a>
                    </div>
                </div>

                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item"  data-url="administrar/productos">
                        <a href="<?= base_url('dashboard'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p class="text-bold">
                                    TABLERO PRINCIPAL
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-boxes"></i>

                                <p class="text-bold">
                                    INVENTARIOS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item" data-url="administrar/productos">
                                    <a href="<?= base_url('administrar/productos'); ?>" class="nav-link">
                                        <i class="nav-icon fas fa-box"></i>
                                        <p>Productos</p>
                                    </a>
                                </li>

                                <li class="nav-item" data-url="administrar/marcas">
                                    <a href="<?php echo base_url(); ?>administrar/marcas" class="nav-link ">
                                        <i class="fas fa-tags"></i>
                                        <p>Marcas</p>
                                    </a>
                                </li>
                                <li class="nav-item" data-url="administrar/carga_masiva">
                                    <a href="<?php echo base_url(); ?>administrar/carga_masiva" class="nav-link">
                                        <i class="fas fa-file-upload"></i>
                                        <p>Carga Masiva</p>
                                    </a>
                                </li>
                                <li class="nav-item" data-url="administrar/categorias">
                                    <a href="<?php echo base_url(); ?>administrar/categorias" style="cursor:pointer;" href="#" class="nav-link">
                                        <i class="fas fa-list"></i>
                                        <p>Categorias</p>
                                    </a>
                                </li>
                                <li class="nav-item" data-url="administrar/unidades">
                                    <a href="<?php echo base_url(); ?>administrar/unidades" style="cursor:pointer;" href="#" class="nav-link">
                                        <i class="fas fa-balance-scale"></i>
                                        <p>Unidades de medida</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-shopping-cart fa-fw"></i>
                                <p class="text-bold">
                                    PUNTO DE VENTA
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item" data-url="administrar/ventas">
                                    <a href="<?php echo base_url(); ?>administrar/ventas" class="nav-link ">
                                        <i class="nav-icon fas fa-file-invoice-dollar" aria-hidden="true"></i>
                                        <p> Facturar</p>
                                    </a>
                                </li>
                                <li class="nav-item" data-url="ventas/clientes">
                                    <a href="<?php echo base_url(); ?>ventas/clientes" class="nav-link ">
                                        <i class="nav-icon fa fa-user" aria-hidden="true"></i> <!-- Ícono de Usuario Clásico -->
                                        <p> Clientes</p>
                                    </a>
                                </li>
                                <li class="nav-item" data-url="ventas/tiposdocumentos">
                                    <a href="<?php echo base_url(); ?>ventas/tiposdocumentos" class="nav-link">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Tipo Documentos</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-project-diagram fa-fw"></i>
                                <p class="text-bold">
                                    GERENCIA
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item" data-url="gerencia/empresa">
                                    <a href="<?php echo base_url(); ?>gerencia/empresa" class="nav-link ">
                                        <i class="fas fa-building nav-icon"></i> <!-- Ícono actualizado para EMPRESA -->
                                        <p>EMPRESA</p>
                                    </a>
                                </li>
                                <li class="nav-item" data-url="gerencia/proveedor">
                                    <a href="<?php echo base_url(); ?>gerencia/proveedores" class="nav-link ">
                                        <i class="fas fa-people-carry nav-icon"></i> <!-- Ícono actualizado para PROVEEDORES -->
                                        <p>PROVEEDORES</p>
                                    </a>
                                </li>
                                <li class="nav-item" data-url="gerencia/tiposdocumentos">
                                    <a href="<?php echo base_url(); ?>gerencia/tipo_comprobantes" class="nav-link">
                                        <i class="fas fa-file-contract nav-icon"></i>
                                        <p>TIPO DE COMPROBANTES</p>
                                    </a>
                                </li>
                                <li class="nav-item" data-url="gerencia/series">
                                    <a href="<?php echo base_url(); ?>gerencia/series" class="nav-link">
                                        <i class="fas fa-file-contract nav-icon"></i>
                                        <p>SERIES</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </nav>

            </div>

        </aside>