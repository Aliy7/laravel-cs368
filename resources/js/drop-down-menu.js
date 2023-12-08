function toggleMenu(element) {
    var menu = element.nextElementSibling;
    if (menu.classList.contains('hidden')) {
        // Close all other menus
        document.querySelectorAll('.ellipsis-menu').forEach(function(el) {
            el.classList.add('hidden');
        });
        // Show this menu
        menu.classList.remove('hidden');
    } else {
        // Hide this menu
        menu.classList.add('hidden');
    }
}

// Close the menu if clicked outside of it
// Close the menu if clicked outside of it
window.addEventListener('click', function(e) {
    document.querySelectorAll('.ellipsis-menu').forEach(function(menu) {
        if (!menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
});

// Stop propagation if clicking on the button to prevent window listener from firing
document.querySelectorAll('.ellipsis-button').forEach(function(button) {
    button.addEventListener('click', function(e) {
        e.stopPropagation();
        var menu = button.nextElementSibling;
        document.querySelectorAll('.ellipsis-menu').forEach(function(m) {
            // Hide any other open menus
            if (m !== menu) {
                m.classList.add('hidden');
            }
        });
        // Toggle this menu
        menu.classList.toggle('hidden');
    });
});
