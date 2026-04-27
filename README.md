# Only PHP Task
## Task_1
Для вывода новостей используется стандартный компонент Bitrix `bitrix:news.list`, шаблон `custom_news` .

### Используемые технологии
- CMS 1C-Битрикс
- PHP
- HTML / CSS.

### Структура проекта:
- Шаблон сайта: `/local/templates/task_1/`
- Шаблон компонента `news.list`: 
`/local/templates/task_1/components/bitrix/news.list/custom_news/`
- Компонент подключается на главной странице: `/index.php`

## Task_2
Для вывода формы используется стандартный компонент Bitrix `bitrix:form.result.new`, шаблон `custom_form` .

### Используемые технологии
- CMS 1C-Битрикс
- PHP
- HTML / CSS.

### Структура проекта:
- Шаблон сайта: `/local/templates/task_2/`
- Шаблон компонента `form.result.new`: 
`local\templates\task_2\components\bitrix\form.result.new\custom_form\`
- Компонент подключается на главной странице: `/index.php`

## Task_3
Для вывода новостей используется стандартный комплексный компонент Bitrix `bitrix:news`, шаблон `custom_news` .

### Используемые технологии
- CMS 1C-Битрикс
- PHP
- HTML / CSS.

### Структура проекта:
- Шаблон сайта: `/local/templates/task_3/`
- Шаблон комплексного компонента `news`: 
`/local/templates/task_3/components/bitrix/news.list/custom_news/`
- Шаблон простого компонента `news.list`: 
`local\templates\task_3\components\bitrix\news.list\custom_list\template.php`
- Шаблон простого компонента `news.detail`: 
`local\templates\task_3\components\bitrix\news.detail\custom_detail\template.php`
- Компонент подключается на странице news: `/news/index.php`

## Task_4
Установлен модуль миграций **sprint.migration**, с его помощью создан дополнительный инфоблок Вакансии. Далее реализован парсер, который загружает данные из CSV-файла, обрабатывает значения, автоматически заполняет элементы инфоблока.

### Используемые технологии
- CMS 1C-Битрикс
- PHP
- Миграции sprint.migration
- Работа с инфоблоками
- CSV-парсинг

### Структура проекта
- Миграции: `/local/php_interface/migrations/`
- Инициализация миграций: `/bitrix/modules/sprint.migration/`
- Парсер: `/parser/`
- Данные для импорта: `/parser/vacancy.csv`
- Инфоблок вакансий: создан через миграцию
