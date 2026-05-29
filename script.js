/* =============================================
   NAVIGATION — scroll vers les sections
   ============================================= */
document.querySelectorAll('[data-target]').forEach(btn => {
    btn.addEventListener('click', () => {
        const targetId = btn.getAttribute('data-target');
        const target = document.getElementById(targetId);
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
            // Fermer le menu mobile si ouvert
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

// Fermer menu si on clique en dehors
document.addEventListener('click', e => {
    if (!burger.contains(e.target) && !nav.contains(e.target)) {
        nav.classList.remove('open');
    }
});

/* =============================================
   HEADER — fond opaque au scroll
   ============================================= */
const header = document.querySelector('.header');

window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        header.style.boxShadow = '0 2px 20px rgba(0,0,0,0.08)';
    } else {
        header.style.boxShadow = 'none';
    }
});

/* =============================================
   FORMULAIRE — feedback simple
   ============================================= */
const form = document.getElementById('contactForm');
if (form) {
    form.addEventListener('submit', e => {
        e.preventDefault();
        const btn = form.querySelector('button[type="submit"]');
        btn.textContent = 'Message envoyé ✓';
        btn.style.background = '#1bb8c4';
        btn.disabled = true;
        setTimeout(() => {
            btn.textContent = 'Envoyer le message';
            btn.style.background = '';
            btn.disabled = false;
            form.reset();
        }, 3000);
    });
}

/* =============================================
   ANIMATION — apparition au scroll
   ============================================= */
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.horaire-card, .tarif-card, .club__img, .contact__detail').forEach(el => {
    el.classList.add('fade-in');
    observer.observe(el);
});