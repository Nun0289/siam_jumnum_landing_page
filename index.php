<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/themes.php';
$theme = resolveTheme();
$pageTitle = siteMeta('name');
require_once __DIR__ . '/includes/header.php';



$banners = getBanners();

$products = getProducts();

$featuredProducts = getProducts(null, true);

$promotions = getPromotions();

?>



<!-- Hero Banner Carousel -->

<section class="hero" id="home">

    <div class="swiper hero-swiper">

        <div class="swiper-wrapper">

            <?php foreach ($banners as $i => $banner): ?>
            <?php
                $isStoreBanner = ($banner['banner_style'] ?? '') === 'store';
                $bannerImg = str_starts_with($banner['image_url'], '/assets/')
                    ? themeImageUrl($banner['image_url'])
                    : imageUrl($banner['image_url']);
            ?>
            <div class="swiper-slide hero-slide<?= $isStoreBanner ? ' hero-slide--store' : '' ?>">

                <div class="hero-slide__bg" style="background-image: url('<?= e($bannerImg) ?>')" data-parallax="0.5"></div>

                <div class="hero-slide__overlay"></div>

                <div class="hero-slide__vignette"></div>

                <?php if ($isStoreBanner): ?>
                <div class="hero-slide__gold-accent" aria-hidden="true"></div>
                <?php endif; ?>

                <div class="hero-slide__content">

                    <div class="hero-slide__line"></div>

                    <p class="hero-slide__eyebrow"><?= e(__('hero.eyebrow')) ?></p>

                    <h1 class="hero-slide__title"><?= e($banner['title']) ?></h1>

                    <?php if ($banner['subtitle']): ?>

                    <p class="hero-slide__subtitle"><?= e($banner['subtitle']) ?></p>

                    <?php endif; ?>

                    <div class="hero-slide__actions">

                        <a href="#valuation" class="text-link text-link--light"><?= e(__('hero.evaluate')) ?></a>

                        <a href="#products" class="text-link text-link--light"><?= e(__('hero.collection')) ?></a>

                    </div>

                </div>

            </div>

            <?php endforeach; ?>

        </div>

        <div class="hero-controls">

            <div class="hero-counter"><span class="hero-counter__current">01</span> / <span class="hero-counter__total"><?= str_pad(count($banners), 2, '0', STR_PAD_LEFT) ?></span></div>

            <div class="hero-pagination"></div>

            <div class="hero-arrows">

                <button class="hero-prev" aria-label="<?= e(__('aria.prev')) ?>"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M15 18l-6-6 6-6"/></svg></button>

                <button class="hero-next" aria-label="<?= e(__('aria.next')) ?>"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M9 18l6-6-6-6"/></svg></button>

            </div>

        </div>

    </div>

    <div class="hero-scroll">

        <span><?= e(__('hero.scroll')) ?></span>

        <div class="hero-scroll__line"></div>

    </div>

</section>



<!-- Collections Strip -->

<section class="collections-strip">

    <div class="collections-strip__inner">

        <a href="#products" class="collection-item" data-category="diamond" style="--col-bg: url('<?= e(themeImageUrl('/assets/images/bg-diamond.png')) ?>')">

            <div class="collection-item__bg"></div>

            <span class="collection-item__label"><?= e(__('collection.label')) ?></span>

            <span class="collection-item__title"><?= __html('collection.diamond') ?></span>

            <span class="collection-item__link"><?= e(__('collection.explore')) ?></span>

        </a>

        <a href="#products" class="collection-item" data-category="watch" style="--col-bg: url('<?= e(themeImageUrl('/assets/images/bg-watch.png')) ?>')">

            <div class="collection-item__bg"></div>

            <span class="collection-item__label"><?= e(__('collection.label')) ?></span>

            <span class="collection-item__title"><?= __html('collection.watch') ?></span>

            <span class="collection-item__link"><?= e(__('collection.explore')) ?></span>

        </a>

        <a href="#products" class="collection-item" data-category="bag" style="--col-bg: url('<?= e(themeImageUrl('/assets/images/bg-bag.png')) ?>')">

            <div class="collection-item__bg"></div>

            <span class="collection-item__label"><?= e(__('collection.label')) ?></span>

            <span class="collection-item__title"><?= __html('collection.bag') ?></span>

            <span class="collection-item__link"><?= e(__('collection.explore')) ?></span>

        </a>

    </div>

</section>



<!-- About Intro -->

<section class="intro section" id="about">

    <div class="intro__layout">

        <div class="intro__visual reveal">

            <div class="intro__image" style="background-image: url('<?= e(themeImageUrl('/assets/images/bg-intro.png')) ?>')"></div>

            <div class="intro__shade"></div>

            <div class="intro__frame" aria-hidden="true"><span></span><span></span><span></span><span></span></div>

        </div>

        <div class="intro__text reveal">

            <div class="intro__text-inner">

                <span class="section-eyebrow"><?= e(__('intro.eyebrow')) ?></span>

                <h2 class="section-title intro__title"><?= __html('intro.title') ?></h2>

                <p class="intro__lead"><?= e(__('intro.lead')) ?></p>

                <div class="intro__meta">

                    <p class="intro__note"><?= e(siteMeta('hours')) ?></p>

                    <a href="#valuation" class="text-link intro__cta"><?= e(__('intro.cta')) ?></a>

                </div>

            </div>

        </div>

    </div>

    <div class="container">

        <div class="intro__features">

            <div class="feature-card reveal">

                <span class="feature-card__number">01</span>

                <h3><?= e(__('feature1.title')) ?></h3>

                <p><?= e(__('feature1.desc')) ?></p>

            </div>

            <div class="feature-card reveal">

                <span class="feature-card__number">02</span>

                <h3><?= e(__('feature2.title')) ?></h3>

                <p><?= e(__('feature2.desc')) ?></p>

            </div>

            <div class="feature-card reveal">

                <span class="feature-card__number">03</span>

                <h3><?= e(__('feature3.title')) ?></h3>

                <p><?= e(__('feature3.desc')) ?></p>

            </div>

            <div class="feature-card reveal">

                <span class="feature-card__number">04</span>

                <h3><?= e(__('feature4.title')) ?></h3>

                <p><?= e(__('feature4.desc')) ?></p>

            </div>

        </div>

    </div>

</section>



<!-- Stats Strip -->

<section class="stats-strip">

    <div class="container stats-strip__inner">

        <div class="stat-item reveal">

            <span class="stat-item__number">15+</span>

            <span class="stat-item__label"><?= e(__('stats.years')) ?></span>

        </div>

        <div class="stat-item reveal">

            <span class="stat-item__number">100%</span>

            <span class="stat-item__label"><?= e(__('stats.safe')) ?></span>

        </div>

        <div class="stat-item reveal">

            <span class="stat-item__number">24hr</span>

            <span class="stat-item__label"><?= e(__('stats.cash')) ?></span>

        </div>

        <div class="stat-item reveal">

            <span class="stat-item__number">GIA</span>

            <span class="stat-item__label"><?= e(__('stats.cert')) ?></span>

        </div>

    </div>

</section>



<!-- Quote -->

<section class="quote-section">

    <div class="container quote-section__inner reveal">

        <div class="quote-section__ornament">✦</div>

        <blockquote class="quote-section__text"><?= __html('quote.text') ?></blockquote>

        <cite class="quote-section__cite"><?= e(__('quote.cite')) ?></cite>

    </div>

</section>



<!-- Services -->

<section class="services section" id="services">

    <div class="section-header section-header--left container reveal">

        <span class="section-eyebrow"><?= e(__('services.eyebrow')) ?></span>

        <h2 class="section-title"><?= __html('services.title') ?></h2>

    </div>

    <div class="services__editorial">

        <?php
        $serviceCards = [
            ['num' => '01', 'cat' => 'Joaillerie', 'img' => 'bg-diamond.png', 'title' => 'services.diamond.title', 'desc' => 'services.diamond.desc', 'filter' => 'diamond', 'key' => 'diamond', 'reverse' => false],
            ['num' => '02', 'cat' => 'Horlogerie', 'img' => 'bg-watch.png', 'title' => 'services.watch.title', 'desc' => 'services.watch.desc', 'filter' => 'watch', 'key' => 'watch', 'reverse' => true],
            ['num' => '03', 'cat' => 'Maroquinerie', 'img' => 'bg-bag.png', 'title' => 'services.bag.title', 'desc' => 'services.bag.desc', 'filter' => 'bag', 'key' => 'bag', 'reverse' => false],
        ];
        foreach ($serviceCards as $card):
        ?>
        <article class="editorial-card<?= $card['reverse'] ? ' editorial-card--reverse' : '' ?> reveal">

            <div class="editorial-card__visual">

                <span class="editorial-card__num" aria-hidden="true"><?= e($card['num']) ?></span>

                <div class="editorial-card__image" style="background-image: url('<?= e(themeImageUrl('/assets/images/' . $card['img'])) ?>')"></div>

                <div class="editorial-card__shade"></div>

                <div class="editorial-card__frame" aria-hidden="true"><span></span><span></span><span></span><span></span></div>

                <span class="editorial-card__label"><?= e($card['cat']) ?></span>

            </div>

            <div class="editorial-card__content">

                <span class="editorial-card__cat"><?= e($card['cat']) ?></span>

                <h3><?= e(__($card['title'])) ?></h3>

                <p><?= e(__($card['desc'])) ?></p>

                <ul class="editorial-card__tags">
                    <li><?= e(__('services.' . $card['key'] . '.f1')) ?></li>
                    <li><?= e(__('services.' . $card['key'] . '.f2')) ?></li>
                    <li><?= e(__('services.' . $card['key'] . '.f3')) ?></li>
                </ul>

                <a href="#products" class="text-link editorial-card__link" data-filter="<?= e($card['filter']) ?>"><?= e(__('services.explore')) ?></a>

            </div>

        </article>

        <?php endforeach; ?>

    </div>

</section>



<!-- Parallax Showcase -->

<section class="showcase">

    <div class="showcase__bg" style="background-image: url('<?= e(themeImageUrl('/assets/images/bg-showcase.png')) ?>')" data-parallax="0.4"></div>

    <div class="showcase__overlay"></div>

    <div class="showcase__vignette" aria-hidden="true"></div>

    <div class="showcase__ornament showcase__ornament--tl" aria-hidden="true"></div>

    <div class="showcase__ornament showcase__ornament--br" aria-hidden="true"></div>

    <div class="container showcase__content reveal">

        <div class="showcase__eyebrow-wrap">

            <span class="showcase__line" aria-hidden="true"></span>

            <span class="section-eyebrow section-eyebrow--light"><?= e(__('showcase.eyebrow')) ?></span>

            <span class="showcase__line" aria-hidden="true"></span>

        </div>

        <h2 class="showcase__title"><?= __html('showcase.title') ?></h2>

        <p class="showcase__text"><?= e(__('showcase.text')) ?></p>

        <div class="showcase__stats">

            <div class="showcase__stat">

                <span class="showcase__stat-val"><?= e(__('showcase.stat1.val')) ?></span>

                <span class="showcase__stat-label"><?= e(__('showcase.stat1.label')) ?></span>

            </div>

            <div class="showcase__stat-divider" aria-hidden="true"></div>

            <div class="showcase__stat">

                <span class="showcase__stat-val"><?= e(__('showcase.stat2.val')) ?></span>

                <span class="showcase__stat-label"><?= e(__('showcase.stat2.label')) ?></span>

            </div>

            <div class="showcase__stat-divider" aria-hidden="true"></div>

            <div class="showcase__stat">

                <span class="showcase__stat-val"><?= e(__('showcase.stat3.val')) ?></span>

                <span class="showcase__stat-label"><?= e(__('showcase.stat3.label')) ?></span>

            </div>

        </div>

        <a href="#contact" class="text-link text-link--light showcase__cta"><?= e(__('showcase.cta')) ?></a>

    </div>

</section>



<!-- Featured Products Carousel -->

<section class="products section" id="products">

    <div class="container">

        <div class="products__header reveal">

            <div>

                <span class="section-eyebrow"><?= e(__('products.eyebrow')) ?></span>

                <h2 class="section-title"><?= __html('products.title') ?></h2>

            </div>

            <div class="product-filters">

                <button class="filter-btn active" data-filter="all"><?= e(__('products.filter.all')) ?></button>

                <button class="filter-btn" data-filter="diamond"><?= e(__('category.diamond')) ?></button>

                <button class="filter-btn" data-filter="watch"><?= e(__('category.watch')) ?></button>

                <button class="filter-btn" data-filter="bag"><?= e(__('category.bag')) ?></button>

            </div>

        </div>



        <div class="swiper product-swiper reveal">

            <div class="swiper-wrapper">

                <?php foreach ($products as $product): ?>

                <div class="swiper-slide product-slide" data-category="<?= e($product['category']) ?>">

                    <article class="product-card">

                        <a href="#valuation" class="product-card__link-wrap">

                            <div class="product-card__image">

                                <img src="<?= e(imageUrl($product['image_url'], $product['category'])) ?>" alt="<?= e($product['title']) ?>" loading="lazy">

                            </div>

                            <div class="product-card__body">

                                <?php if ($product['brand']): ?>

                                <span class="product-card__brand"><?= e($product['brand']) ?></span>

                                <?php endif; ?>

                                <h3 class="product-card__title"><?= e($product['title']) ?></h3>

                                <span class="product-card__cta"><?= e($product['price_label'] ?? __('products.evaluate')) ?></span>

                            </div>

                        </a>

                    </article>

                </div>

                <?php endforeach; ?>

            </div>

            <div class="product-nav">

                <button class="product-prev" aria-label="<?= e(__('aria.prev')) ?>"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M15 18l-6-6 6-6"/></svg></button>

                <button class="product-next" aria-label="<?= e(__('aria.next')) ?>"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M9 18l6-6-6-6"/></svg></button>

            </div>

        </div>

    </div>

</section>



<!-- Product Grid -->

<section class="product-grid-section section">

    <div class="container">

        <div class="section-header reveal">

            <span class="section-eyebrow"><?= e(__('products.grid_eyebrow')) ?></span>

            <h2 class="section-title"><?= e(__('products.grid_title')) ?></h2>

        </div>

        <div class="product-grid" id="productGrid">

            <?php foreach ($products as $product): ?>

            <article class="product-grid__item reveal" data-category="<?= e($product['category']) ?>">

                <div class="product-grid__image">

                    <img src="<?= e(imageUrl($product['image_url'], $product['category'])) ?>" alt="<?= e($product['title']) ?>" loading="lazy">

                    <div class="product-grid__overlay">

                        <a href="#valuation" class="text-link text-link--light"><?= e(__('products.evaluate')) ?></a>

                    </div>

                </div>

                <div class="product-grid__info">

                    <span class="product-grid__cat"><?= e(categoryLabel($product['category'])) ?></span>

                    <h3><?= e($product['title']) ?></h3>

                    <?php if ($product['brand']): ?>

                    <span class="product-grid__brand"><?= e($product['brand']) ?></span>

                    <?php endif; ?>

                </div>

            </article>

            <?php endforeach; ?>

        </div>

    </div>

</section>



<!-- How It Works -->

<section class="how-it-works section luxury-pattern" id="how-it-works">

    <div class="container">

        <div class="section-header reveal">

            <span class="section-eyebrow"><?= e(__('steps.eyebrow')) ?></span>

            <h2 class="section-title"><?= __html('steps.title') ?></h2>

        </div>

        <div class="steps">

            <div class="step reveal">

                <div class="step__icon">

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>

                </div>

                <h3><?= e(__('steps.1.title')) ?></h3>

                <p><?= e(__p('steps.1.desc', ['phone' => PHONE])) ?></p>

            </div>

            <div class="step__connector"></div>

            <div class="step reveal">

                <div class="step__icon">

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>

                </div>

                <h3><?= e(__('steps.2.title')) ?></h3>

                <p><?= e(__('steps.2.desc')) ?></p>

            </div>

            <div class="step__connector"></div>

            <div class="step reveal">

                <div class="step__icon">

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>

                </div>

                <h3><?= e(__('steps.3.title')) ?></h3>

                <p><?= e(__('steps.3.desc')) ?></p>

            </div>

        </div>

    </div>

</section>



<!-- Valuation CTA -->

<section class="valuation section" id="valuation">

    <div class="valuation__parallax" style="background-image: url('<?= e(themeImageUrl('/assets/images/bg-valuation.png')) ?>')" data-parallax="0.25"></div>

    <div class="container">

        <div class="valuation__inner reveal">

            <div class="valuation__text">

                <span class="section-eyebrow"><?= e(__('valuation.eyebrow')) ?></span>

                <h2 class="section-title"><?= __html('valuation.title') ?></h2>

                <p><?= e(__('valuation.desc')) ?></p>

            </div>

            <form class="valuation__form" id="valuationForm">

                <div class="form-group">

                    <label for="name"><?= e(__('valuation.name')) ?></label>

                    <input type="text" id="name" name="name" required placeholder="<?= e(__('valuation.name_ph')) ?>">

                </div>

                <div class="form-group">

                    <label for="phone"><?= e(__('valuation.phone')) ?></label>

                    <input type="tel" id="phone" name="phone" required placeholder="<?= e(__('valuation.phone_ph')) ?>">

                </div>

                <div class="form-group">

                    <label for="category"><?= e(__('valuation.category')) ?></label>

                    <select id="category" name="category">

                        <option value="diamond"><?= e(__('category.diamond')) ?></option>

                        <option value="watch"><?= e(__('category.watch')) ?></option>

                        <option value="bag"><?= e(__('category.bag')) ?></option>

                        <option value="other"><?= e(__('category.other')) ?></option>

                    </select>

                </div>

                <div class="form-group">

                    <label for="message"><?= e(__('valuation.message')) ?></label>

                    <textarea id="message" name="message" rows="3" placeholder="<?= e(__('valuation.message_ph')) ?>"></textarea>

                </div>

                <button type="submit" class="btn btn--gold btn--full"><?= e(__('valuation.submit')) ?></button>

                <p class="form-note"><?= e(__p('valuation.note', ['phone' => PHONE])) ?></p>

            </form>

        </div>

    </div>

</section>



<!-- Promotions -->

<section class="promotions section luxury-pattern" id="promotions">

    <div class="container">

        <div class="section-header reveal">

            <span class="section-eyebrow"><?= e(__('promo.eyebrow')) ?></span>

            <h2 class="section-title"><?= e(__('promo.title')) ?></h2>

        </div>

        <div class="promotions__grid">

            <?php foreach ($promotions as $promo): ?>

            <article class="promo-card reveal">

                <a href="#contact" class="promo-card__link-wrap">

                    <div class="promo-card__image">

                        <img src="<?= e(imageUrl($promo['image_url'])) ?>" alt="<?= e($promo['title']) ?>" loading="lazy">

                    </div>

                    <div class="promo-card__body">

                        <span class="promo-card__date"><?= date('d M Y', strtotime($promo['created_at'])) ?></span>

                        <h3><?= e($promo['title']) ?></h3>

                        <p><?= e($promo['excerpt']) ?></p>

                        <span class="text-link"><?= e(__('promo.read')) ?></span>

                    </div>

                </a>

            </article>

            <?php endforeach; ?>

        </div>

    </div>

</section>



<!-- Brands Marquee -->

<section class="brands">

    <div class="brands__track">

        <span>Rolex</span><span>Patek Philippe</span><span>Richard Mille</span><span>Hermès</span>

        <span>Chanel</span><span>Louis Vuitton</span><span>Gucci</span><span>Dior</span>

        <span>GIA</span><span>HRD</span><span>IGI</span><span>Panerai</span>

        <span>Rolex</span><span>Patek Philippe</span><span>Richard Mille</span><span>Hermès</span>

        <span>Chanel</span><span>Louis Vuitton</span><span>Gucci</span><span>Dior</span>

    </div>

</section>



<?php require_once __DIR__ . '/includes/footer.php'; ?>


