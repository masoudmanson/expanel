<?php

//return [
//
//    /*
//    |--------------------------------------------------------------------------
//    | Validation Language Lines
//    |--------------------------------------------------------------------------
//    |
//    | The following language lines contain the default error messages used by
//    | the validator class. Some of these rules have multiple versions such
//    | as the size rules. Feel free to tweak each of these messages here.
//    |
//    */
//
//    'accepted'             => 'The :attribute must be accepted.',
//    'active_url'           => 'The :attribute is not a valid URL.',
//    'after'                => 'The :attribute must be a date after :date.',
//    'alpha'                => 'The :attribute may only contain letters.',
//    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
//    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
//    'array'                => 'The :attribute must be an array.',
//    'before'               => 'The :attribute must be a date before :date.',
//    'between'              => [
//        'numeric' => 'The :attribute must be between :min and :max.',
//        'file'    => 'The :attribute must be between :min and :max kilobytes.',
//        'string'  => 'The :attribute must be between :min and :max characters.',
//        'array'   => 'The :attribute must have between :min and :max items.',
//    ],
//    'boolean'              => 'The :attribute field must be true or false.',
//    'confirmed'            => 'The :attribute confirmation does not match.',
//    'date'                 => 'The :attribute is not a valid date.',
//    'date_format'          => 'The :attribute does not match the format :format.',
//    'different'            => 'The :attribute and :other must be different.',
//    'digits'               => 'The :attribute must be :digits digits.',
//    'digits_between'       => 'The :attribute must be between :min and :max digits.',
//    'dimensions'           => 'The :attribute has invalid image dimensions.',
//    'distinct'             => 'The :attribute field has a duplicate value.',
//    'email'                => 'The :attribute must be a valid email address.',
//    'exists'               => 'The selected :attribute is invalid.',
//    'file'                 => 'The :attribute must be a file.',
//    'filled'               => 'The :attribute field is required.',
//    'image'                => 'The :attribute must be an image.',
//    'in'                   => 'The selected :attribute is invalid.',
//    'in_array'             => 'The :attribute field does not exist in :other.',
//    'integer'              => 'The :attribute must be an integer.',
//    'ip'                   => 'The :attribute must be a valid IP address.',
//    'json'                 => 'The :attribute must be a valid JSON string.',
//    'max'                  => [
//        'numeric' => 'The :attribute may not be greater than :max.',
//        'file'    => 'The :attribute may not be greater than :max kilobytes.',
//        'string'  => 'The :attribute may not be greater than :max characters.',
//        'array'   => 'The :attribute may not have more than :max items.',
//    ],
//    'mimes'                => 'The :attribute must be a file of type: :values.',
//    'mimetypes'            => 'The :attribute must be a file of type: :values.',
//    'min'                  => [
//        'numeric' => 'The :attribute must be at least :min.',
//        'file'    => 'The :attribute must be at least :min kilobytes.',
//        'string'  => 'The :attribute must be at least :min characters.',
//        'array'   => 'The :attribute must have at least :min items.',
//    ],
//    'not_in'               => 'The selected :attribute is invalid.',
//    'numeric'              => 'The :attribute must be a number.',
//    'present'              => 'The :attribute field must be present.',
//    'regex'                => 'The :attribute format is invalid.',
//    'required'             => 'The :attribute field is required.',
//    'required_if'          => 'The :attribute field is required when :other is :value.',
//    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
//    'required_with'        => 'The :attribute field is required when :values is present.',
//    'required_with_all'    => 'The :attribute field is required when :values is present.',
//    'required_without'     => 'The :attribute field is required when :values is not present.',
//    'required_without_all' => 'The :attribute field is required when none of :values are present.',
//    'same'                 => 'The :attribute and :other must match.',
//    'size'                 => [
//        'numeric' => 'The :attribute must be :size.',
//        'file'    => 'The :attribute must be :size kilobytes.',
//        'string'  => 'The :attribute must be :size characters.',
//        'array'   => 'The :attribute must contain :size items.',
//    ],
//    'string'               => 'The :attribute must be a string.',
//    'timezone'             => 'The :attribute must be a valid zone.',
//    'unique'               => 'The :attribute has already been taken.',
//    'uploaded'             => 'The :attribute failed to upload.',
//    'url'                  => 'The :attribute format is invalid.',
//
//    /*
//    |--------------------------------------------------------------------------
//    | Custom Validation Language Lines
//    |--------------------------------------------------------------------------
//    |
//    | Here you may specify custom validation messages for attributes using the
//    | convention "attribute.rule" to name the lines. This makes it quick to
//    | specify a specific custom language line for a given attribute rule.
//    |
//    */
//
//    'custom' => [
//        'img' => [
//            'empty_when' => 'custom-message',
//        ],
////        'vid' => [
////            'empty_when' => 'custom-message2',
////        ],
//    ],
//
//    /*
//    |--------------------------------------------------------------------------
//    | Custom Validation Attributes
//    |--------------------------------------------------------------------------
//    |
//    | The following language lines are used to swap attribute place-holders
//    | with something more reader friendly such as E-Mail Address instead
//    | of "email". This simply helps us make messages a little cleaner.
//    |
//    */
//
//    'attributes' => [],
//
//];

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute باید پذیرفته شده باشد.',
    'active_url'           => 'آدرس :attribute معتبر نیست',
    'after'                => ':attribute باید تاریخی بعد از :date باشد.',
    'after_or_equal'       => ':attribute باید تاریخی بعد از :date، یا مطابق با آن باشد.',
    'alpha'                => ':attribute باید فقط حروف الفبا باشد.',
    'alpha_dash'           => ':attribute باید فقط حروف الفبا، عدد و خط تیره(-) باشد.',
    'alpha_num'            => ':attribute باید فقط حروف الفبا و عدد باشد.',
    'array'                => ':attribute باید آرایه باشد.',
    'before'               => ':attribute باید تاریخی قبل از :date باشد.',
    'before_or_equal'      => ':attribute باید تاریخی قبل از :date، یا مطابق با آن باشد.',
    'between'              => [
        'numeric' => ':attribute باید بین :min و :max باشد.',
        'file'    => ':attribute باید بین :min و :max کیلوبایت باشد.',
        'string'  => ':attribute باید بین :min و :max کاراکتر باشد.',
        'array'   => ':attribute باید بین :min و :max آیتم باشد.',
    ],
    'boolean'              => ' :attribute فقط می‌تواند صحیح و یا غلط باشد',
    'confirmed'            => ':attribute با فیلد تکرار مطابقت ندارد.',
    'date'                 => ':attribute یک تاریخ معتبر نیست.',
    'date_format'          => ':attribute با الگوی :format مطاقبت ندارد.',
    'different'            => ':attribute و :other باید متفاوت باشند.',
    'digits'               => ':attribute باید :digits رقم باشد.',
    'digits_between'       => ':attribute باید بین :min و :max رقم باشد.',
    'dimensions'           => 'ابعاد تصویر :attribute قابل قبول نیست.',
    'distinct'             => 'فیلد :attribute تکراری است.',
    'email'                => ':attribute باید یک ایمیل معتبر باشد',
    'exists'               => ':attribute انتخاب شده، معتبر نیست.',
    'file'                 => ':attribute باید یک فایل باشد',
    'filled'               => ':attribute الزامی است',
    'image'                => ':attribute باید تصویر باشد.',
    'in'                   => ':attribute انتخاب شده، معتبر نیست.',
    'in_array'             => 'فیلد :attribute در :other وجود ندارد.',
    'integer'              => ':attribute باید عدد صحیح باشد.',
    'ip'                   => ':attribute باید IP معتبر باشد.',
    'ipv4'                 => ':attribute باید یک آدرس معتبر از نوع IPv4 باشد.',
    'ipv6'                 => ':attribute باید یک آدرس معتبر از نوع IPv6 باشد.',
    'json'                 => 'فیلد :attribute باید یک رشته از نوع JSON باشد.',
    'max'                  => [
        'numeric' => ':attribute نباید بزرگتر از :max باشد.',
        'file'    => ':attribute نباید بزرگتر از :max کیلوبایت باشد.',
        'string'  => ':attribute نباید بیشتر از :max کاراکتر باشد.',
        'array'   => ':attribute نباید بیشتر از :max آیتم باشد.',
    ],
    'mimes'                => ':attribute باید یکی از فرمت های :values باشد.',
    'mimetypes'            => ':attribute باید یکی از فرمت های :values باشد.',
    'min'                  => [
        'numeric' => ':attribute نباید کوچکتر از :min باشد.',
        'file'    => ':attribute نباید کوچکتر از :min کیلوبایت باشد.',
        'string'  => ':attribute نباید کمتر از :min کاراکتر باشد.',
        'array'   => ':attribute نباید کمتر از :min آیتم باشد.',
    ],
    'not_in'               => ':attribute انتخاب شده، معتبر نیست.',
    'numeric'              => ':attribute باید عدد باشد.',
    'present'              => 'فیلد :attribute باید در پارامترهای ارسالی وجود داشته باشد.',
    'regex'                => 'فرمت :attribute معتبر نیست',
    'required'             => 'وارد کردن :attribute الزامی است',
    'required_if'          => 'هنگامی که :other برابر با :value است، فیلد :attribute الزامی است.',
    'required_unless'      => 'فیلد :attribute ضروری است، مگر آنکه :other در :values موجود باشد.',
    'required_with'        => 'در صورت وجود فیلد :values، فیلد :attribute الزامی است.',
    'required_with_all'    => 'در صورت وجود فیلدهای :values، فیلد :attribute الزامی است.',
    'required_without'     => 'در صورت عدم وجود فیلد :values، فیلد :attribute الزامی است.',
    'required_without_all' => 'در صورت عدم وجود هر یک از فیلدهای :values، فیلد :attribute الزامی است.',
    'same'                 => ':attribute و :other باید مانند هم باشند.',
    'size'                 => [
        'numeric' => ':attribute باید برابر با :size باشد.',
        'file'    => ':attribute باید برابر با :size کیلوبایت باشد.',
        'string'  => ':attribute باید برابر با :size کاراکتر باشد.',
        'array'   => ':attribute باسد شامل :size آیتم باشد.',
    ],
    'string'               => ':attribute باید متن باشد.',
    'timezone'             => ':attribute باید یک منطقه زمانی قابل قبول باشد.',
    'unique'               => ':attribute قبلا انتخاب شده است.',
    'uploaded'             => 'آپلود فایل :attribute موفقیت آمیز نبود.',
    'url'                  => 'فرمت آدرس :attribute اشتباه است.',
    'iban'                 => " کد iBan وارد شده، صحیح نمی باشد.",
    'bic'                  => 'مقدار :attribute وارد شده، صحیح نمی باشد.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'captcha' => [
            'required' => 'کدامنیتی را وارد کنید!',
            'captcha'  => "کد امنیتی اشتباه است!",
        ],
        'amount' => [
            'required'  => "لطفا مقدار ارز را وارد نمائید.",
            'min'  => "مقدار ارز معتبر وارد نمائید.",
            'max'  => "مقدار ارز معتبر وارد نمائید.",
            'between' => "مقدار ارز وارد شده باید بین 10 تا 10000 باشد."
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name'                  => 'نام',
        'identity_number‌'       => 'کد ملی',
        'username'              => 'نام کاربری',
        'email'                 => 'ایمیل',
        'firstname'             => 'نام',
        'lastname'              => 'نام خانوادگی',
        'password'              => 'رمز عبور',
        'password_confirmation' => 'تکرار رمز عبور',
        'city'                  => 'شهر',
        'country'               => 'کشور',
        'address'               => 'نشانی',
        'phone'                 => 'تلفن',
        'mobile'                => 'تلفن همراه',
        'age'                   => 'سن',
        'sex'                   => 'جنسیت',
        'gender'                => 'جنسیت',
        'day'                   => 'روز',
        'month'                 => 'ماه',
        'year'                  => 'سال',
        'hour'                  => 'ساعت',
        'minute'                => 'دقیقه',
        'second'                => 'ثانیه',
        'title'                 => 'عنوان',
        'text'                  => 'متن',
        'content'               => 'محتوا',
        'description'           => 'توضیحات',
        'excerpt'               => 'گزیده مطلب',
        'date'                  => 'تاریخ',
        'time'                  => 'زمان',
        'available'             => 'موجود',
        'size'                  => 'اندازه',
        'terms'                 => 'شرایط',
        'bank_name'             => 'نام بانک',
        'branch_name'           => 'نام شعبه',
        'swift_code'            => 'کد سویفت',
        'iban_code'             => 'کد iBan',
        'tel'                   => 'شماره تماس',
        'fax'                   => 'شماره فکس',
        'amount'                => 'مقدار پول',
        'contactText'           => 'متن ارسالی',
        'account_number‌'        => 'شماره حساب',
        'user_id‌'               => 'شناسه ی کاربر'
    ]
];
