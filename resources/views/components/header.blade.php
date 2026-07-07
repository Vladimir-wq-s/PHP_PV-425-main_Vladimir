<!-- resources/views/layouts/partials/header.blade.php -->
<style>
    /* Стили для header */
    .header {
        background: #ffffff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .header-top {
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        padding: 8px 0;
        font-size: 14px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .header-top__inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .header-top__info {
        display: flex;
        gap: 25px;
        flex-wrap: wrap;
    }

    .header-top__item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #6c757d;
    }

    .header-top__item a {
        color: #6c757d;
        text-decoration: none;
        transition: color 0.3s;
    }

    .header-top__item a:hover {
        color: #0d6efd;
    }

    .header-top__item i {
        font-size: 14px;
        color: #0d6efd;
    }

    .header-top__actions {
        display: flex;
        gap: 20px;
        align-items: center;
        flex-wrap: wrap;
    }

    .header-top__link {
        color: #6c757d;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .header-top__link:hover {
        color: #0d6efd;
    }

    .header-top__link--register {
        background: #0d6efd;
        color: #fff;
        padding: 4px 12px;
        border-radius: 4px;
    }

    .header-top__link--register:hover {
        background: #0b5ed7;
        color: #fff;
    }

    .badge {
        background: #dc3545;
        color: #fff;
        border-radius: 50%;
        padding: 2px 7px;
        font-size: 11px;
        margin-left: 3px;
    }

    .header-main {
        padding: 15px 0;
    }

    .header-main__inner {
        display: flex;
        align-items: center;
        gap: 30px;
        flex-wrap: wrap;
    }

    .header-logo {
        flex: 0 0 200px;
    }

    .header-logo__link {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #212529;
    }

    .header-logo__img {
        height: 40px;
        width: 40px;
        background: #0d6efd;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 20px;
    }

    .header-logo__text {
        font-size: 24px;
        font-weight: 700;
        color: #0d6efd;
    }

    .header-search {
        flex: 1;
        max-width: 600px;
        position: relative;
    }

    .header-search__form {
        width: 100%;
    }

    .header-search__wrapper {
        display: flex;
        border: 2px solid #0d6efd;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
    }

    .header-search__category {
        padding: 10px 15px;
        border: none;
        background: #f8f9fa;
        font-size: 14px;
        cursor: pointer;
        outline: none;
        min-width: 150px;
    }

    .header-search__category:focus {
        background: #fff;
    }

    .header-search__input {
        flex: 1;
        padding: 10px 15px;
        border: none;
        outline: none;
        font-size: 16px;
    }

    .header-search__input:focus {
        box-shadow: none;
    }

    .header-search__button {
        padding: 10px 20px;
        background: #0d6efd;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background 0.3s;
    }

    .header-search__button:hover {
        background: #0b5ed7;
    }

    .header-search__results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-top: 2px;
        max-height: 400px;
        overflow-y: auto;
        z-index: 1001;
        display: none;
    }

    .search-result__item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 15px;
        text-decoration: none;
        color: #212529;
        border-bottom: 1px solid #f1f3f5;
        transition: background 0.3s;
    }

    .search-result__item:hover {
        background: #f8f9fa;
    }

    .search-result__item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
        background: #e9ecef;
    }

    .search-result__item div {
        flex: 1;
    }

    .search-result__item div div:first-child {
        font-weight: 500;
    }

    .search-result__item div div:last-child {
        font-size: 14px;
        color: #0d6efd;
        font-weight: 600;
    }

    .search-result__empty {
        padding: 30px;
        text-align: center;
        color: #6c757d;
    }

    .header-actions {
        flex: 0 0 auto;
        position: relative;
    }

    .header-actions__cart {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 20px;
        background: #0d6efd;
        color: #fff;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.3s;
        font-weight: 500;
        position: relative;
    }

    .header-actions__cart:hover {
        background: #0b5ed7;
        color: #fff;
    }

    .header-actions__cart i {
        font-size: 24px;
    }

    .header-actions__cart-badge {
        background: #dc3545;
        color: #fff;
        border-radius: 50%;
        padding: 2px 8px;
        font-size: 12px;
        margin-left: 5px;
    }

    .header-cart-dropdown {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        width: 380px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        z-index: 1001;
        display: none;
    }

    .header-cart-dropdown__inner {
        padding: 20px;
    }

    .header-cart-dropdown__items {
        max-height: 300px;
        overflow-y: auto;
    }

    .cart-dropdown-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 10px 0;
        border-bottom: 1px solid #f1f3f5;
    }

    .cart-dropdown-item__image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
        background: #e9ecef;
    }

    .cart-dropdown-item__info {
        flex: 1;
    }

    .cart-dropdown-item__name {
        font-weight: 500;
        margin-bottom: 4px;
    }

    .cart-dropdown-item__price {
        font-size: 14px;
        color: #0d6efd;
        font-weight: 600;
    }

    .cart-dropdown-item__remove {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
        font-size: 18px;
        padding: 5px;
        transition: transform 0.3s;
    }

    .cart-dropdown-item__remove:hover {
        transform: scale(1.2);
    }

    .cart-dropdown__empty {
        padding: 30px;
        text-align: center;
        color: #6c757d;
    }

    .cart-dropdown__footer {
        padding-top: 15px;
        border-top: 2px solid #f1f3f5;
    }

    .cart-dropdown__total {
        display: flex;
        justify-content: space-between;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .cart-dropdown__button {
        display: block;
        padding: 12px;
        background: #0d6efd;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.3s;
    }

    .cart-dropdown__button:hover {
        background: #0b5ed7;
        color: #fff;
    }

    .header-nav {
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .header-nav__list {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 5px;
        flex-wrap: wrap;
    }

    .header-nav__item {
        position: relative;
    }

    .header-nav__item--catalog {
        position: relative;
    }

    .header-nav__link {
        display: block;
        padding: 12px 20px;
        color: #212529;
        text-decoration: none;
        font-weight: 500;
        font-size: 15px;
        transition: all 0.3s;
        border-radius: 4px;
    }

    .header-nav__link i {
        margin-right: 8px;
    }

    .header-nav__link:hover,
    .header-nav__link.active {
        background: #0d6efd;
        color: #fff;
    }

    .header-nav__catalog-toggle {
        padding: 12px 20px;
        background: #0d6efd;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
        font-size: 15px;
        transition: background 0.3s;
    }

    .header-nav__catalog-toggle:hover {
        background: #0b5ed7;
    }

    .header-nav__catalog-toggle i {
        margin-right: 8px;
    }

    .header-nav__dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 260px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        padding: 8px 0;
        list-style: none;
        display: none;
        z-index: 1000;
    }

    .header-nav__dropdown-item {
        position: relative;
    }

    .header-nav__dropdown-item:hover > .header-nav__subdropdown {
        display: block;
    }

    .header-nav__dropdown-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        color: #212529;
        text-decoration: none;
        transition: background 0.3s;
    }

    .header-nav__dropdown-link:hover {
        background: #f8f9fa;
    }

    .header-nav__dropdown-link i {
        margin-right: 10px;
        width: 20px;
        color: #0d6efd;
    }

    .header-nav__subdropdown {
        position: absolute;
        top: 0;
        left: 100%;
        min-width: 220px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        padding: 8px 0;
        list-style: none;
        display: none;
    }

    .header-nav__subdropdown li a {
        display: block;
        padding: 10px 20px;
        color: #212529;
        text-decoration: none;
        transition: background 0.3s;
    }

    .header-nav__subdropdown li a:hover {
        background: #f8f9fa;
    }

    /* Медиа-запросы для мобильных устройств */
    @media (max-width: 991px) {
        .header-top__info {
            display: none;
        }

        .header-main__inner {
            flex-wrap: wrap;
            gap: 15px;
        }

        .header-logo {
            flex: 0 0 auto;
        }

        .header-search {
            order: 3;
            flex: 1 1 100%;
            max-width: 100%;
        }

        .header-actions__cart-text {
            display: none;
        }

        .header-nav__list {
            overflow-x: auto;
            flex-wrap: nowrap;
        }

        .header-nav__list .header-nav__item--catalog {
            flex: 0 0 auto;
        }

        .header-nav__link {
            white-space: nowrap;
            padding: 10px 15px;
            font-size: 14px;
        }
    }

    @media (max-width: 576px) {
        .header-top__actions {
            font-size: 12px;
        }

        .header-top__actions .header-top__link {
            gap: 3px;
        }

        .header-actions__cart {
            padding: 8px 12px;
        }

        .header-actions__cart i {
            font-size: 20px;
        }

        .header-cart-dropdown {
            width: 300px;
            right: -50px;
        }
    }
</style>

<header class="header">
    <!-- Верхняя строка с контактами -->
    <div class="header-top">
        <div class="container">
            <div class="header-top__inner">
                <div class="header-top__info">
                    <span class="header-top__item">
                        <i class="fas fa-phone"></i>
                        <a href="tel:+78001234567">8 (800) 123-45-67</a>
                    </span>
                    <span class="header-top__item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:info@shop.ru">info@shop.ru</a>
                    </span>
                    <span class="header-top__item">
                        <i class="fas fa-clock"></i>
                        Ежедневно с 9:00 до 21:00
                    </span>
                </div>
                <div class="header-top__actions">
                    <a href="#" class="header-top__link">
                        <i class="fas fa-exchange-alt"></i> Сравнение
                    </a>
                    <a href="#" class="header-top__link">
                        <i class="fas fa-heart"></i> Избранное
                        <span class="badge">0</span>
                    </a>
                    <a href="#" class="header-top__link">
                        <i class="fas fa-user"></i> Войти
                    </a>
                    <a href="#" class="header-top__link header-top__link--register">
                        Регистрация
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Основная часть с логотипом и поиском -->
    <div class="header-main">
        <div class="container">
            <div class="header-main__inner">
                <!-- Логотип -->
                <div class="header-logo">
                    <a href="#" class="header-logo__link">
                        <div class="header-logo__img">S</div>
                        <span class="header-logo__text">ShopName</span>
                    </a>
                </div>

                <!-- Поиск -->
                <div class="header-search">
                    <form action="#" method="GET" class="header-search__form" id="search-form">
                        <div class="header-search__wrapper">
                            <select name="category" class="header-search__category" aria-label="Категория">
                                <option value="">Все категории</option>
                                <option value="1">Электроника</option>
                                <option value="2">Одежда</option>
                                <option value="3">Дом и сад</option>
                                <option value="4">Красота</option>
                                <option value="5">Спорт</option>
                            </select>
                            <input
                                type="text"
                                name="query"
                                class="header-search__input"
                                placeholder="Поиск товаров..."
                                value=""
                                autocomplete="off"
                                id="search-input"
                            >
                            <button type="submit" class="header-search__button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <!-- Выпадающий список результатов поиска -->
                        <div id="search-results" class="header-search__results"></div>
                    </form>
                </div>

                <!-- Корзина -->
                <div class="header-actions">
                    <a href="#" class="header-actions__cart" id="cart-toggle">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="header-actions__cart-text">Корзина</span>
                        <span class="header-actions__cart-badge" id="cart-count">0</span>
                    </a>

                    <!-- Мини-корзина при наведении -->
                    <div class="header-cart-dropdown" id="cart-dropdown">
                        <div class="header-cart-dropdown__inner">
                            <div class="header-cart-dropdown__items" id="cart-items">
                                <div class="cart-dropdown__empty">Корзина пуста</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Меню навигации -->
    <nav class="header-nav">
        <div class="container">
            <ul class="header-nav__list">
                <li class="header-nav__item header-nav__item--catalog">
                    <button class="header-nav__catalog-toggle" id="catalog-toggle">
                        <i class="fas fa-bars"></i> Каталог товаров
                    </button>
                    <ul class="header-nav__dropdown" id="catalog-dropdown">
                        <li class="header-nav__dropdown-item">
                            <a href="#" class="header-nav__dropdown-link">
                                <i class="fas fa-laptop"></i> Электроника
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            <ul class="header-nav__subdropdown">
                                <li><a href="#">Смартфоны</a></li>
                                <li><a href="#">Ноутбуки</a></li>
                                <li><a href="#">Планшеты</a></li>
                                <li><a href="#">Аксессуары</a></li>
                            </ul>
                        </li>
                        <li class="header-nav__dropdown-item">
                            <a href="#" class="header-nav__dropdown-link">
                                <i class="fas fa-tshirt"></i> Одежда
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            <ul class="header-nav__subdropdown">
                                <li><a href="#">Мужская</a></li>
                                <li><a href="#">Женская</a></li>
                                <li><a href="#">Детская</a></li>
                            </ul>
                        </li>
                        <li class="header-nav__dropdown-item">
                            <a href="#" class="header-nav__dropdown-link">
                                <i class="fas fa-home"></i> Дом и сад
                            </a>
                        </li>
                        <li class="header-nav__dropdown-item">
                            <a href="#" class="header-nav__dropdown-link">
                                <i class="fas fa-heart"></i> Красота и здоровье
                            </a>
                        </li>
                        <li class="header-nav__dropdown-item">
                            <a href="#" class="header-nav__dropdown-link">
                                <i class="fas fa-running"></i> Спорт и отдых
                            </a>
                        </li>
                        <li class="header-nav__dropdown-item">
                            <a href="#" class="header-nav__dropdown-link">
                                <i class="fas fa-gamepad"></i> Игрушки
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="header-nav__item">
                    <a href="#" class="header-nav__link active">
                        <i class="fas fa-home"></i> Главная
                    </a>
                </li>
                <li class="header-nav__item">
                    <a href="#" class="header-nav__link">
                        <i class="fas fa-box"></i> Все товары
                    </a>
                </li>
                <li class="header-nav__item">
                    <a href="#" class="header-nav__link">
                        <i class="fas fa-tags"></i> Акции
                    </a>
                </li>
                <li class="header-nav__item">
                    <a href="#" class="header-nav__link">
                        <i class="fas fa-newspaper"></i> Блог
                    </a>
                </li>
                <li class="header-nav__item">
                    <a href="#" class="header-nav__link">
                        <i class="fas fa-phone"></i> Контакты
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
