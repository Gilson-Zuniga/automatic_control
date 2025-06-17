
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