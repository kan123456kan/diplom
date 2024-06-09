@extends('layouts.app')
@section('content')

@if(session('success_message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success_message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

    <div class="banner">
        <div class="text-section">
            <h5><span class="green-text">Академия</span> – это возможность изнутри познакомиться с корпоративной культурой,
                кейсами CoffeeTeaFusion, а также отлично провести время в приятной компании, погрузившись в мир чая и кофе
            </h5>
            <div class="divider"></div>
            <p>Академия находится в уютном и стильном пространстве в центре Ульяновска. Наши мероприятия – это треннинги,
                интересный досуг и бизнес-развитие</p>
        </div>
        <div class="image-section">
            <img src="/media/images/akadem/akadem3.jpg" alt="Academy Interior">
        </div>
    </div>

    {{-- <div class="marquee-container">
        <div class="marquee-text">
            Акция! С 10 февраля по 31 марта все мастер-классы по 3900 рублей
            Акция! С 10 февраля по 31 марта все мастер-классы по 3900 рублей
            Акция! С 10 февраля по 31 марта все мастер-классы по 3900 рублей
            Акция! С 10 февраля по 31 марта все мастер-классы по 3900 рублей
            Акция! С 10 февраля по 31 марта все мастер-классы по 3900 рублей
            Акция! С 10 февраля по 31 марта все мастер-классы по 3900 рублей
        </div>
    </div> --}}


    <div class="container">
        <h1>Самое важное о CoffeeTeaFusion</h1>
        <div class="info-section">
            <div class="info-circle"><span>1</span>Более 300 галерей расположены в Италии, Германии, Испании, Нидерландах,
                Греции, и в Португалии.</div>
            <div class="info-circle"><span>2</span>Свыше 5000 сотрудников в нашей компании. Мы — большая и сплочённая
                команда.</div>
            <div class="info-circle"><span>3</span>Собственное производство кофе под названием "КофеПродукт". Начало работы
                фабрики пришлось на 2016 год.</div>
            <div class="info-circle"><span>4</span>Более 300 сотрудников компании стали её партнёрами, открыв франшизу и
                успешно развивая свой бизнес.</div>
            <div class="info-circle"><span>5</span>У нас большой опыт обучения через внутреннюю платформу "Университет
                CoffeeTeaFusion".</div>
        </div>
    </div>


    <div class="form-container">
        <h1>Отправить заявку</h1>
        <form action="{{ url('/add-task') }}" method="POST">
            @csrf
            <div class="form-group">
                <input name="title" type="text" placeholder="Ваше имя" required>
            </div>
            <div class="form-group">
                <input type="tel" placeholder="+7 (___) ___-__-__" required pattern="\+?[0-9]{10,11}" name="phone"
                    title="Телефон должен содержать только цифры от 0 до 9">
            </div>
            <div class="form-group">
                <input name="email" type="email" placeholder="Ваш email" required>
            </div>
            <div class="form-group">
                <input name="message" type="text" placeholder="Ваш коменнтарий" required>
            </div>
            <div class="form-group">
                <select>
                    <option value="business-excursion">Бизнес-экскурсия</option>
                    <option value="sales-workshop">Мастер-класс по продажам</option>
                    <option value="other">Встреча</option>
                </select>
            </div>
            <div class="form-group checkbox-group">
                <input type="checkbox" id="agree" required checked>
                <label for="agree" class="checkbox-label">Нажимая кнопку "Зарегистрироваться", Вы соглашаетесь с <a
                        href="{{ asset('politika.rtf') }}" download>политикой
                        конфиденциальности</a></label>
            </div>
            <button type="submit" class="check">ЗАРЕГИСТРИРОВАТЬСЯ</button>
        </form>
    </div>

    <div class="container-map">
        <div class="text">
            <p><b>Место проведения:</b></p>
            <p> Улноявск, улица Гончарова, 23/11, 2 этаж, номер офиса 30</p>
        </div>
        <div class="map">
            <div style="position:relative;overflow:hidden;">
                <iframe
                    src="https://yandex.ru/map-widget/v1/?indoorLevel=1&ll=48.397221%2C54.319118&mode=whatshere&whatshere%5Bpoint%5D=48.397221%2C54.319118&whatshere%5Bzoom%5D=17&z=17"
                    width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;">
                </iframe>
            </div>
        </div>
    </div>

    <script>
        function showAgreementPopup() {
            document.getElementById('agreementPopup').style.display = 'block';
        }

        function hideAgreementPopup() {
            document.getElementById('agreementPopup').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
        var closeButtons = document.querySelectorAll('.close[data-dismiss="alert"]');
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                button.closest('.alert').remove();
            });
        });
    });
    </script>
@endsection
@extends('layouts.footer')
