<?php

return [
    // CRUD STATUS MESSAGES
    "not_found" => ":item topilmadi",
    "created_success" => ":item muvaffaqiyatli qo'shildi",
    "updated_success" => ":item ma'lumotlari muvaffaqiyatli yangilandi",
    "active_updated_success" => ":item faollik holati muvaffaqiyatli o'zgartirildi",
    "deleted_success" => ":item muvaffaqiyatli o'chirildi",
    "approved_success" => ":item muvaffaqiyatli tasdiqlandi",

    // AUTH
    "register_success" => "Ro'yxatdan muvaffaqiyatli o'tdingiz.",
    "login_success" => "Tizimga muvaffaqiyatli kirdingiz.",
    "logout_success" => "Tizimdan chiqarildingiz.",
    "invalid_credentials" => "Foydalanuvchi nomi yoki parol noto'g'ri.",
    "unauthenticated" => "Tizimga kirishga huquqingiz yo'q",

    "cash_box_exists_by_currency" => "Sizda ushbu valyuta bo'yicha kassa mavjud",
    "valid_currencies" => "Valyuta turi faqat UZS yoki USD bo'lishi mumkin",
    "input_or_output_required" => "Kassa amaliyoti turini tanlash shart",
    "only_one_of_input_or_output" => "Kassa amaliyoti Kirim yoki Chiqim bo'lishi kerak",
    "not_belongs_to_user" => ":item ushbu foydalanuvchiga tegishli emas",
    "not_enough_amount_in_cash" => "Kassada yetarli summa mavjud emas.",
    "input_type_required_due_to_existing_data" => "Kirim turini tanlash majburiy",
    "output_type_required_due_to_existing_data" => "Chiqim turini tanlash majburiy",

    "from_cash_box_id_required" => "Qaysi kassadan pul chiqishini ko‘rsating.",
    "to_cash_box_id_required" => "Qaysi kassaga pul tushishini ko‘rsating.",
    "from_cash_box_id_different" => "Kassalar bir xil bo‘lmasligi kerak.",
    "from_amount_gt" => "Konvertatsiya summasi 0 dan katta bo‘lishi kerak.",
    "exchange_rate_gt" => "Valyuta kursi 0 dan katta bo‘lishi kerak.",
];
