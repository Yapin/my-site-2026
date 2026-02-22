document.addEventListener('DOMContentLoaded', function () {
    // フォーム要素の取得
    const form = document.getElementById('snow-monkey-form-105');

    // フォームが存在するかどうかを確認
    if (form) {
        const emailInput = form.querySelector('input[name="email"]');
        const emailConfirmInput = form.querySelector('input[name="confirm-email"]');
        const submitButton = form.querySelector('button[type="submit"]');

        // エラーメッセージ表示用の要素を作成
        const errorMessage = document.createElement('div');
        errorMessage.className = 'custom-error-message';
        errorMessage.style.color = '#ff0000';
        errorMessage.style.display = 'none';
        errorMessage.innerText = 'メールアドレスが一致しません。';
        emailConfirmInput.parentNode.appendChild(errorMessage);

        // 確認用メールアドレスフィールドの変更イベントリスナー
        emailConfirmInput.addEventListener('input', function () {
            if (emailInput.value !== emailConfirmInput.value) {
                errorMessage.style.display = 'block';
                submitButton.disabled = true;
            } else {
                errorMessage.style.display = 'none';
                submitButton.disabled = false;
            }
        });

        // フォーム送信時のイベントリスナー
        form.addEventListener('submit', function (event) {
            if (emailInput.value !== emailConfirmInput.value) {
                errorMessage.style.display = 'block';
                submitButton.disabled = true;
                event.preventDefault(); // フォーム送信を停止
            } else {
                submitButton.disabled = false;
            }
        });
    }
});