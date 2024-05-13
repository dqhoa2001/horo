# Hướng dẫn cài đặt và triển khai ứng dụng Horoscope

## 1. Cài đặt Docker và Triển khai ứng dụng

1. Tạo container Docker:
    ```bash
    docker-compose -f docker-compose.yml up -d --build
    ```

2. Truy cập vào container `horoscope`:
    ```bash
    docker exec -it horoscope bash
    ```

3. Trong container, chạy các lệnh sau:
    ```bash
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    chmod +x /var/www/Modules/Horoscope/Http/Actions/Predict/sweph/ephe/swetest
    exit
    ```

## 2. Cài đặt và xây dựng Client

1. Di chuyển đến thư mục `horoscope/Modules/Horoscope`:
    ```bash
    cd horoscope/Modules/Horoscope
    ```

2. Cài đặt các dependencies PHP:
    ```bash
    composer install
    ```

3. Cài đặt các dependencies JavaScript:
    ```bash
    npm install
    ```

4. Xây dựng ứng dụng Client:
    ```bash
    npm run build
    ```

## 3. Cài đặt và xây dựng Admin

1. Di chuyển đến thư mục `horoscope`:
    ```bash
    cd horoscope
    ```

2. Cài đặt các dependencies PHP:
    ```bash
    composer install
    ```

3. Cài đặt các dependencies JavaScript:
    ```bash
    npm install
    ```

4. Xây dựng ứng dụng Admin:
    ```bash
    npm run build
    ```

## 4. Link

- Client: [http://localhost:8080/user/login](http://localhost:8080/user/login)
- Admin: [http://localhost:8080/admin/login](http://localhost:8080/admin/login)

## 5. Môi trường Phát triển

- Client URL: [https://stg-horoscorp-uranai.4sis.site/](https://stg-horoscorp-uranai.4sis.site/)
- Admin URL: [https://stg-horoscorp-uranai.4sis.site/admin/login](https://stg-horoscorp-uranai.4sis.site/admin/login)
- Tài khoản Client:
    - Email: user1@test.com
    - Mật khẩu: 123123123Mm
- Tài khoản Admin:
    - Email: admin1@test.com
    - Mật khẩu: 11111111

## 6. Tính năng thanh toán

- Thẻ Stripe Thử nghiệm:
    - Thành công: 4242 4242 4242 4242
    - Thất bại: 4000 0000 0000 0341
