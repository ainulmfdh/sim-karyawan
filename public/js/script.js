document.addEventListener('DOMContentLoaded', () => {

    // ===== Sidebar Toggle for Desktop =====
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const pageContainer = document.querySelector('.page-container');
    const sidebar = document.querySelector('.sidebar');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
            // PENTING: Hanya jalankan fungsi ini jika lebar layar di atas 992px
            if (window.innerWidth > 992) {
                sidebar.classList.toggle('mini');
                pageContainer.classList.toggle('sidebar-mini');
            }
        });
    }

    // ===== Mobile Menu Toggle =====
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });
    }

    // Close mobile sidebar when clicking outside
    document.addEventListener('click', (e) => {
        if (sidebar.classList.contains('open') && !sidebar.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
            sidebar.classList.remove('open');
        }
    });

    // ===== Dropdown Toggle =====
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent window click event from firing immediately
            const dropdownMenu = toggle.nextElementSibling;

            // Close all other open dropdowns
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                if (menu !== dropdownMenu) {
                    menu.classList.remove('show');
                }
            });

            dropdownMenu.classList.toggle('show');
        });
    });

    // Close dropdowns when clicking outside
    window.addEventListener('click', (e) => {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });

    // ===== Sidebar Submenu Toggle =====
    const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children > a');

    menuItemsWithChildren.forEach(item => {
        item.addEventListener('click', (e) => {
            // Prevent link from navigating if it's just a toggle
            e.preventDefault();

            // Allow opening submenus even when sidebar is mini
            if (sidebar.classList.contains('mini')) {
                sidebar.classList.remove('mini');
                pageContainer.classList.remove('sidebar-mini');
            }

            const parentLi = item.parentElement;
            parentLi.classList.toggle('open');
        });
    });

});