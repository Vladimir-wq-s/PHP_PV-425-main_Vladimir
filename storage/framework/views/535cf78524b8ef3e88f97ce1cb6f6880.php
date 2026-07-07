<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Интернет-магазин'); ?></title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Основные стили -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
            padding: 20px 0;
        }

        /* Стили для хедера */
        .header {
            background: #1a202c;
            padding: 12px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .header-logo {
            color: #fff;
            font-size: 24px;
            font-weight: 800;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .header-logo:hover {
            color: #63b3ed;
        }

        .header-logo i {
            color: #63b3ed;
            font-size: 28px;
        }

        .header-search {
            flex: 1;
            max-width: 500px;
            position: relative;
        }

        .header-search form {
            display: flex;
            position: relative;
        }

        .header-search input {
            width: 100%;
            padding: 10px 50px 10px 18px;
            border: none;
            border-radius: 10px;
            background: #2d3748;
            color: #fff;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .header-search input::placeholder {
            color: #a0aec0;
        }

        .header-search input:focus {
            outline: none;
            background: #374151;
            box-shadow: 0 0 0 2px #63b3ed;
        }

        .header-search .search-btn {
            position: absolute;
            right: 4px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: #a0aec0;
            padding: 8px 12px;
            cursor: pointer;
            transition: color 0.3s ease;
            font-size: 16px;
            border-radius: 8px;
        }

        .header-search .search-btn:hover {
            color: #63b3ed;
        }

        .header-search .search-btn i {
            font-size: 18px;
        }

        .header-search-results {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            right: 0;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            display: none;
            max-height: 400px;
            overflow-y: auto;
            padding: 8px 0;
            z-index: 1001;
        }

        .search-result-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            text-decoration: none;
            color: #1a202c;
            transition: background 0.2s ease;
        }

        .search-result-item:hover {
            background: #f7fafc;
        }

        .search-result-item img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 8px;
            background: #f7fafc;
        }

        .search-result-item .info {
            flex: 1;
        }

        .search-result-item .name {
            font-weight: 500;
            font-size: 14px;
        }

        .search-result-item .price {
            font-size: 13px;
            color: #2b6cb0;
            font-weight: 600;
        }

        .search-result-item .category {
            font-size: 11px;
            color: #a0aec0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-btn {
            color: #e2e8f0;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            position: relative;
            background: transparent;
            border: none;
        }

        .header-btn:hover {
            background: #2d3748;
            color: #fff;
        }

        .header-btn i {
            font-size: 18px;
        }

        .cart-badge {
            background: #e53e3e;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            position: absolute;
            top: -4px;
            right: -4px;
        }

        .header-cart-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            min-width: 320px;
            padding: 16px;
            display: none;
            z-index: 1001;
        }

        .cart-empty {
            text-align: center;
            padding: 20px 0;
            color: #718096;
        }

        .cart-empty i {
            font-size: 40px;
            color: #e2e8f0;
            margin-bottom: 10px;
            display: block;
        }

        /* Футер */
        .footer {
            background: #1a202c;
            color: #a0aec0;
            padding: 30px 0;
            margin-top: auto;
        }

        .footer a {
            color: #a0aec0;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #63b3ed;
        }

        .footer h5 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .footer .social-links {
            display: flex;
            gap: 12px;
        }

        .footer .social-links a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #2d3748;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            color: #a0aec0;
            font-size: 18px;
        }

        .footer .social-links a:hover {
            background: #63b3ed;
            color: #fff;
            transform: translateY(-3px);
        }

        /* Адаптивность */
        @media (max-width: 768px) {
            .header .container {
                flex-wrap: wrap;
            }

            .header-search {
                order: 3;
                flex: 1 1 100%;
                max-width: 100%;
            }

            .header-logo {
                font-size: 20px;
            }

            .header-btn span {
                display: none;
            }

            .header-btn {
                padding: 8px 12px;
            }

            .header-cart-dropdown {
                min-width: 280px;
                right: -60px;
            }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
<!-- Хедер -->
<header class="header">
    <div class="container">
        <a href="/" class="header-logo">
            <i class="fas fa-store"></i>
            <span>ShopName</span>
        </a>

        <div class="header-search">
            <form action="<?php echo e(route('products.index')); ?>" method="GET" id="searchForm">
                <input
                    type="text"
                    id="searchInput"
                    name="search"
                    placeholder="Поиск товаров..."
                    autocomplete="off"
                    value="<?php echo e(request('search')); ?>"
                >
                <button type="submit" class="search-btn" title="Найти">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="header-search-results" id="searchResults"></div>
        </div>

        <div class="header-actions">
            <a href="<?php echo e(route('products.index')); ?>" class="header-btn">
                <i class="fas fa-th-large"></i>
                <span>Каталог</span>
            </a>

            <div style="position: relative;">
                <button class="header-btn" id="cartToggle">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Корзина</span>
                    <span class="cart-badge" id="cartCount">0</span>
                </button>
                <div class="header-cart-dropdown" id="cartDropdown">
                    <div class="cart-empty">
                        <i class="fas fa-shopping-bag"></i>
                        <p>Корзина пуста</p>
                    </div>
                </div>
            </div>

            <?php if(auth()->guard()->check()): ?>
                <div style="position: relative;">
                    <button class="header-btn">
                        <i class="fas fa-user"></i>
                        <span><?php echo e(Auth::user()->name); ?></span>
                    </button>
                </div>
            <?php else: ?>
                <a href="#" class="header-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Войти</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>

<!-- Основной контент -->
<main class="main-content">
    <?php echo $__env->yieldContent('content'); ?>
</main>

<!-- Футер -->
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5><i class="fas fa-store me-2"></i>ShopName</h5>
                <p>Лучший интернет-магазин с широким ассортиментом товаров высокого качества.</p>
                <div class="social-links mt-3">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-telegram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                </div>
            </div>
            <div class="col-md-2">
                <h5>Информация</h5>
                <ul class="list-unstyled">
                    <li><a href="#">О нас</a></li>
                    <li><a href="#">Доставка</a></li>
                    <li><a href="#">Оплата</a></li>
                    <li><a href="#">Контакты</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h5>Покупателям</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Возврат</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Отзывы</a></li>
                    <li><a href="#">Блог</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Контакты</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-phone me-2"></i> +7 (777) 123-45-67</li>
                    <li><i class="fas fa-envelope me-2"></i> info@shopname.kz</li>
                    <li><i class="fas fa-map-marker-alt me-2"></i> г. Алматы, ул. Абая 123</li>
                </ul>
            </div>
        </div>
        <hr class="border-secondary mt-4">
        <div class="text-center">
            <small>&copy; <?php echo e(date('Y')); ?> ShopName. Все права защищены.</small>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {
        // AJAX поиск с автоподстановкой (live search)
        let searchTimeout;
        let isAjaxSearch = false;

        $('#searchInput').on('input', function() {
            clearTimeout(searchTimeout);
            const query = $(this).val().trim();

            if (query.length >= 2) {
                isAjaxSearch = true;
                searchTimeout = setTimeout(function() {
                    // AJAX запрос для автоподстановки
                    $.ajax({
                        url: '<?php echo e(route("products.index")); ?>',
                        type: 'GET',
                        data: {
                            search: query,
                            ajax: 1
                        },
                        success: function(response) {
                            const results = $('#searchResults');
                            if (response.products && response.products.length > 0) {
                                let html = '';
                                response.products.forEach(function(product) {
                                    html += `
                                        <a href="/products/${product.id}" class="search-result-item">
                                            ${product.image ? `<img src="${product.image}" alt="${product.name}">` : '<div style="width:40px;height:40px;background:#f7fafc;border-radius:8px;display:flex;align-items:center;justify-content:center;"><i class="fas fa-box" style="color:#a0aec0;"></i></div>'}
                                            <div class="info">
                                                <div class="name">${product.name}</div>
                                                <div class="price">${Number(product.price).toLocaleString()} ₸</div>
                                                ${product.category ? `<div class="category">${product.category.name}</div>` : ''}
                                            </div>
                                        </a>
                                    `;
                                });
                                html += `
                                    <div style="text-align:center;padding:8px;border-top:1px solid #edf2f7;">
                                        <a href="<?php echo e(route('products.index')); ?>?search=${encodeURIComponent(query)}" style="color:#2b6cb0;font-weight:500;text-decoration:none;">
                                            <i class="fas fa-arrow-right me-1"></i> Показать все результаты
                                        </a>
                                    </div>
                                `;
                                results.html(html).slideDown(200);
                            } else {
                                results.html(`
                                    <div style="text-align:center;padding:20px;color:#a0aec0;">
                                        <i class="fas fa-search" style="font-size:24px;display:block;margin-bottom:8px;"></i>
                                        <p style="margin:0;">Ничего не найдено</p>
                                    </div>
                                `).slideDown(200);
                            }
                        },
                        error: function() {
                            // Если AJAX не работает, просто показываем ссылку на поиск
                            const results = $('#searchResults');
                            results.html(`
                                <div style="text-align:center;padding:16px;">
                                    <a href="<?php echo e(route('products.index')); ?>?search=${encodeURIComponent(query)}" style="color:#2b6cb0;font-weight:500;text-decoration:none;">
                                        <i class="fas fa-search me-1"></i> Найти "${query}"
                                    </a>
                                </div>
                            `).slideDown(200);
                        }
                    });
                }, 400);
            } else {
                $('#searchResults').slideUp(200);
                isAjaxSearch = false;
            }
        });

        // Закрытие поиска при клике вне
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.header-search').length) {
                $('#searchResults').slideUp(200);
            }
        });

        // Отправка формы при нажатии Enter (уже работает через form)
        // Дополнительно: поиск по клику на кнопку

        // Корзина
        $('#cartToggle').on('click', function(e) {
            e.stopPropagation();
            $('#cartDropdown').slideToggle(200);
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('#cartToggle').length && !$(e.target).closest('#cartDropdown').length) {
                $('#cartDropdown').slideUp(200);
            }
        });

        // Автозакрытие уведомлений
        setTimeout(function() {
            $('.alert').fadeOut(500);
        }, 5000);
    });
</script>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\PHP Project\PV-425-main\resources\views/layouts/main.blade.php ENDPATH**/ ?>