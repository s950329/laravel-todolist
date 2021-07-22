# Laravel Todolist

Laravel Todolist 是一個利用 Laravel 特性所開發的一系列極簡 API，僅包含一個 Todolist 必要的最小功能。

## 目錄
1. [環境要求](#環境要求)
2. [環境安裝](#環境安裝)
3. [接口說明](#接口說明)

## 環境要求
1. PHP >= 7.4
2. Laravel >= 8
3. Composer
4. Docker

## 環境安裝

### 使用 Laradock 安裝環境

1. 進入 laradock 目錄
2. 複製並配置 .env 檔案

```
cp .env.example .env
```

3. 使用 docker 建立環境
```
docker-compose up -d nginx mysql workspace
```

4. 訪問 [http://localhost](http://localhost) 即可查看應用

### 準備項目環境

1. 進入專案目錄
2. 複製並配置 .env 檔案

```
cp .env.example .env
```

3. 安裝 composer 依賴

```
composer install
```

4. 執行數據庫遷移，建立數據表

```
php artisan migrate
```

5. （可選）執行數據填充，創建假數據

```
php artisan db:seed
```

## 接口說明

部分接口需經過安全令牌驗證才可調用，於下方接口名前方以 🔒 標示
安全令牌傳送方式需夾帶於請求 Header 中，詳見如下：

```
...
Authorization: Bearer {token}
...
```

### 用戶授權
#### 登入

> POST /api/auth/login

1. 請求參數

| 參數名 | 必填 |
| ------ | ---- |
| id     |      |

2. 返回參數

```
{
    "access_token": "xxx",
    "token_type": "bearer",
    "expires_in": 3600
}
```

#### 🔒 登出

> POST /api/auth/logout

2. 返回參數

```
{
    "message": "Successfully logged out"
}
```

#### 🔒 刷新 JWT 令牌

> POST /api/auth/refresh

2. 返回參數

```
{
    "access_token": "xxx",
    "token_type": "bearer",
    "expires_in": 3600
}
```

#### 🔒 檢查 JWT 令牌是否有效

> POST /api/auth/me

2. 返回參數

```
{
    "id": 1,
    "created_at": "2021-07-22T07:53:55.000000Z",
    "updated_at": "2021-07-22T07:53:55.000000Z"
}
```

### 待辦事項

#### 🔒 任務列表

> GET /api/tasks

1. 請求參數

| 參數名 | 必填 |
| ------ | ---- |
| page   |      |

2. 返回參數

```
{
    "data": [
        {
            "id": 1,
            "title": "title",
            "content": "content",
            "attachment_url": "attachment_url",
            "created_at": "2021-07-22 11:42:30",
            "done_at": null
        }
    ],
    "links": {
        "first": "http://voicetube.test/api/tasks?page=1",
        "last": "http://voicetube.test/api/tasks?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://voicetube.test/api/tasks?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://voicetube.test/api/tasks",
        "per_page": 15,
        "to": 1,
        "total": 1
    }
}
```

#### 🔒 獲取單一任務

> GET /api/tasks/:id

2. 返回參數

```
{
    "data": {
        "id": 12,
        "title": "title",
        "content": "content",
        "attachment_url": "/storage/files/J7LRQdRjnxzQOXvAul71GzK0VgbZOqyDse7IptX6.txt",
        "created_at": "2021-07-22 11:42:30",
        "done_at": null
    }
}
```

#### 🔒 新增任務

> POST /api/tasks

1. 請求參數

| 參數名     | 必填 |
| ---------- | ---- |
| title      | V    |
| content    | V    |
| attachment |      |


2. 返回參數

```
{
    "data": {
        "id": 12,
        "title": "title",
        "content": "content",
        "attachment_url": "/storage/files/J7LRQdRjnxzQOXvAul71GzK0VgbZOqyDse7IptX6.txt",
        "created_at": "2021-07-22 11:42:30",
        "done_at": null
    }
}
```

#### 🔒 修改任務

> PUT /api/tasks/:id

1. 請求參數

| 參數名     | 必填 |
| ---------- | ---- |
| title      | V    |
| content    | V    |
| attachment |      |
| done_at    |      |


2. 返回參數

```
{
    "data": {
        "id": 12,
        "title": "title",
        "content": "content",
        "attachment_url": "/storage/files/J7LRQdRjnxzQOXvAul71GzK0VgbZOqyDse7IptX6.txt",
        "created_at": "2021-07-22 11:42:30",
        "done_at": null
    }
}
```

#### 🔒 刪除任務

> DELETE /api/tasks/:id

2. 返回參數

```
{
    "code": 200,
    "message": "success"
}
```

#### 🔒 刪除全部任務

> DELETE /api/tasks

2. 返回參數

```
{
    "code": 200,
    "message": "success"
}
```
