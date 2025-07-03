<?php

return [
    "validation_error" => "Ошибка валидации",
    "unexpected_fields" => "Отправлены лишние данные",

    "required" => "Поле :attribute обязательно для заполнения.",
    "min" => [
        "string" => "Поле :attribute должно содержать не менее :min символов.",
        "numeric" => "Значение поля :attribute должно быть не меньше :min."
    ],
    "max" => [
        "string" => "Поле :attribute должно содержать не более :max символов.",
    ],
    "confirmed" => "Поле :attribute не подтверждено.",
    "unique" => ":attribute уже существует.",
    "exists" => "Данные по полю :attribute не найдены.",
    "numeric" => "Поле :attribute должно быть числом.",
    "in" => "Выбрано некорректное значение для :attribute.",

    "valid_currencies" => "Валюта может быть только USD или UZS.",
    "input_or_output_required" => "Необходимо выбрать тип прихода или расхода.",
    "only_one_of_input_or_output" => "Необходимо выбрать только одно: приход или расход.",
    "not_belongs_to_user" => ":attribute не принадлежит этому пользователю.",
];
