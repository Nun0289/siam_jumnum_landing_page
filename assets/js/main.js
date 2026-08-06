document.addEventListener('DOMContentLoaded', () => {
    initPreloader();
    initHeader();
    initHeroSwiper();
    initProductSwiper();
    initParallax();
    initReveal();
    initFilters();
    initNav();
    initForm();
});

function initPreloader() {
    const preloader = document.getElementById('preloader');
    const hide = () => {
        preloader?.classList.add('hidden');
        document.body.classList.add('loaded');
    };
    setTimeout(hide, 900);
    window.addEventListener('load', () => setTimeout(hide, 400));
}

function initHeader() {
    const header = document.getElementById('header');
    const hero = document.querySelector('.hero');
    const isClassic = document.body.classList.contains('theme-classic');

    function updateHeader() {
        const heroBottom = hero ? hero.offsetHeight : 600;
        const scrolled = window.scrollY > 80;
        const pastHero = window.scrollY > heroBottom - 100;

        header.classList.toggle('scrolled', scrolled);
        if (isClassic) {
            header.classList.toggle('header--hero', !pastHero);
        }
    }

    updateHeader();
    window.addEventListener('scroll', updateHeader, { passive: true });
}

function initHeroSwiper() {
    const counter = document.querySelector('.hero-counter__current');
    const swiper = new Swiper('.hero-swiper', {
        loop: true,
        autoplay: { delay: 7000, disableOnInteraction: false },
        effect: 'fade',
        fadeEffect: { crossFade: true },
        pagination: { el: '.hero-pagination', clickable: true },
        speed: 1400,
        on: {
            slideChange(s) {
                if (counter) {
                    counter.textContent = String(s.realIndex + 1).padStart(2, '0');
                }
                s.slides.forEach(slide => {
                    slide.querySelector('.hero-slide__line')?.style.setProperty('animation', 'none');
                });
                const line = s.slides[s.activeIndex]?.querySelector('.hero-slide__line');
                if (line) {
                    void line.offsetWidth;
                    line.style.animation = 'heroLineIn 1s cubic-bezier(0.16, 1, 0.3, 1) forwards';
                }
            },
        },
    });
}

function initProductSwiper() {
    window.productSwiper = new Swiper('.product-swiper', {
        slidesPerView: 1.15,
        spaceBetween: 12,
        centeredSlides: false,
        slidesOffsetBefore: 0,
        navigation: { nextEl: '.product-next', prevEl: '.product-prev' },
        breakpoints: {
            640: { slidesPerView: 2.4, spaceBetween: 16 },
            1024: { slidesPerView: 3.6, spaceBetween: 20 },
            1280: { slidesPerView: 4.5, spaceBetween: 20 },
            1600: { slidesPerView: 5.2, spaceBetween: 24 },
        },
    });
}

function initParallax() {
    const elements = document.querySelectorAll('[data-parallax]');
    if (!elements.length) return;

    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(() => {
                elements.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    const center = rect.top + rect.height / 2;
                    const viewCenter = window.innerHeight / 2;
                    const offset = (center - viewCenter) * 0.08;
                    el.style.transform = `translate3d(0, ${offset}px, 0)`;
                });
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });
}

function initReveal() {
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 80);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

    reveals.forEach(el => observer.observe(el));
}

function initFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const carouselSlides = document.querySelectorAll('.product-slide');
    const gridItems = document.querySelectorAll('.product-grid__item');

    function filterProducts(category) {
        carouselSlides.forEach(slide => {
            slide.style.display = (category === 'all' || slide.dataset.category === category) ? '' : 'none';
        });
        gridItems.forEach(item => {
            item.style.display = (category === 'all' || item.dataset.category === category) ? '' : 'none';
        });
        window.productSwiper?.update();
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            filterProducts(btn.dataset.filter);
        });
    });

    document.querySelectorAll('[data-filter]').forEach(link => {
        if (link.classList.contains('filter-btn')) return;
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const cat = link.dataset.filter;
            filterBtns.forEach(b => b.classList.toggle('active', b.dataset.filter === cat));
            filterProducts(cat);
            document.getElementById('products')?.scrollIntoView({ behavior: 'smooth' });
        });
    });

    document.querySelectorAll('.collection-item').forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            const cat = item.dataset.category;
            filterBtns.forEach(b => b.classList.toggle('active', b.dataset.filter === cat));
            filterProducts(cat);
            document.getElementById('products')?.scrollIntoView({ behavior: 'smooth' });
        });
    });
}

function initNav() {
    const toggle = document.getElementById('navToggle');
    const mobileNav = document.getElementById('mobileNav');

    toggle?.addEventListener('click', () => {
        toggle.classList.toggle('active');
        mobileNav?.classList.toggle('open');
        document.body.style.overflow = mobileNav?.classList.contains('open') ? 'hidden' : '';
    });

    mobileNav?.querySelectorAll('.mobile-nav__link').forEach(link => {
        link.addEventListener('click', () => {
            toggle?.classList.remove('active');
            mobileNav?.classList.remove('open');
            document.body.style.overflow = '';
        });
    });
}

function initForm() {
    const form = document.getElementById('valuationForm');
    form?.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = form.querySelector('#name').value;
        const category = form.querySelector('#category').value;
        const message = form.querySelector('#message').value;
        const text = encodeURIComponent(
            `สวัสดีค่ะ ต้องการประเมินราคา\nชื่อ: ${name}\nประเภท: ${category}\nรายละเอียด: ${message}`
        );
        window.open(`https://line.me/R/msg/text/?${text}`, '_blank');
    });
}
