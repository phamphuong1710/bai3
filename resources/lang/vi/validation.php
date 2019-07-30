<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute phải được chấp nhận.',
    'active_url' => ':attribute không phải là 1 URL hợp lệ.',
    'after' => ':attribute phải là ngày sau :date.',
    'after_or_equal' => ':attribute phải là 1 ngày sau hoặc ngày :date.',
    'alpha' => ':attribute chỉ có thể chứa các ký tự chữ.',
    'alpha_dash' => ':attribute chỉ có thể chứa các ký tự chữ, số, đấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => ':attribute chỉ có thể chứa các ký tự chữ và số.',
    'array' => ':attribute phải là 1 mảng.',
    'before' => ':attribute phải là 1 ngày trước :date.',
    'before_or_equal' => ':attribute phải là 1 ngày trước hoặc ngày :date.',
    'between' => [
        'numeric' => ':attribute phải nằm giữa :min and :max.',
        'file' => ':attribute phải nằm giữa :min and :max kilobytes.',
        'string' => ':attribute phải nằm giữa :min and :max characters.',
        'array' => ':attribute phải nằm giữa :min and :max items.',
    ],
    'boolean' => ':attribute phải đúng hoặc sai.',
    'confirmed' => ':attribute xác nhận không trùng khớp.',
    'date' => ':attribute không phải là ngày hợp lệ.',
    'date_equals' => ':attribute phải là 1 ngày bằng :date.',
    'date_format' => ':attribute không phù hợp với định dạng :format.',
    'different' => ':attribute and :other phải khác nhau.',
    'digits' => ':attribute phải là :digits chữ số.',
    'digits_between' => ':attribute phải nằm giữa :min and :max digits.',
    'dimensions' => ':attribute kích thước ảnh không hợp lệ.',
    'distinct' => ':attribute trường có giá trị trùng lặp',
    'email' => ':attribute phải là 1 đại chỉ e-mail hợp lệ.',
    'ends_with' => ':attribute phải kết thúc bằng một trong những điều sau đây: :values',
    'exists' => 'Giá trị được chọn :attribute không hợp lệ.',
    'file' => ':attribute phải là 1 file.',
    'filled' => ':attribute trường phải có giá trị.',
    'gt' => [
        'numeric' => ':attribute phải lớn hơn :value.',
        'file' => ':attribute phải lớn hơn :value kilobytes.',
        'string' => ':attribute phải lớn hơn :value characters.',
        'array' => ':attribute phải có nhiều hơn :value mục.',
    ],
    'gte' => [
        'numeric' => ':attribute phải có nhiều hơn hoặc bằng :value.',
        'file' => ':attribute phải có nhiều hơn hoặc bằng :value kilobytes.',
        'string' => ':attribute phải có nhiều hơn hoặc bằng :value characters.',
        'array' => ':attribute phải có :value mục hoặc hơn.',
    ],
    'image' => ':attribute phải là 1 hình ảnh.',
    'in' => 'Giá trị được chọn :attribute không hợp lệ.',
    'in_array' => ':attribute trường khong tồn tại trong :other.',
    'integer' => ':attribute phải là 1 số.',
    'ip' => ':attribute phải là 1 địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute phải là 1 địa chỉ IPV4 hợp lệ.',
    'ipv6' => ':attribute phải là 1 địa chỉ IPV6 hợp lệ.',
    'json' => ':attribute phải là 1 chuỗi JSON hợp lệ.',
    'lt' => [
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'file' => ':attribute phải nhỏ hơn :value kilobytes.',
        'string' => ':attribute phải nhỏ hơn :value characters.',
        'array' => ':attribute có ít hơn :value mục.',
    ],
    'lte' => [
        'numeric' => ':attribute phải nhỏ hơn or equal :value.',
        'file' => ':attribute phải nhỏ hơn or equal :value kilobytes.',
        'string' => ':attribute phải nhỏ hơn or equal :value characters.',
        'array' => ':attribute không nhiều hơn :value mục.',
    ],
    'max' => [
        'numeric' => ':attribute có thể không lớn hơn :max.',
        'file' => ':attribute có thể không lớn hơn :max kilobytes.',
        'string' => ':attribute có thể không lớn hơn :max characters.',
        'array' => ':attribute có thể không nhiều hơn :max mục.',
    ],
    'mimes' => ':attribute phải là một tập tin loại: :values.',
    'mimetypes' => ':attribute must be a file of type: :values.',
    'min' => [
        'numeric' => ':attribute nhỏ nhất là :min.',
        'file' => ':attribute nhỏ nhất là :min kilobytes.',
        'string' => ':attribute nhỏ nhất là :min characters.',
        'array' => ':attribute phải có ít nhất :min mục.',
    ],
    'not_in' => 'Giá trị được chọn :attribute không hợp lệ.',
    'not_regex' => ':attribute định dạng không hợp lệ.',
    'numeric' => ':attribute phải là 1 số.',
    'present' => ':attribute phải hiện diện.',
    'regex' => 'Trường :attribute định dạng không hợp lệ.',
    'required' => 'Trường :attribute là bắt buộc .',
    'required_if' => 'Trường :attribute là bắt buộc khi :other là :value.',
    'required_unless' => 'Trường :attribute là bắt buộc trừ khi :other trong :values.',
    'required_with' => 'Trường :attribute là bắt buộc khi :values hiện diện.',
    'required_with_all' => 'Trường :attribute là bắt buộc khi :values hiện diện.',
    'required_without' => 'Trường :attribute là bắt buộc khi :values không hiện diện.',
    'required_without_all' => 'Trường :attribute trường là bắt buộc khi không có :values hiện diện.',
    'same' => ':attribute và :other phải giống nhau.',
    'size' => [
        'numeric' => ':attribute phải là :size.',
        'file' => ':attribute phải là :size kilobytes.',
        'string' => ':attribute phải là :size ký tự.',
        'array' => ':attribute phải chứa :size mục.',
    ],
    'starts_with' => ':attribute phải bắt đầu với một trong những điều sau đây: :values',
    'string' => ':attribute phải là 1 chuỗi.',
    'timezone' => ':attribute phải là một khu vực hợp lệ.',
    'unique' => ':attribute đã được thực hiện.',
    'uploaded' => ':attribute không tải lên được.',
    'url' => ':attribute định dạng không hợp lệ.',
    'uuid' => ':attribute phải là một UUID hợp lệ.',

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
        'logo_id' => [
            'required' => 'Logo là trường bắt buộc',
        ],
        'category_id' => [
            'required' => 'Danh mục là trường bắt buộc',
        ],
        'name' => [
            'required' => 'Tên là trường bắt buộc',
        ],
        'price' => [
            'required' => 'Giá nhập là trường bắt buộc',
        ],
        'sale_price' => [
            'required' => 'Giá bán là trường bắt buộc',
        ],
        'quantity' => [
            'required' => 'Số lượng là trường bắt buộc',
        ],
        'description' => [
            'required' => 'Mô tả là trường bắt buộc',
        ],
        'list_image' => [
            'required' => 'Ảnh là trường bắt buộc',
        ],
        'user_id' => [
            'required' => 'Người Dùng là trường bắt buộc',
        ],
        'store_id' => [
            'required' => 'Cửa hàng là trường bắt buộc',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
