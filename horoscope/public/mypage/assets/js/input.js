function validateText(evt) {
    var value = evt.target.value;
    // アルファベット、数字、コンマのみを許可する正規表現
    evt.target.value = value.replace(/[^a-z0-9._-]/g, '');
}