// Sticky Header
// Mobile toggle and current selection for side-by-side navigation
document.addEventListener('DOMContentLoaded', function() {
    // Mobile: Toggle subcategories
    if (window.innerWidth < 992) {
        const subcategoryTitles = document.querySelectorAll('.subcategory-title');
        subcategoryTitles.forEach(title => {
            title.addEventListener('click', function() {
                this.classList.toggle('active');
            });
        });
    }
    
    // Mark current selection
    const currentUrl = window.location.href;
    const subSubLinks = document.querySelectorAll('.sub-subcategory-list a');
    
    subSubLinks.forEach(link => {
        if (link.href === currentUrl) {
            // Mark the link as current
            link.classList.add('current');
            
            // Mark parent subcategory as active
            const parentTitle = link.closest('.subcategory-column').querySelector('.subcategory-title');
            if (parentTitle) {
                parentTitle.classList.add('active');
            }
            
            // Mark main dropdown parent
            const dropdownParent = link.closest('.nav-item.dropdown');
            if (dropdownParent) {
                const navLink = dropdownParent.querySelector('.nav-link');
                if (navLink) {
                    navLink.classList.add('active');
                }
            }
        }
    });
});