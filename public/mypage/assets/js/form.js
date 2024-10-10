$(document).ready(function() {
    $('input[name="birth"]').on('input', function() {
        var birth_val = $(this).val().replace(/\D/g, ''); // 非数字を削除

        if (birth_val.length > 8) {
            birth_val = birth_val.substring(0, 8); // 8桁を超えた入力をトリム
        }

        if (birth_val.length > 6) {
            birth_val = birth_val.substring(0, 4) + '/' + birth_val.substring(4, 6) + '/' + birth_val.substring(6, 8);
        } else if (birth_val.length > 4) {
            birth_val = birth_val.substring(0, 4) + '/' + birth_val.substring(4, 6);
        }

        $(this).val(birth_val);
    });
});

$(document).ready(function() {
    $('input[name="time"]').on('input', function() {
        var time_val = $(this).val().replace(/\D/g, ''); // 非数字を削除

        if (time_val.length > 4) {
            time_val = time_val.substring(0, 4); // 4桁を超えた入力をトリム
        }

        if (time_val.length > 2) {
            time_val = time_val.substring(0, 2) + ':' + time_val.substring(2, 4);
        }

        $(this).val(time_val);
    });
});