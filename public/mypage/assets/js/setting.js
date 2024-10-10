$(".Setting-form input").on("change", function() {
    // "変更を保存する"ボタンのdisabled属性を取り除く
    $(".Button--lightblue").prop("disabled", false);
});