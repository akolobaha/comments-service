<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Тестовый проект "Сервис комментариев"</h1>
    <br>
</p>

### Задача

1. сделать сервис предназначенный для добавления комментариев к неким сущностям, набор которых будет менятся
2. сущность к которой прикрепляется комментарий идентифицируется двумя полями:
   - subject - вид сущности (к примеру 'product' )
   - subject_id - идентификатор сущности
3. каждая сущность может иметь много комментариев
3. комментарии оставляю пользователи на веб страничке. авторизация не требуется.
4. на поля формы (первые два чисто технические):
   - subject    (required)
   - subject_id (required)
   - username
   - comment    (required)
5. при сохранении комментария необходимо также сохранять IP, user agent, дату создания
6. предусмотреть статус для комментария. создаваться он будет в статусе New и может быть модерирован (модерация в задание не входит).  Стастусы могут быть:
   - New
   - Approved
   - Rejected
7. Страницы которые должны быть:
   - создание комментария (см п 4)
   - список комментариев
      - с фильтрами по:
         - subject
         - subject_id
         - username
         - дате создания
      - колонки грида
         - subject
         - subject_id
         - username
         - дата создания
         - комментарий (первые 150 символов)
         - actions - линк на открытие деталей комментария
      - страница деталей комментария, где все вышеперечмсленные поля можно менять
8. точки апи
   - создание комментария (см п 4)
   - список комментариев - параметры фильтрации и поля как у грида
   - получение комментария по id
9. заполнить коменты отзывами с любого сайта - парсинг нескольких штук

10. создание структуры базы предполагается самостоятельное
11. если знаком с docker, swagger то их применение приветсвуется


### Пример .ENV файла
```
### Database
DB_HOST     = 'db'
DB_PORT     = '3309'
DB_NAME     = 'comments'
DB_PASSWORD = '12345'
DB_USERNAME = 'root'
DB_PREFIX   = ''
```

### Docker
Под доккером php, mysql.

Update your vendor packages

    docker-compose run --rm php composer update --prefer-dist

Run the installation triggers (creating cookie validation code)

    docker-compose run --rm php composer install    

Start the container

    docker-compose up -d

### .env Файл

   ```docker-compose run --rm php mv .env.template .env```

You can then access the application through the following URL:

    http://127.0.0.1:8000

### Миграции
```docker-compose run --rm php yii migrate```

### Парсинг
#### Otzovik.com
``` docker exec php yii parser/otzovik```


### API

#### Получение всех комментариев (GET):
```http://127.0.0.1:8000/api```

#### Получение комментариев по фильтрам (GET):

```http://127.0.0.1:8000/api?comment=sdf&id=2&subject_id=1&username=wrr&date=23.04.2023```

#### Создание комментария (POST):
```http://127.0.0.1:8000/api/create```

Тело запроса:
```json
{
   "subject_id": 1,
   "username": "akolobaha",
   "comment": "Текст комментария"
}
```


