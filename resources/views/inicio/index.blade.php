<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Automatic Control - Software de Gestión de Inventarios</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link id="app-style" href="{{ asset('css/inicio.css') }}" rel="stylesheet">

  <script type="importmap">
{
  "imports": {
    "three": "https://unpkg.com/three@0.160.0/build/three.module.js",
    "three/addons/": "https://unpkg.com/three@0.160.0/examples/jsm/"
  }
}
</script>

<script type="module" src="{{ asset('js/logo3d.js') }}"></script>

</head>
<body>
  <!-- Loading Overlay -->
  <div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
      <a class="navbar-brand" href="javascript:void(0)">
        <img src="{{ asset('img/logoBlanco.png') }}" alt="Logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#features">Características</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#products">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contacto</a>
          </li>
          <li class="nav-item d-flex align-items-center mx-2">
          
          </li>
          <li class="nav-item">
            <a class="btn btn-laravel ms-lg-3" href="{{ route('login') }}">Iniciar sesión</a>

          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-section" id="hero">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 hero-text">
          <h1>Controla tu Inventario como nunca antes</h1>
          <p>Automatic Control es un software de gestión de inventarios potente y fácil de usar desarrollado con Laravel. Optimiza tus procesos, reduce errores y aumenta la productividad.</p>
          <a href="#products" class="btn btn-laravel btn-lg">Empezar ahora</a>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
          <div id="logo3d" style="width: 100%; height: 400px;"></div>
        </div>
      </div>
    </div>
  </section>

   <!-- New Inventory Management Section -->
  <section class="py-5 bg-dark" id="inventory-management">
    <div class="container">
        <div class="row"> 
            <div class="col-md-3 mb-3"> 
                    <div class="card h-100 bg-dark text-white border-0">
                 <img src="{{ asset('img/inventarioCheck.svg') }}" class="card-img-top w-50 mx-auto" alt="card-logo" id="card-logo">
                    <div class="card-body">
                        <h5 class="card-title">Inventario Eficiente</h5>
                        <p class="card-text">Mantener un registro actualizado de todos los productos y sus movimientos</p>
              
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                   <div class="card h-100 bg-dark text-white border-0">
                    <img src="{{ asset('img/tablet.svg') }}" class="card-img-top w-50 mx-auto" alt="card-logo" id="card-logo">
                    <div class="card-body">
                        <h5 class="card-title">Portabilidad</h5>
                        <p class="card-text">Ten acceso a tu inventario desde cualquier parte del mundo con acceso a internet.</p>
                     
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                    <div class="card h-100 bg-dark text-white border-0">
                   <img src="{{ asset('img/camion.svg') }}" class="card-img-top w-50 mx-auto" alt="card-logo" id="card-logo">
                    <div class="card-body">
                        <h5 class="card-title">Nunca Desabastecido</h5>
                        <p class="card-text">Siempre estarás avisado cuando se esté acabando el stock para que puedas reaccionar a tiempo.</p>
                       
                    </div>
                </div>
            </div>
                        <div class="col-md-3 mb-3">
               <div class="card h-100 bg-dark text-white border-0">
                 <img src="{{ asset('img/admin.svg') }}" class="card-img-top w-50 mx-auto" alt="card-logo" id="card-logo">
                    <div class="card-body">
                        <h5 class="card-title">Seguridad</h5>
                        <p class="card-text">Puedes estar tranquilo con nosotros, nuestra plataforma tiene altos estándares de seguridad.</p>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  <!-------Info-------->
 <div class="container py-5">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4">
        <h1 class="display-5 fw-bold">Optimiza tu <em class="text-danger">Gestión de Inventarios</em></h1>
        <p><strong>Automatic Control</strong> es un software diseñado para automatizar y controlar en tiempo real el movimiento de productos en tu almacén o negocio.
        Reduce pérdidas, mejora la trazabilidad, y toma decisiones con datos precisos gracias a nuestros reportes inteligentes y alertas personalizadas.
        Accede desde cualquier dispositivo, en cualquier momento, con total seguridad en la nube.</p>
       
      </div>
      <div class="col-lg-6 text-center">
        <img src="{{ asset('img/fondo3.jpg') }}" alt="Software Inventarios" class="circle-img shadow">
      </div>
    </div>
  </div>

<!---Info2---->

  <div class="container py-5">
    <div class="row align-items-center">
      <!-- Imagen a la izquierda -->
      <div class="col-lg-6 mb-4">
        <img src="{{asset('img/fondo4.png')}}" alt="Control de stock" class="circle-img shadow">
      </div>
      <!-- Texto a la derecha -->
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold">Tu Bodega, <em class="text-danger">Bajo Control</em></h1>
        <p><strong>Automatic Control</strong> te permite visualizar el estado actual de tu inventario, registrar entradas y salidas, y generar reportes automáticos con solo unos clics.
        Aumenta la eficiencia operativa de tu negocio con un sistema fácil de usar, adaptable y seguro.
        Ideal para almacenes, distribuidores y negocios que necesitan control preciso en tiempo real.</p>
        
      </div>
    </div>
  </div>
 

<!-- Purchase Modal -->
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="purchaseForm" action="{{ route('contacto.enviar') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="purchaseModalLabel">Adquirir producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <!-- Lado izquierdo con imagen y detalles -->
            <div class="col-md-5">
              <img id="modalProductImage" src="https://via.placeholder.com/400x300" alt="Producto" class="img-fluid rounded">
              <div class="mt-3">
                <h4 id="modalProductName">Nombre del Plan</h4>
                <p id="modalProductPrice" class="product-price">$0.00/mes</p>
                <!-- Campos ocultos para enviar el plan y precio -->
                <input type="hidden" name="plan" id="planInput" value="">
                <input type="hidden" name="price" id="priceInput" value="">
              </div>
            </div>

            <!-- Lado derecho con formulario -->
            <div class="col-md-7">
              <h5>Información de contacto</h5>
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" name="name" id="name" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="email" id="email" required>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" name="phone" id="phone">
              </div>
              <div class="mb-3">
                <label for="company" class="form-label">Empresa (opcional)</label>
                <input type="text" class="form-control" name="company" id="company">
              </div>
              <div class="mb-3">
                <label for="comments" class="form-label">Comentarios adicionales</label>
                <textarea class="form-control" name="comments" id="comments" rows="3"></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-laravel">Confirmar pedido</button>
        </div>
      </form>
    </div>
  </div>
</div>


  <!-- Products Section -->
  <section class="py-5" id="products">
    <div class="container">
      <h2 class="section-title">Obten tu plan</h2>
      <div class="error-message" id="productsError">
        Ha ocurrido un error al cargar los productos. Por favor, intenta de nuevo más tarde.
      </div>
      <div class="row" id="productsContainer">
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="product-card">
            <img src="https://cdn.pixabay.com/photo/2015/07/17/22/42/startup-849804_1280.jpg" alt="Plan Básico" class="product-img">
            <div class="product-info">
              <h3>Plan Básico</h3>
              <p>Ideal para pequeños negocios. Incluye gestión básica de inventario y reportes mensuales.</p>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="product-price">$29.99/mes</span>
                <button class="btn btn-laravel btn-sm" data-bs-toggle="modal" data-bs-target="#purchaseModal" data-product="Plan Básico" data-price="29.99">Contactar</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="product-card">
            <img src="{{ asset('img/planpro.jpg') }}" alt="Plan Profesional" class="product-img">
            <div class="product-info">
              <h3>Plan Profesional</h3>
              <p>Para negocios en crecimiento. Incluye alertas automáticas y múltiples usuarios.</p>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="product-price">$59.99/mes</span>
                <button class="btn btn-laravel btn-sm" data-bs-toggle="modal" data-bs-target="#purchaseModal" data-product="Plan Profesional" data-price="59.99">Contactar</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="product-card">
            <img src="https://cdn.pixabay.com/photo/2017/07/31/11/44/laptop-2557576_1280.jpg" alt="Plan Empresarial" class="product-img">
            <div class="product-info">
              <h3>Plan Empresarial</h3>
              <p>Solución completa para grandes empresas. Incluye API para integraciones y soporte 24/7.</p>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="product-price">$99.99/mes</span>
                <button class="btn btn-laravel btn-sm" data-bs-toggle="modal" data-bs-target="#purchaseModal" data-product="Plan Empresarial" data-price="99.99">Contactar</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="product-card">
            <img src="https://cdn.pixabay.com/photo/2018/03/10/09/45/businessman-3213659_1280.jpg" alt="Plan Personalizado" class="product-img">
            <div class="product-info">
              <h3>Plan Personalizado</h3>
              <p>Adaptado a tus necesidades específicas. Consulta con nuestro equipo para obtener una cotización.</p>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="product-price">Consultar</span>
                <button class="btn btn-laravel btn-sm" data-bs-toggle="modal" data-bs-target="#purchaseModal" data-product="Plan Personalizado" data-price="Consultar">Contactar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



<!-- Sección del equipo -->
<div class="container-fluid bg-dark text-white py-5">
  <div class="container">
    <h2 class="text-center mb-5">Nuestro Equipo<em class="text-danger"> Automatic Control</em> </h2>
    <div class="row text-center justify-content-center">
      <!-- Persona 1 -->
      <div class="col-6 col-md-4 col-lg-2 mb-4">
        <img src="{{ asset('img/gilson.jpg') }}" class="team-img mb-2" alt="Gilson">
        <h5 class="mb-1">Gilson Zuñiga</h5>
        <small class="d-block">Líder del proyecto</small>
        <small class="d-block">Backend y base de datos</small>
      </div>
      <!-- Persona 2 -->
       <div class="col-6 col-md-4 col-lg-2 mb-4">
        <img src="{{ asset('img/levi.jpg') }}" class="team-img mb-2" alt="Levi">
        <h5 class="mb-1">Levi Quintero</h5>
        <small class="d-block">Desarrollo del Back-end y Front-end</small>
      </div>
      <!-- Persona 3 -->
     
      <!-- Persona 4 -->
      
    </div>
  </div>
</div>
  <!-- Footer -->
  <footer id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-links">
          <h5>Automatic Control</h5>
          <p>Software de gestión de inventarfios desarrollado con Laravel para potenciar tu negocio y optimizar tus procesos.</p>
          <div class="social-icons mt-4">
            <a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a>
            <a href="javascript:void(0)"><i class="fab fa-twitter"></i></a>
            <a href="javascript:void(0)"><i class="fab fa-linkedin-in"></i></a>
            <a href="javascript:void(0)"><i class="fab fa-github"></i></a>
          </div>
        </div>
        <div class="col-md-2 footer-links">
          <h5>Enlaces</h5>
          <a href="#features">Características</a>
          <a href="/tienda">Productos</a>
          <a href="/tienda">Ecommerce</a>
          <a href="javascript:void(0)">Documentación</a>
          <a href="javascript:void(0)">Blog</a>
        </div>
        <div class="col-md-3 footer-links">
          <h5>Recursos</h5>
          <a href="javascript:void(0)">Centro de ayuda</a>
          <a href="javascript:void(0)">Guías de usuario</a>
          <a href="javascript:void(0)">API</a>
          <a href="javascript:void(0)">Comunidad</a>
        </div>
        <div class="col-md-3 footer-links">
          <h5>Contacto</h5>
          <p><i class="fas fa-envelope me-2"></i> automatic.control25@gmail.com</p>
          <p><i class="fas fa-phone me-2"></i> +57 3243034346</p>
          <p><i class="fas fa-map-marker-alt me-2"></i> Cra 87 MZ 178 Lt 10b</p>
        </div>
      </div>
      <div class="text-center copyright">
        <p>&copy; 2025 Automatic Control. Todos los derechos reservados.</p>
      </div>
    </div>
  </footer>

  <!-- Back to Top Button -->
  <div class="back-to-top" id="backToTop">
    <i class="fas fa-arrow-up"></i>
  </div>

  <!-- Purchase Success Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">¡Pedido recibido!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="text-center mb-4">
            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
            <h4 class="mt-3">Gracias por tu pedido</h4>
            <p>Hemos recibido tu solicitud y te contactaremos pronto para finalizar los detalles.</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-laravel" data-bs-dismiss="modal">Continuar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script id="app-script" src="{{ asset('js/inicio.js') }}"></script>


</body>
</html>