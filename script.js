/* =============================================
   NAVIGATION — scroll vers les sections
   ============================================= */
document.querySelectorAll('[data-target]').forEach(btn => {
    btn.addEventListener('click', () => {
        const targetId = btn.getAttribute('data-target');
        const target = document.getElementById(targetId);
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
            nav.classList.remove('open');
        }
    });
});

/* =============================================
   MENU BURGER (mobile)
   ============================================= */
const burger = document.getElementById('burger');
const nav    = document.querySelector('.header__nav');

burger.addEventListener('click', () => {
    nav.classList.toggle('open');
});

document.addEventListener('click', e => {
    if (!burger.contains(e.target) && !nav.contains(e.target)) {
        nav.classList.remove('open');
    }
});

/* =============================================
   HEADER — ombre au scroll
   ============================================= */
const header = document.querySelector('.header');

window.addEventListener('scroll', () => {
    header.style.boxShadow = window.scrollY > 50
        ? '0 2px 20px rgba(0,0,0,0.08)'
        : 'none';
});

/* =============================================
   FORMULAIRE — envoi via PHP
   ============================================= */
const form     = document.getElementById('contactForm');
const feedback = document.getElementById('formFeedback');

if (form) {
    form.addEventListener('submit', async e => {
        e.preventDefault();

        const btn = form.querySelector('button[type="submit"]');

        // État chargement
        btn.textContent = 'Envoi en cours…';
        btn.disabled = true;
        feedback.textContent = '';
        feedback.className = 'form-feedback';

        try {
            const response = await fetch('send.php', {
                method: 'POST',
                body: new FormData(form),
            });

            const data = await response.json();

            if (data.success) {
                feedback.textContent = data.message;
                feedback.classList.add('form-feedback--success');
                form.reset();
            } else {
                feedback.textContent = data.message;
                feedback.classList.add('form-feedback--error');
            }

        } catch (err) {
            feedback.textContent = 'Une erreur réseau s\'est produite. Veuillez réessayer.';
            feedback.classList.add('form-feedback--error');
        }

        // Réactiver le bouton
        btn.textContent = 'Envoyer le message';
        btn.disabled = false;
    });
}

/* =============================================
   ANIMATIONS — apparition au scroll
   ============================================= */
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add('visible');
    });
}, { threshold: 0.1 });

document.querySelectorAll('.horaire-card, .tarif-card, .club__img, .contact__detail').forEach(el => {
    el.classList.add('fade-in');
    observer.observe(el);
});