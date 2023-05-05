
# MVC PROJECT

Um projeto de MVC para estudo utilizando PHP.

## Instruções para executar.

Para instalar o repositório: `composer install`.

Para rodar a aplicação: `php -S localhost:8000 -F index.php`.

# Como funciona o projeto

## Controller

O projeto é baseado no modelo MVC.

Para criar uma nova rota basta ir em `app/Http/Routes/Routes.php` e criar uma nova rota da seguinte forma:

```bash
  $router->get('/', [
    function() {
        return newClass(\App\Controller\HomeController::class)->index();
    }
  ]);
```

Podem ser criado rotas do tipo GET, POST, PUT e DELETE. Tendo que passar o primeiro parâmetro sendo a rota e o segundo o callback

```bash
  $router->post('/', [
    function() {
        return newClass(\App\Controller\HomeController::class)->store();
    }
  ]);

  $router->put('/', [
    function() {
        return newClass(\App\Controller\HomeController::class)->edit();
    }
  ]);

  $router->delete('/', [
    function() {
        return newClass(\App\Controller\HomeController::class)->delete();
    }
  ]);
```

O controller responsável pela rota, deverá retornar uma Response. Exemplo:

```bash
  public function index()
    {
        try {
            return new Response(
                200,
                View::render('home', [
                  'userId' => 50
                ], 'Início')
            );
        } catch (\Exception $e) {
            return new Response(
                $e->getCode(),
                [
                    'message' => 'Ocorreu um erro'
                ],
                'application/json'
            );
        }
    }
```
Temos que passar para dentro do response o status, o retorno e o terceiro parâmetro não é obrigatório, sendo o content-type.

## View

Na parte do view temos três parâmetros que podemos passar. Sendo eles, o caminho do html de acordo com o caminho `resources/Views/Pages/`, o segundo é o array de parâmetros que podemos passar para dentro do view e o terceiro sendo o título da página. Exemplo:
```bash
  View::render('home', [
    'userId' => 50
  ], 'Início')
```
Na parte de view tem também o footer e o header da página nas rotas `resources/Views/footer.html` e `resources/Views/header.html`. Caso não haja um dos arquivos ou forem deletados, não irão ser renderizados na tela.

## Model

Em construção...












