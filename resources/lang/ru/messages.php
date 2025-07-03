<?php

return [
    // CRUD STATUS MESSAGES
    "not_found" => ":item не найден",
    "created_success" => ":item успешно добавлен",
    "updated_success" => "Данные :item успешно обновлены",
    "active_updated_success" => "Статус активности :item успешно изменён",
    "deleted_success" => ":item успешно удалён",
    "approved_success" => ":item успешно подтверждён",

    // AUTH
    "register_success" => "Вы успешно зарегистрировались.",
    "login_success" => "Вы успешно вошли в систему.",
    "logout_success" => "Вы вышли из системы.",
    "invalid_credentials" => "Неверное имя пользователя или пароль.",
    "unauthenticated" => "У вас нет доступа к системе",

    "cash_box_exists_by_currency" => "У вас уже есть касса с этой валютой",
    "valid_currencies" => "Валюта должна быть только UZS или USD",
    "input_or_output_required" => "Необходимо выбрать тип операции кассы",
    "only_one_of_input_or_output" => "Операция кассы должна быть либо приходом, либо расходом",
    "not_belongs_to_user" => ":item не принадлежит этому пользователю",
    "not_enough_amount_in_cash" => "Недостаточно средств в кассе.",
    "input_type_required_due_to_existing_data" => "Выбор типа прихода обязателен",
    "output_type_required_due_to_existing_data" => "Выбор типа расхода обязателен",

    "from_cash_box_id_required" => "Укажите, из какой кассы осуществляется вывод средств.",
    "to_cash_box_id_required" => "Укажите, в какую кассу поступают средства.",
    "from_cash_box_id_different" => "Кассы не должны быть одинаковыми.",
    "from_amount_gt" => "Сумма конверсии должна быть больше 0.",
    "exchange_rate_gt" => "Курс обмена должен быть больше 0.",
];
