document.addEventListener('DOMContentLoaded', function() {
    // Handle initial page load with hash
    if(window.location.hash) {
      const fragment = window.location.hash.substring(1);
      const element = document.getElementById(fragment);
      if(element) {
        // Wait a moment for page to settle
        setTimeout(() => {
          element.scrollIntoView({behavior: 'smooth'});
          // Remove the hash from URL
          if (history.pushState) {
            history.pushState('', document.title, window.location.pathname);
          }
        }, 100);
      }
    }
  
    // Handle all links with data-scroll-to attribute
    const scrollLinks = document.querySelectorAll('[data-scroll-to]');
    scrollLinks.forEach(link => {
      link.addEventListener('click', function(event) {
        event.preventDefault();
        
        const targetId = this.getAttribute('data-scroll-to');
        const targetElement = document.getElementById(targetId);
        
        if(targetElement) {
          targetElement.scrollIntoView({behavior: 'smooth'});
        }
        
        // Update URL without fragment
        if (history.pushState) {
          history.pushState(null, null, this.getAttribute('href'));
        }
      });
    });
  });