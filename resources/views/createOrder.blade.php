@extends('layouts.app')
@section('content')
    <style>
        .cart {
            font-family: 'Arial', sans-serif;
            margin: auto;
            max-width: 960px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .cart__table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed;
        }

        .cart__table th,
        .cart__table td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .cart__table th:nth-child(1),
        .cart__table td:nth-child(1) {
            width: 20%;
        }

        .cart__table th:nth-child(2),
        .cart__table td:nth-child(2) {
            width: 15%;
        }

        .cart__table th:nth-child(3),
        .cart__table td:nth-child(3) {
            width: 20%;
        }

        .cart__table th:nth-child(4),
        .cart__table td:nth-child(4) {
            width: 15%;
        }


        .cart__qty,
        .cart__price,
        .cart__price-total {
            text-align: center;
        }


        .total-price {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        .form-control {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .order__confirm {
            background-color: #f90;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .order__confirm:hover {
            background-color: #e80;
        }

        @media (max-width: 768px) {
            .container {
                width: 100% !important;
            }

            .cart__table,
            .cart__qty,
            .cart__price,
            .cart__price-total {
                font-size: 14px;
            }

            .cart__table td,
            .cart__table th {
                padding: 8px;
            }

            .form-control,
            .order__confirm {
                width: 100%;
            }
        }
    </style>
    <div class="cart">
        <table class="cart__table">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Итого</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    <tr class="cart__raw">
                        <td>{{ $item->title }}</td>
                        <td class="cart__qty container">
                            <span class="cart__qty-value">
                                {{ $item->qty }}
                            </span>
                        </td>
                        <td class="cart__price">{{ $item->price }}</td>
                        <td class="cart__price-total">{{ $item->price * $item->qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class=""> К оплате <span>{{ $total }}</span></div>
        <form action="/create-order" method="POST">
            @csrf
            <input type="text" class="confirmation-code form-control" value="{{ old('confirmation_code') }}"
                autocomplete="off" name="confirmation_code" placeholder="Введите код подтверждения"
                style="box-shadow: none !important; border-color: #fc9;" required>
            <input type="submit" value="Сформировать заказ" class="order__confirm btn">
        </form>
    </div>
    </div>

    <script>
        const confirmationCode = document.querySelector('.confirmation-code');
        const btn = document.querySelector('.order__confirm');
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            if (!confirmationCode.value.trim()) {
                confirmationCode.classList.add('is-invalid');
                return;
            }
            let response = undefined;
            fetch(`/create-order`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        'confirmation_code': confirmationCode.value
                    }),
                    method: "POST"
                })
                .then(data => {
            if (data.message === 'Confirmation code verified successfully') {
                window.location.replace('/user');
            } else {
                confirmationCodeInput.classList.add('is-invalid');
                setTimeout(() => {
                    confirmationCodeInput.classList.remove('is-invalid');
                }, 3000);
            }
        })
                .then(res => response = res.json())
                .finally(async () => {
                    let message = await response;
                    if (message.message === 'err') {
                        confirmationCode.classList.add('is-invalid');
                        setTimeout(() => {
                            confirmationCode.classList.remove('is-invalid');
                        }, 100000);
                    } else {
                        confirmationCode.classList.remove('is-invalid');
                        confirmationCode.classList.add('is-valid');
                        setTimeout(() => {
                            window.location.replace('/user');
                        }, 500);
                    }
                });
        });

document.addEventListener('DOMContentLoaded', function() {
    const confirmationCodeInput = document.querySelector('.confirmation-code');
    const orderConfirmButton = document.querySelector('.order__confirm');

    orderConfirmButton.addEventListener('click', function(e) {
        e.preventDefault();

        const enteredCode = confirmationCodeInput.value.trim();

        if (!enteredCode) {
            confirmationCodeInput.classList.add('is-invalid');
            return;
        }

        fetch('/verify-confirmation-code', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                'confirmation_code': enteredCode
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Confirmation code verified successfully') {
                window.location.replace('/user');
            } else {
                confirmationCodeInput.classList.add('is-invalid');
                setTimeout(() => {
                    confirmationCodeInput.classList.remove('is-invalid');
                }, 3000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    fetch('/send-confirmation-code', {
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        method: 'GET'
    })
    .then(response => response.json())
    .catch(error => {
        console.error('Error:', error);
    });
});
    </script>
@endsection
@extends('layouts.footer')
