document.addEventListener('DOMContentLoaded', () => {
    const toggles = document.querySelectorAll('.toggle-plat');

    toggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const targetId = toggle.getAttribute('data-target');
            const content = document.getElementById(targetId);

            if (content.style.display === 'none') {
                content.style.display = 'block';
                toggle.textContent = toggle.textContent.replace('▶️', '🔽');
            } else {
                content.style.display = 'none';
                toggle.textContent = toggle.textContent.replace('🔽', '▶️');
            }
        });
    });
});
