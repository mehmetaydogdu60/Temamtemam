/**
 * Navigation Scripts
 */
(function() {
    'use strict';

    const siteNavigation = document.getElementById('site-navigation');
    
    if (!siteNavigation) {
        return;
    }

    const button = siteNavigation.querySelector('.menu-toggle');
    const menu = siteNavigation.querySelector('ul');

    if (!button) {
        return;
    }

    if (!menu || !menu.classList.contains('nav-menu')) {
        button.style.display = 'none';
        return;
    }

    // Toggle mobile menu
    button.addEventListener('click', function() {
        siteNavigation.classList.toggle('toggled');
        
        if (button.getAttribute('aria-expanded') === 'true') {
            button.setAttribute('aria-expanded', 'false');
        } else {
            button.setAttribute('aria-expanded', 'true');
        }
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInside = siteNavigation.contains(event.target);
        
        if (!isClickInside && siteNavigation.classList.contains('toggled')) {
            siteNavigation.classList.remove('toggled');
            button.setAttribute('aria-expanded', 'false');
        }
    });

    // Handle submenu toggles on mobile
    const menuItemsWithChildren = siteNavigation.querySelectorAll('.menu-item-has-children');
    
    menuItemsWithChildren.forEach(function(item) {
        const link = item.querySelector('a');
        const submenu = item.querySelector('.sub-menu');
        
        if (link && submenu) {
            // Create toggle button for mobile
            const toggleButton = document.createElement('button');
            toggleButton.className = 'submenu-toggle';
            toggleButton.setAttribute('aria-expanded', 'false');
            toggleButton.innerHTML = '<span class="screen-reader-text">Toggle submenu</span>▼';
            
            link.parentNode.insertBefore(toggleButton, link.nextSibling);
            
            toggleButton.addEventListener('click', function(e) {
                e.preventDefault();
                submenu.classList.toggle('toggled');
                
                if (toggleButton.getAttribute('aria-expanded') === 'true') {
                    toggleButton.setAttribute('aria-expanded', 'false');
                } else {
                    toggleButton.setAttribute('aria-expanded', 'true');
                }
            });
        }
    });

    // Handle keyboard navigation
    const links = menu.querySelectorAll('a');
    
    links.forEach(function(link, index) {
        link.addEventListener('keydown', function(e) {
            const parentLi = link.parentElement;
            let focusLink;

            if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                e.preventDefault();
                focusLink = links[index + 1] || links[0];
                focusLink.focus();
            } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                e.preventDefault();
                focusLink = links[index - 1] || links[links.length - 1];
                focusLink.focus();
            }
        });
    });

})();
