<!-- resources/views/layouts/partials/footer.blade.php -->
<style>
    /* Стили для footer */
    .footer {
        background: #1a1a2e;
        color: #e9ecef;
        margin-top: 50px;
    }

    .footer-main {
        padding: 60px 0 40px;
        border-bottom: 1px solid #2a2a3e;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1.5fr;
        gap: 40px;
    }

    .footer-column__title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #fff;
        position: relative;
    }

    .footer-column__title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 40px;
        height: 3px;
        background: #0d6efd;
        border-radius: 2px;
    }

    .footer-column__text {
        line-height: 1.7;
        color: #adb5bd;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .footer-column__list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-column__item {
        margin-bottom: 10px;
    }

    .footer-column__item:last-child {
        margin-bottom: 0;
    }

    .footer-column__link {
        color: #adb5bd;
        text-decoration: none;
        transition: all 0.3s;
        font-size: 14px;
        display: inline-block;
    }

    .footer-column__link:hover {
        color: #0d6efd;
        padding-left: 5px;
    }

    .footer-social {
        display: flex;
        gap: 12px;
    }

    .footer-social__link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: #2a2a3e;
        color: #adb5bd;
        border-radius: 50%;
        text-decoration: none;
        transition: all 0.3s;
    }

    .footer-social__link:hover {
        background: #0d6efd;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    .footer-contacts .footer-contacts__item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .footer-contacts .footer-contacts__item i {
        color: #0d6efd;
        width: 18px;
        margin-top: 2px;
    }

    .footer-contacts .footer-contacts__item span,
    .footer-contacts .footer-contacts__item a {
        color: #adb5bd;
        font-size: 14px;
    }

    .footer-contacts .footer-contacts__item a {
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-contacts .footer-contacts__item a:hover {
        color: #0d6efd;
    }

    .footer-bottom {
        padding: 20px 0;
        background: #15152a;
    }

    .footer-bottom__inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .footer-bottom__copyright {
        color: #6c757d;
        font-size: 14px;
    }

    .footer-bottom__payment {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .footer-bottom__payment-icon {
        height: 25px;
        width: auto;
        opacity: 0.7;
        transition: opacity 0.3s;
        filter: grayscale(100%);
    }

    .footer-bottom__payment-icon:hover {
        opacity: 1;
        filter: grayscale(0%);
    }

    .footer-bottom__links {
        display: flex;
        gap: 20px;
    }

    .footer-bottom__link {
        color: #6c757d;
        text-decoration: none;
        font-size: 13px;
        transition: color 0.3s;
    }

    .footer-bottom__link:hover {
        color: #0d6efd;
    }

    /* Медиа-запросы для мобильных устройств */
    @media (max-width: 991px) {
        .footer-grid {
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
    }

    @media (max-width: 576px) {
        .footer-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .footer-bottom__inner {
            flex-direction: column;
            text-align: center;
        }

        .footer-bottom__payment {
            justify-content: center;
        }

        .footer-bottom__links {
            flex-direction: column;
            gap: 8px;
        }
    }
</style>

<footer class="footer">
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">
                <!-- Колонка 1: О магазине -->
                <div class="footer-column">
                    <h3 class="footer-column__title">О магазине</h3>
                    <p class="footer-column__text">
                        Интернет-магазин качественных товаров с доставкой по всей России.
                        Мы работаем с 2024 года и ценим каждого клиента.
                    </p>
                    <div class="footer-social">
                        <a href="#" class="footer-social__link" aria-label="VK">
                            <i class="fab fa-vk"></i>
                        </a>
                        <a href="#" class="footer-social__link" aria-label="Telegram">
                            <i class="fab fa-telegram"></i>
                        </a>
                        <a href="#" class="footer-social__link" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="footer-social__link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Колонка 2: Каталог -->
                <div class="footer-column">
                    <h3 class="footer-column__title">Каталог</h3>
                    <ul class="footer-column__list">
                        <li class="footer-column__item">
                            <a href="#" class="footer-column__link">Электроника</a>
                        </li>
                        <li class="footer-column__item">
                            <a href="#" class="footer-column__link">Одежда</a>
                        </li>
                        <li class="footer-column__item">
                            <a href="#" class="footer-column__link">Дом и сад</a>
                        </li>
                        <li class="footer-column__item">
                            <a href="#" class="footer-column__link">Красота и здоровье</a>
                        </li>
                        <li class="footer-column__item">
                            <a href="#" class="footer-column__link">Спорт и отдых</a>
                        </li>
                        <li class="footer-column__item">
                            <a href="#" class="footer-column__link">Игрушки</a>
                        </li>
                    </ul>
                </div>

                <!-- Колонка 3: Покупателям -->
                <div class="footer-column">
                    <h3 class="footer-column__title">Покупателям</h3>
                    <ul class="footer-column__list">
                        <li class="footer-column__item">
                            <a href="#" class="footer-column__link">Доставка и оплата</a>
                        </li>
                        <li class="footer-column__item">
                            <a href="#" class="footer-column__link">Возврат товара</a>
                        </li>
                        <li class="footer-column__item">
                            <a href="#" class="footer-column__link">Часто задаваемые вопросы</a>
                        </li>
                        <li class="footer-column__item">
                            <a href="#" class="footer-column__link">Конфиденциальность</a>
                        </li>
                        <li class="footer-column__item">
                            <a href="#" class="footer-column__link">Условия использования</a>
                        </li>
                        <li class="footer-column__item">
                            <a href="#" class="footer-column__link">Блог</a>
                        </li>
                    </ul>
                </div>

                <!-- Колонка 4: Контакты -->
                <div class="footer-column">
                    <h3 class="footer-column__title">Контакты</h3>
                    <ul class="footer-column__list footer-contacts">
                        <li class="footer-column__item footer-contacts__item">
                            <i class="fas fa-phone"></i>
                            <a href="tel:+78001234567">8 (800) 123-45-67</a>
                        </li>
                        <li class="footer-column__item footer-contacts__item">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:info@shop.ru">info@shop.ru</a>
                        </li>
                        <li class="footer-column__item footer-contacts__item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>г. Москва, ул. Тверская, д. 1</span>
                        </li>
                        <li class="footer-column__item footer-contacts__item">
                            <i class="fas fa-clock"></i>
                            <span>Пн-Вс: 9:00 - 21:00</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Подвал с копирайтом -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom__inner">
                <div class="footer-bottom__copyright">
                    &copy; 2024 ShopName. Все права защищены.
                </div>

                <div class="footer-bottom__payment">
                    <!-- Заглушки для платежных систем -->
                    <span style="color: #6c757d; font-size: 12px;">Visa</span>
                    <span style="color: #6c757d; font-size: 12px;">Mastercard</span>
                    <span style="color: #6c757d; font-size: 12px;">МИР</span>
                    <span style="color: #6c757d; font-size: 12px;">СБП</span>
                    <span style="color: #6c757d; font-size: 12px;">Yandex Pay</span>
                </div>

                <div class="footer-bottom__links">
                    <a href="#" class="footer-bottom__link">Политика конфиденциальности</a>
                    <a href="#" class="footer-bottom__link">Условия</a>
                </div>
            </div>
        </div>
    </div>
</footer>
