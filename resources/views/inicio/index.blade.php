<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Automatic Control - Software de Gestión de Inventarios</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style id="app-style">
    :root {
      --laravel-dark: #343a40;
      --laravel-red: #e3342f;
      --laravel-light: #f8f9fa;
      --body-bg: var(--laravel-dark);
      --body-color: var(--laravel-light);
      --card-bg: rgba(52, 58, 64, 0.8);
      --navbar-bg: rgba(33, 37, 41, 0.95);
      --border-color: rgba(255, 255, 255, 0.1);
    }
    
    body {
      font-family: 'Nunito', sans-serif;
      background-color: var(--body-bg);
      color: var(--body-color);
      transition: background-color 0.3s ease, color 0.3s ease;
    }
    
    /* Light theme styles */
    body.light-theme {
      --body-bg: #f8f9fa;
      --body-color: #343a40;
      --card-bg: rgba(255, 255, 255, 0.9);
      --navbar-bg: rgba(248, 249, 250, 0.95);
      --border-color: rgba(0, 0, 0, 0.1);
    }
    
    body.light-theme .navbar {
      background-color: var(--navbar-bg);
    }
    
    body.light-theme .navbar-dark .navbar-nav .nav-link {
      color: var(--body-color);
    }
    
    body.light-theme .feature-card,
    body.light-theme .product-card,
    body.light-theme .modal-content {
      background-color: var(--card-bg);
      color: var(--body-color);
      border-color: var(--border-color);
    }
    
    body.light-theme footer {
      background-color: var(--navbar-bg);
      color: var(--body-color);
    }
    
    body.light-theme .footer-links a {
      color: var(--body-color);
    }
    
    /* Theme toggle button */
    #themeToggle {
      background: transparent;
      border: 1px solid var(--laravel-red);
      color: var(--body-color);
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    #themeToggle:hover {
      background-color: var(--laravel-red);
      color: white;
    }
    
    .navbar {
      background-color: rgba(33, 37, 41, 0.95);
      padding: 1rem 0;
    }
    
    .navbar-brand {
      font-weight: 700;
      font-size: 1.5rem;
    }
    
    .navbar-brand img {
      height: 40px;
      margin-right: 10px;
    }
    
    .btn-laravel {
      background-color: var(--laravel-red);
      border-color: var(--laravel-red);
      color: white;
      transition: all 0.3s ease;
    }
    
    .btn-laravel:hover {
      background-color: #c82333;
      border-color: #c82333;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(227, 52, 47, 0.3);
    }
    
    .hero-section {
      background: linear-gradient(rgba(33, 37, 41, 0.9), rgba(33, 37, 41, 0.9)), url('https://cdn.pixabay.com/photo/2018/03/27/21/43/startup-3267505_1280.jpg');
      background-size: cover;
      background-position: center;
      min-height: 90vh;
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
    }
    
    .hero-text h1 {
      font-size: 3.5rem;
      font-weight: 800;
      margin-bottom: 1.5rem;
    }
    
    .hero-text p {
      font-size: 1.25rem;
      margin-bottom: 2rem;
      opacity: 0.9;
    }
    
    .feature-card {
      background-color: rgba(52, 58, 64, 0.8);
      border-radius: 10px;
      padding: 2rem;
      margin: 1rem 0;
      transition: all 0.3s ease;
      border: 1px solid rgba(255, 255, 255, 0.1);
      height: 100%;
    }
    
    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
      border-color: var(--laravel-red);
    }
    
    .feature-icon {
      background-color: var(--laravel-red);
      color: white;
      width: 70px;
      height: 70px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      margin-bottom: 1.5rem;
    }
    
    .features-section {
      padding: 5rem 0;
    }
    
    .section-title {
      position: relative;
      margin-bottom: 3rem;
      padding-bottom: 1rem;
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 80px;
      height: 4px;
      background-color: var(--laravel-red);
    }
    
    .product-card {
      background-color: rgba(52, 58, 64, 0.8);
      border-radius: 10px;
      overflow: hidden;
      transition: all 0.3s ease;
      border: 1px solid rgba(255, 255, 255, 0.1);
      height: 100%;
    }
    
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    
    .product-img {
      height: 200px;
      object-fit: cover;
      width: 100%;
    }
    
    .product-info {
      padding: 1.5rem;
    }
    
    .product-price {
      color: var(--laravel-red);
      font-weight: bold;
      font-size: 1.2rem;
    }
    
    .modal-content {
      background-color: var(--laravel-dark);
      color: var(--laravel-light);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .modal-header, .modal-footer {
      border-color: rgba(255, 255, 255, 0.1);
    }
    
    .modal-title {
      color: var(--laravel-red);
    }
    
    footer {
      background-color: rgba(33, 37, 41, 0.95);
      padding: 3rem 0;
      margin-top: 3rem;
    }
    
    .footer-links h5 {
      color: var(--laravel-red);
      margin-bottom: 1.5rem;
      font-weight: 600;
    }
    
    .footer-links a {
      color: var(--laravel-light);
      text-decoration: none;
      display: block;
      margin-bottom: 0.8rem;
      transition: all 0.3s ease;
    }
    
    .footer-links a:hover {
      color: var(--laravel-red);
      transform: translateX(5px);
    }
    
    .social-icons a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.1);
      color: var(--laravel-light);
      margin-right: 10px;
      transition: all 0.3s ease;
    }
    
    .social-icons a:hover {
      background-color: var(--laravel-red);
      transform: translateY(-3px);
    }
    
    .copyright {
      margin-top: 2rem;
      padding-top: 2rem;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(33, 37, 41, 0.9);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
    }
    
    .spinner {
      width: 50px;
      height: 50px;
      border: 5px solid rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      border-top-color: var(--laravel-red);
      animation: spin 1s ease-in-out infinite;
    }
    
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    
    .carousel-item {
      height: 300px;
    }
    
    .carousel-caption {
      background-color: rgba(33, 37, 41, 0.7);
      border-radius: 10px;
      padding: 20px;
    }
    
    .back-to-top {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-color: var(--laravel-red);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      opacity: 0;
      transition: all 0.3s ease;
      z-index: 99;
    }
    
    .back-to-top.visible {
      opacity: 1;
      cursor: pointer;
    }
    
    .back-to-top:hover {
      transform: translateY(-5px);
    }
    
    .error-message {
      background-color: rgba(220, 53, 69, 0.2);
      color: #dc3545;
      border: 1px solid #dc3545;
      border-radius: 5px;
      padding: 10px 15px;
      margin-bottom: 1rem;
      display: none;
    }
  </style>
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
        <img src="https://cdn.pixabay.com/photo/2017/03/16/21/18/logo-2150297_640.png" alt="Logo">
        Automatic Control
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
            <button id="themeToggle" type="button" aria-label="Toggle theme">
              <i class="fas fa-moon"></i>
            </button>
          </li>
          <li class="nav-item">
            <a class="btn btn-laravel ms-lg-3" href="#products">Empezar ahora</a>
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
          <h1>Controla tu inventario como nunca antes</h1>
          <p>Automatic Control es un software de gestión de inventarios potente y fácil de usar desarrollado con Laravel. Optimiza tus procesos, reduce errores y aumenta la productividad.</p>
          <a href="#products" class="btn btn-laravel btn-lg">Empezar ahora</a>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
          <img src="https://cdn.pixabay.com/photo/2018/09/28/19/07/ethics-3709719_1280.png" alt="Dashboard" class="img-fluid">
        </div>
      </div>
    </div>
  </section>

  <!-- New Inventory Management Section -->
  <section class="py-5 bg-dark" id="inventory-management">
    <div class="container">
      <h2 class="section-title">Nuestra Gestión de Inventarios</h2>
      <div class="row">
        <div class="col-lg-6">
          <div class="feature-card">
            <p>Automatic Control automatiza la gestión de inventarios, proporcionando a las empresas un control completo sobre sus existencias en tiempo real. Con nuestra solución desarrollada en Laravel, podrás:</p>
            <ul class="mt-3">
              <li class="mb-2">Mantener un registro actualizado de todos los productos y sus movimientos</li>
              <li class="mb-2">Generar reportes detallados sobre el estado del inventario</li>
              <li class="mb-2">Recibir alertas automáticas cuando los niveles de stock caigan por debajo de umbrales predefinidos</li>
              <li class="mb-2">Integrar con plataformas de ecommerce para facilitar la comercialización de productos</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="feature-card">
            <p>Nuestro sistema, construido sobre Laravel, garantiza la seguridad y robustez que tu empresa necesita para gestionar eficientemente su cadena de suministro. La optimización de la gestión de inventarios te permitirá:</p>
            <ul class="mt-3">
              <li class="mb-2">Reducir costos operativos al evitar excesos y escasez de inventario</li>
              <li class="mb-2">Mejorar la toma de decisiones con información precisa y en tiempo real</li>
              <li class="mb-2">Aumentar la satisfacción del cliente al asegurar disponibilidad de productos</li>
              <li class="mb-2">Optimizar el espacio de almacenamiento y mejorar la gestión logística</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features-section" id="features">
    <div class="container">
      <h2 class="section-title">Características principales</h2>
      
      <div id="featuresCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#featuresCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#featuresCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#featuresCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="carousel-caption">
              <div class="feature-icon mx-auto">
                <i class="fas fa-chart-line"></i>
              </div>
              <h3>Inventarios en tiempo real</h3>
              <p>Monitorea tus existencias en tiempo real y mantén un control preciso de tu inventario, evitando quiebres de stock y excesos.</p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="carousel-caption">
              <div class="feature-icon mx-auto">
                <i class="fas fa-file-alt"></i>
              </div>
              <h3>Generación de reportes</h3>
              <p>Genera informes detallados sobre movimientos de inventario, ventas, rotación de productos y más para tomar decisiones informadas.</p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="carousel-caption">
              <div class="feature-icon mx-auto">
                <i class="fas fa-bell"></i>
              </div>
              <h3>Alertas automáticas</h3>
              <p>Recibe notificaciones automáticas sobre niveles bajos de stock, productos próximos a vencer o movimientos inusuales en tu inventario.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#featuresCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuresCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      
      <div class="row mt-5">
        <div class="col-md-4 mb-4">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-tachometer-alt"></i>
            </div>
            <h3>Panel intuitivo</h3>
            <p>Interfaz amigable que permite visualizar métricas clave y tomar acciones rápidas desde una sola pantalla.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-barcode"></i>
            </div>
            <h3>Escaneo QR/Código de barras</h3>
            <p>Escanea códigos QR y códigos de barras para realizar movimientos de inventario de forma rápida y precisa.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-mobile-alt"></i>
            </div>
            <h3>Acceso móvil</h3>
            <p>Gestiona tu inventario desde cualquier dispositivo, con una interfaz responsiva adaptada a móviles y tablets.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Products Section -->
  <section class="py-5" id="products">
    <div class="container">
      <h2 class="section-title">Nuestros productos</h2>
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
                <button class="btn btn-laravel btn-sm" data-bs-toggle="modal" data-bs-target="#purchaseModal" data-product="Plan Básico" data-price="29.99">Comprar</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="product-card">
            <img src="https://cdn.pixabay.com/photo/2015/01/08/18/24/children-593313_1280.jpg" alt="Plan Profesional" class="product-img">
            <div class="product-info">
              <h3>Plan Profesional</h3>
              <p>Para negocios en crecimiento. Incluye alertas automáticas y múltiples usuarios.</p>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="product-price">$59.99/mes</span>
                <button class="btn btn-laravel btn-sm" data-bs-toggle="modal" data-bs-target="#purchaseModal" data-product="Plan Profesional" data-price="59.99">Comprar</button>
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
                <button class="btn btn-laravel btn-sm" data-bs-toggle="modal" data-bs-target="#purchaseModal" data-product="Plan Empresarial" data-price="99.99">Comprar</button>
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

  <!-- Purchase Modal -->
  <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="purchaseModalLabel">Adquirir producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-5">
              <img id="modalProductImage" src="https://cdn.pixabay.com/photo/2015/07/17/22/42/startup-849804_1280.jpg" alt="Producto" class="img-fluid rounded">
              <div class="mt-3">
                <h4 id="modalProductName">Plan Básico</h4>
                <p id="modalProductPrice" class="product-price">$29.99/mes</p>
                <div class="d-flex align-items-center mt-3">
                  <label for="quantity" class="me-3">Cantidad:</label>
                  <div class="input-group" style="max-width: 150px;">
                    <button class="btn btn-outline-secondary" type="button" id="decreaseQuantity">-</button>
                    <input type="number" class="form-control text-center" id="quantity" value="1" min="1" max="10">
                    <button class="btn btn-outline-secondary" type="button" id="increaseQuantity">+</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <h5>Información de contacto</h5>
              <form id="purchaseForm">
                <div class="mb-3">
                  <label for="name" class="form-label">Nombre completo</label>
                  <input type="text" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Correo electrónico</label>
                  <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">Teléfono</label>
                  <input type="tel" class="form-control" id="phone">
                </div>
                <div class="mb-3">
                  <label for="company" class="form-label">Empresa (opcional)</label>
                  <input type="text" class="form-control" id="company">
                </div>
                <div class="mb-3">
                  <label for="comments" class="form-label">Comentarios adicionales</label>
                  <textarea class="form-control" id="comments" rows="3"></textarea>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-laravel" id="confirmPurchase">Confirmar pedido</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-links">
          <h5>Automatic Control</h5>
          <p>Software de gestión de inventarios desarrollado con Laravel para potenciar tu negocio y optimizar tus procesos.</p>
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
          <a href="#products">Productos</a>
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
          <p><i class="fas fa-envelope me-2"></i> info@automaticcontrol.com</p>
          <p><i class="fas fa-phone me-2"></i> +1 (555) 123-4567</p>
          <p><i class="fas fa-map-marker-alt me-2"></i> Av. Tecnológica 123, Ciudad Innovación</p>
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
  <script id="app-script">
    $(document).ready(function() {
      // Simulating loading
      setTimeout(function() {
        $("#loadingOverlay").fadeOut();
      }, 1500);
      
      // Theme toggle functionality
      const themeToggle = document.getElementById('themeToggle');
      const themeIcon = themeToggle.querySelector('i');
      
      // Check if user has previously selected a theme
      const currentTheme = localStorage.getItem('theme');
      if (currentTheme === 'light') {
        document.body.classList.add('light-theme');
        themeIcon.classList.remove('fa-moon');
        themeIcon.classList.add('fa-sun');
      }
      
      // Toggle theme on button click
      themeToggle.addEventListener('click', function() {
        document.body.classList.toggle('light-theme');
        
        // Update icon
        if (document.body.classList.contains('light-theme')) {
          themeIcon.classList.remove('fa-moon');
          themeIcon.classList.add('fa-sun');
          localStorage.setItem('theme', 'light');
        } else {
          themeIcon.classList.remove('fa-sun');
          themeIcon.classList.add('fa-moon');
          localStorage.setItem('theme', 'dark');
        }
      });
      
      // Smooth scrolling for anchor links
      $('a[href^="#"]').on('click', function(event) {
        if (this.hash !== '') {
          event.preventDefault();
          const hash = this.hash;
          $('html, body').animate({
            scrollTop: $(hash).offset().top - 70
          }, 800);
        }
      });
      
      // Back to top button
      $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
          $('#backToTop').addClass('visible');
        } else {
          $('#backToTop').removeClass('visible');
        }
      });
      
      $('#backToTop').click(function() {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
      });
      
      // Quantity controls in modal
      $('#decreaseQuantity').click(function() {
        const currentVal = parseInt($('#quantity').val());
        if (currentVal > 1) {
          $('#quantity').val(currentVal - 1);
        }
      });
      
      $('#increaseQuantity').click(function() {
        const currentVal = parseInt($('#quantity').val());
        if (currentVal < 10) {
          $('#quantity').val(currentVal + 1);
        }
      });
      
      // Update modal content based on selected product
      $('#purchaseModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const product = button.data('product');
        const price = button.data('price');
        
        const modal = $(this);
        modal.find('#modalProductName').text(product);
        
        if (price === 'Consultar') {
          modal.find('#modalProductPrice').text('Precio: A consultar');
        } else {
          modal.find('#modalProductPrice').text(`$${price}/mes`);
        }
        
        // Set appropriate image based on product
        let imageSrc = '';
        switch (product) {
          case 'Plan Básico':
            imageSrc = 'https://cdn.pixabay.com/photo/2015/07/17/22/42/startup-849804_1280.jpg';
            break;
          case 'Plan Profesional':
            imageSrc = 'https://cdn.pixabay.com/photo/2015/01/08/18/24/children-593313_1280.jpg';
            break;
          case 'Plan Empresarial':
            imageSrc = 'https://cdn.pixabay.com/photo/2017/07/31/11/44/laptop-2557576_1280.jpg';
            break;
          case 'Plan Personalizado':
            imageSrc = 'https://cdn.pixabay.com/photo/2018/03/10/09/45/businessman-3213659_1280.jpg';
            break;
          default:
            imageSrc = 'https://cdn.pixabay.com/photo/2015/07/17/22/42/startup-849804_1280.jpg';
        }
        
        modal.find('#modalProductImage').attr('src', imageSrc);
      });
      
      // Handle purchase form submission
      $('#confirmPurchase').click(function() {
        const form = $('#purchaseForm')[0];
        if (form.checkValidity()) {
          // Show success modal after a brief loading period
          $('#purchaseModal').modal('hide');
          
          setTimeout(function() {
            $('#successModal').modal('show');
            // Reset form
            form.reset();
          }, 1000);
        } else {
          form.reportValidity();
        }
      });
      
      // Initialize tooltips
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });
  </script>
</body>
</html>