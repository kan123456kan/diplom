@section('footer')
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>CoffeeTeaFusion</h3>
                <p>Наш магазин кофе и чая</p>
            </div>
            <div class="footer-section">
                <h3>Контакты</h3>
                <p>Телефон: +7 999 999 99 99</p>
                <p>Email: CoffeeTeaFusion@mail.com</p>
            </div>
            <div class="footer-section">
                <div class="subscribe">
                    <h3>Подписаться на рассылку</h3>
                    <form action="{{ route('subscribe') }}" method="post">
                        @csrf
                        <input type="email" name="email" placeholder="Введите ваш email" required>
                        <button type="submit">Подписаться</button>
                    </form>
                    <p>Нажимая на кнопку «Подписаться» вы соглашаетесь с <a href="{{ asset('soglashenie.rtf') }}">пользовательским соглашением</a></p>
                </div>
            </div>

            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>Спасибо за подписку на нашу рассылку!</p>
                </div>
            </div>
        </div>


        <div class="header-top">
            <div>&copy; 2024 CoffeeTeaFusion. Все права защищены.</div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if ("{{ session('success') }}") {
                    var modal = document.getElementById('myModal');
                    modal.style.display = 'block';

                    var span = document.getElementsByClassName('close')[0];
                    span.onclick = function() {
                        modal.style.display = 'none';
                    };

                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = 'none';
                        }
                    };

                    sessionStorage.setItem('modalShown', 'true');
                }
            });
        </script>
</footer>
@endsection
